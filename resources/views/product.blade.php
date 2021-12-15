@extends('layouts.app2')

@section('content')
        
        <div class="container-fluid">
            
                    
                    <div class="container">

                        <div class="row">

                                <div class="col-md-4 offset-md-4">
                                    <div class="card  mt-3">
                                        <a href="{{ route('shop.show', $product->slug) }}">
                                            <img class="card-img-top" src="{{ productImage($product->image) }}"alt="product">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">{{ $product->presentPrice() }}</p>
                                            <p>
                                                {!! $product->description !!}
                                            </p>
                                            @if ($product->quantity > 0)
                                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                   
                                </div>
                            

                        </div> <!-- end products -->

                    </div> <!-- end container -->


             
        </div>
        </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
    </body>
@endsection
