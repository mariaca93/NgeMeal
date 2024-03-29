<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Order extends Model
{
    use HasFactory;
    protected $table='order';
    protected $fillable=['user_id','order_total','transaction_id','transaction_type','address'];
    public function user_info(){
        return $this->hasOne('App\Models\User','id','user_id')->select('id','name','email','mobile','token',DB::raw("CONCAT('".url('/storage/app/public/admin-assets/images/profile/')."/', profile_image) AS profile_image"));
    }
    public function driver_info(){
        return $this->hasOne('App\Models\User','id','driver_id')->select('id','name','email','mobile','token',DB::raw("CONCAT('".url('/storage/app/public/admin-assets/images/profile/')."/', profile_image) AS profile_image"));
    }
}