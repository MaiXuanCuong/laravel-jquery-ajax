</div>
<div class="s-skeleton s-skeleton--h-640 s-skeleton--bg-grey">
    <div class="owl-carousel primary-style-3" id="hero-slider">
        @foreach ($banners as $banner)
                <div class="hero-slide hero-slide" style="background: center center/cover no-repeat; background-image: url({{ asset($banner->image) }})">
            <div class="primary-style-3-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-content slider-content--animation">

                                <span class="content-span-1 u-c-white">Thay đổi thời trang của bạn</span>

                                <span class="content-span-2 u-c-white">Giảm 10% khách hàng mới</span>

                                <span class="content-span-3 u-c-white">Tìm đồ với giá tốt nhất</span>

                                <span class="content-span-4 u-c-white">Bắt đầu từ

                                    <span class="u-c-brand">100.000 VNĐ</span></span>

                                <a class="shop-now-link btn--e-brand" data-page="home-page">Đén shop</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    
        
       
    </div>
</div>