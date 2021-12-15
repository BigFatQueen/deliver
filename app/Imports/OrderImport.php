<?php

namespace App\Imports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Contact;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class OrderImport implements ToModel,ToCollection,WithHeadingRow
{
    private $contacts;
    private $orders;
    private $sender;
    public function __construct($sender=''){
        $this->sender=$sender;
        $this->contacts=Contact::with('city')->get();
        $this->orders=Order::select('order_code')->get();
    }

    public function collection(Collection $rows)
       {
        //dd($rows);
        return $rows;
       }
   
     public function model(array $row)
    {

        
        // generateCode start

            $orderCode=$this->generateCode($row['address']);
            // dd($orderCode);

        return new Order([
             'code' => $row['code'],
                'order_code' =>$orderCode,
                'recipient_name' => $row['recipient_name'],
                'order_date' => Carbon::now()->toDateString(),
                'address_id' => $row['address'],
                'user_id' => $this->sender,
                'phone' => $row['recipient_phone'],
                'status_id' => '1',
                'goods' => $row['goods_name'],
                'qty' => 1,
                'price' => $row['price'],
                'weight'=>$row['weight']
        ]);
    }

        public function generateCode($id)
    {
          // dd($id);
        $contact=$this->contacts->find($id);

        $city=$contact->city->abb;
        $finalCode=null;
        
        // dd($city)
        $order=Order::select('order_code')->where('order_code', 'like', "%NPT-%")->get()->last();

        // dd($order);


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

?>