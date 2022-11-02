<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $page_title?> | <?= WEBSITE_TITLE?></title>
    <link href="<?= ASSETS . THEME ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/price-range.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>css/animate.css" rel="stylesheet">
	<link href="<?= ASSETS . THEME ?>css/main.css" rel="stylesheet">
	<link href="<?= ASSETS . THEME ?>css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?= ASSETS . THEME ?>js/html5shiv.js"></script>
    <script src="<?= ASSETS . THEME ?>js/respond.min.js"></script>
    <![endif]--> 
    	 
    <!--
    <link href="<?= ASSETS . THEME ?>admin/css/style.css" rel="stylesheet">
    <link href="<?= ASSETS . THEME ?>admin/css/style-responsive.css" rel="stylesheet">
	-->
	
    <link rel="shortcut icon" href="<?= ASSETS . THEME ?>images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?= ASSETS . THEME ?>images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<style type="text/css"> 
	.label {
		position: absolute;
		top: -5px;
		left: 7px;
		text-align: center;
		font-size: 9px;
		padding: 2px 3px;
		line-height: .9;
	}
</style>

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> <?=Settings::phone_number()?></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> <?=Settings::email()?></a></li>
								<?php if(isset($data['user_data'])): ?>
									<li><a href="#"><i class="fa fa-user"></i> <?= $data['user_data']->name ?></a></li>
								<?php endif;?>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a target="_new" href="<?=Settings::facebook_link()?>" title="facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a target="_new" href="<?=Settings::twitter_link()?>" title="twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a target="_new" href="<?=Settings::linkedin_link()?>" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
								<li><a target="_new" href="<?=Settings::website_link()?>" title="website"><i class="fa fa-dribbble"></i></a></li>
								<li><a target="_new" href="<?=Settings::google_plus_link()?>" title="google+"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="<?=ROOT?>index"><img src="<?= ASSETS . THEME ?>images/home/logo.png" alt="" /></a>
						</div>
						<!--
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
						-->
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<?php if(isset($data['user_data'])):?>
									<li><a href="<?=ROOT?>profile"><img src="<?= ($data['user_data']->image != "") ? ROOT.$data['user_data']->image : ROOT.'uploads/user.png'?>" class="img-circle" width="24"> Account</a></li>
								<?php endif; ?>
								<?php if(isset($data['user_data']) && $data['user_data']->rank == "admin"):?>
									<li><a href="<?=ROOT?>admin"><img style="width: 2.5rem;" src="<?= ASSETS . THEME ?>vip.png" alt="" />Admin</a></li>
								<?php endif;?>
								
								<!--<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>-->
								<li><a href="<?=ROOT?>checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="<?=ROOT?>cart"><i class="fa fa-shopping-cart"></i>
									<?php if (isset($_SESSION['CART'])): ?>
									<span class="label label-success cart_count"><?=count($_SESSION['CART'])?></span>
									<?php endif; ?> Cart</a></li>
								<?php if(isset($data['user_data'])): ?>
									<li><a href="<?=ROOT?>logout"><i class="fa fa-lock"></i> Logout</a></li>
								<?php else: ?>
									<li><a href="<?=ROOT?>login"><i class="fa fa-lock"></i> Login</a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?=ROOT?>home" class="<?= $page_title == "Home" ? "active" : ""?>">Home</a></li>
								<li class="dropdown"><a href="" class="<?= $page_title == "Shop" ? "active" : ""?>">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?=ROOT?>shop">Products</a></li>
						     				<li><a href="<?=ROOT?>checkout">Checkout</a></li> 
										<li><a href="<?=ROOT?>cart">Cart</a></li> 
										<?php if(isset($data['user_data'])): ?>
											<li><a href="<?=ROOT?>logout"><i class="fa fa-lock"></i> Logout</a></li>
										<?php else: ?>
											<li><a href="<?=ROOT?>login"><i class="fa fa-lock"></i> Login</a></li>
										<?php endif; ?>
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="<?=ROOT?>blog" class="<?= $page_title == "Blog" ? "active" : ""?>">Blog</a></li> 
								<li><a href="<?=ROOT?>contact-us" class="<?= $page_title == "Contact-Us" ? "active" : ""?>">Contact</a></li>
							</ul>
						</div>
					</div>
					<?php if(isset($show_search)): ?>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form method="get">
								<input name="find" type="text" placeholder="Search" style="color:#000;" />
							</form>
						</div>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<style type="text/css">
		.product-image{
			transition: all 1s ease;
		}
		.product-image:hover{
			transform: scale(1.5);
		}
	</style>
	
