<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::where('id', $request->coupon_code)->first();

        /*if (!$coupon) {
            return back()->withErrors('Invalid coupon code. Please try again.');
        }

        dispatch_now(new UpdateCoupon($coupon));

        return back()->with('success_message', 'Coupon has been applied!');*/

        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => $coupon->code,
            'type' => $coupon->type,
            'value' => '-'.$coupon->percent_off.'%',
        ));

        $items = \Cart::getContent();
        $total = 0;
        foreach($items as $item) {
            \Cart::addItemCondition($item->id, $condition);
            $total + $item->getPriceWithConditions;
        }

        session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => session()->get('subtotal') * ".$coupon->percent_off",
        ]);

        session()->flash('success', 'Coupon Applied');
        return redirect()->route('cart.index');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $items = \Cart::getContent();
        foreach($items as $item) {
            \Cart::clearItemConditions($item->id);
        }

       session()->remove('coupon');
        session()->flash('success', 'Coupon has been removed.');
        return redirect()->route('cart.index');
    }
}
