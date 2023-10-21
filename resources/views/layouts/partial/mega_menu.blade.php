<style>
    .by-style{
        cursor: default;
        color: #000;
        font-weight: bold;
        margin-top: 20px;
        font-size: 13px;
    }
</style>
<div class="menu-layer-1">
    <div class="sub-menu-layer">
        <ul>
            @if(count($category->subCategories) > 0)
                @foreach($category->subCategories as $key => $subCategory)
                <li onclick="showSubSubCategory('{{ $subCategory->id }}')" class="{{ $key == 0 ? 'active' : '' }} sub_category_active{{$subCategory->id}}">{{ $subCategory->name }}</li>
                @endforeach
            @else
                <h3>Opps.. no data available</h3>
            @endif

        </ul>
    </div>
</div>
<div class="menu-layer-1">
    <div class="sub-sub-menu-layer">
        <ul id="sub_sub_menu">
            @if(count($category->subCategories) > 0)
            @foreach($category->subCategories[0]->subSubCategories->where('by_style',0) as $subSubCategory)
                <li><a data-id="{{ $subSubCategory->id }}" class="mouse-hover-img" href="{{ route('page.view_by_look_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a></li>
            @endforeach
            @if($category->subCategories[0]->subSubCategories->where('by_style',1)->count() > 0)
                <li class="by-style">BY STYLE</li>
                @foreach($category->subCategories[0]->subSubCategories->where('by_style',1) as $subSubCategory)
                    <li ><a data-id="{{ $subSubCategory->id }}" class="mouse-hover-img" href="{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a></li>
                @endforeach
            @endif
            @else
                <h3>Opps.. no data available</h3>
            @endif
        </ul>
    </div>
</div>
<div class="menu-layer-2">
    @if($category->subCategories[0]->subSubCategories[0] && $category->subCategories[0]->subSubCategories[0]->thumbs)
    <img id="sub_sub_category_img" src="{{ asset($category->subCategories[0]->subSubCategories[0]->thumbs) }}" alt="">
    @else
    <img id="sub_sub_category_img" src="{{ asset('img/category.jpg') }}" alt="">
    @endif
</div>
<div onclick="megaCancelButton()" class="mega-cancel-button">X</div>

