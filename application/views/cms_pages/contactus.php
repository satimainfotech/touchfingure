
<?php foreach($contactus_data as $contact_row){ 
$slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'contact'))->row()->second_slider_image;
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
        <!-- Contact Start -->
        <div class="container-fluid contact bg-light py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="contact-item">
                            <div class="pb-5">
                                <h4 class="text-primary"><?php echo $contact_row['title']; ?></h4>
                                <h1 class="display-4 mb-4"><?php echo $contact_row['page_small_title']; ?></h1>
                                <p class="mb-0"><?php echo $contact_row['page_description']; ?></p>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary btn-lg-square rounded-circle p-4"><i class="fa fa-home text-white" style="font-size:25px;"></i></div>
                                <div class="ms-4">
                                    <h4>Addresses</h4>
                                    <p class="mb-0"><?php echo $contact_row['office_address']; ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary btn-lg-square rounded-circle p-2"><i class="fa fa-phone text-white" style="font-size:25px;"></i></div>
                                <div class="ms-4">
                                    <h4>Mobile</h4>
                                    <p class="mb-0">+91<?php echo $contact_row['contact_one']; ?></p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary btn-lg-square rounded-circle p-2"><i class="fa fa-envelope text-white" style="font-size:25px;"></i></div>
                                <div class="ms-4">
                                    <h4>Email</h4>
                                    <p class="mb-0"><?php echo $contact_row['email']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                       <?php
								echo form_open(base_url() . 'contact/submit_enquiry', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'myCatlog',
								'enctype' => 'multipart/form-data',
								'class' => 'cool-b4-form'
								));
								?>
                            <div class="row g-3">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Phone">
                                        <label for="phone">Your Phone</label>
                                    </div>
                                </div>                               
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" style="height: 160px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
								<div class="col-12">
									<button class="btn btn-primary w-100 py-3" type="button" id="submitBtn">Send Message</button>
								</div>
								<div class="col-12">
									<div id="show_msg"> </div>
								</div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded h-100">
                            <iframe class="rounded-top w-100" 
                            style="height: 500px; margin-bottom: -6px;" src="<?php echo $contact_row['office_address_map']; ?><?php echo $contact_row['office_address_map']; ?>" 
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <div class="d-flex align-items-center justify-content-center bg-primary rounded-bottom p-4">
                                <div class="d-flex">
								<?php foreach($social_media_data as $row_s){?>
					<a href="<?php echo $row_s['link']; ?>" class="btn btn-dark btn-lg-square rounded-circle me-2"><img src="<?php echo base_url(); ?>uploads/web_social_icon/<?php echo $row_s['icon'];?>" alt="Logo" style="height:30px; width:30px;"> 
                    </a>
                    	
							<?php } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
<?php } ?>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData($('#myCatlog')[0]);

            $.ajax({
                url: "<?php echo base_url(); ?>contact/submit_enquiry",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
					document.getElementById("myCatlog").reset();
                 $('#open_quick_catalog_button').modal('hide');
						$('#show_msg').show().html('<p style="color:#fff;background-color:green;padding:5px 15px;font-size:16px">Your enquire has been successfully submited</p>');
						$('#show_button').show();
						$('#show_button').removeAttr('style');
						$('.show_msg').css('z-index','999999');
                },
                error: function(xhr, status, error) {
                    $('#show_msg').show().html('<p style="color:#fff;background-color:#f00;padding:5px 15px;font-size:16px">OOPS! Something Wrong...</p>');
						$('.show_msg').css('z-index','999999');
						setTimeout(function () {
							$('#show_msg').hide().html('');
						}, 4000);
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit <i class="ml-3 fas fa-chevron-right"></i>');
                }
            });
        });
    });
</script>
