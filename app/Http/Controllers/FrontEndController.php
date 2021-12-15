<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Order;
use Auth;

class FrontEndController extends Controller
{
    public function userHomePage(){
        return view('user.home');
    }
    public function userInfo(){
        return view('user.info_page');
    }

    public function userAddressList(){
        $contacts=Contact::where('user_id',3)->get();
        return view('user.address_list_page',compact('contacts'));
    }

    public function userOrderList(){

        $orders=Order::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
       
        /*$orders=$orders->groupBy('order_code');
        $newarray=[];$codes='';
        
        foreach($orders as $k=>$order)
        {
            
            foreach($order as $i){
                if($codes == ''){
                    $codes=$i->code;
                }else{
                    $codes.=','.$i->code;
                }
               
                $newarray[$k]['id']=$i->id;
                $newarray[$k]['codes']=$codes;
                $newarray[$k]['recipient_name']=$i->recipient_name;
                $newarray[$k]['order_date']=$i->order_date;
                $newarray[$k]['contact']=$i->contact->full_address.','.$i->contact->city->name;
                $newarray[$k]['user']=$i->user_id;
                $newarray[$k]['phone']=$i->phone;
                $newarray[$k]['status']=$i->status->name;
                $newarray[$k]['qty']=$i->qty;
                $newarray[$k]['price']=$i->price;
               
                
            }
            
          
        }

       

      
       
       
       $newOrders=$newarray;*/
       $newOrders=$orders;

        

        
        
        return view('user.order_list_page',compact('newOrders'));
    }

    public function orderSearch(Request $request){
       $keyword=$request->keyword;

       $orders=Order::with(['status','contact','contact.city','user'])->where('code', 'LIKE', "%{$keyword}%")->get();

       if(count($orders) < 1){
        return response()->json(['status'=>404,'data'=>$orders]);
       }else{
           return response()->json(['status'=>200,'data'=>$orders]);
       }
       
    }
}
