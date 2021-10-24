
@extends('backEnd.master')
@section('mainContent')
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message-success'))
                <div class="alert alert-success background-success" role="alert">
                    {{ session()->get('message-success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session()->has('message-danger'))
                <div class="alert alert-danger background-danger">
                    {{ session()->get('message-danger') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

         
            <div id="inner_div">
                @include('backEnd.portfolio_images.view_inner_data')
            </div>


       

            {{-- <script src={{ asset('public/js/imageList.js') }}></script> --}}
        </div>

        <script>
            $(window).on('hashchange', function() {
                if (window.location.hash) {
                    var page = window.location.hash.replace('#', '');
                    if (page == Number.NaN || page <= 0) {
                        return false;
                    } else {
                        getData(page);
                    }
                }
            });

            $(document).ready(function() {
                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();

                    $('li').removeClass('active');
                    $(this).parent('li').addClass('active');

                    var myurl = $(this).attr('href');
                    var page = $(this).attr('href').split('page=')[1];

                    getData(page);
                });

            });

            function getData(page) {
                // alert(page);
                $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    datatype: "html"
                }).done(function(data) {

                    $("#inner_div").empty().html(data);
                    location.hash = page;
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('No response from server');
                });
            }

        </script>

    @endSection


    










