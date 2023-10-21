<style>

    ul.filter-list li:first-child,ul.filter-list li{
        font-size: 16px;
        cursor: auto;
        padding: 0;
        border-left: 0px solid #eee;
        color: #000;
    }
    ul.filter-list {
        padding: 0;
    }
    ul.filter-list li{
        display: inline-block;
    }
    ul.filter-list li a {
        display: inline-block;
        padding: 23px 25px;
        transition: all 0.5s ease;
        margin: 0;
        border-left: 1px solid #eee;
    }
    ul.filter-list li a:hover{
        box-shadow: inset 0 -1px 0 0 #19110b;
    }
    ul.filter-list li a.other-page-active{
        box-shadow: inset 0 -4px 0 0 #19110b;
    }
    .other-page-content-area {
        background: #f6f5f3;
        padding: 50px 0;
    }

    h1.contact-page-title {
        font-weight: bold;
        font-size: 32px;
        border-bottom: #eae8e4 1px solid;
        margin-bottom: 25px;
        padding-bottom: 17px;
    }
    .other-page-box {
        border: 1px solid #eae8e4;
        background: #fff;
        padding: 2rem;
        margin: 7px 0;
    }
    h1.other-box-title {
        font-weight: bold;
        font-size: 20px;
    }
    a.send-and-email{
        align-items: center;
        align-content: center;
        -webkit-appearance: none;
        border: 0 none;
        border-radius: 0;
        box-sizing: border-box;
        cursor: pointer;
        display: inline-flex;
        min-height: 3rem;
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
        padding: 19px 0;
        font-size: 15px;
        margin: 10px 0;
    }
    a.send-and-email:hover{
        background-color: #eae8e4;
        box-shadow: inset 0 0 0 1px #eae8e4;
        color: #19110b;
    }

    .other-select-country-list select {
        background: #fff;
        background-clip: padding-box;
        border: 1px solid #eae8e4;
        border-radius: 0;
        box-shadow: none;
        box-sizing: border-box;
        color: #19110b;
        height: 3rem;
        text-align: left;
        font-family: "Louis Vuitton Web","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-style: normal;
        font-weight: 500;
        font-size: 1rem;
        line-height: 2;
        letter-spacing: .4px;
        transition: border .3s cubic-bezier(0.39,0.575,0.565,1);
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2080%2080'%20focusable='false'%20aria-hidden='true'%20class='ui-icon-controls-chevron-down'%3E%3Cpath%20fill='%2319110b'%20fill-rule='evenodd'%20d='M46.2%2048.6L17.8%2020.3l-5.5%205.4%2028.4%2028.4%205.4%205.5.1.1.1-.1%205.3-4.5L80%2026.7l-5.5-6.4-28.3%2028.3z'/%3E%3C/svg%3E") no-repeat right 1rem top 50%;
        background-size: 1rem 1rem;
        max-width: 100%;
        padding: 0 2rem 0 1rem;
        position: relative;
        text-overflow: ellipsis;
    }
    .other-select-country-list select {
        width: 100%;
        height: 50px;
        font-size: 14px;
    }
    ul.filter-list {
        padding: 0;
        text-align: right;
    }
    .accordion-collapse {
        border: 0;
    }
    .accordion-button {
        padding: 0px;
        font-weight: bold;
        border: 0;
        font-size: 15px;
        color: #333333;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .accordion-button:focus {
        box-shadow: none;
        border: none;
    }
    .accordion-button:not(.collapsed) {
        background: none;
        color: #dc3545;
    }
    .accordion-body {
        padding: 15px;
        background-color: #f6f6f6;
    }
    .accordion-button::after {
        width: auto;
        height: auto;
        content: "+";
        font-size: 24px;
        background-image: none;
        font-weight: 100;
        color: #1b6ce5;
        transform: translateY(-4px);
    }
    .accordion-button:not(.collapsed)::after {
        width: auto;
        height: auto;
        background-image: none;
        content: "-";
        font-size: 48px;
        transform: translate(-5px, -4px);
        transform: rotate(0deg);
    }
    .accordion-button::after {
        color: #000000;
        font-size: 24px;
        font-weight: 500;
    }
    .accordion-button:not(.collapsed)::after {
        font-size: 34px;
    }
    button.accordion-button.collapsed {
         font-weight: normal;
     }
    .accordion-button:not(.collapsed) {
        background: none;
        color: #000000;
    }
    .accordion-body {
        padding: 15px;
        background-color: #ffffff;
    }
    button.accordion-button.collapsed {
        padding: 18px 0;
    }
    .accordion-body {
        padding: 0;
    }
    .accordion-body.inner-body {
        background: #f6f5f3;
        padding: 1.5rem;
    }
    button.accordion-button {
        cursor: pointer;
    }
    @media screen and (max-width: 767px){
        ul.filter-list {
            margin-top: 91px;
        }


        ul.filter-list li a {
            padding: 7px 33px;
            font-size: 12px;
        }

        .header-mobile__inner.fixed-header {
            border-bottom: 1px solid #eee;
        }

        ul.filter-list li a.other-page-active {
            box-shadow: inset 0 -2px 0 0 #19110b;
        }
        h1.contact-page-title {
            font-weight: bold;
            font-size: 17px;
            margin-bottom: 11px;
            padding-bottom: 7px;
        }
        .other-page-content-area {
            padding: 16px 0;
        }
        h1.other-box-title {
            font-size: 15px;
        }
        ul.filter-list li:first-child, ul.filter-list li {
            line-height: 56px;
        }
    }
    .fall-back i{
        margin-left: 10px;
        padding: 30px 50px;
        background:#fff;
        color: #000;
    }
    .fall-back i:hover{
        background:#EAE8E4;
        color: #000;
    }
    a:hover {
        color: #19110b;
    }
    /*ul.filter-list{*/
    /*     text-align: left;*/
    /* }*/

    /*.filter-list li a{*/
    /*    margin-left: 900px;*/
    /*}*/

</style>
<div class="container-fluid" style="padding: 0">
    <div class="row">
        <div class="col-12">
            <ul class="filter-list">
{{--                <li><a class="test" href="{{ route('start_the_journey') }}"><i class="fa fa-long-arrow-left"></i></a></li>--}}
                <li><a style="" class="{{ Route::currentRouteName() == 'faq' ? 'other-page-active' : '' }}" href="{{ route('faq') }}">FAQ</a></li>
                <li><a class="{{ Route::currentRouteName() == 'start_the_journey' ? 'other-page-active' : '' }}" href="{{ route('start_the_journey') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>
