@extends('layouts.app')
@section('style')
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
        button.btn.btn-danger.btn-cancel {
            background: #bb2d3b;
            border-color: #bb2d3b;
        }
        h1.other-box-title {
            margin: 25px 0;
        }
    </style>
    <style>

    </style>
@endsection
@section('content')

    @include('layouts.partial.user_nav')
    <div id="content" class="main-content-wrapper body-height-full">
        <div class="page-content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <h1 class="other-box-title">MY APPOINTMENTS</h1>
                        <hr>

                        <h1 class="other-box-title">UPCOMING APPOINTMENTS</h1>
                        @if(count($upcomingAppointments) > 0)
                            @foreach($upcomingAppointments as $appointment)
                                <div class="other-page-box">
                                    <div class="row">
                                        <div class="col-12 pb-5">
                                            <h3><b id="">{{ $appointment->appointment_day->format('l, F d, Y') }}, at <span style="text-transform: uppercase">{{ $appointment->appointment_time }}</span></b></h3>
                                            @if($appointment->type == 1)
                                                <h4><b id="">In-Store Appointment</b></h4>
                                            @else
                                                <h4><b id="">Virtual appointment</b></h4>
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="row pt-3">
                                            <div class="col-6">
                                                <img src="{{ asset('img/rsz_store.png') }}" alt="" class="store-img">
                                            </div>
                                            <div class="col-6">
                                                <h3><b>Lalmatia, Dhaka</b></h3>
                                                <h4>2/1 Block A, Lalmatia, Dhaka</h4>
                                                <h4>+8801608911692</h4>
                                            </div>
                                            <div class="col-12 pt-4">
                                                <a style="color: #000" href="{{ route('booking_appointments') }}"><u>Re-book an appointment at this store</u></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">

                                                <button onclick="appointmentCancel('{{ $appointment->id }}')" type="button" class="btn-next cancel-btn">Cancel my appointment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="other-page-box">
                                <p class="email-text">You have no upcoming appointments.</p>
                                <a href="{{ route('stores') }}" class="btn-next">Book in-store appointment</a>
                            </div>
                        @endif

                        <h1 class="other-box-title">APPOINTMENT HISTORY</h1>
                        @if(count($appointments) > 0)
                            @foreach($appointments as $appointment)
                            <div class="other-page-box">
                                <div class="row">
                                    <div class="col-12 pb-5">
                                        <h3><b id="">{{ $appointment->appointment_day->format('l, F d, Y') }}, at <span style="text-transform: uppercase">{{ $appointment->appointment_time }}</span></b></h3>
                                        @if($appointment->type == 1)
                                        <h4><b id="">In-Store Appointment</b></h4>
                                        @else
                                        <h4><b id="">Virtual appointment</b></h4>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="row pt-3">
                                        <div class="col-6">
                                            <img src="{{ asset('img/rsz_store.png') }}" alt="" class="store-img">
                                        </div>
                                        <div class="col-6">
                                            <h3><b>Lalmatia, Dhaka</b></h3>
                                            <h4>2/1 Block A, Lalmatia, Dhaka</h4>
                                            <h4>+8801608911692</h4>
                                        </div>
                                        <div class="col-12 pt-4">
                                            <a style="color: #000" href="{{ route('booking_appointments') }}"><u>Re-book an appointment at this store</u></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

            function appointmentCancel(id) {
                if (confirm('Are you sure delete?')) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('appointment_cancel') }}",
                        data: { id: id }
                    }).done(function( response ) {
                        location.reload();
                    });
                }
            }

    </script>
@endsection
