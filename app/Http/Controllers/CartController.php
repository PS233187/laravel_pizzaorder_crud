<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartCheckout(){

      
        $cartItems = \Cart::getContent();

        return view('checkout',compact('cartItems'));


    }


    public function cartList()
    {
        $cartItems = \Cart::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
            'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }
    // \Cart::create([
    //     $topping = Topping::whereDoesntHave(
    //     'products',
    //       function (Builder $query) use ($products) {
    //       $query->where('topping_id', $product->id);
    //       }
    //       )->get();
    //     ]);
    
    public function attachTopping(Topping $topping, Product $product)
    {
        $topping->products()->attach($product);
        return redirect()->route('cart.update', [$topping]);
    }

    public function detachTopping(Topping $topping, Product $product)
    {
        $topping->products()->detach($product);
        return redirect()->route('cart.update', [$topping]);
    }
    
    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
