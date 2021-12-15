<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Product;

class CartController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $coupons = Coupon::all();
        $items = \Cart::getContent();
        // dd($cartItems);

        

        return view('cart', compact('items', 'categories', 'coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {

        \Cart::add([
            'id' => $product->id,
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product->image,
            )
        ]);

        // add single condition on a cart bases
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'VAT 12%',
            'type' => 'tax',
            'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
            'value' => '12%',
            'attributes' => array( // attributes field is optional
                'description' => 'Value added tax',
                'more_data' => 'more data here'
            )
        ));

        \Cart::condition($condition);
        session()->put('subtotal', \Cart::getSubTotal());
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        session()->put('subtotal', \Cart::getSubTotal());
        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
         \Cart::remove($id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        session()->put('subtotal', \Cart::getSubTotal());
        return redirect()->route('cart.index');
    }

    public function clear()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');
        session()->remove('subtotal');
        session()->remove('coupon');
        return redirect()->route('cart.index');
    }

}
