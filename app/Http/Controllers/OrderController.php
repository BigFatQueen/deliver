<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Contact;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function orderCreatedByUser(){
        $contacts=Contact::where('user_id',3)->get();
        return view('user.order_create',compact('contacts'));
    }

    public function orderStoredByUser(Request $request){
      
        $request->validate([
            'codes' => 'required',
            'contact_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'qty' => 'required',
        ]);

        //dd($request);

        $codes=$request->codes;
        $codesArray=explode(',',$codes);

        $order_date=Carbon::now();
        $order_code=$this->generateRandomString(5);

        
        
        foreach($codesArray as $item){
            Order::create([
                'code'=>$item,
                'order_code'=>$order_code,
                'recipient_name'=>$request->name,
                'order_date'=>$order_date,
                'contact_id'=>$request->contact_id,
                'user_id'=>'3',
                'phone'=>$request->phone,
                'status_id'=>'1',
                'goods'=>$request->goodsNames,
                'qty'=>$request->qty,
                'price'=>$request->price,
            ]);
        }

        return response()->json([
    'status' => '200',
    'msg' => 'Data is added successfully!',
]);

    }

    function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }



    function orderDestroy($id){
        $order=Order::find($id);
        $order->delete();
        return back();
    }

    

    
}
