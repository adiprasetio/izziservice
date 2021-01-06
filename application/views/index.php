<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('include/head'); ?>

<body>

    <div class="page-loader"></div>

    <div class="wrapper">

        <!--Use class "navbar-fixed" or "navbar-default" -->
        <!--If you use "navbar-fixed" it will be sticky menu on scroll (only for large screens)-->

        <!-- ======================== Navigation ======================== -->
<?php $this->load->view('include/navbar'); ?>

        <!-- ========================  Header content ======================== -->

       <?php $this->load->view('include/slider'); ?>

        <!-- ========================  Icons slider ======================== -->

        <section class="owl-icons-wrapper owl-icons-frontpage">

            <!-- === header === -->

            <header class="hidden">
                <h2>Product categories</h2>
            </header>

            <div class="container">

                <div class="owl-icons">

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-sofa"></i>
                            <figcaption>AC</figcaption>
                        </figure>
                    </a>

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-armchair"></i>
                            <figcaption>CCTV</figcaption>
                        </figure>
                    </a>

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-chair"></i>
                            <figcaption>ELEKTRONIK</figcaption>
                        </figure>
                    </a>

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-dining-table"></i>
                            <figcaption>FURNITUR</figcaption>
                        </figure>
                    </a>

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-media-cabinet"></i>
                            <figcaption>JARINGAN</figcaption>
                        </figure>
                    </a>

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-table"></i>
                            <figcaption>KOMPUTER</figcaption>
                        </figure>
                    </a>

                    <!-- === icon item === -->

                    <a href="#">
                        <figure>
                            <i class="f-icon f-icon-bookcase"></i>
                            <figcaption>RENOVASI & BANGUN</figcaption>
                        </figure>
                    </a>

                   
                </div> <!--/owl-icons-->
            </div> <!--/container-->
        </section>

        <!-- ========================  Products widget ======================== -->

        <section class="products">

            <div class="container">

                <!-- === header title === -->

                <header>
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2 class="title">Popular Service</h2>
                            <div class="text">
                                <p>Check out our latest collections</p>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="row">

                    <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">

                        <article>
                            <div class="info">
                                <span class="add-favorite added">
                                    <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                                </span>
                                <span>
                                    <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            <div class="btn btn-add">
                                <i class="icon icon-cart"></i>
                            </div>
                            <div class="figure-grid">
                                <div class="image">
                                    <a href="#productid1" class="mfp-open">
                                        <img src="assets/images/product-1.png" alt="" width="360" />
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="product.html">Green corner</a></h2>
                                    <sub>$ 1499,-</sub>
                                    <sup>$ 1099,-</sup>
                                    <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">
                        <article>
                            <div class="info">
                                <span class="add-favorite">
                                    <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                                </span>
                                <span>
                                    <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            <div class="btn btn-add">
                                <i class="icon icon-cart"></i>
                            </div>
                            <div class="figure-grid">
                                <div class="image">
                                    <a href="#productid1" class="mfp-open">
                                        <img src="assets/images/product-2.png" alt="" width="360" />
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="product.html">Laura</a></h2>
                                    <sub>$ 3999,-</sub>
                                    <sup>$ 3499,-</sup>
                                    <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">
                        <article>
                            <div class="info">
                                <span class="add-favorite">
                                    <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                                </span>
                                <span>
                                    <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            <div class="btn btn-add">
                                <i class="icon icon-cart"></i>
                            </div>
                            <div class="figure-grid">
                                <span class="label label-warning">New</span>
                                <div class="image">
                                    <a href="#productid1" class="mfp-open">
                                        <img src="assets/images/product-3.png" alt="" width="360" />
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="product.html">Nude</a></h2>
                                    <sup>$ 2999,-</sup>
                                    <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">
                        <article>
                            <div class="info">
                                <span class="add-favorite">
                                    <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                                </span>
                                <span>
                                    <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            <div class="btn btn-add">
                                <i class="icon icon-cart"></i>
                            </div>
                            <div class="figure-grid">
                                <div class="image">
                                    <a href="#productid1" class="mfp-open">
                                        <img src="assets/images/product-4.png" alt="" width="360" />
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="product.html">Aurora</a></h2>
                                    <sup>$ 299,-</sup>
                                    <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">
                        <article>
                            <div class="info">
                                <span class="add-favorite added">
                                    <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                                </span>
                                <span>
                                    <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            <div class="btn btn-add">
                                <i class="icon icon-cart"></i>
                            </div>
                            <div class="figure-grid">
                                <span class="label label-info">-50%</span>
                                <div class="image">
                                    <a href="#productid1" class="mfp-open">
                                        <img src="assets/images/product-5.png" alt="" width="360" />
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="product.html">Dining set</a></h2>
                                    <sub>$ 1999,-</sub>
                                    <sup>$ 1499,-</sup>
                                    <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- === product-item === -->

                    <div class="col-md-4 col-xs-6">
                        <article>
                            <div class="info">
                                <span class="add-favorite">
                                    <a href="javascript:void(0);" data-title="Add to favorites" data-title-added="Added to favorites list"><i class="icon icon-heart"></i></a>
                                </span>
                                <span>
                                    <a href="#productid1" class="mfp-open" data-title="Quick wiew"><i class="icon icon-eye"></i></a>
                                </span>
                            </div>
                            <div class="btn btn-add">
                                <i class="icon icon-cart"></i>
                            </div>
                            <div class="figure-grid">
                                <div class="image">
                                    <a href="#productid1" class="mfp-open">
                                        <img src="assets/images/product-6.png" alt="" width="360" />
                                    </a>
                                </div>
                                <div class="text">
                                    <h2 class="title h4"><a href="product.html">Seat chair</a></h2>
                                    <sup>$ 896,-</sup>
                                    <span class="description clearfix">Gubergren amet dolor ea diam takimata consetetur facilisis blandit et aliquyam lorem ea duo labore diam sit et consetetur nulla</span>
                                </div>
                            </div>
                        </article>
                    </div>

                </div> <!--/row-->
                <!-- === button more === -->


                <!-- ========================  Product info popup - quick view ======================== -->

                <div class="popup-main mfp-hide" id="productid1">

                    <!-- === product popup === -->

                    <div class="product">

                        <!-- === popup-title === -->

                        <div class="popup-title">
                            <div class="h1 title">Laura <small>product category</small></div>
                        </div>

                        <!-- === product gallery === -->

                        <div class="owl-product-gallery">
                            <img src="assets/images/product-1.png" alt="" width="640" />
                            <img src="assets/images/product-2.png" alt="" width="640" />
                            <img src="assets/images/product-3.png" alt="" width="640" />
                            <img src="assets/images/product-4.png" alt="" width="640" />
                        </div>

                        <!-- === product-popup-info === -->

                        <div class="popup-content">
                            <div class="product-info-wrapper">
                                <div class="row">

                                    <!-- === left-column === -->

                                    <div class="col-sm-6">
                                        <div class="info-box">
                                            <strong>Maifacturer</strong>
                                            <span>Brand name</span>
                                        </div>
                                        <div class="info-box">
                                            <strong>Materials</strong>
                                            <span>Wood, Leather, Acrylic</span>
                                        </div>
                                        <div class="info-box">
                                            <strong>Availability</strong>
                                            <span><i class="fa fa-check-square-o"></i> in stock</span>
                                        </div>
                                    </div>

                                    <!-- === right-column === -->

                                    <div class="col-sm-6">
                                        <div class="info-box">
                                            <strong>Available Colors</strong>
                                            <div class="product-colors clearfix">
                                                <span class="color-btn color-btn-red"></span>
                                                <span class="color-btn color-btn-blue checked"></span>
                                                <span class="color-btn color-btn-green"></span>
                                                <span class="color-btn color-btn-gray"></span>
                                                <span class="color-btn color-btn-biege"></span>
                                            </div>
                                        </div>
                                        <div class="info-box">
                                            <strong>Choose size</strong>
                                            <div class="product-colors clearfix">
                                                <span class="color-btn color-btn-biege">S</span>
                                                <span class="color-btn color-btn-biege checked">M</span>
                                                <span class="color-btn color-btn-biege">XL</span>
                                                <span class="color-btn color-btn-biege">XXL</span>
                                            </div>
                                        </div>
                                    </div>

                                </div> <!--/row-->
                            </div> <!--/product-info-wrapper-->
                        </div> <!--/popup-content-->
                        <!-- === product-popup-footer === -->

                        <div class="popup-table">
                            <div class="popup-cell">
                                <div class="price">
                                    <span class="h3">$ 1999,00 <small>$ 2999,00</small></span>
                                </div>
                            </div>
                            <div class="popup-cell">
                                <div class="popup-buttons">
                                    <a href="product.html"><span class="icon icon-eye"></span> <span class="hidden-xs">View more</span></a>
                                    <a href="javascript:void(0);"><span class="icon icon-cart"></span> <span class="hidden-xs">Buy</span></a>
                                </div>
                            </div>
                        </div>

                    </div> <!--/product-->
                </div> <!--popup-main-->
            </div> <!--/container-->
        </section>

        <!-- ========================  Stretcher widget ======================== -->

        <section class="stretcher-wrapper">

            <!-- === stretcher header === -->

            <header class="hidden">
                <!--remove class 'hidden'' to show section header -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h1 class="h2 title">Service Kami</h1>
                            <div class="text">
                                <p>
                                    Whether you are changing your home, or moving into a new one, you will find a huge selection of quality living room furniture,
                                    bedroom furniture, dining room furniture and the best value at Furniture factory
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- === stretcher === -->

            <ul class="stretcher">

                <!-- === stretcher item === -->

                <li class="stretcher-item" style="background-image:url(assets/images/gallery-1.jpg);">
                    <!--logo-item-->
                    <div class="stretcher-logo">
                        <div class="text">
                            <span class="f-icon f-icon-bedroom"></span>
                            <span class="text-intro">Bedroom</span>
                        </div>
                    </div>
                    <!--main text-->
                    <figure>
                        <h4>Modern furnishing projects</h4>
                        <figcaption>New furnishing ideas</figcaption>
                    </figure>
                    <!--anchor-->
                    <a href="#">Anchor link</a>
                </li>

                <!-- === stretcher item === -->

                <li class="stretcher-item" style="background-image:url(assets/images/gallery-2.jpg);">
                    <!--logo-item-->
                    <div class="stretcher-logo">
                        <div class="text">
                            <span class="f-icon f-icon-sofa"></span>
                            <span class="text-intro">Living room</span>
                        </div>
                    </div>
                    <!--main text-->
                    <figure>
                        <h4>Furnishing and complements</h4>
                        <figcaption>Discover the design table collection</figcaption>
                    </figure>
                    <!--anchor-->
                    <a href="#">Anchor link</a>
                </li>

                <!-- === stretcher item === -->

                <li class="stretcher-item" style="background-image:url(assets/images/gallery-3.jpg);">
                    <!--logo-item-->
                    <div class="stretcher-logo">
                        <div class="text">
                            <span class="f-icon f-icon-office"></span>
                            <span class="text-intro">Office</span>
                        </div>
                    </div>
                    <!--main text-->
                    <figure>
                        <h4>Which is Best for Your Home</h4>
                        <figcaption>Wardrobes vs Walk-In Closets</figcaption>
                    </figure>
                    <!--anchor-->
                    <a href="#">Anchor link</a>
                </li>

                <!-- === stretcher item === -->

                <li class="stretcher-item" style="background-image:url(assets/images/gallery-4.jpg);">
                    <!--logo-item-->
                    <div class="stretcher-logo">
                        <div class="text">
                            <span class="f-icon f-icon-bathroom"></span>
                            <span class="text-intro">Bathroom</span>
                        </div>
                    </div>
                    <!--main text-->
                    <figure>
                        <h4>Keeping Things Minimal</h4>
                        <figcaption>Creating Your Very Own Bathroom</figcaption>
                    </figure>
                    <!--anchor-->
                    <a href="#">Anchor link</a>
                </li>

                <!-- === stretcher item more=== -->

                <li class="stretcher-item more">
                    <div class="more-icon">
                        <span data-title-show="Show more" data-title-hide="+"></span>
                    </div>
                    <a href="#"></a>
                </li>

            </ul>
        </section>


        <!-- ================== Footer  ================== -->

        <footer>
            <div class="container">

                <!--footer showroom-->
                <div class="footer-showroom">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Visit our showroom</h2>
                            <p>Jl. H. Dimun Raya No.5A, RT.04/RW.24, Sukamaju, Kec. Cilodong, Kota Depok, Jawa Barat 16415</p>
            
                        </div>
                        <div class="col-sm-4 text-center">
                            <a href="#" class="btn btn-clean"><span class="icon icon-map-marker"></span> Get directions</a>
                            <div class="call-us h4"><span class="icon icon-phone-handset"></span> 0819-2001-233</div>
                        </div>
                    </div>
                </div>

                <!--footer links-->
                <div class="footer-links">
                    <div class="row">
                        <div class="col-sm-4 col-md-2">
                            <h5>Browse by</h5>
                            <ul>
                                <li><a href="#">Brand</a></li>
                                <li><a href="#">Product</a></li>
                                <li><a href="#">Category</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <h5>Recources</h5>
                            <ul>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Projects</a></li>
                                <li><a href="#">Sales</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4 col-md-2">
                            <h5>Our company</h5>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <h5>Sign up for our newsletter</h5>
                            <p><i>Add your email address to sign up for our monthly emails and to receive promotional offers.</i></p>
                            <div class="form-group form-newsletter">
                                <input class="form-control" type="text" name="email" value="" placeholder="Email address" />
                                <input type="submit" class="btn btn-clean btn-sm" value="Subscribe" />
                            </div>
                        </div>
                    </div>
                </div>

                <!--footer social-->

                <div class="footer-social">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="https://themeforest.net/item/mobel-furniture-website-template/20382155" target="_blank"><i class="fa fa-download"></i> Download Mobel</a> &nbsp; | <a href="#">Sitemap</a> &nbsp; | &nbsp; <a href="#">Privacy policy</a>
                        </div>
                        <div class="col-sm-6 links">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div> <!--/wrapper-->

    <!--JS files-->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.ion.rangeSlider.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery.isotope.pkgd.js"></script>
    <script src="<?php echo base_url(); ?>js/main.js"></script>
</body>

</html>