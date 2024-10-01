
<!DOCTYPE html>
<html lang="en">

    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />		
		<?php $system_name = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;	?>
		<title><?php echo $system_name; ?></title>
		<?php $ext =  $this->db->get_where('general_settings',array('type' => 'fav_ext'))->row()->value;?>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/others/favicon.<?php echo $ext; ?>">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
		<meta content="" name="keywords">
		<meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="<?=base_url('template/front/abdaily/lib/animate/animate.min.css')?>" rel="stylesheet">
        <link href="<?=base_url('template/front/abdaily/lib/owlcarousel/assets/owl.carousel.min.css')?>"  rel="stylesheet">
        <link href="<?=base_url('template/front/abdaily/lib/lightbox/css/lightbox.min.css')?>"  rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="<?=base_url('template/front/abdaily/css/bootstrap.min.css')?>"  rel="stylesheet">
		<link href="<?=base_url('template/front/abdaily/css/style.css')?>"  rel="stylesheet">

        <!-- Template Stylesheet -->
        
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Topbar Start -->
        <div class="container-fluid topbar px-0 d-none d-lg-block">
            <div class="container px-0">
                <div class="row gx-0 align-items-center" style="height: 45px;">
                    <div class="col-lg-8 text-center text-lg-start mb-lg-0">
                        <div class="d-flex flex-wrap">
						<?php $header_data = $this->db->get_where('header_setting', array('header_id' =>"1"))->result_array(); ?>
                            <a href="<?php echo $header_data[0]['location'];?>" class="text-muted me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                            <a href="#" class="text-muted me-4"><i class="fas fa-phone-alt text-primary me-2"></i><?php echo $header_data[0]['contact_one'];?></a>
                            <a href="#" class="text-muted me-0"><i class="fas fa-envelope text-primary me-2"></i><?php echo $header_data[0]['email'];?></a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="d-flex align-items-center justify-content-end">
						<?php $get_social =  $this->db->get_where('web_social_media',array('status' => 'Active'))->result_array(); ?>
							<?php foreach($get_social as $row_s){
								if($row_s['icon'] != '') {?>

					<a href="<?php echo $row_s['link']; ?>" class="btn btn-primary btn-square rounded-circle nav-fill me-3"><img src="<?php echo base_url(); ?>uploads/web_social_icon/<?php echo $row_s['icon'];?>" alt="Logo" style="height:30px; width:30px;"> 
                    </a>
					<?php } else { ?>
								<a href="<?php echo $row_s['link']; ?>" class="btn btn-primary btn-square rounded-circle nav-fill me-3"><img src="<?php echo base_url(); ?>uploads/web_social_icon/default.png" alt="Logo" style="height:20px; width:20px;"> 
                    </a>
                    	<!--<a class="btn btn-light btn-md-square me-2" href="<?php echo $row_s['link']; ?>"><i class="fab fa-<?php echo $row_s['name']; ?>"></i></a>-->
							<?php }  } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <!-- Topbar End -->
		


        <!-- Navbar & Hero Start -->
        <div class="container-fluid sticky-top px-0">
		
            <div class="position-absolute bg-dark" style="left: 0; top: 0; width: 100%; height: 100%;">
            </div>
			<div class="top-bar-area-bgcolor header-variant-01" style="background-color:#FFF !important;font-size:30px;">
        <div class="container" style="background-color:#FFF !important;">
            <div class="row">
			<!--<div class="col-lg-3">
                    <div class="top-bar-inner">   
					<span style="color:#FFF !important;"> Today News: </span>
                                     
                    </div>
                </div>-->
                <div class="col-lg-12">
                    <div class="top-bar-inner">   
					<marquee onmouseover="this.stop()" onmouseout="this.start()" style="color:#FFF;"><span style="color:#FFF !important;"><?php echo $header_data[0]['news'];?></marquee>
                                     
                    </div>
                </div>
            </div>
        </div>
    </div>
			
            <div class="container px-0">
			
                <nav class="navbar navbar-expand-lg navbar-dark bg-white py-3 px-4">
                    <a href="<?php echo base_url(); ?>" class="navbar-brand p-0">
                    <?php
					$home_top_logo = $this->db->get_where('general_settings',array('type' => 'home_top_logo'))->row()->value;
					?>
					<img src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo;?>.png" alt="Logo" style="height:100px; width:200px;"> 
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
							<a class="nav-item nav-link <?php if(@$page_slug == 'home'){ echo 'active'; }?>" href="<?php echo base_url(); ?>">Home </a></li>
							<a class="nav-item nav-link <?php if(@$page_slug == 'about'){ echo 'active'; }?>" href="<?php echo base_url(); ?>aboutus">About Us</a></li>
							<a class="nav-item nav-link <?php if(@$page_slug == 'services'){ echo 'active'; }?>" href="<?php echo base_url(); ?>services">Services </a></li>
							<a class="nav-item nav-link <?php if(@$page_slug == 'faqs'){ echo 'active'; }?>" href="<?php echo base_url(); ?>faqs">FAQs </a></li>
							<a class="nav-item nav-link <?php if(@$page_slug == 'community'){ echo 'active'; }?>" href="<?php echo base_url(); ?>community">Community </a></li>
							<a class="nav-item nav-link <?php if(@$page_slug == 'news'){ echo 'active'; }?>" href="<?php echo base_url(); ?>news">News </a></li>
							<a class="nav-item nav-link <?php if(@$page_slug == 'contact'){ echo 'active'; }?>" href="<?php echo base_url(); ?>contact">Contact </a></li>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap pt-xl-0">
                            
<!--<a href="<?php echo base_url(); ?>login" class="btn btn-primary rounded-pill text-white py-2 px-4 ms-2 flex-wrap flex-sm-shrink-0">Login</a>-->
							 <a href="<?php echo base_url(); ?>register" class="btn btn-primary rounded-pill text-white py-2 px-4 ms-2 flex-wrap flex-sm-shrink-0">Register</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
		
		
		
        <!-- Navbar & Hero End -->