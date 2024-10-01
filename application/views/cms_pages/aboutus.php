<?php foreach($home_page_data as $home_row){ 
$slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'aboutus'))->row()->second_slider_image;
$image =  base_url().'uploads/second_slider_image/'.$slider_image; ?>
 <div class="container-fluid bg-breadcrumb" style="background: url(<?php echo $image; ?>);">
            <div class="bg-breadcrumb-single"></div>
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s"></h4>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                   
                </ol>    
            </div>
        </div>
        <!-- Header End -->
        <!-- About Start -->
        <div class="container-fluid about bg-light py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="about-img">
                           
                            <img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $header_image; ?>" class="img-fluid w-100 rounded-bottom" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                        <h4 class="text-primary"><?php echo $page_title; ?></h4>
                       
                        <p class="text ps-4 mb-4"><?php echo $page_title_bottom_text; ?></p>
                       
                     
                        <div class="row g-4 text-center align-items-center justify-content-center">
						<?php $i=0; foreach($our_technology as $row_ot){ ?>
                            <div class="col-sm-4">
                                <div class="<?php if(($i%2) == 0){ ?> bg-primary <?php } else { ?> bg-dark<?php } ?> rounded p-4">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="counter-value fs-1 fw-bold <?php if(($i%2) == 0){ ?>  text-dark <?php } else { ?> text-white<?php } ?>" data-toggle="counter-up"><?php echo $row_ot['our_technology_title']; ?></span>
                                        <h4 class="<?php if(($i%2) == 0){ ?>  text-dark <?php } else { ?> text-white<?php } ?> fs-1 mb-0" style="font-weight: 600; font-size: 25px;">+</h4>
                                    </div>
                                    <div class="w-100 d-flex align-items-center justify-content-center">
                                        <p class="text-white mb-0"><b><?php echo $row_ot['our_technology_description']; ?></b></p>
                                    </div>
                                </div>
                            </div>
						<?php $i++; } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Start -->
        <div class="container-fluid team py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Team</h4>
                    <h1 class="display-4"><?php echo $content; ?></h1>
                </div>
                <div class="row g-4 justify-content-center">
				
				<?php  foreach($team_data as $team_row){ ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded">
                            <div class="team-img">
                                <img src="<?php echo base_url(); ?>uploads/abdaily_team_image/<?php echo $team_row['team_image']; ?>" class="img-fluid w-100 rounded-top" alt="Image">
                                
                            </div>
                            <div class="team-content bg-dark text-center rounded-bottom p-4">
                                <div class="team-content-inner rounded-bottom">
                                    <h4 class="text-white"><?php echo $team_row['team_name'];?></h4>
                                    <p class="text-muted mb-0" style="font-size:19px;"><?php echo $team_row['team_position'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php } ?>
                    
                   
                </div>
            </div>
        </div>
        <!-- Team End -->

 
 <?php } ?>
 
 
 
 