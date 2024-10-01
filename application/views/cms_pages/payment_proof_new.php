<?php $slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'register'))->row()->second_slider_image;
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
                <div class="row ">
                   
				   <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                    <div class="col-lg-12 wow fadeInRight" data-wow-delay="0.3s" style="text-algin:center;">
                        	<?php
							echo form_open(base_url() . 'register/payment_proof_uploaded/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'register_add',
								'enctype' => 'multipart/form-data'
							));
						?>
						
                             <input type="hidden" name="user_id" id="base_url" value="<?php echo $user_id; ?>">
							<div class="row g-3">
                            <?php if($this->session->flashdata('message')): ?>
							<div class="alert alert-success">
							<?php echo $this->session->flashdata('message'); ?>
							</div>
							<?php endif; ?>
							
								<div class="row ">
								 <div class="col-lg-4 col-xl-4">
                                    <div class="form-floating">
                                       <input style="cursor: pointer;" type="file" name="payment_proof_image" accept="image" id="payment_proof_image" class="form-control" required>
                                        <label for="confirm_password">payment Proof Image</label>
                                    </div>
                                </div>
								</div>
								
								<div class="row ">
								<div class="col-lg-4 col-xl-4">
                                    <div class="form-floating">
									<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="payment_proof_main_images_wrap">
									<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="payment_proof_main_images_blah" />
									</span>
                                    </div>
                                </div>
								</div>
								
                                <div class="col-3">
                                    <button class="btn btn-primary w-100 py-3" onclick="ajax_form_submit('register_add','<?php echo translate('user_has_been_added!'); ?>','register');">Submit</button>
                                </div>
                                 <div class="col-3">
                                    <button class="btn btn-primary w-100 py-3" onclick="form_reset(); ">Reset</button>
                                </div>
                                <div id="msg_popup"></div>
                            </div>
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
		  
		  $("#payment_proof_image").change(function() {
			payment_proof_main_images(this);
		});
	
		function payment_proof_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#payment_proof_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	
	
	

</script>


 
