<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable =[
        'customer_id','waiter_id','status'
    ];

    public function menu(){
        return $this->hasMany('App\Models\OrderMenu');
    }

}
