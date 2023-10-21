@extends('layouts.app')
@section('content')
    @include('frontend.partial.other_page_nav')
    <div class="other-page-content-area body-height-full" style="padding: 21px 0px 20px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="contact-page-title">FIND OUT MORE ABOUT BANGLADESH DRIP</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="other-page-box">
                        <div class="accordion accordion-flush" id="faqlist">
                            @foreach($questions as $key => $question)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed click-question-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-{{ $key }}">
                                        {{ $question->question }}
                                    </button>
                                </h2>
                                <div id="faq-content-{{ $key }}" class="accordion-collapse collapse click-answer-button answer-section">
                                    <div class="accordion-body">
                                        {!! $question->answer !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="other-page-box">
                        <h1 class="other-box-title">CONTACT US</h1>
                        <p style="font-size: 15px">Our advisors will be delighted to answer your questions</p>
                        <a class="send-and-email" href="{{ route('email.us') }}">Send an email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function (){
            $("#phone-number-select").change(function (){
                let number = $(this).val();

                if(number != ''){
                    $("#phone-number-show").html(number);
                }

            })
            $("#phone-number-select").trigger("change");
        })
    </script>
@endsection
