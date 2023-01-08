<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Subcuisine extends Model
{
    use HasFactory;
    protected $table='subcuisines';
    protected $fillable=['name','cuisine_id','is_available','is_deleted'];
    public function cuisine_info(){
        return $this->hasOne('App\Models\Cuisine','id','cuisine_id')->select('cuisines.id','cuisines.cuisine_name',\DB::raw("CONCAT('".url('/storage/app/public/admin-assets/images/cuisine/')."/', image) AS image_url"));
    }
}