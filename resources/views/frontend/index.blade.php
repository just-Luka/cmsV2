@extends('frontend.layouts.app')
@section('content')
<!-- Mobile Header Section Start -->
<div class="mobile-header bg-white section d-xl-none">
    <div class="container">
        <div class="row align-items-center">

            <!-- Header Logo Start -->
            <div class="col">
                <div class="header-logo">
                    <a href="index.html"><img src="assets/images/logo/logo-2.png" alt=""></a>
                </div>
            </div>
            <!-- Header Logo End -->

            <!-- Header Tools Start -->
            <div class="col-auto">
                <div class="header-tools justify-content-end">
                    <div class="header-login d-none d-sm-block">
                        <a href=""><i class="fal fa-user"></i></a>
                    </div>
                    <div class="header-search d-none d-sm-block">
                        <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                    </div>
                    <div class="header-wishlist d-none d-sm-block">
                        <a href="#offcanvas-wishlist" class="offcanvas-toggle"><span class="wishlist-count">3</span><i class="fal fa-heart"></i></a>
                    </div>
                    <div class="header-cart">
                        <a href="#offcanvas-cart" class="offcanvas-toggle"><span class="cart-count">3</span><i class="fal fa-shopping-cart"></i></a>
                    </div>
                    <div class="mobile-menu-toggle">
                        <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                <path d="M300,320 L540,320" id="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Header Tools End -->

        </div>
    </div>
</div>
<!-- Mobile Header Section End -->

<!-- Mobile Header Section Start -->
<div class="mobile-header sticky-header bg-white section d-xl-none">
    <div class="container">
        <div class="row align-items-center">

            <!-- Header Logo Start -->
            <div class="col">
                <div class="header-logo">
                    <a href="index.html"><img src="assets/images/logo/logo-2.png" alt=""></a>
                </div>
            </div>
            <!-- Header Logo End -->

            <!-- Header Tools Start -->
            <div class="col-auto">
                <div class="header-tools justify-content-end">
                    <div class="header-login d-none d-sm-block">
                        <a href=""><i class="fal fa-user"></i></a>
                    </div>
                    <div class="header-search d-none d-sm-block">
                        <a href="#offcanvas-search" class="offcanvas-toggle"><i class="fal fa-search"></i></a>
                    </div>
                    <div class="header-wishlist d-none d-sm-block">
                        <a href="#offcanvas-wishlist" class="offcanvas-toggle"><span class="wishlist-count">3</span><i class="fal fa-heart"></i></a>
                    </div>
                    <div class="header-cart">
                        <a href="#offcanvas-cart" class="offcanvas-toggle"><span class="cart-count">3</span><i class="fal fa-shopping-cart"></i></a>
                    </div>
                    <div class="mobile-menu-toggle">
                        <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                            <svg viewBox="0 0 800 600">
                                <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                <path d="M300,320 L540,320" id="middle"></path>
                                <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Header Tools End -->

        </div>
    </div>
</div>
<!-- Mobile Header Section End -->
<!-- OffCanvas Search Start -->
<div id="offcanvas-search" class="offcanvas offcanvas-search">
    <div class="inner">
        <div class="offcanvas-search-form">
            <button class="offcanvas-close">×</button>
            <form action="#">
                <div class="row mb-n3">
                    <div class="col-lg-8 col-12 mb-3"><input type="text" placeholder="ჩაწერეთ პროდუქციის დასახელება..."></div>
                    <div class="col-lg-4 col-12 mb-3">
                        <select class="search-select select2-basic">
                            <option value="0">ყველა კატეგორია</option>
                            <option value="kids-babies">თმის მოვლა</option>
                            <option value="home-decor">წამწამები</option>
                            <option value="gift-ideas">ფეხის მოვლა</option>
                            <option value="kitchen">კანის მოვლა</option>
                            <option value="toys">მაკიაჟი</option>
                            <option value="kniting-sewing">ტანის მოვლა</option>
                            <option value="pots">ფრხილები</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- OffCanvas Search End -->

<!-- OffCanvas Wishlist Start -->
<div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist">
    <div class="inner">
        <div class="head">
            <span class="title">მოწონებული</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                <li>
                    <a href="" class="image"><img src="assets/images/product/cart-product-1.jpg" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title">პროდუქციის დასახელება</a>
                        <span class="quantity-price">1 x <span class="amount">₾100.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="" class="image"><img src="assets/images/product/cart-product-2.jpg" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title">პროდუქციის დასახელება</a>
                        <span class="quantity-price">1 x <span class="amount">₾35.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="" class="image"><img src="assets/images/product/cart-product-3.jpg" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title">პროდუქციის დასახელება</a>
                        <span class="quantity-price">1 x <span class="amount">₾9.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="foot">
            <div class="buttons">
                <a href="" class="btn btn-dark btn-hover-primary">დეტალური გვერდი</a>
            </div>
        </div>
    </div>
</div>
<!-- OffCanvas Wishlist End -->

<!-- OffCanvas Cart Start -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart">
    <div class="inner">
        <div class="head">
            <span class="title">კალათა</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                <li>
                    <a href="" class="image"><img src="assets/images/product/cart-product-1.jpg" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title">პროდუქციის დასახელება</a>
                        <span class="quantity-price">1 x <span class="amount">₾100.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="" class="image"><img src="assets/images/product/cart-product-2.jpg" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title">პროდუქციის დასახელება</a>
                        <span class="quantity-price">1 x <span class="amount">₾35.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="" class="image"><img src="assets/images/product/cart-product-3.jpg" alt="Cart product Image"></a>
                    <div class="content">
                        <a href="" class="title">პროდუქციის დასახელება</a>
                        <span class="quantity-price">1 x <span class="amount">₾9.00</span></span>
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="foot">
            <div class="sub-total">
                <strong>ჯამში :</strong>
                <span class="amount">₾144.00</span>
            </div>
            <div class="buttons">
                <a href="" class="btn btn-dark btn-hover-primary">კალათაში გადასვლა</a>
                <a href="" class="btn btn-outline-dark">სწრაფი ყიდვა</a>
            </div>
            <p class="minicart-message">უფასო მიტანა თბილისის მასშტაბით 60 ₾ შენაძენზე მეტის შემთხვევაში!</p>
        </div>
    </div>
</div>
<!-- OffCanvas Cart End -->

<!-- OffCanvas Search Start -->
<div id="offcanvas-mobile-menu" class="offcanvas offcanvas-mobile-menu">
    <div class="inner customScroll">
        <div class="offcanvas-menu-search-form">
            <form action="#">
                <input type="text" placeholder="ძიება...">
                <button><i class="fal fa-search"></i></button>
            </form>
        </div>
        <div class="offcanvas-menu">
            <ul>
                <li class="has-children"><a href="#"><span class="menu-text">თმის მოვლა</span></a>
                    <ul class="sub-menu">
                        <li><a href="shop.html"><span class="menu-text">თმის ინსტრუმენტები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">მამაკაცის ხაზი</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">თმის ზეთები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">შამპუნები და კონდიციონერები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ნიღბები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">დანარჩენი პროდუქცია</span></a></li>
                    </ul>
                </li>
                <li><a href="shop.html"><span class="menu-text">წამწამები</span></a>
                </li>
                <li><a href="shop.html"><span class="menu-text">ფეხის მოვლა</span></a>
                </li>
                <li class="has-children"><a href="#"><span class="menu-text">კანის მოვლა</span></a>
                    <ul class="sub-menu">
                        <li><a href="shop.html"><span class="menu-text">საწმენდი საშუალებები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">თვალები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ნიღბები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ამპულები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">მამაკაცის ხაზი</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">დანარჩენი პროდუქცია</span></a></li>
                    </ul>
                </li>
                <li class="has-children"><a href="#"><span class="menu-text">მაკიაჟი</span></a>
                    <ul class="sub-menu">
                        <li><a href="shop.html"><span class="menu-text">სახის</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">თვალის</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ტუჩის</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ფუნჯები</span></a></li>
                    </ul>
                </li>
                <li class="has-children"><a href="#"><span class="menu-text">ტანის მოვლა</span></a>
                    <ul class="sub-menu">
                        <li><a href="shop.html"><span class="menu-text">მზის დამცავები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">მამაკაცის ხაზი</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ყველა</span></a></li>
                    </ul>
                </li>
                <li class="has-children"><a href="#"><span class="menu-text">ფრჩხილები</span></a>
                    <ul class="sub-menu">
                        <li><a href="shop.html"><span class="menu-text">მანიკური</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">მოვლა</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ხელისა და ფეხის კრემები</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">ქლიბი</span></a></li>
                    </ul>
                </li>
                <li class="has-children"><a href="#"><span class="menu-text">პირის ღრუს მოვლა</span></a>
                    <ul class="sub-menu">
                        <li><a href="shop.html"><span class="menu-text">კბილის პასტა</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">კბილის ჯაგრისი</span></a></li>
                        <li><a href="shop.html"><span class="menu-text">კბილის ძაფი</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="offcanvas-buttons">
            <div class="header-tools">
                <div class="header-login">
                    <a href=""><i class="fal fa-user"></i></a>
                </div>
                <div class="header-wishlist">
                    <a href=""><span>3</span><i class="fal fa-heart"></i></a>
                </div>
                <div class="header-cart">
                    <a href=""><span class="cart-count">3</span><i class="fal fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
        <div class="offcanvas-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>
<!-- OffCanvas Search End -->

<div class="offcanvas-overlay"></div>

<!-- Slider main container Start -->
@include('frontend.blocks.slider')
<!-- Slider main container End -->

<!-- Category Banner Section Start -->
@include('frontend.blocks.event')
<!-- Category Banner Section End -->

<!-- Product Section Start -->
@include('frontend.blocks.product')
<!-- Product Section End -->

<!-- Deal of the Day Section Start -->
@include('frontend.blocks.offer')
<!-- Deal of the Day Section End -->

<!-- Shop By Category Section Start -->
<div class="section section-fluid section-padding bg-white">
    <div class="container">

        <!-- Section Title Start -->
        <div class="section-title text-center">
            <h2 class="title title-icon-both">პოპულარული კატეგორიები</h2>
        </div>
        <!-- Section Title End -->

        <div class="row row-cols-xl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 learts-mb-n40">

            <div class="col learts-mb-40">
                <div class="category-banner5">
                    <a href="" class="inner">
                        <div class="image"><img src="{{ asset('profbeauty/assets/images/banner/category/banner-s5-1.png')}}" alt=""></div>
                        <div class="content">
                            <h3 class="title">კატეგორიის დასახელება</h3>
                            <span class="number">256 პროდუქტი</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="category-banner5">
                    <a href="" class="inner">
                        <div class="image"><img src="{{ asset('profbeauty/assets/images/banner/category/banner-s5-2.png')}}" alt=""></div>
                        <div class="content">
                            <h4 class="title">კატეგორიის დასახელება</h4>
                            <span class="number">117 პროდუქტი</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="category-banner5">
                    <a href="" class="inner">
                        <div class="image"><img src="{{ asset('profbeauty/assets/images/banner/category/banner-s5-3.png')}}" alt=""></div>
                        <div class="content">
                            <h3 class="title">კატეგორიის დასახელება</h3>
                            <span class="number">65 პროდუქტი</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="category-banner5">
                    <a href="" class="inner">
                        <div class="image"><img src="{{ asset('profbeauty/assets/images/banner/category/banner-s5-4.png')}}" alt=""></div>
                        <div class="content">
                            <h3 class="title">კატეგორიის დასახელება</h3>
                            <span class="number">44 პროდუქტი</span>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="category-banner5">
                    <a href="" class="inner">
                        <div class="image"><img src="{{ asset('profbeauty/assets/images/banner/category/banner-s5-5.png')}}" alt=""></div>
                        <div class="content">
                            <h3 class="title">კატეგორიის დასახელება</h3>
                            <span class="number">51 პროდუქტი</span>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Shop By Category Section End -->

<!-- Shop By Brands Section Start -->
<div class="section section-fluid section-padding bg-white border-top-dashed border-bottom-dashed">
    <div class="container">

        <!-- Section Title Start -->
        <div class="section-title text-center">
            <h2 class="title title-icon-both">ბრენდები</h2>
        </div>
        <!-- Section Title End -->

        <div class="brand-carousel">

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-7.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-8.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-1.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-2.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-3.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-4.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-5.png')}}" alt="Brands Image"></a>
                </div>
            </div>

            <div class="col">
                <div class="brand-item">
                    <a href="#"><img src="{{ asset('profbeauty/assets/images/brands/brand-6.png')}}" alt="Brands Image"></a>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Shop By Brands Section End -->

<!-- Blog Section Start -->
<div class="section section-fluid section-padding bg-white">
    <div class="container">

        <!-- Section Title Start -->
        <div class="section-title text-center">
            <h2 class="title title-icon-both">ბლოგი და სიახლეები</h2>
        </div>
        <!-- Section Title End -->

        <div class="row row-cols-xl-4 row-cols-md-2 row-cols-1 learts-mb-n40">

            <div class="col learts-mb-40">
                <div class="blog">
                    <div class="image">
                        <a href=""><img src="{{ asset('profbeauty/assets/images/blog/s370/blog-1.jpg')}}" alt="Blog Image"></a>
                    </div>
                    <div class="content">
                        <ul class="meta">
                            <li><i class="far fa-calendar"></i><a href="#">ნოე 16, 2020</a></li>
                        </ul>
                        <h5 class="title"><a href="">როგორ მოვუაროთ სახის კანს პანდემიის დროს</a></h5>
                        <div class="desc">
                            <p>საბეჭდი და ტიპოგრაფიული ინდუსტრიის უშინაარსო ტექსტია. იგი სტანდარტად 1500-იანი წლებიდან იქცა, როდესაც უცნობმა მბეჭდავმა ამწყობ დაზგაზე წიგნის საცდელი ეგზემპლარი დაბეჭდა. მისი ტექსტი არამარტო...</p>
                        </div>
                        <a href="" class="link">სრულად</a>
                    </div>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="blog">
                    <div class="image">
                        <a href=""><img src="{{ asset('profbeauty/assets/images/blog/s370/blog-2.jpg')}}" alt="Blog Image"></a>
                    </div>
                    <div class="content">
                        <ul class="meta">
                            <li><i class="far fa-calendar"></i><a href="#">ნოე 10, 2020</a></li>
                        </ul>
                        <h5 class="title"><a href="">რატომ უნდა მივიღოთ დილის შხაპი აუცილებლად უზმოზე?</a></h5>
                        <div class="desc">
                            <p>საბეჭდი და ტიპოგრაფიული ინდუსტრიის უშინაარსო ტექსტია. იგი სტანდარტად 1500-იანი წლებიდან იქცა, როდესაც უცნობმა მბეჭდავმა ამწყობ დაზგაზე წიგნის საცდელი ეგზემპლარი დაბეჭდა. მისი ტექსტი არამარტო...</p>
                        </div>
                        <a href="" class="link">სრულად</a>
                    </div>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="blog">
                    <div class="image">
                        <a href=""><img src="{{ asset('profbeauty/assets/images/blog/s370/blog-3.jpg')}}" alt="Blog Image"></a>
                    </div>
                    <div class="content">
                        <ul class="meta">
                            <li><i class="far fa-calendar"></i><a href="#">ოქტ 22, 2020</a></li>
                        </ul>
                        <h5 class="title"><a href="">სწორი კვება და ეფექტური დიეტები სახლის პირობებში</a></h5>
                        <div class="desc">
                            <p>საბეჭდი და ტიპოგრაფიული ინდუსტრიის უშინაარსო ტექსტია. იგი სტანდარტად 1500-იანი წლებიდან იქცა, როდესაც უცნობმა მბეჭდავმა ამწყობ დაზგაზე წიგნის საცდელი ეგზემპლარი დაბეჭდა. მისი ტექსტი არამარტო...</p>
                        </div>
                        <a href="" class="link">სრულად</a>
                    </div>
                </div>
            </div>

            <div class="col learts-mb-40">
                <div class="blog">
                    <div class="image">
                        <a href=""><img src="{{ asset('profbeauty/assets/images/blog/s370/blog-4.jpg')}}" alt="Blog Image"></a>
                    </div>
                    <div class="content">
                        <ul class="meta">
                            <li><i class="far fa-calendar"></i><a href="#">ოქტომბერი 12, 2020</a></li>
                        </ul>
                        <h5 class="title"><a href="">ლორეალ პარიზის ახალი კოლექცია ჩვენს მაღაზიაში</a></h5>
                        <div class="desc">
                            <p>საბეჭდი და ტიპოგრაფიული ინდუსტრიის უშინაარსო ტექსტია. იგი სტანდარტად 1500-იანი წლებიდან იქცა, როდესაც უცნობმა მბეჭდავმა ამწყობ დაზგაზე წიგნის საცდელი ეგზემპლარი დაბეჭდა. მისი ტექსტი არამარტო...</p>
                        </div>
                        <a href="" class="link">სრულად</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row learts-mt-50">
            <div class="col text-center">
                <a href="" class="btn btn-dark btn-hover-primary">ბლოგში გადასვლა</a>
            </div>
        </div>

    </div>
</div>
<!-- Blog Section End -->
@endsection
