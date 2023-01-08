<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;


class Addons extends Model

{

    protected $table='addons';

    protected $fillable=['cuisine_id','item_id','name','price'];



    public function cuisine(){

        return $this->hasOne('App\Models\Cuisine','id','cuisine_id');

    }



    public function item(){

        return $this->hasOne('App\Models\Item','id','item_id');

    }

}

