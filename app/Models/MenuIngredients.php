<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuIngredients extends Model
{
    use HasFactory;

    protected $table = 'menu_ingredients';

    protected $fillable =[
        'name','menu_id','ingredient_id','quantity'

    ];

    public function menu(){
        return $this->belongsTo('App\Models\Menu');
    }
}
