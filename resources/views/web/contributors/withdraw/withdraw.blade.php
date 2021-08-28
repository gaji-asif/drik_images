@include('web.partials.header')
<style>
    .theBox {
      overflow: hidden;
      /* width: 240px; */
      height: 100px;
   }

   .theBox img {
      /* display: block; */
      height: 100%;
   }
</style>
<div class="row col-md-12" style="min-height: 450px; background-color: #eff0f4; padding-top: 10px; padding-bottom: 5px;">
    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <p>
                    <span>
                        <img width="40" class="rounded-circle" src="{{ asset($user->upload_img) }}" class="img-radius" alt="">
                    </span>
                    <span>{{ Auth::user()->name }}</span>
                </p>
                <hr>
                @include('web.contributors.sidemenu')
            </div>
        </div>
    </div>
    <div class="col-sm-9">
        <div class="card ">
            <div class="container mt-4">
                
                <a href="{{url('withdraw-list')}}"><button class="btn btn-info mb-2">Withdraw List</button></a>
                <h5>Withdraw Request</h5>
                <form>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="amount">Withdraw Amount</label>
                        <input type="number" step="0.1" min="0.1" required class="form-control" id="amount" name="amount" placeholder="0.0" @if (isset($contributorWithdrawInformation)) max="{{$contributorWithdrawInformation->muture_amount}}"@endif>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="paymentMethod">Payment Type</label>
                        <select class="form-control" id="paymentMethod" name="payment_method" required>
                            <option value="">Select a payment method</option>
                           @if (isset($paymentMethods))
                            @foreach ($paymentMethods as $paymentMethod)
                                <option value="{{$paymentMethod->id}}">{{$paymentMethod->method_name}}</option>
                            @endforeach
                           @endif
                        </select>
                      </div>
                    </div>


                    <div id="bank_div"  class="">
                        <div class="form-row ">
                            <div class="form-group col-md-6">
                              <label for="bank_name">Bank Name</label>
                              <input type="text" name="bank_name"  class="form-control" id="bank_name" placeholder="Enter a bank name" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_account_no">Bank Account No</label>
                                <input type="text" name="bank_account_no"  class="form-control" id="bank_account_no" placeholder="Enter a bank name" >
                            </div>
                        </div>
                    </div>
                    <div id="mobile_div" class="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="mobile_number">Mobile Number</label>
                              <input type="text" name="mobile_number"  class="form-control" id="mobile_number" placeholder="Enter a bkash mobile number" >
                            </div>
                        </div>
                    </div>
                   
                    <div class="text-center pt-2">
                        <button type="submit" class="btn btn-primary">Request</button>
                    </div>
      
                </form>
            </div>
        </div>
    </div>
</div>

@include('web.partials.footer')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function() {
        $('#bank_div').hide();
        $('#mobile_div').hide();
        $('#example').DataTable();


        $("form").submit(function (event) {
            event.preventDefault();
            let form = $(this).serialize()
           
            // let formData = new FormData();
           
            // formData.append('form', form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            type: "POST",
            url: "{{url('submit-withdraw')}}",
            data: form,
            dataType: "json",
            encode: true,
            }).done(function (data) {
                swal("Withdraw request send successfully", {
                        icon: "success",
                }).then((willApprove) =>{
                    window.location.href = "{{url('withdraw-list')}}";
                });
                   
            });

          
        });
    });

    $('#paymentMethod').on('change', function() {
        var paymentMethod = $(this).val();
   

        if(paymentMethod == 1) {
            $('#bank_div').show();
            $('#mobile_div').hide();
            $("#bank_name").prop('required',true);
            $("#bank_account_no").prop('required',true);
            $("#mobile_number").prop('required',false);
        }
        else if(paymentMethod == 2){
            // alert(2);
            $('#mobile_div').show();
            $('#bank_div').hide();
            $("#bank_name").prop('required',false);
            $("#bank_account_no").prop('required',false);
            $("#mobile_number").prop('required',true);
        }
        else{
            $('#bank_div').hide();
            $('#mobile_div').hide();
            $("#bank_name").prop('required',false);
            $("#bank_account_no").prop('required',false);
            $("#mobile_number").prop('required',false);
        }

    });
</script>