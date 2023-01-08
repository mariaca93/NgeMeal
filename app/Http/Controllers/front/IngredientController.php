<?php

namespace App\Http\Controllers\front;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Ingredient::select("ingredent_name as value", "id")
                    ->where('ingredeint_name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}
