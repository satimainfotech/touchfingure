<?php foreach($home_page_data as $home_row){ 
$slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'faqs'))->row()->second_slider_image;
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
                            <h4 class="text-primary">FAQs</h4>
                            <h1 class="display-4">Get the Answers to Common Questions</h1>
                        </div>
                       <div class="accordion bg-light rounded p-4" id="accordionExample">
						<?php foreach($faqs_data as $faqs_row){ ?>   
							<div class="accordion-item border-0 mb-4">
								<h2 class="accordion-header" id="heading<?php echo $faqs_row['faq_id']; ?>">
									<button class="accordion-button text-dark fs-5 fw-bold rounded-top" 
											type="button" 
											data-bs-toggle="collapse" 
											data-bs-target="#collapse<?php echo $faqs_row['faq_id']; ?>" 
											aria-expanded="false" 
											aria-controls="collapse<?php echo $faqs_row['faq_id']; ?>">
										<?php echo $faqs_row['faq_name']; ?>
									</button>
								</h2>
								<div id="collapse<?php echo $faqs_row['faq_id']; ?>" 
									 class="accordion-collapse collapse" 
									 aria-labelledby="heading<?php echo $faqs_row['faq_id']; ?>" 
									 data-bs-parent="#accordionExample">
									<div class="accordion-body my-2">
										<p><?php echo $faqs_row['faq_desicription']; ?></p>
									</div>
								</div>
							</div>
						<?php } ?>
</div>
                    </div>
					
					 <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                        <div class="faq-img RotateMoveRight rounded">
                            <img src="<?php echo base_url(); ?>uploads/other_images/faq.jpg" class="img-fluid rounded w-100" alt="Image">
                           
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>

 
 <?php } ?>
 
 
 
 