<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable =[
        'name','type','description','price','category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function ingredients(){
        return $this->hasMany('App\Models\MenuIngredients');
    }

    public function order(){
        return $this->hasMany('App\Models\Order');
    }
}
