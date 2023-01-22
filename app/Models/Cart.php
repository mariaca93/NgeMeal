<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Cart extends Model

{

    use HasFactory;
    protected $table='cart';

    protected $fillable=['user_id','item_id','addons_id','qty','price'];

}

