<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Status;
use DataTable;
use DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderImport;
use App\Http\Resources\ExcelResource;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class BackendController extends Controller
{
    public function permissionDelete($id)
    {
       $permission=Permission::find($id);
       $permission->delete();
       return response()->json(['status'=>'200']);
    }
    public function permissionUpdate(Request $request,$id){
        
        $permissions=Permission::find($id);
        $permissions->name=$request->ename;
        $permissions->save();
        return back();
    }
    public function permissionStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            
        ]);
          Permission::create(['name' => $request->get('name')]);
          return back();
    }

    public function permissionIndex(Request $request){

         if ($request->ajax()) {
            $permission=Permission::get();
            return DataTable::of($permission)->addIndexColumn()->make(true);
         }

        return view('admin.rp.permission_index');
    }

    public function roleDelete($id){
        $role=Role::find($id)->delete();
        return redirect()->route('admin.rp.index')
                        ->with('success','Role deleted successfully');
    }

    public function roleUpdate(Request $request,$id){
        $this->validate($request, [
                'name' => 'required',
                'permission' => 'required',
            ]);
        $role=Role::find($id);

         $role->update($request->only('name'));
    
        $role->syncPermissions($request->get('permission'));

         return redirect()->route('admin.rp.index')
                        ->with('success','Role updated successfully');

    }

    public function roleEdit($id){
        $role=Role::find($id);
       // dd($role);
        $rolePermissions=$role->permissions->pluck('name')->toArray();
        // dd($rolePermissions);
        $permissions = Permission::get();

        return view('admin.rp.role_edit',compact('role', 'rolePermissions', 'permissions'));
    }

    public function roleShow($id){
        $role=Role::find($id);
        $permissions=$role->permissions;
        return response()->json($permissions);
    }
    public function roleStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        
          $role = Role::create(['name' => $request->get('name')]);
        $role->syncPermissions($request->get('permission'));

        return redirect()->route('admin.rp.index');
    }
    public function roleCreate(){
        $permissions=Permission::get();
         return view('admin.rp.role_create',compact('permissions'));
    }
    public function roleIndex(){
         $roles = Role::orderBy('id','asc')->get();
         $permissions=Permission::get();
        return view('admin.rp.index',compact('roles','permissions'));
    }
    public function orderImport(){
        $customers=User::role('customer')->get();
        return view('admin.order.import',compact('customers'));
    }

    public function readExcel(Request $request){
        $sender=$request->sender;
        // dd($sender);
        $rows = Excel::toArray(new OrderImport, request()->file('file'));

        $newRecords=[];
       
       foreach($rows[0] as $k=>$value){
            foreach($value as $i=>$v){
                if($i == 'address'){

                   $data= Contact::whereHas('user',function($q)use($sender){
                    return $q->where('id',$sender);
                   })->find($v);
                   
                   if($data!=null){
                    $value[$i]=$data->full_address."(".$data->city->name.")";
                    $value['color']='';
                   }else{
                    $value[$i]="unknow address";
                    $value['color']='red';
                   }
                }
            }
            array_push($newRecords, $value);
       }

      return response()->json($newRecords);


    }

    public function importExcel(Request $request){
        // dd($request);
        $sender=$request->sender;
        

     Excel::import(new OrderImport($sender), $request->file('file'));
        return redirect()->route('admin.order.list');
    }



    public function dashboard()
    {
        return view('admin.dashboard');
    }


    //customer start
    public function customerIndex()
    {
        $users = User::role('customer')->get();
        // dd($users);
        return view('admin.user.customer_index', compact('users'));
    }

    //admin crud order

    public function orderIndex(Request $request){
                $status=Status::all();
                 $statusControl='';
           

               $colors = [
                            1=> "#ff0000",
                            2=>"#2196f3",
                            3=> "#5417c1",
                            4=> "#03ad0a",
                             ];

        if ($request->ajax()) {
            if($request->get('start_date')){
                 $start = Carbon::parse($request->start_date)->format('Y-m-d ');
                $end = Carbon::parse($request->end_date)->format('Y-m-d');

        $orders = Order::whereBetween(DB::raw('date(order_date)'), [$start, $end])->get();

            }else{
                  $orders=Order::all();
            }
           $collection = collect($orders);
                 $unique = $collection->unique('order_code');
                 $orders=$unique->values()->all();


            return DataTable::of($orders)
            ->addIndexColumn()
            ->addColumn('OrderCode', function ($order) use ($colors) {
                return '<span class="order-code">Order No: '.$order->order_code.'</span>
                        <br />
                        <span class="order-code">date: '.$order->order_date.'</span><br/>
                        <span class="badge" style="background-color:'.$colors[$order->status_id].' ">'.$order->status->name.'</span>';

                })
                 ->addColumn('recipiant', function ($order) {
                     return '<span class=""> '.$order->recipient_name.'</span>
                        <br />'.'<span class="order-code">Ph:'.$order->phone.'</span>';
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
                ->addColumn('statusAction', function ($order) use ($status,$colors,$statusControl) {
                     

                    $statusControl.='<div class="btn-group dropstart">
                        <button class="btn btn-outline-success" type="button" id="dropdownMenu3" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fas fa-sync"></i>
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu3">';



                        foreach($status as $s){
                          $statusControl.=' <li><a class="dropdown-item statusHandle" data-statusid="'.$s->id.'" data-orderCode="'.$order->order_code.'" style="color:'.$colors[$s->id].'" href="#">'.$s->name.'</a></li>';


                        }

                        $statusControl.='</ul> </div>';

                     return $statusControl;
                })
                
                ->rawColumns(['OrderCode','recipiant','action','statusAction','address'])
                ->toJson();
        }

        return view('admin.order.list');
    }



    public function getOrderByAjax()
    {
        $orders = Order::with('user', 'contact.city')->orderBy('id', 'desc')->get();

        $datatables = DataTable::of($orders)
            ->addColumn('action', function ($order) {

                return "<button class='btn btn-danger btn-delete' data-id=" . $order->id . "><i class='fas fa-trash'></i></button>

                <a href=admin/order/$order->id/edit class='btn btn-warning btn-edit' data-id=" . $order->id . "><i class='fas fa-edit'></i></a>



                <a href=admin/order/$order->id class='btn btn-info btn-detail' data-id=" . $order->id . "><i class='fas fa-info-circle'></i></a>
                ";
            });

        return $datatables->make(true);
    }

    public function  orderCreate()
    {
        $customers=User::role('customer')->get();
       // $contacts = Contact::all();

        return view('admin.order.create', compact('customers'));
    }

    public function getAddressByuid($id){
        $addresses=Contact::with('city')->where('user_id',$id)->get();
        if($addresses == !''){
             return response()->json(['status'=>'200','data'=>$addresses]);
        }else{
             return response()->json(['status'=>'300','data'=>$addresses]);
        }
       
    }



   
}
