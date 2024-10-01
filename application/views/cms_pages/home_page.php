<?php foreach($home_page_data as $home_row){ 

?>

<!-- Carousel Start -->
 <div class="header-carousel owl-carousel">
 <?php foreach($slider_data as $slider_row){	?>		
            <div class="header-carousel-item">
                <div class="header-carousel-item-img-1">
                    <img src="<?php echo base_url(); ?>uploads/slider_image/<?php echo $slider_row['slider_image']; ?>" alt="<?php echo $slider_row['text_one']; ?>" class="img-fluid w-100" >
                </div>
                <div class="carousel-caption">
                    <div class="carousel-caption-inner text-start p-3">
                        <h1 class="display-1 text-capitalize text-white mb-4 fadeInUp animate__animated" data-animation="fadeInUp" data-delay="1.3s" style="animation-delay: 1.3s;"><?php echo $slider_row['text_one']; ?></h1>
                        <p class="mb-5 fs-5 fadeInUp animate__animated" data-animation="fadeInUp" data-delay="1.5s" style="animation-delay: 1.5s;"><?php echo $slider_row['text_tow']; ?></p>
                       <!-- <a class="btn btn-primary rounded-pill py-3 px-5 mb-4 me-4 fadeInUp animate__animated" data-animation="fadeInUp" data-delay="1.5s" style="animation-delay: 1.7s;" href="register">Apply Now</a>-->
                       
                    </div>
                </div>
            </div>
 <?php } ?>
		</div>
		<!-- Carousel End -->
		
		
		<!-- About Start -->
        <div class="container-fluid about bg-light py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="about-img">
                           
                            <img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $home_row['about_us_image']; ?>" class="img-fluid w-100 rounded-bottom" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                        <h4 class="text-primary"><?php echo $home_row['about_us_title']; ?></h4>
                       
                        <p class="text ps-4 mb-4"><?php echo $home_row['about_us_content']; ?></p>
                     
                        <div class="row g-4 text-center align-items-center justify-content-center">
						<?php $i=0; foreach($our_technology as $row_ot){ ?>
                            <div class="col-sm-4">
                                <div class="<?php if(($i%2) == 0){ ?> bg-primary <?php } else { ?> bg-dark<?php } ?> rounded p-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="counter-value fs-1 fw-bold <?php if(($i%2) == 0){ ?>  text-dark <?php } else { ?> text-white<?php } ?>" data-toggle="counter-up"><?php echo $row_ot['our_technology_title']; ?></span>
                                        <h4 class="<?php if(($i%2) == 0){ ?>  text-dark <?php } else { ?> text-white<?php } ?> fs-1 mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-center">
                                        <p class="text-white mb-0"><?php echo $row_ot['our_technology_description']; ?></p>
                                    </div>
                                </div>
                            </div>
						<?php $i++; } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
		
		 <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h4 class="text-primary"><?php echo $home_row['our_brand_first_title']; ?></h4>
                    <h1 class="display-4"> <?php echo $home_row['our_brand_second_title']; ?></h1>
                </div>
                <div class="row g-4 justify-content-center text-center">
				<?php foreach($services_data as $services_row){ ?>  
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item bg-light rounded">
                            <div class="service-img">
                                <img src="<?php echo base_url(); ?>uploads/abdaily_services_image/<?php echo $services_row['services_image']; ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="service-content text-center p-4">
                                <div class="service-content-inner">
                                    <a class="h4 mb-4 d-inline-flex text-start"> <?php echo $services_row['services_name']; ?></a>
                                    <p class="mb-4"><?php echo $services_row['services_description']; ?>
                                    </p>
                                    <a class="btn btn-light rounded-pill py-2 px-4" href="<?php echo base_url(); ?>services/view/<?php echo $services_row['services_token']; ?>/<?php echo $services_row['services_id']; ?>">Read More</a>
                                </div>
                                </div>
                            </div>
                        </div>
				<?php } ?>
                    </div>
					
                   <div class="col-12 text-center" style="margin-top:1% !important;" >
                        <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.1s" href="<?php echo base_url(); ?>services">Services More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services End -->
		
		
		        <!-- Happy Birthday Start -->
				<?php  	if(!empty($user_data)){ ?>
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h4 class="text-primary">Today's Happy Birthday</h4>
                    <h1 class="display-4"><?php echo $content; ?></h1>
                </div>
                <div class="row g-4 justify-content-center">
				
				<?php  foreach($user_data as $user_row){ ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded">
                            <div class="team-img">
                                <img src="<?php echo base_url(); ?>uploads/abdaily_profile_images/<?php echo $user_row['profile_image']; ?>" class="img-fluid w-100 rounded-top" alt="<?php echo $user_row['name'];?>">
                                
                            </div>
                            <div class="team-content bg-dark text-center rounded-bottom p-4">
                                <div class="team-content-inner rounded-bottom">
                                    <h4 class="text-white"><?php echo $user_row['name'];?></h4>
                                    <p class="text-muted mb-0"><?php echo $user_row['member_type_name'];?> Reporter</p>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php } ?>
                    
                   
                </div>
            </div>
        </div>
				<?php } ?>
        <!-- Happy Birthday End -->

		
		 <!-- Testimonial Start -->
        <div class="container-fluid testimonial bg-light py-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-xl-4 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="h-100 rounded">
                            <h4 class="text-primary"><?php echo $home_row['our_technolgy_first_title']; ?> </h4>
                            <h1 class="display-4 mb-4"><?php echo $home_row['our_technolgy_second_title']; ?></h1>
                            <p class="mb-4"><?php echo $home_row['our_technolgy_content']; ?></p>
                            
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="testimonial-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">
						
						<?php $i=0; foreach($testominal_data as $testominal_row){ ?>
                            <div class="testimonial-item bg-white rounded p-4 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="d-flex">
                                    <div><i class="fas fa-quote-left fa-3x text-dark me-3"></i></div>
                                    <p class="mt-4"><?php echo $testominal_row['testimonials_desicription'];?></p>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="my-auto text-end">
                                        <h5><?php echo $testominal_row['testimonials_name'];?></h5>
                                        <p class="mb-0"><?php echo $testominal_row['designation'];?></p>
                                    </div>
                                    <div class="bg-white rounded-circle ms-3">
                                        <img src="<?php echo base_url(); ?>uploads/testimonials_image/<?php echo $testominal_row['testimonials_image']; ?>" class="rounded-circle p-2" style="width: 80px; height: 80px; border: 1px solid; border-color: var(--bs-primary);" alt="">
                                    </div>
                                </div>
                            </div>
						<?php } ?>
                            
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->

		
 <?php } ?>

