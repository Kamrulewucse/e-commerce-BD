<style>
    section.product-zoom-slider {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 999999999;
        background: #F6F5F3;
        overflow: hidden;
    }
    .product-zoom-icon {
        z-index: 9;
        position: absolute;
        right: 0;
        top: 0;
        border: 1px solid #ddd;
        width: 75px;
        height: 75px;
        text-align: center;
        line-height: 75px;
        background: #fff;
        font-size: 26px;
        cursor: pointer;
        color: #000;
        transition: background-color 0.5s ease;
    }

    .product-zoom-icon:hover {
        background: #EAE8E4;
    }
    html {
        overflow: hidden;
    }
    .product-zoom-container {
        width: 100%;
        background-color: #F6F5F3;
        margin: 0 auto;
        text-align: center;
        position: relative;
        cursor: url('{{ asset('img/zoom-in.svg') }}') 24 24,zoom-in;
    }
    .zoom-cursor-out-effect{
        cursor: url('{{ asset('img/zoom-out.svg') }}') 24 24,zoom-out !important;
    }
    .product-zoom-img-single{
        height: 100%;
    }
    .product-zoom-img-single img {
        width: auto;
        height: 100vh;
        transition-duration: 800ms;
        transform: translate3d(0px, 0px, 0px) scale(1);
    }
    .product-zoom-img-single {
        display: none;
        -webkit-transition: .2s;
        -moz-transition: .2s;
        -o-transition: .2s;
        transition: .2s;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }
    .product-zoom-img-single.active{
        display: inline-block;
        -webkit-animation-name: fadeIn;
        animation-name: fadeIn;

    }

    .btn-wrapp{
        max-width: 400px;
        text-align: center;
        margin: 15px auto;
    }
    button.prev-product-zoom {
        position: absolute;
        right: 17px;
        background: transparent;
        font-size: 30px;
        border: none;
        color: #000;
        font-weight: bold;
        top: 49%;
    }
    button.next-product-zoom {
        position: absolute;
        left: 17px;
        background: transparent;
        font-size: 30px;
        border: none;
        color: #000;
        font-weight: bold;
        top: 49%;
    }
    .product-zoom-img-single img {
        object-fit: contain;
    }
    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
    @keyframes resize {
        0% {width: 100px}
        25% {height: 150px}
        50% {width: 150px}
        100% {height: 100px}
    }
</style>
<section class="product-zoom-slider">
    <div class="product-zoom-icon" onclick="closeProductZoom()">x</div>
    <div class="product-zoom-container">
        @foreach($images as $image)
            <div class="product-zoom-img-single {{ $image->id == $activeImageId->id ? 'active drag' : '' }}">
                <img src="{{ asset($image->image_full) }}"/>
            </div>
        @endforeach
    </div>
    <button class="next-product-zoom"><i class="fa fa-angle-left"></i></button>
    <button class="prev-product-zoom"><i class="fa fa-angle-right"></i></button>
</section>

<script>
    var currentIndex = 0,
        items = $('.product-zoom-container .product-zoom-img-single'),
        itemAmt = items.length;
    var scale = 2;
    function cycleItems() {
        var item = $('.product-zoom-container .product-zoom-img-single').eq(currentIndex);
        items.hide().removeClass('active');
        item.css('display','inline-block').addClass('active');
        scale = 2;
        $('.swiper-slide-zoomed img').css('transform','translate3d(0px, 0px, 0px) scale(1)');
        $('.product-zoom-img-single.active').removeClass('swiper-slide-zoomed');
        $(".product-zoom-container").removeClass('zoom-cursor-out-effect');
    }

    var autoSlide = setInterval(function() {
        currentIndex += 1;
        if (currentIndex > itemAmt - 1) {
            currentIndex = 0;
        }
        cycleItems();
    }, 1000000500);

    $('.next-product-zoom').click(function() {
        clearInterval(autoSlide);
        currentIndex += 1;
        if (currentIndex > itemAmt - 1) {
            currentIndex = 0;
        }
        cycleItems();
    });

    $('.prev-product-zoom').click(function() {
        clearInterval(autoSlide);
        currentIndex -= 1;
        if (currentIndex < 0) {
            currentIndex = itemAmt - 1;
        }
        cycleItems();
    });

    $('body').on('click', '.product-zoom-container', function(){
        $('.product-zoom-img-single.active').addClass('swiper-slide-zoomed')
        $('.swiper-slide-zoomed img').css('transform','translate3d(0px, 0px, 0px) scale('+scale+')');
        scale = scale + 0.6;
        if(scale == 3.2){
            $(".product-zoom-container").addClass('zoom-cursor-out-effect');
        }
        if(scale > 3.6){
            $('.swiper-slide-zoomed img').css('transform','translate3d(0px, 0px, 0px) scale(1)');
            $(".product-zoom-container").removeClass('zoom-cursor-out-effect');
            scale = 2;
        }
    })


</script>
