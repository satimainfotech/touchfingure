<?php foreach($home_page_data as $home_row){ ?>

        <!-- Page Banner Start -->
        <div class="section page-banner-section">
            <div class="container">
                <div class="page-banner-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Banner Content Start -->
                            <div class="page-banner text-center">
                                <h2 class="title">About Event</h2>
                                <ul class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">About Event</li>
                                </ul>
                            </div>
                            <!-- Page Banner Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Banner End -->

        <!-- About Section Start -->
        <div class="meeta-about-section section-padding">
            <div class="container">

                <div class="row gy-5 align-items-center">
                    <div class="col-lg-7">

                        <!-- About Images Start -->
                        <div class="meeta-about-images" >
                            <div class="image">
                                 <img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $home_row['about_us_image'];?>" alt="About">
                            </div>
                        </div>
                        <!-- About Images End -->

                    </div>
                    <div class="col-lg-5">

                        <!-- Section Title Start -->
                        <div class="meeta-section-title-2 meeta-about-title">
                           <h4 class="sub-title">An event for</h4>
                            <h2 class="main-title"><?php echo $home_row['about_us_title'];?></h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Content Start -->
                        <div class="meeta-about-content">

                            <p<?php echo $home_row['about_us_content'];?></p>

                        </div>
                        <!-- About Content End -->

                    </div>
                </div>

            </div>
        </div>
        <!-- About Section End -->

        <!-- Features Section Start -->
        <div class="meeta-features-section section-padding">
            <div class="shape-1" data-aos-delay="700" data-aos="zoom-in"></div>
            <img class="shape-2" src="assets/images/shape/shape-11.png" alt="">
            <div class="container">
                <div class="meeta-features-wrap">
                    <div class="row">
					<?php $i = 0; foreach($attend_event_data as $attend_event_row) { ?>
                        <div class="col-lg-4">
                            <!-- Section Title Start -->
							<?php if($i == 0){ ?>
                            <div class="meeta-section-title-2">
                                <h4 class="sub-title">Reason to join Event</h4>
                                <h2 class="main-title">Why attend Event</h2>
                            </div>
							<?php } else if( $i > 2 &&($i%1 == 1 )) { ?>
							
							 <!-- Features Item Start -->
                            <div class="feature-item feature-<?php echo $i; ?>">
                                <div class="feature-icon">
                                    <img src="<?php echo base_url(); ?>uploads/our_technology_image/<?php echo $attend_event_row['our_technology_image'];?>" alt="">
                                </div>
                                <div class="feature-content">
                                    <h3 class="title"><a href="#">Facility</a></h3>
                                    <p>We’re inviting the top creatives in the tech industry from all over the world to come learn, grow, scrape their </p>
                                </div>
                            </div>
                            <!-- Features Item End -->
							
							
							<?php } else if(  $i%1 == 0) {  ?>
                            <!-- Section Title End -->
                            <!-- Features Item Start -->
							
							
							
                            <div class="feature-item feature-<?php echo $i; ?>">
                                <div class="feature-icon">
                                    <img src="<?php echo base_url(); ?>uploads/our_technology_image/<?php echo $attend_event_row['our_technology_image'];?>" alt="">
                                </div>
                                <div class="feature-content">
                                    <h3 class="title"><?php echo $attend_event_row['our_technology_title'];?></h3>
                                    <p><?php echo @$attend_event_row['our_technology_title'];?> </p>
                                </div>
                            </div>
					<?php } ?>
							
                           
                            <!-- Features Item End -->
                        </div>
						
					<?php $i++; } ?>
                        </div>
                </div>
            </div>
        </div>
        <!-- Features Section End -->

       <!-- Speakers Start -->
        <div class="meeta-speakers section-padding">
            <div class="container">
                <!-- Section Title Start -->
                <div class="meeta-section-title text-center">
                    <h4 class="sub-title">categories</h4>
                    <h2 class="main-title">categories</h2>
                </div>
                <!-- Section Title End -->

                 <div class="row gy-5 meeta-speakers-row">
				
				<?php foreach($category_data as $category_row){ ?>
                    <div class="col-lg-3 col-sm-6">
                        <!-- Single Speakers Start -->
                        <div class="single-speaker">
                            <div class="speaker-image">
                                <a href=""><img src="<?php echo base_url(); ?>uploads/category_image/<?php echo $category_row['category_image']; ?>" alt="Speaker"></a>
                            </div>
                            <div class="speaker-content">
                                <div class="speaker-content-box">
                                    <h4 class="speaker-name"><a href="#"><?php echo $category_row['category_name']; ?></a></h4>
                                   <!-- <p class="speaker-designation">Ahmedabad</p>-->
                                </div>
                                <img class="speaker-shape-1" src="<?php echo base_url(); ?>uploads/images/shape/shape-8.png" alt="">
                                <div class="speaker-shape-2"></div>
                            </div>
                        </div>
                        <!-- Single Speakers End -->
                    </div>
					
				<?php } ?>
                      
                    </div>

            </div>
        </div>
        <!-- Speakers End -->
        <!-- Gallery Start -->
        <!-- Gallery Start -->
        <div class="meeta-pricing section-padding">
            <div class="container">

                <!-- Section Title Start -->
                <div class="meeta-section-title text-center">
                    <h4 class="sub-title">Photo Gallery</h4>
                    <h2 class="main-title">Have A Look On</h2>
                </div>
                <!-- Section Title End -->

                <div class="row g-0">
				
				<?php foreach($sub_category_data as $sub_category_row){ ?>
                    <div class="col-lg-4 col-sm-6">

                        <!-- Single Gallery Start -->
                        <div class="single-gallery">
                            <div class="gallery-image">
                                <img src="<?php echo base_url(); ?>uploads/sub_category_image/<?php echo $sub_category_row['sub_category_image']; ?>" alt="<?php echo $sub_category_row['sub_category_name'];?>">
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-content-wrap">
                                    <a href="<?php echo base_url(); ?>uploads/sub_category_image/<?php echo $sub_category_row['sub_category_image']; ?>" class="gallery-plus image-popup">
                                        <span></span>
                                    </a>
                                    <h4 class="gallery-title"><a href="#"><?php echo $sub_category_row['sub_category_name'];?></a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Single Gallery End -->

                    </div>
				<?php } ?>
                    </div>

            </div>
        </div>
        <!-- Gallery End -->
        <!-- Gallery End -->

        <!-- Event Sponsors Start -->
        <div class="meeta-event-sponsors-2 section-padding" style="background-image: url(assets/images/event-bg-1.jpg);">
            <div class="container">

                <!-- Section Title Start -->
                <div class="meeta-section-title-2 text-center">
                    <h2 class="main-title">Event Sponsors</h2>
                </div>
                <!-- Section Title End -->

                 <!-- Sponsor Active Start -->
                <div class="meeta-sponsor-active">
                    <div class="swiper">
                        <div class="swiper-wrapper">
						
							<?php foreach($brand_data as $brand_row){ ?>
                            <div class="swiper-slide">
                                <div class="meeta-sponsor-logo">
                                    <img src="<?php echo base_url(); ?>uploads/brand_image/<?php echo $brand_row['brand_image']; ?>" alt="<?php echo $brand_row['brand_name'];?>">
                                </div>
                            </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
                <!-- Sponsor Active End -->

            </div>
        </div>
        <!-- Event Sponsors End -->


    </div>

 
 
 <?php } /* 






<div class="reddmica-main-content">
	<div class="reddmica-main-section margin-bottom">
        <div class="container">
            <div class="row">
				<div class="col-md-5">
					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $content_data[0]['about_image'];?>" >
				</div>
				<div class="col-md-7">
					<?php echo $content_data[0]['content']; ?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Achivement Section -->
		<div class="reddmica-main-section margin-bottom margin-top" style="<?php if($content_data[0]['show_achivement'] == 'no'){ echo "display:none"; }?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="reddmica-counter">
							<ul class="row">
								<?php foreach($achievement as $a_row){ ?>
									<li class="col-md-3">
										<div class="reddmica-counter-wrap">
											<i class="reddmica-color "><img src="<?php echo base_url();?>uploads/achievement_icon/<?php echo $a_row['icon']; ?>"></i>
											<span class="word-count" id="word-count1"><?php echo $a_row['total_count']; ?></span>
											<small><?php echo $a_row['name']; ?></small>
										</div>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Achivement Section -->
</div>

<?php */ ?>