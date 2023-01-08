<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;


class ItemIngredient extends Model

{

    protected $table='item_ingredient';

    protected $fillable=['item_id','ingredient_id','quantity'];



    public function ingredient(){

        return $this->hasOne('App\Models\Ingredient','id','ingredient_id');

    }

}

