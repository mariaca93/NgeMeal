<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Cuisine extends Model

{

    protected $table='cuisines';

    protected $fillable=['cuisine_name','image'];

    public function cuisine_info(){
        return $this->hasOne('App\Models\Cuisine','id')->select('id','cuisine_name','slug');
    }

}