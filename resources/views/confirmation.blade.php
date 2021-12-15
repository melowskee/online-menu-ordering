@extends('layouts.app2')

@section('content')
        
        <div class="container-fluid">
            <div class="card mt-3">
                <div class="card-header">Thank You!</div>

                <div class="card-body">
                    
                    <div class="container">

                        <div class="row">
                            <div class="col-md-12 text-center">
                            @if ($message = Session::get('success'))
                                <h3>{{ $message }}</h3>
                                <hr>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">Continue Shopping</a>
                                 <hr>
 
                            @endif
                            </div>
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
