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

        .invalid_promo_code_display_none {
            display: none;
        }

    </style>
   <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
    @csrf
    <div class="container">
        <div class="form-row mt-3 mb-3">
            @if (!is_null(auth()->user()))
                @include('checkout_inner_div_authenticated_user')
            @else
                @include('checkout_inner_div_unauthenticated_user')
            @endif
          
        </div>
    </div>
</form>
@endsection
