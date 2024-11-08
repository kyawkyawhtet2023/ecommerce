<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductItemRequest;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ProductController extends Controller
{
    
   

    public function index(Request $request)
{
    $searchName = $request->input('search_name');
    $searchBarcode = $request->input('search_barcode');
    $searchSku = $request->input('search_sku');
    $query = Product::query();

    if ($request->has('status')) {
        $status = $request->input('status');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        } elseif ($status === 'out_of_stock') {
            $query->whereHas('productItems', function ($query) {
                $query->where('quantity', 0);
            });
        }
    }


    if ($request->has('search_name')) {
        $searchName = $request->input('search_name');
        $query->where('name', 'like', "%{$searchName}%");
    }

    if ($request->has('search_barcode')) {
        $searchBarcode = $request->input('search_barcode');
        $query->whereHas('productItems', function ($query) use ($searchBarcode) {
            $query->where('barcode', 'like', "%{$searchBarcode}%");
        });
    }

    if ($request->has('search_sku')) {
        $searchSku = $request->input('search_sku');
        $query->whereHas('productItems', function ($query) use ($searchSku) {
            $query->where('sku', 'like', "%{$searchSku}%");
        });
    }

    $products = $query->with('category', 'productItems')->paginate(10); 

    return view('dashboard.app.products.index', compact('products'));
}





public function bulkAction(Request $request)
{
    $request->validate([
        'action' => 'required|string',
        'product_ids' => 'required|array',
        'product_ids.*' => 'integer|exists:products,id',
    ]);

    $action = $request->input('action');
    $productIds = $request->input('product_ids');

    try {
        if ($action === 'delete') {
            // Delete the products
            Product::destroy($productIds);
        } elseif ($action === 'deactivate') {
            // Deactivate the products
            Product::whereIn('id', $productIds)->update(['is_active' => false]); // assuming 'active' is the field for status
        }

        return response()->json(['success' => true, 'message' => 'Products processed successfully.']);
    } catch (\Exception $e) {
        \Log::error($e);
        return response()->json(['success' => false, 'message' => 'An error occurred while processing your request.'], 500);
    }
}




public function toggleStatus(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $product->is_active = $request->input('is_active');
    $product->save();

    return response()->json(['status' => 'success', 'is_active' => $product->is_active]);
}


    public function create()
    {
        $categories = Category::all(); 
        return view ('dashboard.app.products.create' , compact('categories'));
    }
    

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:category,id',
        'image_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'highlight' => 'required|string',
        'description' => 'required|string',
        'item-name.*' => 'required|string',
        'quantity.*' => 'required|integer|min:1',
        'price.*' => 'required|numeric|min:0',
        'sku.*' => 'required|string',
        'barcode.*' => 'required|string',
        'height.*' => 'nullable|numeric',
        'width.*' => 'nullable|numeric',
        'length.*' => 'nullable|numeric',
        'weight.*' => 'nullable|numeric',
    ]);

    
    $product = new Product();
    $product->name = $request->input('name');
    $product->category_id = $request->input('category_id');
    $product->highlight = $request->input('highlight');
    $product->description = $request->input('description');
    
   
    for ($i = 1; $i <= 6; $i++) {
        if ($request->hasFile("image_$i")) {
            $imagePath = $request->file("image_$i")->store('products', 'public');
            $product->{"image_$i"} = $imagePath;
        }
    }
    
    $product->save();

    
    foreach ($request->input('item-name') as $index => $itemName) {
        $productItem = new ProductItem();
        $productItem->product_id = $product->id;
        $productItem->name = $itemName;
        $productItem->quantity = $request->input('quantity')[$index];
        $productItem->price = $request->input('price')[$index];
        $productItem->sku = $request->input('sku')[$index];
        $productItem->barcode = $request->input('barcode')[$index];
        $productItem->height = $request->input('height')[$index];
        $productItem->width = $request->input('width')[$index];
        $productItem->length = $request->input('length')[$index];
        $productItem->weight = $request->input('weight')[$index];

        
        if ($request->hasFile('image')) {
            $itemImagePath = $request->file('image')[$index]->store('items', 'public');
            $productItem->image = $itemImagePath;
        }

        $productItem->save(); 
    }

    
    return redirect()->route('products.index')->with('success', 'Product created successfully');
}


    

    
    public function show(string $id)
    {
        $product = Product::with('category', 'productItems')->findOrFail($id);
        return view('dashboard.app.products.show', compact('product'));
    }


  
    public function edit(string $id)
    {
        $product = Product::with('productItems')->findOrFail($id);
        $categories = Category::all();
        return view('dashboard.app.products.edit', compact('product', 'categories'));
    }


    
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'highlight' => 'required|string',
            'description' => 'required|string',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_6' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'item-name.*' => 'required|string',
            'quantity.*' => 'required|integer|min:1',
            'price.*' => 'required|numeric|min:0',
            'sku.*' => 'required|string',
            'barcode.*' => 'required|string',
            'height.*' => 'nullable|numeric',
            'width.*' => 'nullable|numeric',
            'length.*' => 'nullable|numeric',
            'weight.*' => 'nullable|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->highlight = $request->input('highlight');
        $product->description = $request->input('description');

        // Handle image uploads
        for ($i = 1; $i <= 6; $i++) {
            if ($request->hasFile("image_$i")) {
                $imagePath = $request->file("image_$i")->store('products', 'public');
                $product->{"image_$i"} = $imagePath;
            }
        }
        
        $product->save();

        // Update product items
        foreach ($request->input('item-name') as $index => $itemName) {
            $productItem = ProductItem::findOrFail($request->input('id')[$index]); // Assume there's an input field for item IDs
            $productItem->name = $itemName;
            $productItem->quantity = $request->input('quantity')[$index];
            $productItem->price = $request->input('price')[$index];
            $productItem->sku = $request->input('sku')[$index];
            $productItem->barcode = $request->input('barcode')[$index];
            $productItem->height = $request->input('height')[$index];
            $productItem->width = $request->input('width')[$index];
            $productItem->length = $request->input('length')[$index];
            $productItem->weight = $request->input('weight')[$index];

            // Handle image uploads for items
            if ($request->hasFile('item-image')[$index]) {
                $itemImagePath = $request->file('item-image')[$index]->store('items', 'public');
                $productItem->image = $itemImagePath;
            }

            $productItem->save(); 
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }


    
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        $product->productItems()->delete();

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

}
