<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Http\Controllers\OrderController;
use App\Models\Contact;
use Carbon\Carbon;

class OrderImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Order([
             'code' => $row[0],
                'order_code' =>$this->generateCode($row[3]),
                'recipient_name' => $row[1],
                'order_date' => Carbon::now()->toDateString(),
                'address_id' => $row[3],
                'user_id' => Auth::user()->id,
                'phone' => $row[2],
                'status_id' => '1',
                'goods' => $row[4],
                'qty' => 1,
                'price' => $row[6],
                'weight'=>$$row[5]
        ]);
    }

    public function generateCode($id)
    {
        dd($id);
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


}
