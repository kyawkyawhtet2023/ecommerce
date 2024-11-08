<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;

class ProductItemController extends Controller
{
    
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'price' => 'nullable|numeric|min:0',
            'quantity' => 'nullable|integer|min:0',
        ]);

        
        $productItem = ProductItem::find($id);

       
        if (!$productItem) {
            return response()->json(['error' => 'Product item not found.'], 404);
        }

        
        if ($request->has('price')) {
            $productItem->price = $request->input('price');
        }
        if ($request->has('quantity')) {
            $productItem->quantity = $request->input('quantity');
        }

        
        $productItem->save();

        
        return response()->json(['message' => 'Product item updated successfully.', 'productItem' => $productItem], 200);
    }



    public function toggleStatus(Request $request, $id)
{
    $product = ProductItem::findOrFail($id);
    $product->is_active = $request->input('is_active');
    $product->save();

    return response()->json(['status' => 'success', 'is_active' => $product->is_active]);
}
}
