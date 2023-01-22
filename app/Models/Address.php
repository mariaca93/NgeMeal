<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{

    use HasFactory;
    protected $table='address';
    protected $fillable=['user_id','full_name','address_type','address','lat','lang','landmark','building','mobile'];
}
