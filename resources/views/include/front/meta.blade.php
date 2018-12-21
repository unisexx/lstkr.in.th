<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
{!! SEO::generate() !!}

{{--
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
--}}
{{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="AdminLTE-2.4.2/dist/css/skins/skin-blue.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style>
    /* mobile */
    @media screen and (max-width: 568px){
        body{font-size: 12px !important;}
        h1{font-size:18px; font-weight:bold; margin:3px 0; line-height:18px;}
        p.price{font-size:14px !important; font-weight:bold !important;}

        .carousel-indicators {bottom: -10px !important;}

        .MdIcoPlay_b {
            width: 24px !important;
            height: 24px  !important;
            background-position: -483px -190px  !important;
        }
    }

    /* Small devices (tablets, 768px and up) */
    @media screen and (max-width: 768px){
        .carousel-wrap{margin-top:-19px;}
    }

    /* Medium devices (desktops, 992px and up) */
    @media screen and (min-width: 992px){
    }

    /* Large devices (large desktops, 1200px and up) */
    @media screen and (min-width: 1200px){
    }

    body {
        font-size: 11pt;
        line-height: 140%;
        font-family: 'Helvetica Neue', Helvetica, arial, sans-serif;
        padding-top:70px;
    }
    .footer{ padding-bottom:90px; }
    .navbar-inverse .navbar-brand {
        color: #00CA57 !important;
    }
    .fa-btn {
        margin-right: 6px;
    }
    a{color:#737373;}
    a:hover{color: #cc6600; text-decoration: underline;}
    a:hover img {
        opacity: 0.8;
        filter: alpha(opacity=80);
        -ms-filter: "alpha( opacity=80 )";
    }
    p.price{font-size: 32px; color: #00b84f;}
    .mediablk{margin-top:5px; border-bottom:1px dashed #ddd; padding-bottom:5px;}
    .mediablk .panel{margin-bottom:0px;}
    .mediablk .panel-body h2{text-align:left;}
    .h2sidebar{font-size:16px; line-height: 1.5; padding:10px 0px; margin-top:0px;margin-bottom:0px; font-weight:bold;}
    .h3sidebar{font-size:16px; line-height: 1.5;}
    .table > thead > tr > th, .table > thead > tr > td {
        border: 0;
    }
    .carousel-indicators {bottom: 0px;}
    .foter {
        margin: 20px 0px 0px 0px;
        text-align: center;
        font-size: 10pt;
        line-height: 160%;
        background: #eeeeee;
        /* border-bottom: 1px solid #888888; */
        /* border-right: 1px solid #888888; */
        padding: 4px 10px 2px 10px;
    }

    .btnShop{margin-top:10px;}
    
    /* flex-box */
    .panel-body h3 {
		text-align: center;
		line-height: 1.5;
    	height: 38px;
		font-size: 14px;
		overflow: hidden;
		text-overflow: ellipsis;
		display: block;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
		margin-top:10px;
	}
    

    .icon-bar {
        width: 100%;
        overflow: auto;
    }

    .icon-bar a {
        float: left;
        width: 25%;
        text-align: center;
        padding: 12px 0;
        transition: all 0.3s ease;
        color: #FFF;
        /* border-right: 1px solid #9d9d9d; */
    }
    .icon-bar-wrap{ 
        background:#222; 
        position: fixed;
        bottom: 0px;
        right: 0;
        left: 0;
        opacity: 0.9;
        z-index: 9999;
    }

	/* not requied only for demo * */
	.row [class*='col-'] {
	background-colo: #cceeee;
	background-clip: content-box;
	}
	.panel {
		height: 100%;
		border: none !important;
		box-shadow: none !important;
	}
    .panel-body{padding:0px !important;}
    .img-cover{position: relative;}
    .box{border:none !important; box-shadow:none !important;}
    .box-title{color:#000; font-weight: bold;}
    .box-body{padding:10px 0 !important;}

    /* icon */
    .img-cover .MdIcoSound_b, .img-cover .MdIcoPlay_b, .img-cover .MdIcoAni_b, .img-cover .MdIcoFlash_b, .img-cover .MdIcoFlashAni_b,.img-cover .MdIcoPlay_m {
        z-index: 9;
        position: absolute;
        bottom: 0px;
        right: 0px;
    }
    .MdIcoPlay_b {
        width: 48px;
        height: 48px;
        background-position: -432px -115px;
    }
    .MdIcoPlay_m {
        width: 24px;
        height: 24px;
        background-position: -483px -190px;
    }
    .MdGHD01Logo a, .MdGHD02Search, .MdGFT03Lang .mdGFT03NewSelect01 .mdGFT03Label::before, .MdBtnClose01, .MdIcoCharge01, .MdIcoNew01, .MdIcoNew02, .MdIcoNew03, .MdIcoNew04, .MdIcoMore01, .MdIcoSearch01, .MdIcoSound_b, .MdIcoSound_m, .MdIcoSound_s, .MdIcoPlay_b, .MdIcoPlay_m, .MdIcoPlay_s, .MdIcoAni_s, .MdIcoAni_m, .MdIcoAni_b, .MdIcoFlash_s, .MdIcoFlash_m, .MdIcoFlash_b, .MdIcoFlashAni_s, .MdIcoFlashAni_m, .MdIcoFlashAni_b, .MdIcoWishlist01, .MdBtnIphone01, .MdBtnAndroid01, .MdIcoRadio01 .mdIcoRadio01Ico, .MdIcoWish01 input[type="checkbox"] + span, .MdTxt01MoreLink a::after, .MdCMN03Bnr .mdMN03Pagination span, .MdCMN03Bnr .mdCMN03BtnLi a, .MdCMN10Notice .mdCMN10Head .mdCMN10HeadShare a, .MdCMN11Event .mdCMN11EventH2, .MdCMN13SelectBox .mdCMN13NewSelect01 .mdCMN13Label::before, .MdCMN13SelectBox .mdCMN13NewSelect02 .mdCMN13Label::before, .MdCMN13SelectBox .mdCMN13NewSelect03 .mdCMN13Label::before, .MdCMN13SelectBox .mdCMN13NewSelect04 .mdCMN13Label::before, .MdCMN15List .mdCMN15PointIco, .MdCMN18MyInfo .myCMN18EditProfile .myCMN18Shadow, .MdCMN22Share a, .MdCMN25Setting .mdCMN25Ul li::before, .MdCMN29OaItem.mdCMN29List .MdIcoNew_30, .MdCMN33OaSelectBox .mdCMN33NewSelect01 .mdCMN33Label::before {
        background-image: url({{ url('image/ico_map.png') }});
    }
    .MdGHD01Logo a, .MdGHD02Search, .MdLYR08List .mdLYR08Img .mdLYR08Shadow, .MdIcoNew01, .MdIcoNew02, .MdIcoNew03, .MdIcoNew04, .MdIcoSound_b, .MdIcoSound_m, .MdIcoSound_s, .MdIcoPlay_b, .MdIcoPlay_m, .MdIcoPlay_s, .MdIcoAni_s, .MdIcoAni_m, .MdIcoAni_b, .MdIcoFlash_s, .MdIcoFlash_m, .MdIcoFlash_b, .MdIcoFlashAni_s, .MdIcoFlashAni_m, .MdIcoFlashAni_b, .MdIcoRadio01 .mdIcoRadio01Ico, .MdIcoRadio02 .mdIcoRadio02Ico, .MdIcoCheck01 .mdIcoCheck01Ico, .MdCMN03Bnr .mdMN03Pagination span, .MdCMN11Event .mdCMN11EventH2, .MdCMN18MyInfo .myCMN18EditProfile .myCMN18Shadow {
        display: block;
        overflow: hidden;
        background-repeat: no-repeat;
        text-align: left;
        text-indent: -9999px;
    }

    /* top & back button */
    #footer-back-to-top {
        position: fixed;
        right: 10px;
        bottom: 145px;
        z-index: 1000;
        cursor: pointer;
        width: 32px;
        height: 32px;
        font-size: 40px;
        color: #222;
        opacity: 0.6;
    }
    #footer-back-to-top.offscreen {
    bottom: -100px;
    -moz-transition-duration: 250ms;
    -webkit-transition-duration: 250ms;
    }
    .backButton {
        -moz-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -ms-transform: scaleX(-1);
        color: #222;
        position: fixed;
        right: 5px;
        bottom: 85px;
        z-index: 1000;
        cursor: pointer;
        width: 40px;
        height: 40px;
        font-size: 40px;
        opacity: 0.6;
        text-align: center;
    }

    /* navbar theme */
    .navbar-default {
    background-color: #5f5f5f;
    border-color: #000000;
    }
    .navbar-default .navbar-brand {
    color: #ffffff;
    }
    .navbar-default .navbar-brand:hover,
    .navbar-default .navbar-brand:focus {
    color: #ffffff;
    }
    .navbar-default .navbar-text {
    color: #ffffff;
    }
    .navbar-default .navbar-nav > li > a {
    color: #ffffff;
    }
    .navbar-default .navbar-nav > li > a:hover,
    .navbar-default .navbar-nav > li > a:focus {
    color: #ffffff;
    }
    .navbar-default .navbar-nav > .active > a,
    .navbar-default .navbar-nav > .active > a:hover,
    .navbar-default .navbar-nav > .active > a:focus {
    color: #ffffff;
    background-color: #000000;
    }
    .navbar-default .navbar-nav > .open > a,
    .navbar-default .navbar-nav > .open > a:hover,
    .navbar-default .navbar-nav > .open > a:focus {
    color: #ffffff;
    background-color: #000000;
    }
    .navbar-default .navbar-toggle {
    border-color: #000000;
    }
    .navbar-default .navbar-toggle:hover,
    .navbar-default .navbar-toggle:focus {
    background-color: #000000;
    }
    .navbar-default .navbar-toggle .icon-bar {
    background-color: #ffffff;
    }
    .navbar-default .navbar-collapse,
    .navbar-default .navbar-form {
    border-color: #ffffff;
    }
    .navbar-default .navbar-link {
    color: #ffffff;
    }
    .navbar-default .navbar-link:hover {
    color: #ffffff;
    }

    @media (max-width: 767px) {
    .navbar-default .navbar-nav .open .dropdown-menu > li > a {
        color: #ffffff;
    }
    .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
    .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
        color: #ffffff;
    }
    .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
    .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
    .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
        color: #ffffff;
        background-color: #000000;
    }
    }
</style>