<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Favorite extends Model

{

    protected $table='favorite';

    protected $fillable=['user_id','item_id'];


}