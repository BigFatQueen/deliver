<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use DataTable;
class BackendController extends Controller
{

    public function dashboard(){
        return view('admin.dashboard');
    }
    

    //customer start
public function customerIndex(){
        $users = User::role('customer')->get();
        dd($users);
         return view('backend/tour',compact('tour'));
    }


    //admin order CRUD start
    public function orderIndex(Request $request){

         if ($request->ajax()) {
             $orders=Order::with('user','contact.city')->orderBy('id','desc')->get();

              return DataTable::of($orders)
                ->addColumn('action',function($order){

                    return "<button class='btn btn-danger btn-delete' data-id=".$order->id."><i class='fas fa-trash'></i></button>

                    <a href=admin/order/$order->id/edit class='btn btn-warning btn-edit' data-id=".$order->id."><i class='fas fa-edit'></i></a>



                    <a href=admin/order/$order->id class='btn btn-info btn-detail' data-id=".$order->id."><i class='fas fa-info-circle'></i></a>
                    ";
                })->make(true);

       
        }

       return view('admin.order.list');
    }

    public function getOrderByAjax(){
         $orders=Order::with('user','contact.city')->orderBy('id','desc')->get();

          $datatables=DataTable::of($orders)
            ->addColumn('action',function($order){

                return "<button class='btn btn-danger btn-delete' data-id=".$order->id."><i class='fas fa-trash'></i></button>

                <a href=admin/order/$order->id/edit class='btn btn-warning btn-edit' data-id=".$order->id."><i class='fas fa-edit'></i></a>



                <a href=admin/order/$order->id class='btn btn-info btn-detail' data-id=".$order->id."><i class='fas fa-info-circle'></i></a>
                ";
            });

       return $datatables->make(true);
    }

    public function  orderCreate(){

        return view('admin.order.create');
    }




}
