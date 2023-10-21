@extends('layouts.app')
@section('style')
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .left-form {
            background-color: #f5f5f5;

        }

        .form-field {
            margin-left: 50px;
            margin-right: 50px;
            background-color: white;
            padding: 40px;
            margin-bottom: 50px;
        }

        .form-header {
            margin-left: 50px;
            margin-right: 50px;
        }

        .form-header h1 {
            font-weight: bold;
            font-size: 33px;
            margin-top: 50px;
            font-family:  "Helvetica Neue", Helvetica, Arial, sans-serif;
            border-bottom: 1px solid silver;
            padding-bottom: 20px;
            margin-bottom: 53px;
        }

        .input-button {
            margin-top: 50px;
            margin-bottom:20px;
        }

        .input-full {
            background: white;
            color: black;
            border: 1px solid black;
        }
        .mandatory-field {
            font-weight: 500;
            font-size: 1.rem;
            line-height: 1.7142857142857142;
            letter-spacing: .4px;
            margin-bottom: 1rem;
            text-align: right;
            margin-right: 52px;
        }
        .account-button{
            background: white;
            color: black;
            border: 1.5px solid black
        }
        .d-grid{
            margin-bottom: -11px;
        }

        .account-button:hover {
            background-color: #eae8e4;
            box-shadow: inset 0 0 0 1px #eae8e4;
            color: #19110b;
        }
        .account-area{
            padding: 0px 17px 0px 10px;
        }
        select {
            background: #fff;
            background-clip: padding-box;
            border: 1px solid #eae8e4;
            border-radius: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #19110b;
            height: 3rem;
            text-align: left;
            font-weight: 400;
            font-style: normal;
            font-weight: 500;
            font-size: 1.7rem;
            line-height: 2;
            width: 100%;
            height: 5rem;
            padding-left: 3px;
            margin-bottom: -12px;
        }

        @media screen and (min-width: 300px) and (max-width: 768px) {
            .form-header{
                margin-top: 112px;
            }
            .form-header h1{
                font-size: 28px;
                text-align: center;
            }

        }
    </style>
@endsection

@section('content')
    <div class="full-area">
        <div class="row">
            <div class="col-md-12 left-form">
                <div class="form-header">
                    <h1>START THE JOURNEY</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 left-form">
                <div class="form-field">
                    <span><h1 style="font-weight: 700;">Call Us</h1></span>
                    <p style="margin-top: 20px;margin-bottom: 21px;font-weight: 300;font-size: 2.1rem;line-height: 1.7777777777777777;letter-spacing: .4px;" id="contact-no"></p>
                    <div class="mb-5 {{ $errors->has('sub_name') ? 'has-error' :'' }}">
                        <select id="phone-number-select" name="contact_no" class="functional-link">
                            <option hidden="hidden">Choose your country</option>
                            <option selected="selected" value="+971 58 695 1997">Bangladesh</option>
                            <option value="+971 58 695 1997">Austria</option>
                            <option value="+973 1753 7543">Bahrain</option>
                            <option value="+32 2 626 46 02">Belgium (FR language)</option>
                            <option value="+32 2 626 46 03">Belgium (NL language)</option>
                            <option value="+55 11 3060 5099">Brazil</option>
                            <option value="+1 866 BD-Drip">Canada</option>
                            <option value="+86 400 658 8555">China</option>
                            <option value="+45 35 15 86 34">Denmark</option>
                            <option value="+358 9 8171 0681">Finland</option>
                            <option value="+33 09 77 40 40 77">France</option>
                            <option value="+49 211 864 700">Germany</option>
                            <option value="+852 8100 1182">Hong Kong SAR</option>
                            <option value="1800 103 9988">India ( For local clients)</option>
                            <option value="0800 1400 800">Indonesia</option>
                            <option value="+353 1 533 99 48">Irish Republic</option>
                            <option value="+39 02006608888">Italy</option>
                            <option value="+81 120 00 1854">Japan</option>
                            <option value="+962 6593 6111">Jordan</option>
                            <option value="+7 727 330 3999">Kazakhstan</option>
                            <option value="(966) 11 211 2705">Kingdom of Saudi Arabia</option>
                            <option value="+82 2 3432 1854">Korea</option>
                            <option value="(965) 2 220 0522">Kuwait</option>
                            <option value="(961) 196 6810">Lebanon</option>
                            <option value="+35 22 73 00 025">Luxembourg</option>
                            <option value="+853 2822 8800">Macau SAR</option>
                            <option value="+60 1300888586">Malaysia</option>
                            <option value="+52 55 5980 8803">Mexico</option>
                            <option value="+377 93 25 13 44">Monaco</option>
                            <option value="+31 20 721 9441">Netherlands</option>
                            <option value="+64 800 586 966">New Zealand</option>
                            <option value="+47 228 288 00">Norway</option>
                            <option value="+632 7756 0637">Philippines</option>
                            <option value="+48 22&nbsp;450 30 00">Poland</option>
                            <option value="+351 21 358 43 20">Portugal</option>
                            <option value="+974 4413 4931">Qatar</option>
                            <option value="+7 800 700 50 58">Russian Federation</option>
                            <option value="+65 6788 3888">Singapore</option>
                            <option value="+27 11 784 9854">South Africa</option>
                            <option value="+34 902 100 878">Spain</option>
                            <option value="+46 8 519 928 37">Sweden</option>
                            <option value="+41 22 311 02 32">Switzerland</option>
                            <option value="0080 149 1188">Taiwan</option>
                            <option value="1800-01-1112">Thailand</option>
                            <option value="+971 800 BD-Drip">United Arab Emirates</option>
                            <option value="+44 20 799 86 286">United Kingdom</option>
                            <option value="+1 866 BD-Drip">USA</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6 left-form">
                <div class="form-field">
                    <span><h1 style="font-weight: 700;">Email Us</h1></span>
                    <p style="margin-top: 20px;margin-bottom: -18px;font-weight: 300;">
                        Our advisors will be delighted to answer your questions
                    </p>
                    <div class="input-button">
                        <div class="d-grid">
                            <a href="{{route('email.us')}}" class="btn btn-block input-full account-button">Send an
                                Email</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 left-form">
                <div class="form-field" style="padding: 27px 0px 25px 35px;">
                    <p style="font-weight: 300;">
                        Our Client Services opening hours are accessible here
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>

            $('body').on('change', '.functional-link', function () {
                var mobile_no = $(this).val();
                $('#contact-no').html(mobile_no);
            })
            $('.functional-link').trigger('change');

    </script>
@endsection
