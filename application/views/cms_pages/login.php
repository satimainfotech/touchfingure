<?php $slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'login'))->row()->second_slider_image;
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
                   
                    <div class="col-lg-12 wow fadeInRight" data-wow-delay="0.3s">
                        <?php
						echo form_open(base_url().'login/check_login/', array(
							'method' => 'post',
							'id' => 'login'
						));
					?>
                            <div class="row g-3">
                                
							<?php if($this->session->flashdata('message')): ?>
							<div class="alert alert-danger">
							<?php echo $this->session->flashdata('message'); ?>
							</div>
							<?php endif; ?>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                                        <label for="email">Mobile</label>
                                    </div>
                                </div>
                               
								 <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="	">
                                        <label for="Password">Password</label>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
        <!-- Contact End -->
		
		


 
