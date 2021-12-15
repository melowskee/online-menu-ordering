<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        $categories = Category::all();
        $coupons = Coupon::all();
        $items = \Cart::getContent();

        return view('checkout')->with([
            'categories' => $categories,
            'discount' => session()->get('coupon')['discount'],
            'items' => $items,
            'newSubtotal' => \Cart::getSubTotal(),
            'newTax' => number_format(calculateTax(\Cart::getSubTotal()), 2),
            'newTotal' => \Cart::getTotal(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {
        

        $order = $this->addToOrdersTables($request, null);
        

        // decrease the quantities of all the products in the cart
        $this->decreaseQuantities();

        \Cart::clear();
        session()->forget('coupon');
        session()->forget('subtotal');
        //return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        session()->flash('success', 'Thank you! Your order has been successfully accepted!');

        return redirect()->route('checkout.confirmation');
        
    }

    protected function addToOrdersTables($request, $error)
    {
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'email' => $request->email,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'postalcode' => $request->postalcode,
            'phone' => $request->phone,
            'discount' => session()->has('coupon') ? session()->get('coupon')['discount'] : 0,
            'discount_code' => session()->has('coupon') ? session()->get('coupon')['name'] : "",
            'subtotal' => \Cart::getSubTotal(),
            'tax' => number_format(calculateTax(\Cart::getSubTotal()), 2),
            'total' => \Cart::getTotal(),
            'error' => $error,
        ]);

        // Insert into order_product table
        foreach (\Cart::getContent() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (\Cart::getContent() as $item) {
            $product = Product::find($item->id);

            $product->update(['quantity' => $product->quantity - $item->quantity]);
        }
    }

    public function confirmation()
    {
        if (! session()->has('success')) {
            return redirect('/');
        }
        $categories = Category::all();
        return view('confirmation')->with(['categories' => $categories]);;
    }
}
