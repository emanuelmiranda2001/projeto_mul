<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
use Session;
use Auth;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

	public function index(){
		$data['products'] = Product::orderBy('id','asc')->paginate(5);
		return view('product.list',$data);
	}


	public function edit($id)
    {
        $product = Product::find($id);
		//check if ‘id’ exists, as it is passed by get
		if ( empty($product) ){
			return Redirect::to('products')->with('error','Invalid operation selected.');
		}
			return view('product.edit', ['product' => $product]);
    }

	/*
	public function destroy($id)
    {
        $product = Product::find($id);
		
		if ( !empty($product) && $product['image'] != 'defaultImage.jpg' && file_exists('storage/'. $product['image']) ){
			unlink('storage/' . $product['image'] );
			Product::where('id',$id)->delete();
			return redirect('products')->with('sucess','Product removed from list');
		}
		elseif ( !empty($product) ){
			Product::where('id',$id)->delete();
			return redirect('products')->with('success','Product removed from list');
		}
		else{
			return redirect('products')->with('error','Invalid Operation Detected.');
		}
    }
	*/

	public function update(Request $request, $id){
		//validate fields. In this case, only price and image (may or may not be changed)
		$receivedProductData = $request->validate([
			'title' => 'required|regex:/^[A-z0-9\/\-\s]+$/|max:150',
			'description' => 'required|regex:/^[A-z0-9\-\.\ç\á\é\ã\%\/\,\s]+$/|max:1500',
			'price' => 'required|numeric|between:0,1000',
			'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
		]);
		$originalProduct = Product::find($id);
			if ( !empty($originalProduct) ){
			//the table entry exists in the database
			//price must exist and be filled. Here is has a correct value.
			$originalProduct['title'] = $receivedProductData['title'];
			$originalProduct['description'] = $receivedProductData['description'];
			$originalProduct['price'] = $receivedProductData['price'];
			//image may not exist - nothing needs to change then
				if( array_key_exists('image', $receivedProductData) ){
				//there is a valid image to replace the existing one
					if( $request->file('image')->isValid() ){
					$filename = time() . "_" . $request->file('image')->getClientOriginalName();
					$result = $request->file('image')->move('storage/', $filename);
					//add the new filename to the array and erase the previous file if it is not the default image
						if ( $originalProduct['image'] != 'defaultImage.jpg'){
						unlink('storage/' . $originalProduct['image']);
						}
						$originalProduct['image'] = $filename;
					}
				else{
					//error - return message
					return redirect('products')->with('error','Something went wrong with the file: please try again later.');
				}
				} //update data
				$originalProduct->save();
				return redirect('products')->with('success','Product data updated!');
			}
			else{
			//error - return message
			return redirect('products')->with('error','Invalid operation detected.');
			}
	}

    public function getIndex()
    {
        $products = Product::all();
		return view('home', ['products' => $products]);
    }


    public function getAddToCart(Request $request, $id){
		
		$product = Product::find($id);
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);
		
		$request->session()->put('cart', $cart);
		//dd($request->session()->get('cart'));
		return redirect('home');
	}

    public function getCart(){
		if (!Session::has('cart')){
			return view('shopping-cart', ['products' => null]);
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		return view('shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
	}

	/*
    public function getReduceByOne($id){
		
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->reduceByOne($id);
		
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}
		else{
			Session::forget('cart');
		}
		return redirect()->route('product.shoppingCart');
	}
	*/

	public function getRemoveItem($id){
		
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);
		
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}
		else{
			Session::forget('cart');
		}
		
		return redirect()->route('product.shoppingCart');
	}

    public function getCheckout(){
        if (!Session::has('cart')) {
            return view('shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
		
        if (!Session::has('cart')) {
            return redirect()->route('home');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
		
		
        try {
			
			$validate = $request->validate([
			'name' => ['required', 'string', 'max:255', 'min:4'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'nif' => ['required','numeric','digits:9'],
			'address' => 'required|regex:/^[A-z0-9\-\.\ç\á\é\ã\%\/\,\s]+$/|max:1500',
			]);
			
			$order = new Order();
			
			$order->cart = serialize($cart);
			$order->name = $request['name'];
			$order->nif = $request['nif'];
			$order->email = $request['email'];	
			$order->address = $request['address'];
			
			Auth::user()->orders()->save($order);

			
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Incorrect or incomplete fields!' );
        }

        Session::forget('cart');
        return redirect()->route('home')->with('success', 'Successfully purchased products!');
    }

}
