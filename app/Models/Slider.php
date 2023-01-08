<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Slider extends Model
{
    protected $table='slider';
    protected $fillable=['image','title','description'];
    public function item_info(){
        return $this->hasOne('App\Models\Item','id','item_id')->select('id','item_name','slug');
    }
    public function cuisine_info(){
        return $this->hasOne('App\Models\Cuisine','id','cuisine_id')->select('id','cuisine_name','slug');
    }
}