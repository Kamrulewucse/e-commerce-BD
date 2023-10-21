@extends('layouts.app')
@section('style')
    <style>

        #map{
            height: calc(100vh - 117px);
        }
        @media (max-width: 61.94em){
            #map{
                height: 100vh !important;
            }
        }
        .store-search-area {
            background: #f6f5f3;
        }



        .store-info-area {
            background: #f6f5f3;
        }

        .store-list {
            background: #fff;
        }

        .store-search-area {
            padding: 1.5rem 3.4vw;
        }



        .store-search-area h1 {
            font-size: 30px;
            font-weight: 700;
        }

        .store-list h2,.store-search-area h2{
            font-size: 22px;
            padding-bottom: 15px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        h3.store-name {
            font-weight: 600;
            font-size: 17px;
            margin-bottom: 7px;
        }

        p.store-address {
            font-size: 15px;
        }

        p.store-contact-numbers {
            font-size: 17px;
            font-weight: 600;
            color: #000;
        }

        a.store-detail-link {
            color: #000;
            font-size: 13px;
            text-decoration: underline;
            font-weight: 500;
        }

        .store-item {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .store-item {
            padding-bottom: 20px;
        }

        .input-search {
            background: #fff;
            border: 1px solid #000;
            width: 100%;
        }

        .input-search input {
            border: none;
            height: 47px;
            padding: 12px 13px;
            display: inline-block;
            width: 85%;
            float: left;
        }

        .input-search button {
            width: 15%;
            height: 47px;
            background: #d3d3d3;
            border: none;
            padding: 0;
            color: #fff;
        }
        a.send-and-email {
            align-items: center;
            align-content: center;
            -webkit-appearance: none;
            border: 0 none;
            border-radius: 0;
            box-sizing: border-box;
            cursor: pointer;
            display: inline-flex;
            min-height: 1rem;
            font-weight: 400;
            line-height: 1.25;
            letter-spacing: .4px;
            font-family: inherit;
            justify-content: center;
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1),box-shadow .3s cubic-bezier(0.39,0.575,0.565,1),color .3s cubic-bezier(0.39,0.575,0.565,1),background .3s cubic-bezier(0.39,0.575,0.565,1);
            background: rgba(234,232,228,0);
            box-shadow: inset 0 0 0 1px #19110b;
            color: #19110b;
            width: 100%;
            padding: 14px 0;
            font-size: 15px;
            margin: 12px 0;
            margin-top: 30px;
        }
        a.send-and-email:hover{
            background-color: #eae8e4;
            box-shadow: inset 0 0 0 1px #eae8e4;
            color: #19110b;
        }
        a.send-and-email i {
            margin: 0 5px;
        }
        .store-search-area {
            padding: 1.5rem 40px;
        }
        .form-group {
            margin-bottom: 14px;

        }
        .form-control{
            font-weight: 500;
            color: #000;
        }
        button.app-send-btn {
            border: none;
            border-radius: 50px;
            background: #4A4141;
            color: #fff;
            padding: 6px 16px;
        }
        .store-search-area {
            background: #fff;
        }
        label {
            font-weight: 600;
            color: #000;
        }
        .modal-body{
            border-top: 2px solid #F5F4F2;
        }
        .cart-modal-dialog {
            margin-right: 0;
            margin-top: 0;
            max-width: 400px;
        }
        a.back-button:hover {
            background: #F6F5F3;
        }
        .modal-dialog {
            max-width: 350px;
            margin: 75px auto;
        }
        button.close-modal-btn {
            background: transparent;
            border: none;
        }

        button.close-modal-btn i {
            color: #000;
            font-size: 12px;
            font-weight: normal !important;
        }
        .cart-modal-btn {
            padding: 10px 10px;
            height: auto !important;
            min-height: 10px !important;
            line-height: initial;
            text-transform: uppercase;
        }
        .cart-modal-header{
            display: block;
            padding: 3px;
            margin-right: 13px;
        }
    </style>
    <style>
        button.gm-ui-hover-effect{
            top: 3px !important;
            right: 8px !important;
            width: 32px !important;
            height: 30px !important;
            font-size: 40px !important;
        }
        .share-direction-area ul li{
            display: inline;
        }
        .share-direction-area ul li a.map-direction{border-right: 1px solid #f2efeb;}
        .share-direction-area ul li a {
            display: inline-block;
            padding: 18px 24px;
            color: #000;
            font-weight: 400;
        }
        .share-direction-area ul li a:not([href]):not([class]), .share-direction-area ul li a:not([href]):not([class]):hover {
            color: #000;
            font-weight: 400;
        }
        .share-direction-area ul {
            /*display: flex;*/
            /*align-items: center;*/
            /*justify-content: space-between;*/
            /*flex-wrap: wrap;*/
            border-top: 1px solid #f2efeb;
            border-bottom: 1px solid #f2efeb;
        }
        .share-direction-area ul li {
            position: relative;
        }

        ul.social-links {
            display:none;
            position: absolute;
            top: -58px;
            left: -3px;
            width: 171px;
            background: #fff;
            box-shadow: 0 2px 8px 0 rgb(0 0 0 / 12%), 0 8px 16px 0 rgb(0 0 0 / 16%);
            transition: all 0.5s ease;
        }
        ul.social-links li a {
            display: inline-block;
            padding: 8px 9px;
            font-size: 15px;
        }
        ul.social-links:after {
            left: 50%;
            transform: translateX(-50%);
        }
        ul.social-links:after {
            content: " ";
            position: absolute;
            bottom: -10px;
            height: 0;
            width: 0;
            pointer-events: none;
        }
        ul.social-links:after {
            border-top: 2.4375rem solid #fff;
            border-right: 1.4375rem solid transparent;
            border-left: 1.4375rem solid transparent;
        }
        a.share-btn {
            padding: 18px 43px !important;
        }
        a#social-close-btn {
            border-left: 1px solid #eae8e4;
            font-weight: normal;
            color: #fb5151;
        }

        a.appointment-btn {
            background: #19110b;
            color: #fff;
            width: 100%;
            text-align: center;
            padding: 11px 8px;
            display: block;
            transition: all 0.5s ease;
            margin-bottom: 25px;
        }

        a.appointment-btn:hover {
            background: #eae8e4;
            color: #19110b;
        }
        .store-list h2 {
            padding: 18px 45px;
            padding-top: 40px;
        }

        .store-item {
            padding: 23px 45px;
        }
        .book-appointment-btn-area {
            padding: 0 45px;
        }
        .store-list h2 {
            padding: 18px 45px;
            padding-top: 40px;
        }

        .store-item {
            padding: 23px 45px;
        }

        .book-appointment-btn-area {
            padding: 0 45px;
        }

        .share-direction-area {padding-top: 10px;padding-left: 26px;}
    </style>
@endsection


@section('content')
    <section class="stores-area body-height-full">
        <div class="container-fluid" style="padding: 0;margin: 0">
            <div class="row">
                <div class="col-md-8 order-md-first order-last p-0">
                    <div class="store-map-area">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="col-md-4 p-0">
                    <div class="store-info-area">
                        <div class="store-list">
                            <h2>{{ __('store_page.our_warehouse') }}</h2>
                                <div class="store-item">
                                    <h3 class="store-name">{{ __('store_page.store_name') }}</h3>
                                    <p class="store-address">{{ __('store_page.store_address') }}</p>
                                    <p class="store-contact-numbers">{{ __('store_page.store_contact_number') }}</p>
                                </div>
                                <div class="book-appointment-btn-area">
                                    @if(auth()->check() && auth()->user()->role == \App\Enumeration\Role::$BUYER)
                                    <a class="appointment-btn" href="{{ route('booking_appointments') }}">
                                        Book in-store appointment
                                    </a>
                                    @else
                                        <a class="appointment-btn" href="{{ route('login') }}?redirect_appointment=true">
                                            Book in-store appointment
                                        </a>
                                    @endif
                                </div>
                                <div class="share-direction-area">
                                    <ul>
                                        <li><a target="_blank" id="map-direction" class="map-direction"><i class="fa fa-share"></i> Driving Directions</a></li>
                                        <li>
                                            <a class="share-btn" id="share-btn" role="button"><i class="fa fa-share-alt-square"></i> Share</a>
                                            <ul class="social-links">
                                                <li><a target="_blank" href="{{ $socialLinks['facebook'] }}"><i class="fa fa-facebook"></i></a></li>
                                                <li><a target="_blank" href="{{ $socialLinks['twitter'] }}"><i class="fa fa-twitter"></i></a></li>
                                                <li><a target="_blank" href="{{ $socialLinks['whatsapp'] }}"><i class="fa fa-whatsapp"></i></a></li>
                                                <li><a target="_blank" href="{{ $socialLinks['linkedin'] }}"><i class="fa fa-linkedin"></i></a></li>
                                                <li><a role="button" id="social-close-btn"><i class="fa fa-close"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="store-search-area" style="display: none">
                            <h2>{{ __('store_page.appointment_form_title') }}</h2>
                            <p>{{ __('store_page.appointment_description') }}
                                <br> <br></p>
                            <div class="appointment-from">
                                <form action="{{ route('appointment_form') }}"  method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('form_text.name') }}</label>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input required type="text" name="first_name" class="form-control" placeholder="{{ __('form_text.first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input required type="text" name="last_name" class="form-control" placeholder="{{ __('form_text.last_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('form_text.address') }}</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-12">
                                                   <div class="form-group">
                                                       <input required type="text" name="street_address" class="form-control" placeholder="{{ __('form_text.street_address') }}">
                                                   </div>
                                                </div>
                                                <div class="col-12">
                                                  <div class="form-group">
                                                      <input required type="text" name="street_address_2" class="form-control" placeholder="{{ __('form_text.street_address_line2') }}">
                                                  </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <input required type="text" name="city" class="form-control" placeholder="{{ __('form_text.city') }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                   <div class="form-group">
                                                       <input required type="text" name="post_or_zip_code" class="form-control" placeholder="{{ __('form_text.post_zip_code') }}">
                                                   </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <select required name="country" class="form-control">
                                                            <option value="">{{ __('form_text.country') }}</option>
                                                            @foreach($countries as $country)
                                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10 offset-md-2">
                                            <div class="form-group">
                                                <select required id="appointment_day" name="appointment_day" class="form-control">
                                                    <option value="">{{ __('form_text.appointment_day') }}</option>
                                                    @foreach($appointmentDays as $appointmentDay)
                                                        <option value="{{ $appointmentDay }}">{{ date('(d F l)-Y',strtotime($appointmentDay)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10 offset-md-2">
                                            <div class="form-group">
                                                <select required id="appointment_time" name="appointment_time" class="form-control">
                                                    <option value="">{{ __('form_text.appointment_time') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="">{{ __('form_text.date_of_birth') }}</label>
                                        </div>
                                        <div class="col-md-10">
                                           <div class="form-group">
                                               <input required  max="{{ date('Y-m-d',strtotime('-1 days')) }}"   type="date" name="date_of_birth" class="form-control">
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-10 offset-md-2">
                                            <button id="appointment_check" class="app-send-btn">{{ __('form_text.send_appointment_from') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="modal fade fadeInLeft" id="auth-notification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog cart-modal-dialog">
            <div class="modal-content">
                <div class="modal-header cart-modal-header">
                    <div class="row card-title-header">
                        <div class="col-6">
                            <p class="cart-main-title pull-left">Identification</p>
                        </div>
                        <div class="col-6">
                            <button type="button" class="close-modal-btn pull-right" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="pro-details">
                      <h3>Please Login First</h3>
                    </div>
                    <div class="row">
                        <div class="col-6 offset-md-6">
                            <a href="{{ route('login') }}"  class="btn w-100 btn-secondary cart-modal-btn" style="font-size:10px;">Confirm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/share.js') }}"></script>

        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnKKbnZogxI9jte1w5VhVfg0CyyZyJTzw&callback=initMap">
        </script>
        <script>

            $("#share-btn").click(function (){
                $(".social-links").show();
            })
            $("#social-close-btn").click(function (){
                $(".social-links").hide();
            })
            $(document).on('click', function(){
                $(".social-links").hide();
            });
            $('#share-btn').on('click', function(e){
                e.stopPropagation();
            });
            $("#appointment_check").click(function (){

                var authCheck = "{{ $authCheck }}";

                if(authCheck != ''){
                    return true;
                }else{
                    $("#auth-notification").modal('show');
                    return false;
                }

            })

            $('#appointment_day').change(function () {
                var appointmentDay = $(this).val();

                $('#appointment_time').html('<option value="">{{ __('form_text.appointment_time') }}</option>');

                if (appointmentDay != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_appointment_slot') }}",
                        data: { appointmentDay: appointmentDay }
                    }).done(function( data ) {
                        $.each(data, function( index, item ) {
                            $('#appointment_time').append('<option value="'+item+'">'+item+'</option>');
                        });
                    });
                }
            });

            $('#appointment_day').trigger('change');


            var currentLocation = <?php echo json_encode($locationDetail,true); ?>;
            var directionUrl = 'https://www.google.com/maps/dir/'+currentLocation.latitude+','+currentLocation.longitude+'/2,+1+Block+%23+A,+Dhaka+1205/@23.7574573,90.376835,14z/data=!3m1!4b1!4m18!1m7!3m6!1s0x3755bf54aeecae9d:0x5f5a4e02f6d77e84!2s2,+1+Block+%23+A,+Dhaka+1205!3b1!8m2!3d23.7573716!4d90.3744664!4m9!1m1!4e1!1m5!1m1!1s0x3755bf54aeecae9d:0x5f5a4e02f6d77e84!2m2!1d90.3744664!2d23.7573716!3e0'
            $("#map-direction").attr('href',directionUrl);

            function initMap() {
                const uluru = {lat: 23.757315, lng: 90.374291};
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 21,
                    center: uluru,
                });

                const contentString =
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    "</div>" +
                    '<h1 id="firstHeading" class="firstHeading"><b>'+'{{ config('app.name') }}'+'</b></h1>' +
                    '<div id="bodyContent">' +
                    "<p>" +
                    "<img height='230px' width='400px' src='{{ asset('img/store.png') }}' alt=''>"+
                    "</p>"+
                   "</div>" +
                    "</div>";
                const infowindow = new google.maps.InfoWindow({
                    content: contentString,
                });
                var image = {
                    url: "{{ asset('img/map.png') }}",
                    size: new google.maps.Size(32, 38),
                    scaledSize: new google.maps.Size(32, 38),
                    labelOrigin: new google.maps.Point(20, 38)
                };
                const marker = new google.maps.Marker({
                    position: uluru,
                    icon:image,
                    map,
                    label: '{{ config('app.name') }}',
                    title: '{{ config('app.name') }}',

                });
                infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                });
                marker.addListener("click", () => {
                    infowindow.open({
                        anchor: marker,
                        map,
                        shouldFocus: false,
                    });
                });
            }

            window.initMap = initMap;
        </script>

 @endsection

