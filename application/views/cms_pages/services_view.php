
<?php $slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'services'))->row()->second_slider_image;
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
        <!-- FAQs Start -->
        <div class="container-fluid faq py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="pb-5">
                          
                            <h1 class="display-4"><?php echo $services_data[0]['services_name']; ?></h1>
                        </div>						
                       <div class="accordion bg-light rounded p-4" >
                            <div class="service-content text-center p-4">
                                <div class="service-content-inner">
                                  
                                    <p class="mb-4"><?php echo $services_data[0]['services_description']; ?>
                                    </p>
                                    
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                        <div class="faq-img RotateMoveRight rounded">
                            <img src="<?php echo base_url(); ?>uploads/abdaily_services_inner_image/<?php echo $services_data[0]['services_inner_image']; ?>" class="img-fluid rounded w-100" alt="Image">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

 
 
 