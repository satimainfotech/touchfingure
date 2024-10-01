<?php foreach($home_page_data as $home_row){ 
$slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'community'))->row()->second_slider_image;
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
 <!-- Team Start -->
        <<div class="container-fluid team py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <form action="<?php echo base_url(); ?>community" class="form-horizontal" method="post">
                <div class="row g-3"> <!-- g-3 to control gutter (spacing between columns) -->
                    <!-- Name Input -->
					<div class="col-lg-2 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <div class="form-floating">
                            <input type="text" class="form-control" id="area" name="area" placeholder="Area">
                            <label for="name">Find Area</label>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            <label for="name">Name</label>
                        </div>
                    </div>

                    <!-- Mobile Input -->
                    <div class="col-lg-2 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <div class="form-floating">
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
                            <label for="mobile">Mobile</label>
                        </div>
                    </div>

                    <!-- Member Type Select -->
                    <div class="col-lg-2 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <div class="form-floating">
                            <select id="member_type_id" name="member_type_id" class="form-control demo-chosen-select required">
                                <option value="">Select a member type</option>
                                <?php foreach ($member_type_data as $member_type_row) { ?>
                                    <option value="<?php echo $member_type_row['member_type_id']; ?>">
                                        <?php echo $member_type_row['member_type_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                           
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-lg-2 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                    </div>

                    <!-- Reset Button -->
                    <div class="col-lg-2 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <button class="btn btn-primary w-100 py-3" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    
               
                <div class="row g-4 justify-content-center">
				<?php if(!empty($user)){
								foreach($user as $user_row){ ?> 
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded">
                            <div class="team-img member-img">
							<?php if($user_row['profile_image'] != ''){
								
	$profile_image  = explode(".",$user_row['profile_image']);


    $image_path_jpeg =   FCPATH . 'uploads/abdaily_profile_images/' . $profile_image[0] . '.jpeg';
	$image_path_jpg = FCPATH . 'uploads/abdaily_profile_images/' . $profile_image[0] . '.jpg'; 
	$image_path_extra = FCPATH . 'uploads/abdaily_profile_images/' . $profile_image[0] . '.JPEG'; 

    // Check if the .jpeg file exists
    if (file_exists($image_path_jpeg)) {
        
      $image_url = base_url('uploads/abdaily_profile_images/' . $profile_image[0] .'.jpeg');
    }
    // Check if the .jpg file exists
    elseif (file_exists($image_path_jpg)) {
       $image_url = base_url('uploads/abdaily_profile_images/' . $profile_image[0]. '.jpg');
    }
	 elseif (file_exists($image_path_extra)) {
        $image_url = base_url('uploads/abdaily_profile_images/' . $profile_image[0]. '.JPEG');
    }
    // If neither file exists, you can set a default image or handle the error
    else {
        $image_url =  base_url('uploads/abdaily_profile_images/'.$user_row['profile_image']);
  } ?>
                                <img src="<?php echo $image_url; ?>" class="img-fluid w-100 rounded-top" alt="<?php echo $user_row['name']; ?>">
							<?php }else{?>
							 <img src="<?php echo base_url(); ?>uploads/abdaily_profile_images/default.png" class="img-fluid w-100 rounded-top" alt="<?php echo ucfirst($user_row['name']); ?>">
							<?php } ?>  
                            </div>
                            <div class="team-content bg-dark text-center rounded-bottom p-4">
                                <div class="team-content-inner rounded-bottom">
                                    <h4 class="text-white" ><?php echo $user_row['name']; ?></h4>
                                    <p class="text-muted mb-0"><?php echo ucfirst($user_row['member_type_name']); ?> Reporter</p>
									
                                </div>
                            </div>
                        </div>
                    </div>
				<?php }
				}else{ ?>
											<div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 wow fadeInUp" data-wow-delay="0.1s">
												Data Not Found....
				</div>	<?php }  ?>
                </div>
            </div>
        </div>
        <!-- Team End -->

 
 <?php } ?>
 
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
 
 
 