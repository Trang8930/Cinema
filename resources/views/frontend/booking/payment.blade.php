@extends('frontend.layouts.main')

@section('title', __('Payments'))

@section("css")
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>
    <link rel="stylesheet" href="{{ asset('/fe_css/payment.css') }}">
    <!-- If you're using Stripe for payments -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endsection
@section('content')
<div class="header">
    <div class="top-header">
        <div class="logo">
            <a href="{{ route('homepage') }}"><img src="{{ asset('fe_images/logo.png')}}" alt="" /></a>
            <p style="font-size:3em;">CINEMA</p>
        </div>
        @include("frontend.layouts.partials.login-register")
        <div class="clearfix"></div>
    </div>
</div>
<div class="container" style="font-family: none; margin: 1em 10%;">
    <div class="row">
        <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
        <div class="col-xs-12 col-md-4">
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group">
                                        <input 
                                            type="tel"
                                            class="form-control"
                                            name="cardNumber"
                                            placeholder="Valid Card Number"
                                            autocomplete="cc-number"
                                            required autofocus 
                                        />
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        name="cardExpiry"
                                        placeholder="MM / YY"
                                        autocomplete="cc-exp"
                                        required 
                                    />
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cardCVC">CV CODE</label>
                                    <input 
                                        type="tel" 
                                        class="form-control"
                                        name="cardCVC"
                                        placeholder="CVC"
                                        autocomplete="cc-csc"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode">COUPON CODE</label>
                                    <input type="text" class="form-control" name="couponCode" />
                                </div>
                            </div>                        
                        </div>
                        <div class="row" style="display: none">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="total" id="total" value="{{$request['total']}}" />
                                </div>
                            </div>   
                        </div>
                        <div class="row" style="display: none">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="booking" id="booking" value="{{$request['bookingID']}}" />
                                    </div>
                                </div>                        
                            </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="subscribe btn btn-success btn-lg btn-block" type="button">Start Subscription</button>
                            </div>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
            <!-- CREDIT CARD FORM ENDS HERE -->
        </div>
        <div class="box pull-right col-xs-12 col-md-4">
            <div class="box-header with-border">
                <h3 class="box-title">Thông tin chi tiết</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                <tbody><tr>
                    <th style="width: 10px">#</th>
                    <th></th>
                    <th>Chi tiết</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Số lượng vé</td>
                    <td>
                        {{$request['total']/60000}}
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Ghế</td>
                    <td>
                        {{$request['seats']}}
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Tổng tiền</td>
                    <td>
                        {{$request['total']}}
                    </td>
                </tr>
                </tbody></table>
            </div>
        </div>    
        
        <div class="box pull-right col-xs-12 col-md-4" id="show-message">
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('/fe_js/payment.js') }}"></script>
@endsection