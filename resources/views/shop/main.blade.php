@extends('shop.master')
@section('content')

<!--====== Section 3 ======-->
<div class="u-s-p-b-60" >

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-46">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap" id="list_products">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">SẢN PHẨM MỚI</h1>

                        <span class="section__span u-c-silver">SẢN PHẨM MỚI ĐƯỢC BỔ SUNG</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->


        <!--====== Section Content ======-->
    <div class="section__content" id="about">
        <div class="container">
            <div class="row" id="List-products">

                @foreach ($products->filter(function ($product) {
                    return $product->status == 1;
                }) as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 u-s-m-b-30" id="Product-search">
                    <div class="product-r u-h-100">
                        <div class="product-r__container">

                            <a class="aspect aspect--bg-grey aspect--square u-d-block my-link" data-page="product-detail-page" data-value="{{ $product->id}}" id="product-detail">

                                <img class="aspect__img" src="{{ asset($product->image) }}" alt=""></a>
                        </div>
                        <div class="product-r__info-wrap">

                            <span class="product-r__category">
                                
                                <a >{{ $product->category->name }}</a></span>
                            <div class="product-r__n-p-wrap">

                                <span class="product-r__name">

                                    <a  data-page="product-detail-page" class="my-link" data-value="{{ $product->id}}" id="product-detail">{{ $product->name }}</a></span>

                                <span class="product-r__price">{{ number_format($product->price).' VNĐ' }}</span></div>

                            <span class="product-r__description">Nhà cung cấp {{ $product->supplier->name }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
             
         
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 3 ======-->


<!--====== Section 4 ======-->
<div class="u-s-p-b-60">

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-16">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">SẢN PHẨM BÁN CHẠY NHẤT</h1>

                        <span class="section__span u-c-silver u-s-m-b-16">TÌM SẢN PHẨM BÁN CHẠY NHẤT</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->


    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-category-container">
                        <div class="filter__category-wrapper">

                            <button class="btn filter__btn filter__btn--style-2 js-checked" type="button" data-filter="*">Tất cả</button></div>
                            @foreach ($categories->pluck('name') as $category)
                                
                            <div class="filter__category-wrapper">

                                <button class="btn filter__btn filter__btn--style-2" type="button" data-filter=".{{str_replace(' ', '', $category)}}">{{$category}}</button></div>
                            @endforeach
                    </div>

                    <div class="filter__grid-wrapper u-s-m-t-30">
                        <div class="row">
                        @foreach ($products->filter(function ($product) {
                            return $product->status == 1;
                        }) as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item {{str_replace(' ', '', $product->category->name)}}">
                                <div class="product-bs">
                                    <div class="product-bs__container">
                                        <div class="product-bs__wrap">

                                            <a class="aspect aspect--bg-grey aspect--square u-d-block my-link" data-page="product-detail-page" data-value="{{ $product->id}}" id="product-detail">

                                                <img class="aspect__img" src="{{ asset($product->image) }}" alt=""></a>
                                        </div>

                                        <span class="product-bs__category">

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">{{ $product->category->name }}</a></span>

                                        <span class="product-bs__name">

                                            <a data-page="product-detail-page" class="my-link" data-value="{{ $product->id}}" id="product-detail">{{ $product->name }}</a></span>
                                        <div class="product-bs__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                            <span class="product-bs__review">(23)</span></div>

                                        <span class="product-bs__price">{{ number_format($product->price). ' VNĐ' }}

                                            <span class="product-bs__discount">{{ number_format($product->price+(25/100*($product->price))). ' VNĐ' }}</span></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="load-more">

                        <button class="btn btn--e-brand" type="button">Load More</button></div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 4 ======-->


<!--====== Section 5 ======-->
<div class="u-s-p-b-60">

    <!--====== Section Intro ======-->
    <div class="section__intro u-s-m-b-46">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h1 class="section__heading u-c-secondary u-s-m-b-12">LỊCH SỬ XEM</h1>

                        <span class="section__span u-c-silver">CÁC SẢN PHẨM VỪA XEM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Intro ======-->


    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="row" id="history-product-main">

                
              
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
<!--====== End - Section 5 ======-->


<!--====== Section 6 ======-->
<div class="u-s-p-b-60">

    <!--====== Section Content ======-->
    <div class="section__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                    <div class="column-product">

                        <span class="column-product__title u-c-secondary u-s-m-b-25">SẢN PHẨM ĐẶC BIỆT</span>
                        <ul class="column-product__list">
                            @foreach ($products->sortByDesc('price')->filter(function ($product) {
                                return $product->status == 1;
                            })->take(3) as $product)
                                
                            <li class="column-product__item">
                                <div class="product-l">
                                    <div class="product-l__img-wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block product-l__link my-link" data-page="product-detail-page" data-value="{{ $product->id}}" id="product-detail">

                                            <img class="aspect__img" src="{{ asset($product->image) }}" alt=""></a></div>
                                    <div class="product-l__info-wrap">

                                        <span class="product-l__category">

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">{{ $product->category->name }}</a></span>

                                        <span class="product-l__name">

                                            <a data-page="product-detail-page" class="my-link" data-value="{{ $product->id}}" id="product-detail">{{ $product->name }}</a></span>

                                            <span class="product-l__price">{{ number_format($product->price). ' VNĐ' }}

                                                <span class="product-l__discount">{{ $product->discount != null ? number_format($product->price+($product->discount/100*($product->price))). ' VNĐ' : '' }}</span></span></div>
                                </div>
                            </li>
                            @endforeach
                         
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                    <div class="column-product">

                        <span class="column-product__title u-c-secondary u-s-m-b-25">SẢN PHẨM TRONG TUẦN</span>
                        <ul class="column-product__list">
                            @foreach ($products->sortByDesc('id')->filter(function ($product) {
                                return $product->status == 1;
                            })->take(3) as $product)
                                
                            <li class="column-product__item">
                                <div class="product-l">
                                    <div class="product-l__img-wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block product-l__link my-link" data-page="product-detail-page" data-value="{{ $product->id}}" id="product-detail">

                                            <img class="aspect__img" src="{{ asset( $product->image) }}" alt=""></a></div>
                                    <div class="product-l__info-wrap">

                                        <span class="product-l__category">

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">{{ $product->category->name }}</a></span>

                                        <span class="product-l__name">

                                            <a data-page="product-detail-page" class="my-link" data-value="{{ $product->id}}" id="product-detail">{{ $product->name }}</a></span>

                                        <span class="product-l__price">{{ number_format($product->price). ' VNĐ' }}

                                            <span class="product-l__discount">{{ $product->discount != null ? number_format($product->price+($product->discount/100*($product->price))). ' VNĐ' : '' }}</span></span></div>
                                </div>
                            </li>
                            @endforeach
                          
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 u-s-m-b-30">
                    <div class="column-product">

                        <span class="column-product__title u-c-secondary u-s-m-b-25">SẮP VỀ HÀNG</span>


                        <ul class="column-product__list">
                            @foreach ($products->sortByDesc('id')->filter(function ($product) {
                                return $product->status == 0;
                            })->take(3) as $product)
                            <li class="column-product__item">
                                <div class="product-l">
                                    <div class="product-l__img-wrap">

                                        <a class="aspect aspect--bg-grey aspect--square u-d-block product-l__link my-link" data-page="product-detail-page" data-value="{{ $product->id}}" id="product-detail">

                                            <img class="aspect__img" src="{{ asset($product->image) }}" alt=""></a></div>
                                    <div class="product-l__info-wrap">

                                        <span class="product-l__category">

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">{{ $product->category->name }}</a></span>

                                        <span class="product-l__name">

                                            <a data-page="product-detail-page" class="my-link" data-value="{{ $product->id}}" id="product-detail">{{ $product->name }}</a></span>

                                            <span class="product-l__price">{{ number_format($product->price). ' VNĐ' }}

                                                <span class="product-l__discount">{{ $product->discount != null ? number_format($product->price+($product->discount/100*($product->price))). ' VNĐ' : '' }}</span></span></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section Content ======-->
</div>
@endsection