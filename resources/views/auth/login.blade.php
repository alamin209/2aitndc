<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Dhaka School of Economics</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('/') }}/public/admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/public/admin/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{ url('/') }}/public/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ url('/') }}/public/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ url('/') }}/public/admin/css/owl.carousel.css" type="text/css">

    <!--right slidebar-->
    <link href="{{ url('/') }}/public/admin/css/slidebars.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('/') }}/public/admin/css/style.css" rel="stylesheet">
    <link href="{{ url('/') }}/public/admin/css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background-color: #018888;">

<div class="container" >
    <!--  <div class="col-md-8"> -->
    <div class="card" >
    <!--   <div class="card-header">{{ __('Login') }}</div>
 -->
        <div class="card-body" >

            <form method="POST"  id="loginForm" class="form-signin" action="{{ route('login') }}">
                {{--<img   style="width:326px; height:auto" src={{asset('public/admin/assets/logo/dsec.jpg')}} alt="Logo">--}}
                <h2 class="form-signin-heading" style="color: #000;text-shadow: 0px 0px 12px #fff;">
                    <strong>Dhaka School of Economics</strong>
                </h2>
                <div class="login-wrap">
                    @csrf

                    <div class="form-group row">
                    <!--  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                        <div class="col-md-12">
                            <input id="email" placeholder="Enter Email Address as Username" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                    <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
 -->
                        <div class="col-md-12">
                            <input id="password" placeholder="Enter Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <!--  <div class="col-md-8 offset-md-4"> -->
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-lg btn-login btn-block">
                                {{ __('Login') }}
                            </button>

                        @if (Route::has('password.request'))
                            <!--    <a  class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                </a> -->
                            @endif
                            <br><hr><p style="text-align:center; font-size:14px; color:Blue;"> <a href="http://2aitbd.com"><strong >Design & Developed by</strong> <strong>2A IT</strong></a></p>
                        </div>


                    </div>
                    <!--  </div> -->
                </div>
            </form>
        </div>
    </div>
    <!--   </div> -->



</div>
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{ url('/') }}/public/admin/js/jquery.js"></script>
<script src="{{ url('/') }}/public/admin/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="{{ url('/') }}/admin/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{ url('/') }}/public/admin/js/jquery.scrollTo.min.js"></script>
<script src="{{ url('/') }}/public/admin/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/admin/js/jquery.sparkline.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="{{ url('/') }}/public/admin/js/owl.carousel.js" ></script>
<script src="{{ url('/') }}/public/admin/js/jquery.customSelect.min.js" ></script>
<script src="{{ url('/') }}/public/admin/js/respond.min.js" ></script>

<!--right slidebar-->
<script src="{{ url('/') }}/public/admin/js/slidebars.min.js"></script>

<!--common script for all pages-->
<script src="{{ url('/') }}/public/admin/js/common-scripts.js"></script>

<!--script for this page-->
<script src="{{ url('/') }}/public/admin/js/sparkline-chart.js"></script>
<script src="{{ url('/') }}/public/admin/js/easy-pie-chart.js"></script>
<script src="{{ url('/') }}/public/admin/js/count.js"></script>

<script>

    //owl carousel

    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
</html>

