@if(count($subSubCategories) > 0 || count($products) > 0)
<div class="container">
    <div class="row">
        <div class="col-md-6 p-0">
            <div class="search-category-area-open">
                @foreach($categories->chunk(2) as $chunkCategories)
                    <div class="row">
                        @foreach($chunkCategories as $category)
                            <div class="col-md-6">
                                <h3 class="search-area-category-title">{{ $category->name }}</h3>
                                <ul class="search-area-category-list">
                                    @foreach($subSubCategories->where('category_id',$category->id)->take(5) as $subSubCategory)
                                        <li><a href="{{ route('page.sub_sub_category', ['category_slug' => $subSubCategory->category->slug, 'sub_category_slug' => $subSubCategory->subCategory->slug, 'sub_sub_category_slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 p-0">
            <div class="search-product-head">
                <h3 class="search-area-category-title">PRODUCTS</h3>
                <ul class="search-product-list">
                    @foreach($products as $product)
                        <li onclick="jsRedirectUrl('{{ route('page.product_details',['slug'=>$product->slug]) }}')">
                            <img src="{{ asset($product->colorImages[0]->thumbs ?? '') }}" alt="">
                            <div class="search-list-product-name">
                                {{ $product->name }}
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>

        </div>
    </div>
</div>
@endif
