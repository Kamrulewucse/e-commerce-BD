<style>
    .by-style{
        cursor: default;
        color: #000;
        font-weight: 500;
        margin-top: 20px;
        font-size: 13px;
    }
</style>
@if(count($subSubCategories->where('by_style',0)) > 0)
    @foreach($subSubCategories->where('by_style',0) as $subSubCategory)
        <li><a data-id="{{ $subSubCategory->id }}" class="mouse-hover-img" href="{{ route('page.view_by_look_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a></li>
    @endforeach
@endif
@if(count($subSubCategories->where('by_style',1)) > 0)
<li class="by-style">BY STYLE</li>
@foreach($subSubCategories->where('by_style',1) as $subSubCategory)
    <li><a data-id="{{ $subSubCategory->id }}" class="mouse-hover-img" href="{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a></li>
@endforeach
@endif

