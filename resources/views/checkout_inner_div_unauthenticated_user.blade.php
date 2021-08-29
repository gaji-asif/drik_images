<div class="col-md-8 offset-md-2">
    <div class="right border">
        <div class="summary-header d-flex align-items-center">
            <div class="w-50 text-left">
                <h4>Order Summary</h4>
            </div>
            <div class="w-50 text-right">
                {{-- <h6><span class="cart_item_count" >@if (session()->has('cart')){{count(session()->get('cart'))}} @else 0 @endif</span> items</h6> --}}
                <h6><span>@if (session()->has('cart')){{ count(session()->get('cart')) }} @else 0 @endif</span> items</h6>
            </div>
        </div>
        @if (session('cart'))
            <div class="summary-items">
                @foreach (session('cart') as $id => $details)

                    <input type="hidden" name="images[]" value=" {{ $details->id }}">
                    <input type="hidden" name="images_price[]" value=" {{ $details->price }}">
                    <div class="form-row item align-items-center">
                        <div class="col-2">
                            <img class="img-fluid" src="{{ $details->thumbnail_url }}" />
                        </div>
                        <div class="col-10">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <td class="p-1" colspan="2">
                                        <b>{{ Config::get('app.curreny') }} {{ $details->price }}</b>
                                        <input type="hidden" name="price" value={{ $details->price }}
                                            class="price">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1">Title:</td>
                                    <td class="p-1">{{ $details->title }}</td>
                                </tr>

                                <tr>
                                    <td class="p-1">Image Id:</td>
                                    <td class="p-1">{{ $details->id }}</td>
                                </tr>
                                <tr>
                                    <td class="p-1">License type: </td>
                                    <td class="p-1">{{ $details->id }}</td>
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
                <div class="col text-right ">{{ Config::get('app.curreny') }} <span id="subtotal">0.0</span>
                </div>
                <input type="hidden" name="subtotal" value="0" id="subtotal_input">
            </div>
            <div class="form-row lower">
                <div class="col text-left">Discount</div>
                <div class="col text-right ">{{ Config::get('app.curreny') }} <span id="discount">0.0</span>
                </div>
               
            </div>
            <div class="form-row lower promo_code_div">
                <div class="col text-left">Promo Code</div>
                <span id="" class="text-danger invalid_promo_code invalid_promo_code_display_none">Please insert
                    valid promo code</span>
                <div class="col text-right">
                    <input type="text" class="" onchange="getPromoCode()" id="promo-code_input"
                        placeholder="Enter Promo code">
                    <input type="hidden" name="promo_code" value="" id="promo_code_input">
                </div>


            </div>
            <div class="form-row lower">
                <div class="col text-left"><b>Total to pay</b></div>
                <div class="col text-right ">{{ Config::get('app.curreny') }} <span id="total"> 0.0</span>
                </div>
                <input type="hidden" name="total" value="0" id="total_input">
            </div>
        </div>

        <button class="btn theme-btn btn-block" type="submit">Place order</button>
       
        {{-- <p class="text-muted text-center mt-3">Complimentary Shipping & Returns</p> --}}
    </div>
</div>