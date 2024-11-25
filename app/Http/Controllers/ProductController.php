<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('products', compact('products')); // Pass products to the home view
    }
  
    public function adminproduct()
    {
        $products = Product::with('category')->get(); // Fetch products with their categories
        return view('admin.products.adminproducts', compact('products'));
    }
  
    public function showform()
    {
        $categories = Category::all(); // Fetch all categories for dropdown
        return view('admin.products.createproducts', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categories_id' => 'required|exists:categories,id', // Validate category ID exists
            'image' => 'nullable|mimes:png,jpg,jpeg,webp', // Validate image file
        ]);
        
        // Initialize the image path
        if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
    
            $filename = time().'.'.$extension;
    
            $path = 'uploads/products/';
            $file->move($path, $filename);
        }
        // Insert product into the database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $path.$filename, // Save the image path
            'categories_id' => $request->categories_id,
        ]);

        // Redirect back with a success message
        return redirect('/adminproducts')->with('status', 'Product created successfully');
    }


  
    public function edit(int $id)
    {
      $products = Product::findorfail($id);
      echo($products);
      return view('admin.products.editproducts', data: compact('products'));  
  
    }
     
    public function update(Request $request, int $id)
  {
      // Validate inputs
      $request->validate([
          'name' => 'required|min:3|max:255|string',
          'price' => 'required|numeric',
          'stock' => 'required|integer',
          'image' => 'nullable|mimes:png,jpg,jpeg,webp' // Image is optional
      ]);
  
      // Find the product or fail
      $products = Product::findOrFail($id);
  
      // Initialize the image path variable
      $imagePath = $products->image; // Default to the current image
  
      // Check if a new image is uploaded
      if ($request->hasFile('image')) {
          $file = $request->file('image');
          $extension = $file->getClientOriginalExtension();
          $filename = time() . '.' . $extension;
  
          $path = 'uploads/products/';
          $file->move($path, $filename);
  
          // Delete the old image if it exists
          if (File::exists($products->image)) {
              File::delete($products->image);
          }
  
          // Update the image path
          $imagePath = $path . $filename;
      }
  
      // Update the product details
      $products->update([
          'name' => $request->name,
          'price' => $request->price,
          'stock' => $request->stock,
          'image' => $imagePath // Use the updated image path or retain the current one
      ]);
  
      return redirect('adminproducts')->with('status', 'Product updated successfully!');
  }
  
     public function delete(int $id)
      {
          $products = Product::findOrFail($id);
          $products->delete();
  
          //return redirect()->back()->with('status',value: 'product deleted');
          return redirect()->back()->with('status', 'Product deleted');
  
        }

        public function order(Request $request)
        {
            // Check if the 'user' session key exists
            if (Auth::check()) {
                $user = Auth::user(); 
                $productName = $request->input('product_name'); 
               if ($user) {

                $existingOrder = Order::where('user_name', $user->name)
                ->where('product_name', $productName)
                ->where('order_status', 'pending') // Assuming pending orders are considered "in the cart"
                ->first();

            if ($existingOrder) {
                // If product is already in the cart, return with a message
                return redirect('/vieworder')->with('error', 'Product is already in the cart!');
            }
            $order = new Order;
            $order->user_name = $user->name; // Use Auth data for user ID
            $order->product_name = $productName;
            $order->product_stock = '1'; 
            $order->product_price = $request->product_price;// Hardcoded stock value, can be dynamic if needed
            $order->order_status = 'pending'; // Default order status
            $order->save();
        
                return redirect('/vieworder')->with('status', 'Order added successfully!');;
                         }
                              }
             else{
            return redirect('/login');
                 }
            // Handle case when user session does not exis   
        }


        public function vieworder(){
             if(Auth::check()){
                $order = Order::where('user_name', Auth::user()->name)->get();  
                  return view('order',compact('order'));
             }
             else{
                return redirect('/login');
                     }
        }

        public function updateorder(Request $request, string $product_name, int $id)
        {
            // Fetch the order by ID
            $order = Order::findOrFail($id);
        
            // Fetch the product by its name
            $product = Product::where('name', $product_name)->firstOrFail();
        
            // Retrieve the product's stock and price
            $productStock = $product->stock; // Ensure 'stock' is a valid column in your `products` table
            $productPrice = $product->price; // Ensure 'price' is a valid column in your `products` table
        
            // Check if the requested updated stock is valid
            $requestedStock = $request->updstock;
        
            // Validate stock input
            if ($requestedStock < 0) {
                return redirect('/vieworder')->with('error', 'Invalid stock quantity.');
            }
        
            // Calculate the updated price
            $price = $productPrice * $requestedStock;
        
            if ($requestedStock == 0) {
                // Delete the order if the requested stock is 0
                $order->delete();
                return redirect('/vieworder')->with('status', 'Order deleted successfully!');
            } else {
                if ($productStock >= $requestedStock) {
                    // Update the order if enough stock is available
                    $order->update([
                        'product_price' => $price,
                        'product_stock' => $requestedStock,
                    ]);
        
                    return redirect('/vieworder')->with('status', 'Order updated successfully!');

                } else {
                    // Insufficient stock
                    return redirect('/vieworder')->with('error', 'Not enough stock available.');
                }
            }
        }
        
        

        public function placeOrder(Request $request)
        {
            if (!Auth::check()) {
                return redirect('/login')->with('error', 'Please log in to place an order.');
            }
        
            // Fetch the logged-in user
            $user = Auth::user();
            
            // Fetch all pending orders for the logged-in user
            $orders = Order::where('user_name', $user->name)
                           ->where('order_status', 'pending')
                           ->get();
        
            if ($orders->isEmpty()) {
                return redirect('/vieworder')->with('error', 'No pending orders found.');
            }
        
            $totalPrice = 0;
            foreach ($orders as $order) {
                $totalPrice += $order->product_price;
                $order->order_status = 'placed';
                $order->save();
            }
        
            return redirect('/vieworder')->with('status', 'Order placed successfully!');
        }
        

        public function downloadBill($user_name)
{
    // Fetch all orders for the given user
    $orders = Order::where('user_name', $user_name)->get();

    // Check if the user has any orders
    if ($orders->isEmpty()) {
        return redirect()->back()->with('error', 'No orders found for this user.');
    }

    // Initialize the bill content
    $billContent = "Order Bill for $user_name\n";
    $billContent .= "-----------------------------------\n";

    // Initialize total sum
    $totalSum = 0;

    // Loop through all orders and append order details to the bill
    foreach ($orders as $order) {
       // $billContent .= "Order ID: {$order->id}\n";
        $billContent .= "Product Name: {$order->product_name}\n";
        $billContent .= "Quantity: {$order->product_stock}\n";
        $billContent .= "Product total price: {$order->product_price}\n";
      //  $totalPrice = $order->product_stock * $order->product_price;
       // $billContent .= "Total Price: $totalPrice\n";
        $billContent .= "-----------------------------------\n";

        // Add to the total sum
        $totalSum += $order->product_price;
    }

    // Add the total sum at the end
    $billContent .= "Total Amount for All Orders: $totalSum\n";
    $billContent .= "-----------------------------------\n";
    $billContent .= "Thank you for your orders!";

    // Set the file name and headers for downloading the text file
    $fileName = "{$user_name}_OrderBill.txt";
    $headers = [
        'Content-Type' => 'text/plain',
        'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
    ];

    // Return the text file as a response, allowing the user to download it
    return Response::make($billContent, 200, $headers);
}
        
}
