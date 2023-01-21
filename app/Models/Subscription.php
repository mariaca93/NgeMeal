<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Subscription extends Model
{
    use HasFactory;
    protected $table='subscription';
    protected $fillable=['subscription_name','subscription_type','item_id','id', 'price', 'image', 'slug'];

}