<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;


class Ingredient extends Model

{

    protected $table='ingredient';

    protected $fillable=['ingredient_name','measurement','price'];


    public function items(){

        return $this->belongsToMany('App\Model\Item', 'item_ingredient', 'ingredient_id', 'item_id')->withPivot('quantity');
    }

}

