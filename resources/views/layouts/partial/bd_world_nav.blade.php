<style>
    @media (max-width: 61.94em){
        ul.bd-world-menu-list li a {
            margin: 5px 1px;
        }
    }

    .title-layout{
        margin-top: -45px;
        margin-bottom: -50px;
    }
    ul.bd-world-menu-list li a.active:before {
        bottom: 0px;
    }
    section.bd-world-nav-area {
        margin-bottom: -23px;
    }
    span.bd-world-cate-content-title {
        padding: 0px 0;
        margin-top: -14px;
    }
    span.bd-world-cat-content.first-img-bd-world-content span.bd-world-cate-content-title {
        font-size: 20px;
    }
    section.bd-world-category-wise-content {
        padding: 0px 0;
    }
    .bd-world-category-title {
        font-size: 2.5rem;
    }
    .bd-world-category-title{
        margin-top: -25px;
    }
    span.bd-world-cat-img img {
        height: 300px!important;
    }
    .bd-world-category-title {
        font-size: 2rem;
    }
    /*p.bd-world-title {*/
    /*    margin-top: 23px;*/
    /*}*/

</style>

<section class="bd-world-nav-area" id="bd-world-nav">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <ul class="bd-world-menu-list">
                    <li><a class="{{ Route::currentRouteName() == 'world_of_bd_drip' ? 'active' : '' }}" href="{{ route('world_of_bd_drip') }}">All</a></li>
                    @foreach(\App\Models\MagazineCategory::where('status',1)->orderBy('sort')->get() as $category)
                        <li><a class="{{ Request::url() == route('category_details_magazine',['slug'=>$category->slug]) ? 'active' : '' }}" href="{{ route('category_details_magazine',['slug'=>$category->slug]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
