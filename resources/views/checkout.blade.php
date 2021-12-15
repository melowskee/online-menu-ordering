@extends('layouts.app2')

@section('content')
        
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                    
                    <div class="container">

                        <div class="row">
                            <div class="col-md-3">
                                <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                                    {{ csrf_field() }}
                                    <h2>Billing Details</h2>

                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        @if (auth()->user())
                                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                        @else
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                                    </div>

                                    <div class="half-form">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="province">Province</label>
                                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                                        </div>
                                    </div> <!-- end half-form -->

                                    <div class="half-form">
                                        <div class="form-group">
                                            <label for="postalcode">Postal Code</label>
                                            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                                        </div>
                                    </div> <!-- end half-form -->

                                    <hr>

                                    <button type="submit" id="complete-order" class="btn btn-primary full-width">Complete Order</button>
                            </form>
                        </div>
                        <div class="col-md-9">
                            <h2>Your Order</h2>
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
                                            {{ $item->quantity }}
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
                                         </td>
                                      </tr>
                                      @endforeach
                                   </tbody>
                                </table>
                                <div class="pull-right">
                                    Sub Total: ${{ number_format(session()->get('subtotal'), 2) }} <br>
                                    @if (session()->has('coupon'))
                                    Coupon: -${{ number_format(session()->get('coupon')['discount'], 2) }} 
                                    <hr>
                                    @endif
                                    Tax: ${{ number_format(calculateTax(Cart::getSubTotal()), 2) }} 
                                    <br/>
                                    <b>Total: ${{ number_format(Cart::getTotal(), 2) }}</b>
                                </div>

                        </div>
                    </div>
                </div> <!-- end products -->
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    </body>
@endsection
