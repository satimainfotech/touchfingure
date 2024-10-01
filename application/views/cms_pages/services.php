<?php foreach($home_page_data as $home_row){ 
$slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'services'))->row()->second_slider_image;
$image =  base_url().'uploads/second_slider_image/'.$slider_image; ?>
        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb" style="background: url(<?php echo $image; ?>);">
            <div class="bg-breadcrumb-single"></div>
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s"></h4>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    
                </ol>    
            </div>
        </div>
        <!-- Header End -->
         <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Services</h4>
                    <h1 class="display-4"> Offering the Best reporting Services</h1>
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
                   
                </div>
            </div>
        </div>
        <!-- Services End -->

      

<?php } ?>