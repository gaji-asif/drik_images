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

            <div class="card">
                <div class="container" style="margin: 0 auto;">



                    <div class="search_form row" style="padding: 20px 30px;">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 " style="margin-top:6px">

                            <select
                                class="js-example-basic-single col-sm-12 {{ $errors->has('role_id') ? ' is-invalid' : '' }}"
                                id="contributor_portfolio_id">
                                <option value="">Select Contributor</option>
                                @if (isset($contributor))
                                    @foreach ($contributor as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        {{-- <input name="search_key" type="text" class="form-control col-lg-5" id="" placeholder="Search Images"> --}}
                        <button type="submit" onclick="getPortfolioImages()" class="btn col-lg-1"
                            style="margin-left: 10px;">Search</i></button>
                    </div>

                </div>
            </div>
            <div id="inner_div">
                @include('backEnd.portfolio_images.inner_data')
            </div>


       

            <script src={{ asset('public/js/imageList.js') }}></script>
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
