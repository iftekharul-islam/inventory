@extends('layouts.backend.app')

@section('title','Customer')

@push('css')


@endpush


@section('content')

<div class="container-fluid">
           

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Customer Information
                               
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form action="{{ route('admin.customer.store') }}" method="POST">
                            	@csrf

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name="name">
                                        <label class="form-label">Customer name</label>
                                    </div>

                                    <div class="form-line">
                                        <input type="text" id="address" class="form-control" name="address">
                                        <label class="form-label">Address</label>
                                    </div>

                                    <div class="form-line">
                                        <input type="text" id="email" class="form-control" name="email">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>

                                
                                <br>
                                <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.customer.index') }}">BACK</a>

                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT
                            	</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
           
        </div>



@endsection


@push('js')



@endpush