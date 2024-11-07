<?php
get_header();
$id = get_the_ID();
session_start();
$_SESSION['url'] = get_permalink(10);
global $wpdb;
$img_des = get_field('img_des');
$des_low = get_field('des_low');
$reviews = get_field('reviews');
$price = get_field('price');
$old_price = get_field('old_price');
$content = get_field('content');
$configuration = get_field('configuration');
if ($reviews) {
    $star = $reviews['rating_stars'];
    $number_review = $reviews['number_of_reviews'];
}
//Bài viết mới nhất
$args_post = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'order' => 'DESC',
    'orderby' => 'date',

));
$news = $args_post->posts;

?>
<div class="breadcrumbs">
    <div class="container">
        <ul>
            <li>
                <a href="<?= home_url() ?>">Trang chủ</a>
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M4.58398 3L7.58398 6L4.58398 9" stroke="#9CA3AF" stroke-width="0.75"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </figure>
            </li>
            <li>
                <a href="#">Giải pháp học tập cá nhân</a>
                <figure>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M4.58398 3L7.58398 6L4.58398 9" stroke="#9CA3AF" stroke-width="0.75"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </figure>
            </li>
            <li><a href="#"><?= get_the_title() ?></a></li>
        </ul>
    </div>
</div>
<section class="section-1-device-detail">
    <div class="container">
        <div class="wrapper row">
            <div class="col-left col-lg-7 col-md-12" data-aos="zoom-in-right" data-aos-duration="1000">
                <div class="slider-galeria swiper ">
                    <div class="swiper-wrapper">
                        <?php foreach ($img_des as $key => $value) : ?>
                            <div class="swiper-slide">
                                <div class="child">
                                    <figure>
                                        <img src="<?= getimage($value) ?>" alt="">
                                    </figure>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="slider-galeria-thumbs swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($img_des as $key => $value) : ?>
                            <div class="swiper-slide">
                                <div class="child">
                                    <figure>
                                        <img src="<?= getimage($value) ?>" alt="">
                                    </figure>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="button-next">
                    <img src="<?= get_template_directory_uri() ?>/dist/images/svg-next.svg" alt="">
                </button>
                <button class="button-prev">
                    <img src="<?= get_template_directory_uri() ?>/dist/images/svg-prev.svg" alt="">
                </button>
            </div>
            <div class="col-right col-lg-4 col-md-12" data-aos="zoom-in-left" data-aos-duration="1000">
                <div class="list-social">
                    <a href="<?= 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() ?>"
                        target="_blank">
                        <figure>
                            <img src="<?= get_template_directory_uri() ?>/dist/images/Facebook.png" alt="">
                        </figure>
                    </a>
                    <a href="<?= 'https://twitter.com/intent/tweet?url=' . get_the_permalink() ?>" target="_blank">
                        <figure>
                            <img src="<?= get_template_directory_uri() ?>/dist/images/Twitter.png" alt="">
                        </figure>
                    </a>
                    <a href="<?= 'https://www.linkedin.com/shareArticle?url=' . get_the_permalink() ?>" target="_blank">
                        <figure>
                            <img src="<?= get_template_directory_uri() ?>/dist/images/Linkedin.png" alt="">
                        </figure>
                    </a>
                </div>
                <div class="review">
                    <div class="star">
                        <?php for ($i = 0; $i < $star; $i++): ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="number-review">
                        <span><?= $number_review ?> Lượt đánh giá</span>
                    </div>
                </div>
                <div class="product-name">
                    <h2><?= get_the_title() ?></h2>
                </div>
                <div class="product-desc">

                    <?= $des_low ?>

                </div>
                <div class="price-sale">
                    <span><?= number_format($price, 0, ',', '.')    ?>đ</span>
                </div>
                <div class="price">
                    <span>Giá gốc: </span><span class="text-decoration-line-through"><?= $old_price ?>đ</span>
                </div>
                <div class="action">
                    <div class="quantity">
                        <button class="btn-minus">-</button>
                        <input type="text" data-src="<?= get_the_ID() ?>" id="soluong" name="quantity"
                            data-quantity-target="" min="1" value="1" readonly>
                        <button class="btn-plus">+</button>
                    </div>
                    <div class="button">
                        <a href="javascript:;"
                            class="btn btn-add-cart add-to-cart book_now book_now_<?= get_the_ID() ?>"
                            data-id="<?= $id ?>" data-title="<?php the_title() ?>" data-text="add-cart"
                            data-maxqty="<?= get_field('qty', $id) ?>" data-cateId="97"
                            data-cateName="Máy tính bảng thông minh" data-link="<?php echo get_permalink($id) ?>"
                            data-id="<?= $id ?>" data-img="<?php echo checkImage($id) ?>"
                            data-price="<?= $price ?>">Thêm vào giỏ hàng</a>
                        <a href="javascript:;" class="btn btn-buy-now" data-cateId="97"
                            data-cateName="Máy tính bảng thông minh" data-id="<?= $id ?>"
                            data-maxqty="<?= get_field('qty', $id) ?>" data-title="<?= the_title() ?>"
                            data-text="buy-now" data-link="<?php echo get_permalink($id) ?>"
                            data-img="<?php echo checkImage($id) ?>" data-price="<?= get_field('price', $id) ?>">
                            Mua ngay
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-2-device-detail" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="wrapper row">
            <div class="col-left col-xl-8 col-lg-12">
                <div class="title-general">
                    <h2>Thông tin sản phẩm</h2>
                </div>
                <?= the_content() ?>
            </div>
            <div class="col-right col-xl-4 col-lg-12">
                <div class="title-config">
                    <h2>Cấu hình <?= get_the_title() ?></h2>
                </div>
                <div class="price-sale">
                    <span><?= number_format($price, 0, ',', '.') ?>đ</span>
                </div>
                <div class="price">
                    <span>Giá gốc: </span><span class="text-decoration-line-through"><?= $old_price ?>đ</span>
                </div>
                <div class="action">
                    <a href="javascript:;" class="btn btn-add-cart add-to-cart book_now book_now_<?= get_the_ID() ?>"
                        data-cateId="97" data-cateName="Máy tính bảng thông minh" data-id="<?= $id ?>"
                        data-title="<?php the_title() ?>" data-text="add-cart"
                        data-link="<?php echo get_permalink($id) ?>" data-id="<?= $id ?>"
                        data-img="<?php echo checkImage($id) ?>" data-price="<?= $price ?>">Thêm vào giỏ hàng</a>
                    <a href="javascript:;" class="btn btn-buy-now" data-cateId="97"
                        data-cateName="Máy tính bảng thông minh" data-id="<?= $id ?>"
                        data-maxqty="<?= get_field('qty', $id) ?>" data-title="<?= the_title() ?>" data-text="buy-now"
                        data-link="<?php echo get_permalink($id) ?>" data-img="<?php echo checkImage($id) ?>"
                        data-price="<?= get_field('price', $id) ?>">
                        Mua ngay
                    </a>
                </div>
                <div class="table">
                    <table>
                        <?php foreach ($configuration as $key => $value) : ?>
                            <tr>
                                <td><?= $value['name_configuration'] ?></td>
                                <td><?= $value['configuration_value'] ?></td>
                            </tr>
                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-3-device section-3-detail" data-aos="fade-up" data-aos-duration="1000">
    <div class="container">
        <div class="title-general">
            <h2>Sản phẩm liên quan</h2>
        </div>
        <div class="list-device row">
            <?php foreach ($news as $key => $value) :
                if ($value->ID != $id) {
            ?>
                    <input type="hidden" data-src="<?= $value->ID ?>" id="soluong" name="quantity" data-quantity-target=""
                        min="1" value="1" readonly>
                    <div class="item <?= $key > 1 ? 'col-lg-6 col-md-6' : 'col-lg-4 col-md-6' ?>">
                        <div class="image">
                            <figure>
                                <a href="<?= get_permalink($value->ID) ?>">
                                    <img src="<?= checkImage($value->ID) ?>" alt="">
                                </a>
                            </figure>
                        </div>
                        <div class="category">
                            <a href="<?= home_url() . '/may-tinh-bang-hoc-tap-thong-minh/' ?>">
                                <span>Thiết bị thông minh</span>
                            </a>
                        </div>
                        <div class="name-product">
                            <a href="<?= get_permalink($value->ID) ?>">
                                <span><?= $value->post_title ?></span>
                            </a>
                        </div>
                        <div class="desc-product">
                            <p>
                                <?= get_field('des_low', $value->ID) ?>
                            </p>
                        </div>
                        <div class="price-sale-product">
                            <?php if (!empty(get_field('price', $value->ID))) : ?>
                                <span><?= number_format(get_field('price', $value->ID), 0, ',', '.')  ?>đ</span>
                            <?php else: ?>
                                <span>Giá liên hệ</span>
                            <?php endif; ?>
                        </div>
                        <div class="price-product">
                            <?php if (!empty(get_field('old_price', $value->ID))) : ?>
                                <span>Giá gốc:</span> <span
                                    class="price text-decoration-line-through"><?= get_field('old_price', $value->ID) ?>đ</span>
                            <?php endif; ?>
                        </div>
                        <div class="action">
                            <a href="javascript:;" class="btn btn-add-cart add-to-cart book_now book_now_<?= $value->ID ?>"
                                data-cateId="97" data-cateName="Máy tính bảng thông minh" data-qty="1"
                                data-maxqty="<?= get_field('qty', $value->ID) ?>" data-id="<?= $value->ID ?>"
                                data-maxqty="<?= get_field('qty', $id) ?>" data-title="<?= $value->post_title ?>"
                                data-text="add-cart" data-link="<?php echo get_permalink($value->ID) ?>"
                                data-id="<?= $value->ID ?>" data-img="<?php echo checkImage($value->ID) ?>"
                                data-price="<?= get_field('price', $value->ID) ?>">Thêm vào giỏ hàng</a>
                            <a href="javascript:;" class="btn btn-buy-now" data-id="<?= $value->ID ?>" data-cateId="97"
                                data-cateName="Máy tính bảng thông minh" data-maxqty="<?= get_field('qty', $value->ID) ?>"
                                data-title="<?= $value->post_title ?>" data-text="buy-now"
                                data-link="<?php echo get_permalink($value->ID) ?>"
                                data-img="<?php echo checkImage($value->ID) ?>"
                                data-price="<?= get_field('price', $value->ID) ?>">
                                Mua ngay
                            </a>
                        </div>
                    </div>
            <?php

                }
            endforeach; ?>
        </div>
    </div>
</section>

<?php
get_footer();
?>
<script>
    $(".add-to-cart").on("click", function() {
        addToCart($(this));
    });

    function buyNow(thiss) {
        var link_img = thiss.attr("data-img");
        var link = thiss.attr("data-link");
        var id = thiss.attr("data-id");
        var maxqty = parseInt(thiss.attr('data-maxqty'));
        var title = thiss.attr("data-title");
        var button = thiss.attr("data-text");
        var cateId = thiss.attr("data-cateId");
        var cateName = thiss.attr("data-cateName");
        var price = parseInt(thiss.attr("data-price"));
        var product = {
            id: id,
            title: title,
            price: price,
            cateName: cateName,
            cateId: cateId,
            qty: 1,
            img: link_img,
            link: link
        };
        var buyNowLocal = JSON.parse(localStorage.getItem("buyNow"));
        if (buyNowLocal == null) {
            buyNowLocal = [];
        }
        var check = false;
        for (var i = 0; i < buyNowLocal.length; i++) {
            if (buyNowLocal[i].id == product.id) {
                check = true;
                break;
            }
        }
        if (!check) {
            buyNowLocal.push(product);
        }
        localStorage.setItem("buyNow", JSON.stringify(buyNowLocal));
        setTimeout(function() {
            window.location.href = '<?= home_url() ?>/chi-tiet-thanh-toan/';
        }, 1000);
    }
    $(".btn-buy-now").on("click", function() {
        buyNow($(this));
    });
</script>
<script>
    var galleryThumbs = new Swiper('.slider-galeria-thumbs', {
        speed: 1000,
        loop: true,
        autoplay: {
            delay: 3000,
        },

        slideToClickedSlide: true,
        // next and prev buttons
        navigation: {
            nextEl: '.button-next',
            prevEl: '.button-prev',
        },
        breakpoints: {
            0: {
                slidesPerView: 1,
                spaceBetween: 10,
                loopedSlides: 2,
            },
            640: {
                slidesPerView: 3,
                spaceBetween: 10,
                loopedSlides: 3,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 24,
                loopedSlides: 4,
            }
        }
    });

    var galleryTop = new Swiper('.slider-galeria', {
        slidesPerView: 1,
        spaceBetween: 20,
        speed: 1000,
        loop: true,
        loopedSlides: 4,
        breakpoints: {
            0: {
                navigation: {
                    nextEl: '.button-next',
                    prevEl: '.button-prev',
                },
                loopedSlides: 1,
            },
            640: {
                loopedSlides: 3,
            },
            1024: {
                loopedSlides: 4,
            }
        },
    });
    galleryTop.controller.control = galleryThumbs;
    galleryThumbs.controller.control = galleryTop;
    $('.btn-minus').addClass('disabled');
    $('.btn-plus').click(function() {
        var value = parseInt($(this).prev('input').val());
        // bỏ disabled
        $('.btn-minus').removeClass('disabled');
        $(this).prev('input').val(value + 1);
    });
    $('.btn-minus').click(function() {
        var value = parseInt($(this).next('input').val());
        if (value > 1) {
            $(this).next('input').val(value - 1);
        }
        if (value == 2) {
            $(this).addClass('disabled');
        }
    });
    $(document).ready(function() {
        var value = $('#soluong').val();
        $(window).scroll(function() {
            if ($(window).scrollTop() > $('.section-1-device-detail').height() + 200) {
                $('.col-right').addClass('fixed');
            } else {
                $('.col-right').removeClass('fixed');
            }
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 1200) {
                $('.col-right').addClass('fixed-bot');
            } else {
                $('.col-right').removeClass('fixed-bot');
            }
        });
        if ($('.list-device .item').length > 3) {
            $('.list-device').css('max-width', '54rem');
        }
    });
</script>