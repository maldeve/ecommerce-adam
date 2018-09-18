<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use App\Product;
use App\Order;
use Session;

class ProductController extends Controller
{
    // authentication
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // products table 
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // create form 
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // add product 
    public function store(Request $request)
    {
        $this->validate(request(), [
            'category_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'product_description'=>'required',
            'product_image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable|max:1999',
            'product_status'=>'required',
        ]);

        // handle image
        if ($request->hasFile('product_image')) {
            // get filename with extesion
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            // get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get just extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            // filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // upload image
            $path = $request->file('product_image')->storeAs('public/images', $fileNameToStore);
        }else {
            $fileNameToStore = 'noimage.jpg';
        }

        // save item to database
        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->category_id = $request->input('category_id');
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_description = $request->input('product_description');
        $product->product_image = $fileNameToStore;
        $product->product_status = $request->input('product_status');
        $product->save();
        // $request->session()->flash('success_message', 'You have created a new Product');
        return redirect('/products');
    }

    // update form 
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    // update product 
    public function update(Request $request, $id)
    {
        //validate form
        $this->validate(request(), [
            'product_name'=>'required',
            'product_price'=>'required',
            'product_description'=>'required',
            'product_status'=>'required',
        ]);
        Product::where('id', $id)->update(request(['product_name', 'product_price', 'product_description', 'product_status']));
        return redirect('/products');
    }

    // delete product 
    public function destroy($id)
    {
        Product::where('id', $id)->delete($id);
        return redirect('/products');
    }

    // add to cart
    public function addToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        return redirect('/products');
    }

    // shopping cart
    public function shoppingCart() {
        if (!Session::has('cart')) {
            return view('products.order_items');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('products.order_items', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    // cart checkout
    public function checkOut() {
        if (!Session::has('cart')) {
            return view('products.order_items');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('products.checkout', ['total' => $total]);
    }
    
    // post checkout
    public function postCheckOut(Request $request) {
        if (!Session::has('cart')) {
            return redirect('products.order_items');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        // create a new order
        $order = new Order();
        $order->cart = serialize($cart);
        $order->order_number = $request->input('order_number');

        // save to the database
        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect('/products');
    }

    // get all user orders
    public function getUserOrders() {
        $orders = Auth::user()->orders;
        $orders -> transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('products.user_orders', ['orders' => $orders]);
    }

    // seller view orders
    public function sellerViewOrders() {
        $orders = Order::all();
        $orders -> transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('products.seller_view_orders', ['orders' => $orders]);
    }

    // change order status to complete
    public function completeOrders(Request $request, $id) {
        Order::where('id', $id)->update(request(['order_status_id']));
        return back();
    }
}
