<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::orderBy('id','desc')->paginate(10);
		return view('users.listUsers',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if(Auth::user()){
			$user = User::find(Auth::user()->id);
			
			if($user){
				return view('users.edit-profile')->withUser($user);
			}
			else{
				return redirect()->back();
			}
		}
		else{
			return redirect()->back();
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();
		
		if($user){
			
			$validate = null;
			
			if(Auth::user()->email === $request['email'] && Auth::user()->email === $request['email']){
				
				$validate = $request->validate([
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255'],
				]);
			}
			else{
				$validate = $request->validate([
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
				]);
			}
			
			if($validate){
				$user->name = $request['name'];
				$user->email = $request['email'];
				
				$user->save();
				
				$request->session()->flash('success','Profile data updated!');
				return redirect()->back();
			}
			else{
				return redirect()->back();
			}		
		}
		else{
			return redirect()->back();
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
		
		if ( !empty($user) ){
			User::where('id',$id)->delete();
			return redirect('users')->with('success','User removed from list');
		}
		else{
			return redirect('users')->with('error','Invalid Operation Detected.');
		}
    }

    public function editUser($id)
		{
			$user = User::find($id);
			//check if 'id' exists, as it is passed by get
			if ( empty($user) ){
				return Redirect::to('users')->with('error','Invalid operation selected.');
			}
				return view('users.edit', ['user' => $user]);
		}
		
		
		public function updateUser(Request $request, $id)
        {
			
			$user = User::find($id);
			//validate fields. In this case, only price and image (may or may not be changed)
			$receivedUserData = $request->validate([
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255'],
			]);
			$originalUser = User::find($id);
				if ( !empty($originalUser) ){
				//the table entry exists in the database
				//price must exist and be filled. Here is has a correct value.
				$originalUser['name'] = $receivedUserData['name'];
				$originalUser['email'] = $receivedUserData['email'];
				
				$originalUser->save();
					return redirect('users')->with('success','User data updated!');
				}
				else{
				//error - return message
				return redirect('users')->with('error','Invalid operation detected.');
				}
		}

		public function getOrders(){
			$orders = Auth::user()->orders;
			$orders->transform(function($order, $key){
				$order->cart = unserialize($order->cart);
				return $order;
			});
			return view('orders', ['orders' => $orders]);
		}
		
		public function getAllOrders(){
			$orders = Order::all();
			$orders->transform(function($order, $key){
				$order->cart = unserialize($order->cart);
				return $order;
			});
		return view('orders', ['orders' => $orders]);
		}

}
