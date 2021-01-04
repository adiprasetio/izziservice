<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url() ?>assets/dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - OKGO</title>
    <!-- BEGIN: CSS Assets-->

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/app.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="<?php echo base_url() ?>assets/dist/images/logo.svg">
                    <span class="text-white text-lg ml-3"> OK<span class="font-medium">GO</span> </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="<?php echo base_url() ?>assets/dist/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                       OKGO
                   </div>
                   <div class="-intro-x mt-5 text-lg text-white">Silahkan login untuk menggunakan aplikasi okgo</div>
               </div>
           </div>
           <!-- END: Login Info -->
           <!-- BEGIN: Login Form -->
           <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Sign In
                </h2>
                <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                <form id="loginForm" class="loginForm" action="<?php echo base_url('secure/login_check') ?>" method="POST">
                    <div class="intro-x mt-8">
                        <input type="number" required="" name="no_telp" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Nomor Telepon">
                        <input type="password" required="" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
                    </div>
                    <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input type="checkbox" class="input border mr-2" id="remember-me">
                            <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                        </div>
                        <a href="">Forgot Password?</a> 
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                    </div>
                </form>
                <div id="pesan"></div>
                <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                    By signin up, you agree to our 
                    <br>
                    <a class="text-theme-1" href="">Terms and Conditions</a> & <a class="text-theme-1" href="">Privacy Policy</a> 
                </div>
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>
<!-- BEGIN: JS Assets-->
<!-- END: JS Assets-->
</body>
</html>

<script type="text/javascript">
   $(document).ready(function(){
    $("#loginForm").unbind('submit').bind('submit', function() {

      var form = $(this);
      var url = form.attr('action');
      var type = form.attr('method');

      $.ajax({
        url  : url,
        type : type,
        data : form.serialize(),
        dataType: 'json',
        success:function(response) {
          if(response.success == true) {
            window.location = 'admin';
        }
        else {
            document.getElementById("pesan").innerHTML = "<br><b style='color:red;'>Username / Password anda salah</b>";
            
          } // /else
        } // /if
    });

      return false;
  });
});


</script>
