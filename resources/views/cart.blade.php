@extends('layouts.app2')

@section('content')
 
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-header">Cart</div>

                <div class="card-body">
                    
                    <div class="container">
                         
                                      @if ($message = Session::get('success'))
                                          <div class="p-4 mb-3 bg-green-400 rounded">
                                              <p class="text-green-800">{{ $message }}</p>
                                          </div>
                                      @endif
                                    @if(\Cart::getContent()->count() > 0)    
                                        <div class="row">
                                <div class="col-md-12">
                                              <div class="flex-1">
                                                <table class="table table-bordered" cellspacing="0">
                                                  <thead>
                                                    <tr class="h-12 uppercase">
                                                      <th class="hidden md:table-cell"></th>
                                                      <th class="text-left">Name</th>
                                                      <th class="pl-5 text-left lg:text-right lg:pl-0">
                                                        <span class="lg:hidden" title="Quantity">Qtd</span>
                                                        <span class="hidden lg:inline">Quantity</span>
                                                      </th>
                                                      <th class="hidden text-right md:table-cell"> price</th>
                                                      <th class="hidden text-right md:table-cell"> tax</th>
                                                      <th class="hidden text-right md:table-cell"> action </th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($items as $item)
                                                    <tr>
                                                      <td class="hidden pb-4 md:table-cell text-center">
                                                        <a href="">
                                                          <img src="{{ productImage($item->attributes->image) }}" width="100" class="w-20 rounded" alt="Thumbnail">
                                                        </a>
                                                      </td>
                                                      <td>
                                                        <a href="">
                                                          <p class="mb-2 md:ml-4">{{ $item->name }}</p>
                                                          
                                                        </a>
                                                      </td>
                                                      <td class="justify-center mt-6 md:justify-end md:flex">
                                                        <div class="h-10 w-28">
                                                          <div class="relative flex flex-row w-full h-8">
                                                            
                                                            <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                              @csrf
                                                              <input type="hidden" name="id" value="{{ $item->id}}" >
                                                            <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                                            class="w-6 text-center bg-gray-300" />
                                                            <button type="submit" class="btn btn-warning">update</button>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </td>
                                                      <td class="hidden text-right md:table-cell">
                                                        <span class="text-sm font-medium lg:text-base">
                                                            ${{ $item->price }}
                                                        </span>
                                                      </td>
                                                      <td class="hidden text-right md:table-cell">
                                                        <span class="text-sm font-medium lg:text-base">
                                                            ${{ calculateTax($item->price) }}
                                                        </span>
                                                      </td>
                                                      <td class="hidden text-right md:table-cell">
                                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                          @csrf
                                                          <input type="hidden" value="{{ $item->id }}" name="id">
                                                          <button class="btn btn-danger">x</button>
                                                      </form>
                                                        
                                                      </td>
                                                    </tr>
                                                    @endforeach
                                                     
                                                  </tbody>
                                                </table>
                                                <div class="pull-right">
                                                     @if (! session()->has('coupon'))

                                                        <a href="#" class="have-code">Have a Code?</a>

                                                        <div class="have-code-container">
                                                            <form action="{{ route('coupon.store') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <!-- <input type="text" name="coupon_code" id="coupon_code"> -->
                                                                <select name="coupon_code">
                                                                    @foreach($coupons as $coupon)
                                                                    <option value="{{$coupon->id}}">{{ $coupon->code }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="submit" class="btn btn-success">Apply</button>
                                                            </form>
                                                        </div> <!-- end have-code-container -->
                                                        @else
                                                        <div class="have-code-container">
                                                            
                                                            <form action="{{ route('coupon.clear') }}" method="POST">
                                                                {{ csrf_field() }}
                                                                <!-- <input type="text" name="coupon_code" id="coupon_code"> -->
                                                                <select name="coupon_code">
                                                                    @foreach($coupons as $coupon)
                                                                    <option value="{{$coupon->id}}">{{ $coupon->code }}</option>
                                                                    @endforeach
                                                                </select>
                                                            
                                                                <button type="submit" class="btn btn-danger">Clear Coupon</button>
                                                            </form>
                                                        </div> <!-- end have-code-container -->
                                                    @endif
                                                    Sub Total: ${{ number_format(session()->get('subtotal'), 2) }} <br>
                                                    @if (session()->has('coupon'))
                                                        Coupon: -${{ number_format(session()->get('coupon')['discount'], 2) }} <br>&nbsp;<br>
                                                        <hr>
                                                    @endif
                                                    Tax: ${{ number_format(calculateTax(Cart::getSubTotal()), 2) }} <br>
                                                    <b>Total: ${{ number_format(Cart::getTotal(), 2) }}</b>
                                                </div>
                                                <div class="pt-5">
                                                  <form action="{{ route('cart.clear') }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger">Remove All Cart</button>
                                                  </form>
                                                </div>


                                              </div>
                                                </div>
                        </div>  
                                            <div class="row pt-5">
                                                <div class="col-md-12 text-center">
                                                    <a href="{{ route('shop.index') }}" class="btn btn-info">Continue Shopping</a>
                                                    <a href="{{ route('checkout.index') }}" class="btn btn-primary">Proceed to Checkout</a>
                                                </div>
                                            </div>
                                       

                                    @else
                                    <div  class="row">
                                        <div class="col-md-12 text-center">
                                            <h3>No items in Cart!</h3>
                                            <hr>
                                            <a href="{{ route('shop.index') }}" class="btn btn-primary">Continue Shopping</a>
                                            <hr>
                                        </div>
                                    </div>

                                    @endif
                                  
                    </div> <!-- end container -->


                </div>
            </div>
             
        </div>
        </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
@endsection
