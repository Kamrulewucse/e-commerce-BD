
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
        padding-bottom: 14px;
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
    button.btn-next.cancel-btn {
        background: #F6F5F3;
        color: #000;
        border: 1.4px solid #19110B !important;
        transition: all 0.5s ease;
    }
    button.btn-next.cancel-btn:hover {
        background: #F6F5F3;
        color: #000;
        border: 1.4px solid transparent !important;
    }
</style>
<div class="user-nav-section">
    <div class="container">
        <div class="row">
            <div class="col-3 col-md-3">
                <h3 class="user-panel-title">My BD</h3>
            </div>
            <div class="col-9 col-md-9">

                <div class="user-panel-mobile-area">
                    <div id="open-mobile-menu" class="mobile-menu-button">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div id="close-mobile-menu" style="display: none" class="mobile-menu-button btn-mobile-remove">
                        <i class="fa fa-remove"></i>
                    </div>

                    <ul id="user-panel-mobile-menu" class="text-right">
                        <li><a class="{{ Route::currentRouteName() == 'over_view' ? 'user-nav-active' : '' }}"
                               href="{{ route('over_view') }}">Overview</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'account_details' ? 'user-nav-active' : '' }}"
                               href="{{ route('account_details') }}">My Account</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'orders' ? 'user-nav-active' : '' }}"
                               href="{{ route('orders') }}">My Orders</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'appointments' ? 'user-nav-active' : '' }}"
                               href="{{ route('appointments') }}">My Appointments</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'wishlist' ? 'user-nav-active' : '' }}" href="{{ route('wishlist') }}">My
                                Wishlist</a></li>
                    </ul>
                </div>
                <div class="user-nav d-none d-sm-block d-md-block d-xl-block">
                    <ul>
                        <li><a class="{{ Route::currentRouteName() == 'over_view' ? 'user-nav-active' : '' }}"
                               href="{{ route('over_view') }}">Overview</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'account_details' ? 'user-nav-active' : '' }}"
                               href="{{ route('account_details') }}">My Account</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'orders' ? 'user-nav-active' : '' }}"
                               href="{{ route('orders') }}">My Orders</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'appointments' ? 'user-nav-active' : '' }}"
                               href="{{ route('appointments') }}">My Appointments</a></li>
                        <li><a class="{{ Route::currentRouteName() == 'wishlist' ? 'user-nav-active' : '' }}" href="{{ route('wishlist') }}">My
                                Wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery JS -->
<script src="{{ asset('themes/frontend/assets/js/vendor/jquery.min.js') }}"></script>
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
    $(function (){
        $("#open-mobile-menu").click(function (){
            $(".user-panel-mobile-area ul").css('visibility','visible');

            $("#open-mobile-menu").hide();
            $("#close-mobile-menu").show();
        })
        $("#close-mobile-menu").click(function (){
            $(".user-panel-mobile-area ul").css('visibility','hidden');

            $("#close-mobile-menu").hide();
            $("#open-mobile-menu").show();
        })
    })
</script>
