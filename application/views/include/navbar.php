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
                                <a href="<?php echo base_url('kategori') ?>">Service <span class="open-dropdown"><i class="fa fa-angle-down"></i></span></a>
                                <div class="navbar-dropdown">
                                    <div class="navbar-box">

                                        <!-- box-1 (left-side)-->

                                        <!-- box-2 (right-side)-->

                                        <div class="box-2">
                                            <div class="clearfix categories">
                                                <div class="row">
                                                    
                                                    <!--icon item-->                                                
<?php foreach ($get_kategori as $key => $get_kategori) {?>
                                                    <div class="col-sm-3 col-xs-6">
                                                        <a href="<?php echo base_url('kategori/'). $get_kategori['id_kategori'] ?>">
                                                            <figure>
                                                                 <img style="width: 50px;margin-bottom: 30px;" src="<?php echo base_url('assets/images/icon/').$get_kategori['icon'] ?>"/>
                                                                <figcaption><?php echo $get_kategori['nama_kategori'] ?></figcaption>
                                                            </figure>
                                                        </a>
                                                    </div>
                                    <?php } ?>                
                                                    <!--icon item-->                                                


                                                </div> <!--/row-->
                                            </div> <!--/categories-->
                                        </div> <!--/box-2-->
                                    </div> <!--/navbar-box-->
                                </div> <!--/navbar-dropdown-->
                            </li>

                            <!-- Simple menu link-->

                            <li><a href="javascript:void(0);" class="open-login">Daftar</a></li>
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
