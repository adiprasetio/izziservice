        <nav class="navbar-fixed">

            <div class="container">

                <!-- ==========  Top navigation ========== -->

                <div class="navigation navigation-top clearfix">
                    <ul>
                        <!--add active class for current page-->

                        <li><a href="javascript:void(0);" class="open-login"><i class="icon icon-user"></i> LOGIN</a></li>
                    </ul>
                </div> <!--/navigation-top-->

                <!-- ==========  Main navigation ========== -->

                <div class="navigation navigation-main">

                    <!-- Setup your logo here-->

                    <a href="index.html" class="logo"><img src="assets/images/logo.png" alt="" /></a>

                    <!-- Mobile toggle menu -->

                    <a href="#" class="open-menu"><i class="icon icon-menu"></i></a>

                    <!-- Convertible menu (mobile/desktop)-->

                    <div class="floating-menu">

                        <!-- Mobile toggle menu trigger-->

                        <div class="close-menu-wrapper">
                            <span class="close-menu"><i class="icon icon-cross"></i></span>
                        </div>

                        <ul>
                            <li><a href="<?php echo base_url() ?>">Home</a></li>
                            
                            <!-- Multi-content dropdown -->

                            
                            <!-- Single dropdown-->


                            <!-- Furniture icons in dropdown-->

                            <li>
                                <a href="category.html">Service <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                                <div class="navbar-dropdown">
                                    <div class="navbar-box">

                                        <!-- box-1 (left-side)-->

                                        <div class="box-1">
                                            <div class="image">
                                                <img src="assets/images/blog-2.jpg" alt="Lorem ipsum" />
                                            </div>
                                            <div class="box">
                                                <div class="h2">Service Kami</div>
                                                <div class="clearfix">
                                                    <p>Homes that differ in terms of style, concept and architectural solutions have been furnished by Furniture Factory. These spaces tell of an international lifestyle that expresses modernity, research and a creative spirit.</p>
                                                    <a class="btn btn-clean btn-big" href="ideas.html">Explore</a>
                                                </div>
                                            </div>
                                        </div> <!--/box-1-->

                                        <!-- box-2 (right-side)-->

                                        <div class="box-2">
                                            <div class="clearfix categories">
                                                <div class="row">
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-sofa"></i>
                                                                <figcaption>AC</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-armchair"></i>
                                                                <figcaption>CCTV</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-chair"></i>
                                                                <figcaption>ELEKTRONIK</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-dining-table"></i>
                                                                <figcaption>FURNITUR</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-media-cabinet"></i>
                                                                <figcaption>JARINGAN</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-table"></i>
                                                                <figcaption>KOMPUTER</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    
                                                    <!--icon item-->                                                

                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="javascript:void(0);">
                                                            <figure>
                                                                <i class="f-icon f-icon-bookcase"></i>
                                                                <figcaption>RENOVASI & BANGUN</figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                                    

                                                </div> <!--/row-->
                                            </div> <!--/categories-->
                                        </div> <!--/box-2-->
                                    </div> <!--/navbar-box-->
                                </div> <!--/navbar-dropdown-->
                            </li>

                            <!-- Simple menu link-->

                            <li><a href="<?php echo base_url('register') ?>">Daftar</a></li>
                        </ul>
                    </div> <!--/floating-menu-->
                </div> <!--/navigation-main-->

                <!-- ==========  Search wrapper ========== -->


                <!-- ==========  Login wrapper ========== -->

                <div class="login-wrapper">
                    <form action="<?php echo base_url();?>login/login_akses" method="post">
                        <div class="h4">Sign in</div>
                        
                        <?php echo $this->session->flashdata("msg");?>
                        <div class="form-group">

                            <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username/Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <a href="<?php echo base_url('forget_password') ?>" class="open-popup">Forgot password?</a>
                            <a href="#createaccount" class="open-popup">Don't have an account?</a>
                        </div>
                        <button type="submit" class="btn btn-block btn-main">Submit</button>
                    </form>
                </div>

            </div> <!--/container-->
        </nav>
