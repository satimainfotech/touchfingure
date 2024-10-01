<!doctype html>
<html class="no-js" lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo $system_name; ?></title>
	<?php $ext =  $this->db->get_where('general_settings',array('type' => 'fav_ext'))->row()->value;?>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/others/favicon.<?php echo $ext; ?>">
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@300;400;500;600;700;800&amp;family=Open+Sans:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Archivo:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- CSS
	============================================ -->

    <!-- Icon Font CSS -->
	<link rel="stylesheet" href="<?=base_url('template/front/css/all.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/flaticon.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/swiper-bundle.min.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/magnific-popup.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/aos.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/nice-select.css')?>">
	<link rel="stylesheet" href="<?=base_url('template/front/css/style.css')?>">
	

</head>
<body>

    <div class="main-wrapper">

        <!-- Preloader start -->
        <div id="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- Preloader End -->

        <!-- Header Start -->
        <div class="meeta-header-section">

            <!-- Header Middle Start -->
            <div class="header-middle header-sticky">
                <div class="container-fluid custom-container">

                    <div class="row align-items-center">
                        <div class="col-lg-3 col-4">
								<?php
								$home_top_logo = $this->db->get_where('general_settings',array('type' => 'home_top_logo'))->row()->value;
								?>
                            <!-- Header Logo Start -->
                            <div class="header-logo">
                                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo;?>.png" alt="Logo"></a>
                            </div>
                            <!-- Header Logo End -->

                        </div>
                        <div class="col-lg-6 d-none d-lg-block">

                            <!-- Header Navigation Start -->
                            <div class="header-navigation">
                                <ul class="main-menu">
                                    <li class="<?php if(@$page_slug == 'home'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>">Home</a>
                                    <li class="<?php if(@$page_slug == 'about'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>about">About</a></li>
									<li class="<?php if(@$page_slug == 'gallery'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
									<!--<li class="<?php if(@$page_slug == 'price'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>price">Price</a></li>-->
									<li class="<?php if(@$page_slug == 'events'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>events">Events</a></li>
									<li class="<?php if(@$page_slug == 'contact'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>contact">Contact</a></li>
								
                                   
                                    
                                </ul>
                            </div>
                            <!-- Header Navigation End -->

                        </div>
                        <div class="col-lg-3 col-8">

                            <!-- Header Meta Start -->
                            <div class="header-meta">                               

                               <!-- <div class="header-btn d-none d-md-block">
                                    <a href="<?php echo base_url(); ?>entry-pass" class="btn btn-3 btn-primary">Buy Ticket Now</a>
                                </div>-->

                                <!-- Header Toggle Start -->
                                <div class="header-toggle d-md-none">
                                    <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </button>
                                </div>
                                <!-- Header Toggle End -->

                            </div>
                            <!-- Header Meta End -->

                        </div>
                    </div>

                </div>
            </div>
            <!-- Header Middle End -->

        </div>
        <!-- Header End -->
		
        <!-- Mini Cart Start -->
        <div class="off-canvas">
            <div class="icon-close"></div>


        </div>
        <!-- Mini Cart End -->


        <!-- Offcanvas Start-->
        <div class="offcanvas offcanvas-start" id="offcanvasExample">
            <div class="offcanvas-header">
                <!-- Offcanvas Logo Start -->
                <div class="offcanvas-logo">
                    <a href="index.php"><img src="assets/images/logo.png" alt=""></a>
                </div>
                <!-- Offcanvas Logo End -->
                <button type="button" class="close-btn" data-bs-dismiss="offcanvas"><i class="flaticon-close"></i></button>
            </div>

            <!-- Offcanvas Body Start -->
            <div class="offcanvas-body">
                <div class="offcanvas-menu">
                    <ul class="main-menu">
						<li class="<?php if(@$page_slug == 'home'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>">Home</a>
						<li class="<?php if(@$page_slug == 'about'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>about">About</a></li>
						<li class="<?php if(@$page_slug == 'gallery'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>about">Gallery</a></li>
						<!--<li class="<?php if(@$page_slug == 'price'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>price">Price</a></li>-->
						<li class="<?php if(@$page_slug == 'events'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>events">Events</a></li>
						<li class="<?php if(@$page_slug == 'contact'){ echo 'active-menu'; }?>"><a href="<?php echo base_url(); ?>contact">Contact</a></li>
								
                    </ul>
                </div>
            </div>
            <!-- Offcanvas Body End -->
        </div>
        <!-- Offcanvas End -->





