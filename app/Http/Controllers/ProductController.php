<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Display Products Table (based on logged-in user)
    public function productsTable()
    {
        $userId = session('user_id');
        $products = Product::where('user_id', $userId)->get();
        
        return view('products', compact('products'));
    }

    // Add Product
public function addProduct(Request $request)
{
    $userId = session('user_id');
    
    if (!$userId) {
        return redirect()->back()->with('error', 'Please login first');
    }

    Product::create([
        'product_name' => $request->product_name,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'user_id' => $userId,
    ]);

    return back()->with('success', 'Product added successfully');
}
   public function updateProduct(Request $request, $id)
{
    $userId = session('user_id');
    
    // Get the existing product with user check
    $product = Product::where('id', $id)->where('user_id', $userId)->first();
    
    if(!$product){
        return back()->with('error', 'Product not found');
    }

    // Update with user_id included to satisfy database constraint
    Product::where('id', $id)->update([
        'product_name' => $request->product_name,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'user_id' => $userId  // Add this to prevent null error
    ]);

    return back()->with('success', 'Product updated successfully');
}
    // Delete Product
    public function deleteProduct($id)
    {
        $userId = session('user_id');
        
        // Find product and check ownership
        $product = Product::where('id', $id)->where('user_id', $userId)->first();
        
        if(!$product){
            return back()->with('error', 'Product not found or access denied');
        }
        
        $product->delete();
        
        return back()->with('success', 'Product deleted successfully');
    }
}