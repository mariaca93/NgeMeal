<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    public function addtocart() {
        if($_POST['type'] == 'insert'){
            dd("abc");
            // $slug = mysqli_real_escape_string($db, $_POST['slug']);
            // $item_name = mysqli_real_escape_string($db, $_POST['item_name']);
            // $item_type = mysqli_real_escape_string($db, $_POST['item_type']);
            // $image_name = mysqli_real_escape_string($db, $_POST['image_name']);
            // $item_tax = mysqli_real_escape_string($db, $_POST['item_tax']);
            // $item_price = mysqli_real_escape_string($db, $_POST['item_price']);
            // $variation_id = mysqli_real_escape_string($db, $_POST['variation_id']);
            // $variation_name = mysqli_real_escape_string($db, $_POST['variation_name']);
            // $addons_id = mysqli_real_escape_string($db, $_POST['addons_id']);
            // $addons_name = mysqli_real_escape_string($db, $_POST['addons_name']);
            // $addons_price = mysqli_real_escape_string($db, $_POST['addons_price']);
            // $query = "INSERT INTO cart (item_name,item_type,addons_id,addons_name,addons_price,variation_id ) VALUES ('$item_name','$item_type','$addons_id','$addons_name','$addons_price','$variation_id' )";
          
            // if(mysqli_query($db, $query)){
            //   $last_id = mysqli_insert_id($db);
            //   echo "Sukses";
            // }else{
            //   echo "error";
            // }
        }
    }
}