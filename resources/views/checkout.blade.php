@extends('layouts.master')

@section('main-content')

<style>
    #promo-code_input {
    outline: 0;
    border-width: 0 0 2px;
    border-color: gray;
    /* width:auto; */
    width: 46%;
    text-align: right; 
    }
    #promo-code_input input:focus {
        border-color: green
    }
    .invalid_promo_code {
        position: absolute;
        right: 34px;
        padding-top: 21px;
    }
    .invalid_promo_code_display_none{
        display: none;
    }
</style>

    <div class="container">
        <div class="form-row mt-3 mb-3">
            <div class="col-md-6">
                <div class="left border">
                    <div class="form-row">
                        <div class="col-md-6">
                            <h4 class="mb-3">Billing address</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="icons">
                                <img src="{{url('/public/images/visa.png')}}" />
                                <img src="{{url('/public/images/mastercard-logo.png')}}" />
                                <img src="{{url('/public/images/maestro.png')}}" />
                            </div>
                        </div>
                    </div>
    
                         
                    <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="firstName">Full name</label>
                                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="John Doe"
                                               value="@if(!is_null(auth()->user())){{auth()->user()->name}} @else {{old('customer_name')}} @endif" required>
                                        <div class="invalid-feedback">
                                            Valid customer name is required.
                                        </div>
                                    </div>
                                </div>
                
                                <div class="mb-3">
                                    <label for="mobile">Mobile</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+88</span>
                                        </div>
                                        <input type="text" name="customer_mobile" class="form-control" id="mobile" placeholder="01711xxxxxx"
                                               value="{{old('customer_mobile')}}" required>
                                        <div class="invalid-feedback" style="width: 100%;">
                                            Your Mobile number is required.
                                        </div>
                                    </div>
                                </div>
                
                                <div class="mb-3">
                                    <label for="email">Email </label>
                                    <input type="email" name="customer_email" class="form-control" id="email"
                                           placeholder="you@example.com" value="@if(!is_null(auth()->user())){{auth()->user()->email}} @else {{old('customer_email')}} @endif" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>
                
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St,93 B, New Eskaton Road"
                                           value="{{old('address')}}" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>
                
                                {{-- <div class="mb-3">
                                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                                </div> --}}
                
                                <div class="row">
                                    <div class="col-md-5 mb-3">
                                        <label for="country">Country</label>
                                        <select class="custom-select d-block w-100" id="country" name="country" required>
                                            <option value="">Choose...</option>
                                            <option value="Bangladesh" >Bangladesh</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state">State</label>
                                        <select class="custom-select d-block w-100" id="state" name="city" required>
                                            <option value="">Choose...</option>
                                            <option value="Dhaka">Dhaka</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="zip">Zip</label>
                                        <input type="text" class="form-control" id="zip" placeholder="" name="zip" required>
                                        <div class="invalid-feedback">
                                            Zip code required.
                                        </div>
                                    </div>
                                </div>
                     
                      
                                <hr class="mb-4">
                               
                            
                </div>   
            </div>

            <div class="col-md-6">
                <div class="right border">
                    <div class="summary-header d-flex align-items-center">
                        <div class="w-50 text-left">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="w-50 text-right">
                            {{-- <h6><span class="cart_item_count" >@if(session()->has('cart')){{count(session()->get('cart'))}} @else 0 @endif</span> items</h6> --}}
                            <h6><span >@if(session()->has('cart')){{count(session()->get('cart'))}} @else 0 @endif</span> items</h6>
                        </div>
                    </div>
                    @if(session('cart'))
                        <div class="summary-items">
                            @foreach(session('cart') as $id => $details)
                           
                            <input type="hidden" name="images[]" value=" {{$details->id}}">
                            <input type="hidden" name="images_price[]" value=" {{$details->price}}">
                                <div class="form-row item align-items-center">
                                    <div class="col-2">
                                        <img class="img-fluid" src="{{$details->thumbnail_url}}" />
                                    </div>
                                    <div class="col-10">
                                        <table class="table table-bordered mb-0">
                                            <tr>
                                                <td class="p-1" colspan="2">
                                                    <b>৳ {{$details->price}}</b>
                                                    <input type="hidden" name="price" value={{$details->price}} class="price">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-1">Name</td>
                                                <td class="p-1">{{ $details->title }}&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;1205797237</td>
                                            </tr>

                                            <tr>
                                                <td class="p-1">Size</td>
                                                <td class="p-1">4445 x 6668 px</td>
                                            </tr>
                                            <tr>
                                                <td class="p-1" colspan="2"><b>Qty: 1</b></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="summary_footer">
                        <div class="form-row lower">
                            <div class="col text-left">Subtotal</div>
                            <div class="col text-right " >৳ <span id="subtotal">0.0</span></div>
                            <input type="hidden" name="subtotal" value="0" id="subtotal_input">
                        </div>
                        <div class="form-row lower promo_code_div">
                            <div class="col text-left">Promo Code</div>
                            <span id="" class="text-danger invalid_promo_code invalid_promo_code_display_none">Please insert valid promo code</span>
                            <div class="col text-right">
                                <input type="text" class="" onchange="getPromoCode()" id="promo-code_input" placeholder="Enter Promo code">
                                <input type="hidden" name="promo_code" value="" id="promo_code_input">
                            </div>
                      
                           
                        </div>
                        <div class="form-row lower">
                            <div class="col text-left"><b>Total to pay</b></div>
                            <div class="col text-right " >৳<span id="total"> 0.0</span></div>
                            <input type="hidden" name="total" value="0" id="total_input">
                        </div>
                    </div>
                 
                    <button class="btn theme-btn btn-block" type="submit">Place order</button>
                </form>
                    {{-- <p class="text-muted text-center mt-3">Complimentary Shipping & Returns</p> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
