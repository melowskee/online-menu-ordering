@extends('layouts.app2')

@section('content')
        
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-header">{{ $categoryName }}</div>

                <div class="card-body">
                    
                    <div class="container">

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

                    </div> <!-- end container -->


                </div>
            </div>
        </div>
        </div>
        <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
    </body>
@endsection
