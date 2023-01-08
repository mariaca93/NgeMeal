<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $table='item';
    protected $fillable=['cuisine_id','item_name','item_description','item_price','delivery_time'];
    public function variation(){
        return $this->hasMany('App\Models\Variation','item_id','id')->select('variation.id','variation.item_id','variation.variation','variation.product_price','variation.sale_price');
    }
    public function subcuisine_info(){
        return $this->hasOne('App\Models\Subcuisine','id','subcuisine_id')->select('subcuisines.id','subcuisines.subcuisine_name','subcuisines.slug');
    }
    public function cuisine_info(){
        return $this->hasOne('App\Models\Cuisine','id','cuisine_id')->select('cuisines.id','cuisines.cuisine_name','cuisines.slug',\DB::raw("CONCAT('".url('/admin-assets/images/cuisine/')."/', image) AS image_url"));
    }
    public function item_image(){
        return $this->hasOne('App\Models\ItemImages','item_id','id')->select('item_images.id','item_images.image as image_name','item_images.item_id',\DB::raw("CONCAT('".url('/admin-assets/images/item/')."/', item_images.image) AS image_url"));
    }
    public function item_images(){
        return $this->hasMany('App\Models\ItemImages','item_id','id')->select('item_images.id','item_images.image as image_name','item_images.item_id',\DB::raw("CONCAT('".url('/admin-assets/images/item/')."/', item_images.image) AS image_url"));
    }
    public function ingredients(){
        return $this->belongsToMany('App\Models\Ingredient', 'item_ingredient')->withPivot('quantity');
    }
}