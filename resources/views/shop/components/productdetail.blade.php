
 
@extends('shop.master')
@section('content')

    <div class="preloader is-active">
        <div class="preloader__wrap">
            <img class="preloader__img" src="images/preloader.png" alt=""></div>
    </div>
    <!--====== Main App ======-->
    <div id="app">
        <!--====== App Content ======-->
        <div class="app-content">

            <!--====== Section 1 ======-->

            <div class="u-s-p-t-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">

                            <!--====== Product Breadcrumb ======-->
                            <div class="pd-breadcrumb u-s-m-b-30">
                                <ul class="pd-breadcrumb__list">
                                    <li class="has-separator">

                                        <a data-page="home-page" class="my-link" id="scroll-product">Trang chủ</a></li>
                                    <li class="has-separator">

                                        <a>{{ $product->category->name }}</a></li>
                                  
                                    <li class="is-marked">

                                        <a>Chi tiết sản phẩm</a></li>
                                </ul>
                            </div>
                            <!--====== End - Product Breadcrumb ======-->


                            <!--====== Product Detail Zoom ======-->
                            <div class="pd u-s-m-b-30" width="445px" height="445px">
                                <div class="slider-fouc pd-wrap">
                                    <div id="pd-o-initiate">
                                        <div class="pd-o-img-wrap" data-src="{{ asset($product->image) }}">
                                            <img class="u-img-fluid" width="445px" height="445px" src="{{ asset($product->image) }}" data-zoom-image="{{ asset($product->image) }}" alt=""></div>
                                        @foreach ($product->product_images as $image)
                                        <div class="pd-o-img-wrap" data-src="{{ asset($image->image) }}">

                                            <img class="u-img-fluid" width="445px" height="445px" src="{{ asset($image->image) }}" data-zoom-image="{{ asset($image->image) }}" alt=""></div>
                                            @endforeach
                                    </div>

                                    <span class="pd-text">Click vào để xem ảnh</span>
                                </div>
                                <div class="u-s-m-t-15">
                                    <div class="slider-fouc">
                                        <div id="pd-o-thumbnail">
                                            <div>

                                                <img class="u-img-fluid" src="{{ asset($product->image) }}" alt=""></div>
                                            @foreach ($product->product_images as $image)
                                            <div>

                                                <img class="u-img-fluid" src="{{ asset($image->image) }}" alt=""></div>
                                                 @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- -------------------------------------------- --}}
                     

                            <!--====== End - Product Detail Zoom ======-->
                        </div>
                        <div class="col-lg-7">

                            <!--====== Product Right Side Details ======-->
                            <div class="pd-detail">
                                <div>

                                    <span class="pd-detail__name">{{ $product->name }}</span></div>
                                <div>
                                    <div class="pd-detail__inline">

                                        <span class="pd-detail__price">{{ $product->discount ? number_format($product->price -(($product->discount/100)*$product->price)).' VNĐ' : number_format($product->price).' VNĐ'}}</span>

                                        <span class="pd-detail__discount">{{ $product->discount ? 'Giảm '.$product->discount.'% của' : ''}}</span><del class="pd-detail__del">{{$product->discount ? number_format($product->price). ' VNĐ' : '' }} </del></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                        <span class="pd-detail__review u-s-m-l-4">

                                            <a data-click-scroll="#view-review">23 Reviews</a></span></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">
                                        @if($product->quantity > 10)
                                        <span class="pd-detail__stock">Còn {{ $product->quantity }} chiếc</span>
                                        @else
                                        <span class="pd-detail__left">Chỉ còn {{ $product->quantity }} chiếc</span>
                                        @endif
                                </div>
                                <div class="u-s-m-b-15">

                                    {{-- <span class="pd-detail__preview-desc">{!! $product->description !!}</span></div> --}}
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">

                                        <span class="pd-detail__click-wrap"><i class="far fa-heart u-s-m-r-6"></i>

                                            <a href="signin.html">Thêm vào giỏ yêu thích</a>

                                            <span class="pd-detail__click-count">(222)</span></span></div>
                                </div>
                                <div class="u-s-m-b-15">
                                    <div class="pd-detail__inline">

                                </div>
                                <div class="u-s-m-b-15">
                                    <ul class="pd-social-list">
                                        <li>

                                            <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li>

                                            <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li>

                                            <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li>

                                            <a class="s-wa--color-hover" href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        <li>

                                            <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                                <div class="u-s-m-b-15">
                                    <form class="pd-detail__form" id="form-cart" enctype="multipart/form-data">
                                        @csrf
                                        <div class="u-s-m-b-15">

                                            <span class="pd-detail__label u-s-m-b-8">Size:</span>
                                            <div class="pd-detail__size">
                                                @foreach ($product->sizes as $size)
                                                    
                                                <div class="size__radio">

                                                    <input type="radio" data-name="{{ $size->name }}" value="{{ $size->id }}" name="size" checked>

                                                    <label class="size__radio-label" for="{{ $size->name }}">{{ $size->name }}</label></div>
                                                @endforeach
                                              
                                            </div>
                                        </div>
                                        <div class="pd-detail-inline-2">
                                            <div class="u-s-m-b-15">

                                                <!--====== Input Counter ======-->
                                                <div class="input-counter">

                                                    <span class="input-counter__minus fas fa-minus"></span>

                                                    <input class="input-counter__text input-counter--text-primary-style" name="quantity" id="quantity-product-detail" type="text" value="1" data-min="1" data-max="1000">

                                                    <span class="input-counter__plus fas fa-plus"></span></div>
                                                <!--====== End - Input Counter ======-->
                                            </div>
                                            <div class="u-s-m-b-15">
                                                <button class="btn btn--e-brand-b-2" data-value="{{ $product->id }}" type="submit" id="Add-to-cart-item">Thêm vào giỏ hàng</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="u-s-m-b-15">

                                    <span class="pd-detail__label u-s-m-b-8">Chính sách sản phẩm</span>
                                    <ul class="pd-detail__policy-list">
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Bảo vệ người tiêu dùng.</span></li>
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Hoàn trả đầy đủ nếu bạn không nhận được đơn đặt hàng của bạn.</span></li>
                                        <li><i class="fas fa-check-circle u-s-m-r-8"></i>

                                            <span>Chấp nhận đổi trả nếu sản phẩm không như mô tả.</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!--====== End - Product Right Side Details ======-->
                        </div>
                    </div>
                </div>
            </div>

            <!--====== Product Detail Tab ======-->
            <div class="u-s-p-y-90">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pd-tab">
                                <div class="u-s-m-b-30">
                                    <ul class="nav pd-tab__list">
                                        <li class="nav-item">

                                            <a class="nav-link active" data-toggle="tab" href="#pd-desc">DESCRIPTION</a></li>
                                     
                                        <li class="nav-item">

                                            <a class="nav-link" id="view-review" data-toggle="tab" href="#pd-rev">REVIEWS

                                                <span>(23)</span></a></li>
                                    </ul>
                                </div>
                                <div class="tab-content">

                                    <!--====== Tab 1 ======-->
                                    <div class="tab-pane fade show active" id="pd-desc">
                                        <div class="pd-tab__desc">
                                            <div class="u-s-m-b-15">
                                                <p>{!! $product->description !!}</p>
                                            </div>
                                            <div class="u-s-m-b-30">
                                                <ul>
                                                    <li><i class="fas fa-check u-s-m-r-8"></i>

                                                        <span>Bảo vệ người tiêu dùng</span></li>
                                                    <li><i class="fas fa-check u-s-m-r-8"></i>

                                                        <span>Hoàn trả đầy đủ nếu bạn không nhận được đơn đặt hàng của bạn.</span></li>
                                                    <li><i class="fas fa-check u-s-m-r-8"></i>

                                                        <span>Chấp nhận đổi trả nếu sản phẩm không như mô tả</span></li>
                                                </ul>
                                            </div>
                                            <div class="u-s-m-b-15">
                                                <h4>Thông tin sản phẩm</h4>
                                            </div>
                                            <div class="u-s-m-b-15">
                                                <div class="pd-table gl-scroll">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Tên</td>
                                                                <td>{{ $product->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Giá</td>
                                                                <td>{{ number_format($product->discount ? $product->price - (($product->discount/100)*$product->price) : $product->price)." VNĐ" }}</td>
                                                             
                                                            </tr>
                                                            <tr>
                                                                <td>size</td>
                                                                <td>@foreach($product->sizes as $size)
                                                                    {{ $size->name }}
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Số lượng</td>
                                                                <td>{{ $product->quantity }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Loại hàng</td>
                                                                <td>{{ $product->type_gender }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Danh mục</td>
                                                                <td>{{ $product->category->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nhà cung cấp</td>
                                                                <td>{{ $product->supplier->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ngày sản xuất</td>
                                                                <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                                            </tr>
                                                           
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Tab 1 ======-->
                                    <!--====== Tab 3 ======-->
                                    <div class="tab-pane" id="pd-rev">
                                        <div class="pd-tab__rev">
                                            <div class="u-s-m-b-30">
                                                <div class="pd-tab__rev-score">
                                                    <div class="u-s-m-b-8">
                                                        <h2>23 Reviews - 4.6 (Overall)</h2>
                                                    </div>
                                                    <div class="gl-rating-style-2 u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i></div>
                                                    <div class="u-s-m-b-8">
                                                        <h4>We want to hear from you!</h4>
                                                    </div>

                                                    <span class="gl-text">Tell us what you think about this item</span>
                                                </div>
                                            </div>
                                            <div class="u-s-m-b-30">
                                                <form class="pd-tab__rev-f1">
                                                    <div class="rev-f1__group">
                                                        <div class="u-s-m-b-15">
                                                            <h2>23 Review(s) for Man Ruched Floral Applique Tee</h2>
                                                        </div>
                                                        <div class="u-s-m-b-15">

                                                            <label for="sort-review"></label><select class="select-box select-box--primary-style" id="sort-review">
                                                                <option selected>Sort by: Best Rating</option>
                                                                <option>Sort by: Worst Rating</option>
                                                            </select></div>
                                                    </div>
                                                    <div class="rev-f1__review">
                                                        <div class="review-o u-s-m-b-15">
                                                            <div class="review-o__info u-s-m-b-8">

                                                                <span class="review-o__name">John Doe</span>

                                                                <span class="review-o__date">27 Feb 2018 10:57:43</span></div>
                                                            <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                                <span>(4)</span></div>
                                                            <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                        <div class="review-o u-s-m-b-15">
                                                            <div class="review-o__info u-s-m-b-8">

                                                                <span class="review-o__name">John Doe</span>

                                                                <span class="review-o__date">27 Feb 2018 10:57:43</span></div>
                                                            <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                                <span>(4)</span></div>
                                                            <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                        <div class="review-o u-s-m-b-15">
                                                            <div class="review-o__info u-s-m-b-8">

                                                                <span class="review-o__name">John Doe</span>

                                                                <span class="review-o__date">27 Feb 2018 10:57:43</span></div>
                                                            <div class="review-o__rating gl-rating-style u-s-m-b-8"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>

                                                                <span>(4)</span></div>
                                                            <p class="review-o__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="u-s-m-b-30">
                                                <form class="pd-tab__rev-f2">
                                                    <h2 class="u-s-m-b-15">Add a Review</h2>

                                                    <span class="gl-text u-s-m-b-15">Your email address will not be published. Required fields are marked *</span>
                                                    <div class="u-s-m-b-30">
                                                        <div class="rev-f2__table-wrap gl-scroll">
                                                            <table class="rev-f2__table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i>

                                                                                <span>(1)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(1.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(2)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(2.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(3)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(3.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(4)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>

                                                                                <span>(4.5)</span></div>
                                                                        </th>
                                                                        <th>
                                                                            <div class="gl-rating-style-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>

                                                                                <span>(5)</span></div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-1" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-1"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-1.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-1.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-2" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-2"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-2.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-2.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-3" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-3"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-3.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-3.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-4" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-4"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-4.5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-4.5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                        <td>

                                                                            <!--====== Radio Box ======-->
                                                                            <div class="radio-box">

                                                                                <input type="radio" id="star-5" name="rating">
                                                                                <div class="radio-box__state radio-box__state--primary">

                                                                                    <label class="radio-box__label" for="star-5"></label></div>
                                                                            </div>
                                                                            <!--====== End - Radio Box ======-->
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="rev-f2__group">
                                                        <div class="u-s-m-b-15">

                                                            <label class="gl-label" for="reviewer-text">YOUR REVIEW *</label><textarea class="text-area text-area--primary-style" id="reviewer-text"></textarea></div>
                                                        <div>
                                                            <p class="u-s-m-b-30">

                                                                <label class="gl-label" for="reviewer-name">NAME *</label>

                                                                <input class="input-text input-text--primary-style" type="text" id="reviewer-name"></p>
                                                            <p class="u-s-m-b-30">

                                                                <label class="gl-label" for="reviewer-email">EMAIL *</label>

                                                                <input class="input-text input-text--primary-style" type="text" id="reviewer-email"></p>
                                                        </div>
                                                    </div>
                                                    <div>

                                                        <button class="btn btn--e-brand-shadow" type="submit">SUBMIT</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--====== End - Tab 3 ======-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Product Detail Tab ======-->
            <div class="u-s-p-b-90">

                <!--====== Section Intro ======-->
                <div class="section__intro u-s-m-b-46">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary u-s-m-b-12">Lịch sử sản phẩm</h1>

                                    <span class="section__span u-c-grey">Sản phẩm bạn đã xem</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Intro ======-->


                <!--====== Section Content ======-->
                <div class="section__content">
                    <div class="container">
                        <div class="slider-fouc">
                            <div class="owl-carousel product-slider" data-item="4" id="history-product-detail">
                        

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!--====== End - Section Content ======-->
            </div>
            <!--====== End - Section 1 ======-->
        </div>
        <!--====== End - App Content ======-->

 
    </div>
</div>
</div>
@endsection
