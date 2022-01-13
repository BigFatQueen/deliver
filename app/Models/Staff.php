<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Authenticatable
{
    use HasFactory,HasRoles, Notifiable;
    protected $table='staffs';
    protected $guard='staff';
    protected $guard_name="staff";
    protected $fillable = [
            'name', 'email', 'password','dob','phone','address'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    
    

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

    public function scopeIsActive($query)
    {
        return $query->where('is_active',1);
    }

}
