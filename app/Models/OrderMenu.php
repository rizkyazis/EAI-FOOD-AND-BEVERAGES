<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    use HasFactory;

    protected $table = 'order_menus';

    protected $fillable = [
        'order_id', 'menu_id','quantity', 'status', 'chef_id'
    ];

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }

    public function order(){
        $this->belongsTo('App\Models\Order');
    }
}
