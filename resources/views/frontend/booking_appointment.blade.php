@extends('layouts.app')
@section('style')

    <link rel="stylesheet" href="{{ asset('themes/calender/style.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/calender/theme.css') }}">
    <style>
        .page-content-inner {
            padding: 14px 0;
        }

        h1.user-card-title {
            font-size: 18px;
            font-weight: bold;
        }

        h1.account-page-title {
            font-weight: bold;
        }

        label.col-form-label {
            text-align: right;
        }

        input.form-control {
            margin: 8px 0;
            height: 42px;
        }

        h1.user-card-title {
            padding: 8px 0;
        }
        /*@media screen and (max-width: 450px) {*/
        /*    .user-nav {*/
        /*        margin-top: 57px;*/
        /*    }*/
        /*    .user-nav ul li a {*/
        /*        padding: 2px;*/
        /*    }*/
        /*}*/

        h1.other-box-title {
            margin: 25px 0;
        }
        .other-box-sub-title {
            font-size: 19px !important;
            margin: 0 !important;
            padding: 0 !important;
            margin-bottom: 25px !important;
        }
        input.form-control.register-input {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 5rem;
            text-align: left;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-style: normal;
            font-weight: 500;
            font-size: 1.5rem;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1);
            padding: 0 1rem;
            line-height: 4.5rem;

        }

        .register-label {
            font-size: 13px;
            margin-bottom: 30px;
        }
        .select-input{
            height: 4.5rem;
            line-height: 3.5rem;
            border-radius: 0 !important;
            color: #19110b;

        }
        .date-of-birth-fieldset {
            margin: 0;
            padding: 0;
            border: 0;
        }
        .label {
            color: #19110b;
            display: block;
            margin: 0 0 0.5rem;
            font-weight: 400;
            letter-spacing: .4px;
        }
        .date-of-birth-fieldset legend {
            padding: 0;
        }
        .form-pattern .form-line .inputColumn, .formPattern1 .form-line .inputColumn, .formPattern2 .form-line .inputColumn, .formPattern3 .form-line .inputColumn, .formPattern4 .form-line .inputColumn {
            display: block;
            margin-bottom: 1.5rem;
        }
        @media only screen and (min-width: 48em){
            .date-of-birth-fieldset .displayTableCell {
                padding-right: 0.5rem;
            }
        }

        .displayTableCell {
            display: table-cell;
        }
        select {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 5rem;
            text-align: left;
            font-family: "Louis Vuitton Web","Helvetica Neue",Helvetica,Arial,sans-serif;
            font-weight: 400;
            font-style: normal;
            font-weight: 500;
            font-size: 1.5rem;
            line-height: 2;
            letter-spacing: .4px;
            transition: border .3s cubic-bezier(0.39,0.575,0.565,1);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2080%2080'%20focusable='false'%20aria-hidden='true'%20class='ui-icon-controls-chevron-down'%3E%3Cpath%20fill='%2319110b'%20fill-rule='evenodd'%20d='M46.2%2048.6L17.8%2020.3l-5.5%205.4%2028.4%2028.4%205.4%205.5.1.1.1-.1%205.3-4.5L80%2026.7l-5.5-6.4-28.3%2028.3z'/%3E%3C/svg%3E") no-repeat right 1rem top 50%;
            background-size: 3rem 1.8rem;
            max-width: 100%;
            padding: 0 8rem 0 1rem;
            position: relative;
            text-overflow: ellipsis;
        }
        .readonly-input {
            background: #f6f5f3 !important;
            border: none !important;
        }
        .modal-dialog {
            max-width: 775px;
        }
        button.close-modal-btn {
            background: transparent;
            border: none;
        }

        button.close-modal-btn i {
            color: #000;
            font-size: 23px;
            font-weight: normal !important;
        }

        .modal-title {
            font-weight: bold;
            margin-left: 17px;
        }
        .modal-body {
            position: relative;
            flex: 1 1 auto;
            padding: 1rem 30px;
        }
        .modal-footer {
            justify-content: flex-start;
        }
        .modal-footer {
            padding: 11px 27px;
        }
        .btn-modal-custom {
            padding: 0 4rem;
        }
        .address-book-add-btn {
            font-weight: normal;
            display: inline;
            font-size: 15px;
            padding: 15px 16px;
            background: #f6f5f3 !important;
        }

        .address-book-add-btn:hover {
            background: #EAE8E4 !important;
            border: 1.5px solid #19110B!important;
        }
        button{
            border: 1.5px solid #19110B!important;
        }
        .transferent-btn-style {
            background: transparent!important;
            color: #000!important;
            border: 1.5px solid #19110B!important;
        }
        h2.other-box-name {
            font-weight: bold;
            font-size: 24px;
        }


        #address-book-add-new{
            overflow: hidden;
        }
        .address-new-hid-box {
            top: 100%;
            position: relative;
            transition: all .3s ease-out;
            background: #428bca;
            height: 100%;
        }
        a.cancel-btn-address {
            border: 1px solid #ddd;
            height: 45px;
            width: 45px;
            line-height: 42px;
            text-align: center;
            font-size: 23px;
            color: #000;
            font-weight: 400;
            margin-bottom: 15px;
        }
        @media (min-width: 320px) and (max-width: 400px){
            .btn-next-bg-transparent{
                display: block;
            }
            .btn-next {
                text-align: center;
                color: #fff;
                line-height: 20px;
            }

            select {
                width: 106px;
            }
        }
        @media (min-width: 300px) and (max-width: 900px){
            .btn-next-bg-transparent{
                display: block;
            }
            .btn-next {
                text-align: center;
                color: #fff;
                line-height: 20px;
            }
            select {
                width: 106px;
            }
        }

    </style>
    <style>
        .other-page-box {
            border: 1px solid #eae8e4;
            background: #fff;
            padding: 2rem;
            margin: 7px 0;
        }
        h1.other-box-title {
            font-weight: bold;
            font-size: 26px;
            margin-bottom: 25px;
            padding-bottom: 0;
        }
        p.email-text {
            padding: 15px 0;
            margin: 0;
        }
        .btn-next {
            text-align: center;
            color: #fff;
            line-height: 50px;
        }

        .btn-next {
            background: #19110B;
            color: #fff;
            border: none;
            width: 100%;
            height: 50px;
            margin-top: 30px;
        }
        .btn-next:hover {
            background: #F6F5F3;
            color: #000;
        }
        .btn-next {
            margin: 6px 0;
        }
        .btn-next-bg-transparent {
            background: #fff;
            color: #000;
            border: 1.5px solid #000;
        }
        .btn-next-bg-transparent:hover{
            border: 1.5px solid #F6F5F3;
        }
        .other-page-box {
            margin-bottom: 15px;
        }
        .page-content-inner {
            padding-top: 0;
        }
        #user-panel-mobile-menu,.mobile-menu-button{
            display: none;
        }
        .user-panel-mobile-area ul {
            background: #fff;
            border-top: 1px solid #F6F5F3;
        }

        .user-panel-mobile-area {
            position: relative;
        }

        .user-panel-mobile-area ul {
            position: absolute;
            right: -15px;
            z-index: 9;
            top: 58px;
            box-shadow: -1px 2px 3px 0 #a79696;
        }

        .user-panel-mobile-area ul li {
            display: block;
        }

        .user-panel-mobile-area ul li a {
            display: block;
            padding: 15px 38px;
        }
        @media screen and (max-width: 767px) {
            .user-nav-section {

            }
            #user-panel-mobile-menu,.mobile-menu-button{
                display: block;
            }
        }


        .mobile-menu-button {
            position: absolute;
            right: 0;
            top: 21px;
            font-size: 17px;
        }
        .mobile-menu-button.btn-mobile-remove {
            color: #000;
        }
        .user-panel-mobile-area ul {
            visibility: hidden;
        }
        .table tbody td {
            padding: 1.5rem 1.5rem;
        }
        .table thead th, .table th {
            padding: 1.5rem 1.5rem;

            font-size: 13px;
            border: 1px solid #000000;

        }
        .table tbody td {
            padding: 1.5rem 1.5rem;
        }
        .table td {
            vertical-align: middle;
            border: 1px solid #000000;
        }
        .header-mobile__inner {
            position: initial !important;
        }
        h3.user-panel-title {
            padding: 18px 0;
            margin: 0;
        }
        .con-number{
            color: white;
            border: 1px solid #000;
            background: #000;
            padding: 3px 9px;
            border-radius: 50%;
            margin-right: 12px;
        }
        p.other-box-title{
            color: #000;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
    <style>
        .calendar-wrapper {
            width: 100%;
            max-width: 454px;
            margin: auto;
            border: 1px solid #eee;
            padding: 10px;
        }
        .weeks-wrapper.header {
            min-height: 0 !important;
            height: 41px !important;
        }
        .slide-bar-login-form p {
            text-align: center;
            padding: 8px 0;
            margin: 0;
            color: #000;
            font-weight: 500;
        }
        .week {
            margin: 0;
        }
        a.calender-field-area {
            width: 100%;
            position: relative;
        }

        span.date-icon {
            position: absolute;
            right: 15px;
            top: 16px;
            font-size: 19px;
        }
        .slide-bar-login-form.side-bar-calender {
            border: none;
        }

        .calendar-wrapper {
            max-height: 384px;
            overflow: auto;
        }
        .d-grid.calender-select-button {
            margin-top: 31px;
        }
        label.appointment_type {
            color: #000;
            font-weight: 500;
            font-size: 14px;
            margin-top: 7px;
        }
        .appointment_time span {
            width: 100px;
            display: inline-block;
            text-align: center;
            border: 1px solid #000;
            margin-right: 16px;
            height: 52px;
            margin-top: 15px;
            margin-bottom: 15px;
            line-height: 52px;
            text-transform: uppercase;
            color: #000;
            cursor: pointer;
            font-size: 17px;
        }
        .appointment_time span.active {
            background: #000;
            color: #fff;
        }
        @media screen and (max-width: 400px) {
            .cover-photo img{
                width: 150px;
            }
            .appointment-modify a{
                margin-left: -37px;
            }
        }
        @media screen and (min-width: 371px) and (max-width: 400px) {
            .cover-photo img{
                width: 150px;
            }
            .appointment-modify a{
                margin-left: -37px;
            }
        }
        @media (max-width: 61.94em){
            .cover-photo img{
                width: 150px;
            }
            .appointment-modify a{
                margin-left: -37px;
            }
        }
        @media screen and (min-width: 401px) and (max-width: 460px) {
            .cover-photo img{
                width: 150px;
            }
            .appointment-modify a{
                margin-left: -37px;
            }
        }
        @media screen and (min-width: 401px) and (max-width: 460px) {
            .cover-photo img{
                width: 150px;
            }
            .appointment-modify a{
                margin-left: -37px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/theme.css">
@endsection

@section('content')
    <div class="user-nav-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <h3 class="user-panel-title">My BD</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-inner body-height-full">
        <div class="container">
            <form action="{{ route('appointment_form') }}" method="post">
                @csrf
                <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1 class="other-box-title text-bold">BOOK IN-STORE APPOINTMENT</h1>
                    <div class="other-page-box">
                        <p class="other-box-title"><span class="con-number authentication-checked">1</span>APPOINTMENT DETAILS</p>
                        <hr>
                        <div id="appointment-step-1" >
                            <div class="row">
                                <label class="col-12 register-label" for="country">Date <span class="text-danger">*</span>
                                    <div class="form-group">
                                        <a href="#sideDate" class="toolbar-btn calender-field-area">
                                            <input type="text" readonly name="appointment_field_date" id="appointment_field_date" class="form-control register-input select-input">
                                            <span class="date-icon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </a>
                                    </div>
                                    @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </label>
                            </div>
                        </div>
                        <div id="appointment-step-3" style="display: none">
                            <div class="row">
                                <div class="col-11 pb-5">
                                    <h3><b id="appointment-time-show"></b></h3>
                                    <h4><b id="appointment-type-show"></b></h4>
                                </div>
                                <div class="col-1 pb-5 appointment-modify">
                                    <a id="modify_appointment" role="button"><u>Modify</u></a>
                                </div>
                                <hr>
                                <div class="row pt-3">
                                    <div class="col-6 cover-photo">
                                        <img src="{{ asset('img/rsz_store.png') }}" alt="" class="store-img">
                                    </div>
                                    <div class="col-6">
                                        <h3><b>Lalmatia, Dhaka</b></h3>
                                        <h4>2/1 Block A, Lalmatia, Dhaka</h4>
                                        <h4>+8801608911692</h4>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"  class="btn-next">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="other-page-box" id="appointment-step-2" style="display: none">
                        <p class="other-box-title">Choose your appointment (local time):</p>
                        <hr>
                       <h3><b>Lalmatia, Dhaka</b></h3>
                        <h4>2/1 Block A, Lalmatia, Dhaka</h4>
                        <h4>+8801608911692</h4>
                        <div class="appointment_time" id="appointment_time"></div>
                        <input  type="hidden" id="appointment_time_field"  name="appointment_time_field">

                        <div class="form-group">
                            <label class="appointment_type" for="in_store">
                                <input checked type="radio" id="in_store" value="1" name="type"> In-Store Appointment
                            </label><br>
                            <label class="appointment_type"  for="virtual">
                                <input type="radio" id="virtual" value="2" name="type"> Virtual appointment
                            </label>
                        </div>
                        <button type="button"  id="schedule-selected" style="display: none" class="btn-next">Next</button>
                    </div>
                    <div class="other-page-box" id="appointment-step-4" style="display: none">
                        <p class="other-box-title"><span class="con-number authentication-checked">2</span>CONTACT INFORMATION</p>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" id="email" class="form-control register-input select-input">
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                                <button type="button"  id="email-selected" class="btn-next">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <aside class="side-navigation side-navigation--left" id="sideDate">
        <div class="side-navigation-wrapper">
            <div class="slide-bar-login-area">
                <h3>SELECT A DATE</h3>
                <a href="#" class="btn-close"><i class="dl-icon-close"></i></a>
            </div>
            <div class="side-navigation-inner">

                <div class="slide-bar-login-form side-bar-calender">
                    <p>Available times for the next 30 days.</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="calendar-wrapper" id="calendar-wrapper"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid calender-select-button">
                                <button type="button" id="select-date" class="btn-login-side">Select</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/calendar.min.js"></script>

    <script type="text/javascript">
        $('#calendar-wrapper').on('click', function(e){
            e.stopPropagation();
        });
        $("#appointment_time_select").click(function (){

            var authCheck = "{{ auth()->check() && auth()->user()->role == \App\Enumeration\Role::$BUYER }}";

            if(authCheck != ''){
                location.href('{{ route('login') }}');
            }

        })
        $('body').on('click', '.single_time_slot', function(){
            $('.single_time_slot').removeClass('active');
            $(this).addClass('active');

            $("#appointment_time_field").val($(this).data('id'));
            $("#schedule-selected").show();
        });
        function convertDateStringCustom(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        }
        var defaultConfig = {
            weekDayLength: 1,
            date: '{{ date('m/d/Y') }}',
            onClickDate: selectDate,
            showYearDropdown: true,
            startOnMonday: false,
        };

        var calendar = $('#calendar-wrapper').calendar(defaultConfig);

        function selectDate(date) {
            $('#calendar-wrapper').updateCalendarOptions({
                date: date
            });
            console.log(calendar.getSelectedDate());
            var convertDateFormat = convertDateStringCustom(calendar.getSelectedDate());
            $("#appointment_field_date").val(convertDateFormat);
        }

        $('#select-date').click(function (){
            $('#sideDate').removeClass('open');
            var convertDateGet = $("#appointment_field_date").val();

            if (convertDateGet != '') {
                $('#appointment_time').html(' ');

                $.ajax({
                    method: "GET",
                    url: "{{ route('get_appointment_slot_by_calender') }}",
                    data: {convertDate: convertDateGet}
                }).done(function (data) {
                    $.each(data, function (index, item) {
                        $('#appointment_time').append('<span class="single_time_slot" data-id="' + item + '">' + item + '</span>');
                    });
                    $('#appointment-step-2').show();

                });
            }


        })
        $("#schedule-selected").click(function (){

            var appointmentType = $("input[type]:checked").val();
            var appointmentTime = $("#appointment_field_date").val();
            var appointmentTimeSlot = $(".single_time_slot.active").data('id');

            if(appointmentType == 1)
                var appointmentTypeName = 'In-Store Appointment';
            else
                var appointmentTypeName = 'Virtual appointment';

            $("#appointment-time-show").html(appointmentTime+', '+appointmentTimeSlot);
            $("#appointment-type-show").html(appointmentTypeName);


            $("#appointment-step-1").hide();
            $("#appointment-step-2").hide();
            $("#appointment-step-3").show();

        })
        $("#modify_appointment").click(function (){

            $("#appointment-step-1").show();
            $("#appointment-step-2").show();
            $("#appointment-step-3").hide();

        })

    </script>

@endsection
