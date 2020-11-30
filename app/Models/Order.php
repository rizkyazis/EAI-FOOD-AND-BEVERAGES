<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable =[
        'name','transaction_code','menu_id','quantity','chef_id','waiter_id'
    ];

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }
}
