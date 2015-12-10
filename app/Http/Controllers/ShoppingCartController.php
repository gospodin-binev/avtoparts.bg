<?php

namespace App\Http\Controllers;

use App\Orders;
use Auth;
use App\Images;
use Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ShoppingCartController extends Controller
{
    public function getCart()
    {

    	$content = Cart::content();
    	$images = Images::all();

		return view('pages.cart')
		->with('content', $content)
		->with('images', $images);

    }

    public function addToCart(Request $request)
    {
    	Cart::add($request->input('id'), $request->input('name'), 1, $request->input('price'));
    	
    	return redirect('/order/cart');
    }

    public function destroyCart()
    {
		Cart::destroy();

		return redirect()->back();
    }

    public function removeFromCart($rowid)
    {
    	Cart::remove($rowid);

    	return redirect()->back();
    }

    public function checkOut(Request $request)
    {
    	$order = new Orders;

    	$order->products = $request->input('products');
    	$order->user_id = $request->input('user');
        $order->user_name = $request->input('userName');
        $order->nomer = $request->input('nomer');
        $order->shipment_office = $request->input('shipment-office');
        $order->price = $request->input('price');
    	$order->status = $request->input('status');
    	$order->save();

        Cart::destroy();

    	return redirect('profile/'.$request->input('user').'/orders');
    }
}
