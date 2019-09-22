@extends('layouts.backend.app')

@section('title','Create Invoice')

@push('css')

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet"/>

<!-- multi select css-->
    <link href="{{asset('assets/backend/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet"/>


.amount-card {
    padding: 30px;
}
.amount-p {
    padding: 30px;
}



@endpush


@section('content')

<div class="container-fluid">

        @if ($message = Session::get('success'))
        <div class="w3-panel w3-green w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
                    class="w3-button w3-green w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('success');?>

        @endif

        @if ($message = Session::get('error'))
        <div class="w3-panel w3-red w3-display-container">
            <span onclick="this.parentElement.style.display='none'"
                    class="w3-button w3-red w3-large w3-display-topright">&times;</span>
            <p>{!! $message !!}</p>
        </div>
        <?php Session::forget('error');?>
        @endif


        <form action="{{route('admin.invoice.store')}}" method="POST" enctype="multipart/form-data">
         @csrf
         

          

            <div class="row clearfix">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="header">
                                    <center>
                                        <h1>
                                            INVOICE
                                        </h1>
                                    </center>
                                </div>

                                <div class="body">

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group form-float">
                                                <div class="form-line {{ $errors->has('customer') ? 'focused error' : ''}}">
                                                    
                                                    <label for="category">Select Customer</label>

                                                    <div class="form-line">
                                                        <select name="customer[]" id="customer" class="form-control show-tick"data-live-search="true" >
                                                            
                                                             @foreach($customers as $customer)
                                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                                             @endforeach

                                                        </select> 
                                                    </div>
                                                </div>
                    
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                         <div class="col-sm-5">
                                             <div class="form-group form-float">
                                                <div class="form-line {{ $errors->has('customer') ? 'focused error' : ''}}">
                                                    
                                                    <label for="category">Select Product</label>

                                                    <div class="form-line">
                                                        <select name="product[]" id="product" class="all_product form-control show-tick"data-live-search="true" onchange="getProduct(this)">
                                                            
                                                             @foreach($products as $product)
                                                                <option value="{{ $product->id }}">{{ $product->name }}</option>

                                                             @endforeach

                                                        </select> 
                                                    </div>
                                                </div>
                    
                                            </div>
                                         </div>
                                     </div>
                                    <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>amount</th>
                                            
                                        
                                        </tr>
                                    </thead>
                                    
                                    <tbody class="p">        
                                        
                                    </tbody>
                                </table>
                            </div>

                            </div>
                     </div>
                </div>

            </div>
        
        </form>

        <div class="row clearfix">
            <div class="col-sm-offset-8 col-sm-4">
                <div class="card amount-card">
                    <div class="card-body" style="padding: 20px; height: 130px">
                        <p class="amount-p" style="">
                        <span><strong>Total Amount: </strong> <span class="total-amount">0</span> TK</span>
                        <br><br>
                        
                    </p>
                    <form method="POST" id="payment-form"
                      action="{!! URL::to('paypal') !!}">
                      {{ csrf_field() }}
                            <input type="hidden" name="amount" class="amount_input">
                            <div class="hidden-input">
                                <input type="hidden" name="amount" class="amount_input">
                            </div>
                            

                            <button class="btn btn-info">Make Payment</button>
                      </form>
                    </div>
                    
                </div>
            </div>
        </div>

        
        <!-- 
        <div class="row clearfix">
            <div class="col-sm-offset-2">

                    <form class="col-sm-offset-8 col-sm-4" method="POST" id="payment-form"
                      action="{!! URL::to('paypal') !!}">
                      
                      {{ csrf_field() }}
                      
                      <label class="w3-text-blue"><b>Enter Amount</b></label>
                      <input class="w3-input w3-border" id="amount" type="text" name="amount"></p>
                      <button class="w3-btn w3-blue">Pay with PayPal</button>
                    </form>
            </div>
        </div> -->

        



                               
    </div>


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">

    function getProduct(element) {
        console.log('hello');
         
         var id = $(element).val()
         $('.hidden-input').append('<input type="hidden" name="product[]" class="" value="'+id+'">');


         console.log('hi', id);

         $.ajax({
            type:'GET',
            url:'/admin/invoice/' + id,
            success:function(data){

                $('.p').append(data);

                // var input_amount = $('').val();
                // $('.amount').each(function(){
                //   console.log(this.val());
                // });

                var arr = $('.amount').map((i, e) => e.innerHTML).get();
                var total_amount = 0;

                arr.forEach((amount) => {
                    total_amount = parseFloat(total_amount) + parseFloat(amount);
                })
                console.log(arr);

                $('.total-amount').html(total_amount);
                $('.amount_input').val(total_amount);


            },
            error:function(){

            }

         });
    }

    $(document).on('keyup','.amount',function(){
        var total_amount = $('.total-amount').html();

        var input_amount = $(this).val();
        console.log('hello');
        console.log($(this).val());

        var current_amount = parseFloat(total_amount) + parseFloat(input_amount)
        console.log(total_amount);

        $('.total-amount').html(current_amount);
    });
        
        // $(document).ready(function(){

        //      $(document).on('change','.all_product',function(){
        //          //console.log("hmm its works!!!")

        //          // var cat_id = $(this).val()
        //          console.log('hello');
        //          return;

        //          $.ajax({
        //             type:'GET',
        //             url:'/admin/invoice/' + cat_id,
        //             success:function(data){
        //                 console.log('success');

        //                 console.log(data);

        //             },
        //             error:function(){

        //             }

        //          });
        //    });

        // });

        // function onSelectProduct() {

        //     $('.products').append(data)
        // }

        // $(function(){

        //     $("#product").change(function(){
        //         var displaycourse=$("#product option:selectd").text();
        //         $("#products").val(displaycourse);
        //     })

        // })

    </script>


@endsection


@push('js')


<!-- Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
    


    



@endpush