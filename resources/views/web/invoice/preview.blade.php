<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Drik Images | Invocie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('public/css/drik/css/bootstrap.min.css')}}">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
<style type="text/css">

.theBox {
      overflow: hidden;
      /* width: 240px; */
      height: 100px;
   }

   .theBox img {
      /* display: block; */
      height: 100%;
   }
body{
    margin-top:20px;
    background:#eee;
}

.invoice {
    background: #fff;
    padding: 20px
}

.invoice-company {
    font-size: 20px
}

.invoice-header {
    margin: 0 -20px;
    background: #f0f3f4;
    padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
    display: table-cell;
    width: 1%
}

.invoice-from,
.invoice-to {
    padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    background: #f0f3f4;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    width: 75%;
    position: relative;
    vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
    width: 25%;
    /* background: #2d353c; */
    /* color: #fff; */
    font-size: 15px;
    text-align: right;
    vertical-align: bottom;
    /* font-weight: 300 */
}

/* .invoice-price .invoice-price-right small {
    display: block;
    opacity: .6;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px
} */

.invoice-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    color: #999;
    margin-top: 80px;
    font-size: 85%
}

.invoice>div:not(.invoice-footer) {
    margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
    color: #2d353c;
    background: #fff;
    border-color: #d9dfe3;
}
</style>
   
   <script type="text/javascript">
   
   </script>
</head>
<body>

<div class="container">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
   
         <div class="invoice-company text-inverse f-w-600 row">
            {{-- <span class="pull-right hidden-print">
         
            
            </span> --}}
            <div class="col-lg-6"><img width="25%" src="http://localhost/drik/public/images/Drik images logo.png"></div>
            <div class="col-lg-6 text-right">
               <a href="{{url('all-purchase')}}" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i>Back</a>
               <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </div>
            
            
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
    

         <div class="invoice-header">
            <div class="invoice-from">
               <strong>From</strong>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">Drik Images</strong><br>
                  Union Heights, Level :07; 55-2 West, Panthapath<br>
                  Dhaka,1205<br>
                  Phone: 02-8141817<br>
               </address>
              
            </div>
            <div class="invoice-to">
               <strong>To</strong>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">{{$user->name}}</strong><br>
                
                  <address class="m-t-5 m-b-5">
                     @if(isset($purchase->address)){{$purchase->address}}<br>@endif
                     @if(isset($purchase->street)){{$purchase->street}},@endif @if(isset($purchase->zip)){{$purchase->zip}}<br>@endif
                     Phone: @if(isset($purchase->phone)){{$purchase->phone}}<br>@endif
                  </address>
               </address>
            </div>
            <div class="invoice-date">
               <div class="date text-inverse m-t-5"><h5 style="color: rgb(9, 206, 9)"><strong>Paid</strong></h5></div>
               <div class="date text-inverse m-t-5">Invoice - #{{$purchase->id}}</div>
               <div class="date text-inverse m-t-5">{{date('F d,Y',strtotime($purchase->payment_date))}}</div>
               <div class="invoice-detail">
                
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <h5>Your Order ({{count($purchase->purchase_details)}} Items)</h5>
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-invoice">
                  <thead style="background-color: #f0f3f4">
                     <tr>
                        <th class="text-center"  >Image Id</th>
                        <th class="text-center" width="20%">Image</th>
                       
                        <th class="text-center" >Title</th>
                        <th class="text-center" >Quantity</th>
                        <th class="text-right" >Price</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($purchase->purchase_details as $item)
                        <tr>
                           <td class="text-center">
                              {{$item->image_id}}
                           </td>
                           <td class="text-center">

                              <div class="theBox">
                                 <img src="{{$item->thumbnail}}" alt=""> 
                              </div>
                           </td>
                         
                           
                       
                           <td class="text-center">{{$item->title}}</td>
                           <td class="text-center">1</td>
                           <td class="text-right">{{Config::get('app.curreny')}} {{number_format((float) $item->price, 2, '.', '')}}</td>
                        </tr>
                     @endforeach
                  
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <div class="invoice-price-row">
                     <div class="sub-price">
                        <small>Payment By : {{$purchase->payment_method}}</small>
                        
                       
                     </div> 
         
                  </div>
               </div>
               <div class="invoice-price-right">
                  <div class="row">
            
                     <div class="col-lg-6 text-right">Subtotal</div>
                     <div class="col-lg-6 text-right">{{Config::get('app.curreny')}} {{number_format((float) $purchase->sub_total, 2, '.', '')}}</div>
                     <div class="col-lg-6 text-right">Promocode</div>
                     <div class="col-lg-6 text-right">{{Config::get('app.curreny')}} {{number_format((float) $purchase->promocode_amount, 2, '.', '')}}</div>
             
                     <div class="col-lg-6 text-right">Total</div>
                     <div class="col-lg-6 text-right">{{Config::get('app.curreny')}} {{number_format((float) $purchase->total, 2, '.', '')}}</div>
           
                  </div>
               </div>
               
            </div>
            <!-- end invoice-price -->
         </div>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
         {{-- <div class="invoice-note">
            * Make all cheques payable to [Your Company Name]<br>
            * Payment is due within 30 days<br>
            * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
         </div> --}}
         <!-- end invoice-note -->
         <!-- begin invoice-footer -->
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               THANK YOU FOR BUSINESS WITH US
            </p>
            <p class="text-center">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> drikimages.com</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:02-81418172</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> images@drikimages.com</span>
            </p>
         </div>
         <!-- end invoice-footer -->
      </div>
   </div>
</div>

</body>
</html>