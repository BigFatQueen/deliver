<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;
use DataTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderImport;

class OrderController extends Controller
{
    public function orderCreatedByUser()
    {

        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        return view('user.order_create', compact('contacts'));
    }

    public function orderStoredByUser(Request $request)
    {
       
        
        $request->validate([
            'codes' => 'required',
            'contact_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'qty' => 'required',
        ]);



       $role=Auth::user()->roles[0]['name'];
        if($role== 'admin'){
            $id=$request->sender;
        }else{
            $id=Auth::user()->id;
        }
        
        

        $codes = $request->codes;
        $codesArray = explode(',', $codes);
        

        $order_date = Carbon::now()->toDateString();
        $order_code = $this->generateCode($request->contact_id);
       

        foreach ($codesArray as $item) {
            Order::create([
                'code' => $item,
                // 'code' => $this->changeCode($item,$request->contact_id),
                'order_code' => $order_code,
                'recipient_name' => $request->name,
                'order_date' => $order_date,
                'address_id' => $request->contact_id,
                'user_id' => $id,
                'phone' => $request->phone,
                'status_id' => '1',
                'goods' => $request->goodsNames,
                'qty' => $request->qty,
                'price' => $request->price,
                'weight'=>$request->weight
            ]);
        }

        return response()->json([
            'status' => '200',
            'msg' => 'Data is added successfully!',
        ]);
    }

    

    public function generateCode($id)
    {
        $contact=Contact::with('city')->find($id);
        $city=$contact->city->abb;
        $finalCode=null;
        
        
        $order=Order::select('order_code')->where('order_code', 'LIKE', "%{$city}%")->get()->last();
        
       

        if($order ==null){
             $codeno = $city.'-0001';
             $finalCode= $codeno;

        }else{
            $codeno = $order->order_code;
            $pos= explode('-',$codeno);
            $id=$pos[1];
        

            if ($id >= 9999) {
                $id = 0;
                $id = str_pad($id, 4, '0', STR_PAD_LEFT);
                $alpha++;
            } else {
                $id = str_pad($id + 1, 4, '0', STR_PAD_LEFT);
            }
            
            $finalCode=$pos[0].'-'.$id;
        }

        
        

        return $finalCode;



       
    }

    // function generateRandomString($length = 20,id) {

    //         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //         $charactersLength = strlen($characters);
    //         $randomString = '';
    //         for ($i = 0; $i < $length; $i++) {
    //             $randomString .= $characters[rand(0, $charactersLength - 1)];
    //         }
    //         return $randomString;
    // }

    function orderDetail($id)
    {
        $order = Order::find($id);
        return view('user.order_detail', compact('order'));
    }

    function orderDestroy($id)
    {
        
        $order = Order::find($id);
        $order->delete();
       return back();
    }

    function orderDeleteByAdmin($id){
        $order = Order::find($id);
        $order->delete();
        return response()->json(['status'=>200]);

    }

     public function orderDetailByAdmin($id){
         $order=Order::find($id);
         
        
         $others=collect(Order::where('order_code',$order->order_code)->get(['code']));
        $others=$others->groupBy('code')->keys()->all();
        $others=implode(',', $others);
       
         return view('admin.order.detail',compact('order','others'));
     }


     public function changeOrderStatus(Request $request){
         $orderCode=$request->orderCode;
         $statusid=$request->sid;

         $orders=Order::where('order_code',$orderCode)->get();

            foreach($orders as $order){
                $order->status_id=$statusid;
                $order->save();
            }

            return response()->json(['status'=>'200']);

     }

     public function orderDateFilter(Request $request){
         $start=$request->start;
         $end=$request->end;

         $orders=Order::whereBetween(DB::raw('DATE(order_date)'), [$start, $end])
                        ->latest()
                        ->get()
                        ->unique('order_code');

          $status=Status::all();

          //dd($orders);

          $colors = [
          1=> "#ff0000",
          2=>"#2196f3",
          3=> "#5417c1",
          4=> "#03ad0a",
          ];


          return DataTable::of($orders)
                    ->addIndexColumn()
                    ->addColumn('OrderCode', function ($order) use ($colors) {
                    return '<span class="order-code">Order No: '.$order->order_code.'</span>
                    <br />
                    <span class="order-code">date: '.$order->order_date.'</span><br />
                    <span class="badge" style="background-color:'.$colors[$order->status_id].' ">'.$order->status->name.'</span>';


                    })

                    ->addColumn('address', function ($order) {
                    return $order->contact->full_address.','.$order->contact->city->name;
                    })
                    ->addColumn('action', function ($order) {

                    return '<div class=dropdown">
                        <button class="btn btn-outline-danger " type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tools"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                            <li><button class="dropdown-item btn-edit" type="button" data-id="' .
                                    $order->id
                                    . '"><i class="fas fa-edit text-warning "></i> Edit</button></li>
                            <li><button class="dropdown-item btn-delete" type="button" data-id="' .
                                    $order->id
                                    . '"><i class="fas fa-trash text-danger "></i> Delete</button></li>

                            <li><button class="dropdown-item btn-detail" type="button" data-id="' .
                                    $order->id
                                    . '"> <i class="fas fa-info-circle text-info "></i> Detail</button></li>

                        </ul>
                    </div>';
                    })
                    ->addColumn('statusAction', function ($order) use ($status,$colors) {
                    $statusControl='';

                    $statusControl.='<div class="btn-group dropstart">
                        <button class="btn btn-outline-success" type="button" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fas fa-sync"></i>
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">';



                            foreach($status as $s){
                            $statusControl.=' <li><a class="dropdown-item statusHandle" data-statusid="'.$s->id.'" data-orderCode="'.$order->order_code.'" style="color:'.$colors[$s->id].'" href="#">'.$s->name.'</a></li>';


                            }

                            $statusControl.='</ul>
                    </div>';
                    return $statusControl;
                    })
                    ->rawColumns(['OrderCode','action','statusAction'])->make(true);

     }

     public function orderEditByAdmin($id){
        $order=Order::find($id);
        $others=collect(Order::where('order_code',$order->order_code)->get(['code']));
        $others=$others->groupBy('code')->keys()->all();
        $others=implode(',', $others);
        $customers=User::role('customer')->get();
        return view('admin.order.edit',compact('customers','others','order'));
     }


     public function orderUpdateByAdmin(Request $request,$id){
        $order=Order::find($id);
        $orders=$order::where('order_code',$order->order_code)->get();
            foreach($orders as $k){
                $k->recipient_name=$request->name;
                $k->address_id=$request->contact_id;
                $k->user_id=$request->sender;
                $k->phone=$request->phone;
                $k->goods=$request->goodsNames;
                $k->weight=$request->weight;
                $k->price=$request->price;

                $k->save(); 

            }
        return redirect()->route('admin.order.list');
     }

     public function UserImportfileReading(){
        return view('user.importData.index');
     }

     public function fileImport(Request $request) 
    {
        // dd($request);

        $sender=Auth::user()->id;
        Excel::import(new OrderImport($sender), $request->file('file'));
        return redirect('/user/order/list');
    }



}
