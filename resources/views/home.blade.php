@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark">
                <!-- <div class="card-header">{{ __('Dashboard') }}</div> -->

                <div class="card-body">
                    
                    <div class="container">
                        <h1 class="text-center">Menu</h1>

                        
                        <div class="row">
                            @foreach ($products as $product)
                                 <div class="col-xs-8 col-sm-6 col-md-3">
                                    <div class="card  mt-3">
                                        <a href="{{ route('shop.show', $product->slug) }}">
                                            <img class="card-img-top" src="{{ productImage($product->image) }}"alt="product">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->presentPrice() }}</p>
                                            <a href="{{ route('shop.show', $product->slug) }}" class="btn btn-primary">View</a>
                                        </div>
                                    </div>

                                   
                                </div>
                            @endforeach

                        </div> <!-- end products -->

                        <div class="text-center mt-3">
                            <a href="{{ route('shop.index') }}" class="btn btn-success">View more foods</a>
                        </div>

                    </div> <!-- end container -->


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

