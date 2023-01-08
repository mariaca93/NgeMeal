<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notification';
    protected $fillable=['title','message'];

    public function cuisine_info(){
        return $this->hasOne('App\Models\Cuisine','id','cuisine_id')->select('id','cuisine_name',\DB::raw("CONCAT('".url('/storage/app/public/admin-assets/images/cuisine/')."/', image) AS image_url"));
    }
    public function item_info(){
        return $this->hasOne('App\Models\Item','id','item_id')->select('id','item_name',\DB::raw("CONCAT('".url('/storage/app/public/admin-assets/images/item/')."/', image) AS image_url"));
    }
}
