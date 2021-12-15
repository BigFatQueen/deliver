<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['code','order_code','recipient_name','order_date','address_id','user_id','cus_address','phone','status_id','goods','weight','qty','price'];
    

    public function user(){
    return $this->belongsTo(User::class);
    }

    public function contact(){
        return $this->belongsTo(Contact::class,'address_id');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
