<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();  // Fetch all products
        return view('products', compact('products'));  // Pass products to the home view
    }
  
    public function showform()
    {
        return view('admin.products.createproducts');
    }

  public function store(Request $request)
  {
    $request->validate([
        'name' => 'Required|max:255|string',
        'image' => 'required|mimes:png,jpg,jpeg,webp'
    ]);


    if($request->has('image')){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename = time().'.'.$extension;

        $path = 'uploads/products/';
        $file->move($path,$filename);
    }

    Product::create([
        'name' => $request->name,
        'price'  => $request->price,
        'stock'  => $request->stock,
        'image'  => $path.$filename
    ]);

    return redirect('/createproducts')->with('status','product created');
  }


  public function adminproduct()
  {
    $products = Product::all();  // Fetch all products
    return view('admin.products.adminproducts', compact('products'));  
  }

  public function edit(int $id)
  {
    $products = Product::findorfail($id);
    return view('admin.products.editproducts', compact('products'));  

  }
   
   public function update( Request $request, int $id)
   {
    $request->validate([
        'name' => 'Required|max:255|string',
        'image' => 'required|mimes:png,jpg,jpeg,webp'
    ]);
   $products = Product::findorfail($id);
    if($request->has('image')){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $filename = time().'.'.$extension;

        $path = 'uploads/products/';
        $file->move($path,$filename);

        if(File::exists($products->image)){
              File::delete($products->image);
        }
    }
          $products->update([
        'name' => $request->name,
        'price'  => $request->price,
        'stock'  => $request->stock,
        'image'  => $path.$filename
    ]);

    return redirect()->back()->with('status','product updated');
  
   }

}
