<div class="section section-fluid section-padding bg-white">
    <div class="container">

        <!-- Product Tab Start -->
        <div class="row">
            <div class="col-12">
                <ul class="product-tab-list nav">
                    @foreach($productData['menu'] as $key => $menu)
                        @if(!$key)
                            <li><a class="active" data-toggle="tab" href="#tab-new-sale">{{ $menu->translation->title ?? '####' }}</a></li>
                        @else
                            <li><a data-toggle="tab" href="#tab-sale-items">{{ $menu->translation->title ?? '####'}}</a></li>
                        @endif
                    @endforeach
                </ul>
                <div class="prodyct-tab-content1 tab-content">
                    <div class="tab-pane fade show active" id="tab-new-sale">
                        <!-- Products Start -->
                        <div class="products row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1">
                            @foreach($productData['products'] as $product)
                                <div class="col">
                                    <div class="product">
                                        <div class="product-thumb">
                                            <a href="" class="image">
                                                <img src="{{ asset('storage/'.$product->image) }}" alt="Product Image">
                                                @if($product->second_image)
                                                    <img class="image-hover " src="{{ asset('storage/'.$product->second_image) }}" alt="Product Image">
                                                @endif
                                            </a>
                                            <a href="" class="add-to-wishlist hintT-left" data-hint="მომწონს"><i class="far fa-heart"></i></a>
                                        </div>
                                        <div class="product-info">
                                            <h6 class="title"><a href="">{{ $product->translation->title ?? '####' }}</a></h6>
                                            <span class="price">
                                                @if($product->new_price)
                                                    <span class="old">ლ{{ $product->price }}</span>
                                                    <span class="new">ლ{{ $product->new_price }}</span>
                                                @else
                                                    ლ{{ $product->price }}
                                                @endif
                                            </span>
                                            <div class="product-buttons">
                                                <a href="#quickViewModal" product="{{ $product->id }}" data-toggle="modal" class="product-button hintT-top" data-hint="სწრაფი ნახვა"><i class="fal fa-search"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="კალათაში"><i class="fal fa-shopping-cart"></i></a>
                                                <a href="#" class="product-button hintT-top" data-hint="შედარება"><i class="fal fa-random"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                        <!-- Products End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Tab End -->

    </div>
</div>
@push('frontend.scripts')
<script>
    const address = `{{ route('frontend.products.show', ['locale' => App::getLocale(), 'id' => 'clickedId']) }}`
    const view = $('a[href="#quickViewModal"]')

    const photoBlock = (items) => {
        let asset = `{{ asset('storage/MyImage') }}`
        let gallery = Object.keys(items).map((key, index) => {
            let image = asset.replace('MyImage', items[key].full_src)
            return `
            <div class="product-zoom" data-image="assets/images/product/single/1/product-zoom-1.jpg">
                <img src="${image}" alt="">
            </div>
            `
        })
        $('#quickview-gallery').children().empty()
        $('#quickview-gallery').append(gallery)

    }

    const contextBlock = (item) => {
        let context = item.productText
        let product = item.product

        let element =  `
                        <h3 class="product-title">${context.title}</h3>
                        <div class="product-price">ლ${product.new_price ? product.new_price : product.price}</div>
                        <div class="product-description">
                            <p>${context.desc}</p>
                        </div>
                        `
        $('#context-product').children().empty()
        $('#context-product').append(element)
    }

    const category = (item) => {
        return Object.keys(item).map((key, index) => {
            return `
                <li><a href="#">${item[key].category_translate.name}</a></li>
            `
        })
    }

    const tag = (item) => {
        return Object.keys(item).map((key, index) => {
           return `
                <li><a href="#">${item[key].tag_translate.name}</a></li>
           `
        });
    }

    const infoBlock = (items) => {
        let product = items.product;
        let categoryItems = items.myCategories;
        let tagItems = items.myTags;

        let element = `
               <table>
                    <tbody>
                    <tr>
                        <td class="label"><span>ID</span></td>
                        <td class="value">0404019</td>
                    </tr>
                    <tr>
                        <td class="label"><span>კატეგჰორია</span></td>
                        <td class="value">
                            <ul class="product-category">
                                ${category(categoryItems)}
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"><span>ბრენდი</span></td>
                        <td class="value">
                            <ul class="product-category">
                                <li><a href="#">${product.brand_name}</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"><span>ტეგები</span></td>
                        <td class="value">
                            <ul class="product-tags">
                                ${tag(tagItems)}
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td class="label"><span>გაიზიარეთ</span></td>
                        <td class="va">
                            <div class="product-share">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-pinterest"></i></a>
                                <a href="#"><i class="fal fa-envelope"></i></a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
               </table>
        `

        $('#product-meta').empty();
        $('#product-meta').append(element);
    }

    const fetchProduct = (address) =>{
        return new Promise((resolve) => {
            $.ajax({
                url: address,
                type: "GET",
                success: (response) => {
                    resolve(response)
                }
            })
        })
    }


    view.on('click', function(e) {
        const id = $(this).attr('product')
        const fullAddress = address.replace('clickedId', id)
        fetchProduct(fullAddress).then((res) => {
            photoBlock(res.images)
            contextBlock(res)
            infoBlock(res)
        })
    })
</script>
@endpush
<!-- Modal -->
<div class="quickViewModal modal fade" id="quickViewModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button class="close" data-dismiss="modal">&times;</button>
            <div class="row learts-mb-n30">

                <!-- Product Images Start -->
                <div id="gallery-div-replace"></div>
                <div class="col-lg-6 col-12 learts-mb-30" id="gallery-div">
                    <div class="product-images">
                        <div class="product-gallery-slider-quickview" id="quickview-gallery">

                        </div>
                    </div>
                </div>
                <!-- Product Images End -->

                <!-- Product Summery Start -->
                <div class="col-lg-6 col-12 overflow-hidden learts-mb-30">
                    <div class="product-summery customScroll">
                        <div id="context-product">

                        </div>
                        <div class="product-buttons">
                            <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark"><i class="fal fa-heart"></i></a>
                            <a href="#" class="btn btn-dark btn-outline-hover-dark"><i class="fal fa-shopping-cart"></i> კალათაში</a>
                            <a href="#" class="btn btn-icon btn-outline-body btn-hover-dark"><i class="fal fa-random"></i></a>
                        </div>
                        <div class="product-meta mb-0" id="product-meta">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
