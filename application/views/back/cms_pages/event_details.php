<!-- Page Banner Start -->
        <div class="section page-banner-section">
            <div class="shape-2"></div>
            <div class="container">
                <div class="page-banner-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Banner Content Start -->
                            <div class="page-banner text-center">
                                <h2 class="title">Contact Us</h2>
                                <ul class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php if($event_type=="entrypass"){ ?>
								Entry Pass
							<?php }else { ?> Stall Book<?php } ?> </li>
                                </ul>
                            </div>
                            <!-- Page Banner Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Banner End -->

        <!-- Contact Form Start -->
        <div class="contact-form-section section-padding">
		

            <div class="container">
                <!-- Contact Wrap Start -->

                <div class="contact-wrap">
				
				<!-- Event List Content Start -->
                    <div class="event-list-content-wrap">
                        <div class="tab-content">
                           
                            <div class="tab-pane show active" id="list">
                                <!-- Event List Item Start -->
									
                                <div class="event-list-item event-list d-lg-flex align-items-center">
                                    <div class="event-img">
                                        <a href="<?php echo base_url(); ?>events/details/<?php echo $event_data[0]['event_id'];?>"><img src="<?php echo base_url(); ?>uploads/event_main_images/<?php echo $event_data[0]['main_event_image']; ?>" height="200" width="340" alt=""></a>
                                    </div>
                                    <div class="event-list-content">
                                        <div class="event-price">
                                            
                                            <span class="cat"><?php echo $event_data[0]['city_name'];?></span>
                                        </div>
                                        <h3 class="title"><a href="<?php echo base_url(); ?>events/details/<?php echo $event_data[0]['event_id'];?>"><?php echo $event_data[0]['event_name'];?> </a></h3>
                                        <div class="meta-data">
                                            <span><i class="fas fa-map-marker-alt"></i> <?php echo $event_data[0]['start_date'];?> <?php echo $event_data[0]['end_date'];?><?php echo $event_data[0]['event_time'];?> </span>
                                            <span><i class="fas fa-map-marker-alt"></i>   <?php echo $event_data[0]['address'];?> </span>
                                        </div>
                                    </div>
                                </div>
								<!-- Event List Item EEnd -->
                                
                              
                            </div>
                        </div>
                    </div>
				
				
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="form-title text-center">
                                <h2 class="title"> <?php if($event_type=="entrypass"){ ?>
								Entry Pass
							<?php }else { ?> Stall Book<?php } ?> </h2>
                            </div>
							<div id="show_msg"></div>
							<div id="show_button" style="display:none;"><a href="/images/myw3schoolsimage.jpg" download>
 <span class="btn btn-primary"> Download Pass </span></a></div>
                            <!-- Contact Form Wrap Start -->
                            <div class="contact-form-wrap">
								<?php
								echo form_open(base_url() . 'events/inquiry', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'myCatlog',
								'enctype' => 'multipart/form-data',
								'class' => 'cool-b4-form'
								));
								?>
                                    <div class="row">
									 <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" name="company_name" type="text" placeholder="Company Name" required>
												<input class="form-control required" name="event_type" type="hidden" value="<?php echo $event_type; ?>" placeholder="Company Name">
												
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" name="name" type="text" placeholder="Your Name" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" name="email"  type="email" placeholder="Your Email" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" name="phone" type="text" placeholder="Your Number" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control" name="subject"  type="text" placeholder="Subject" value="<?php echo $event_data[0]['event_name'];?> " readonly="readonly">
												<input type="hidden" name="event_id" value="<?php echo $event_data[0]['event_id'];?>">
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <textarea class="form-control" placeholder="Write A Message"></textarea>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        
										<div class="col-md-12 form-btn text-center">
						<span class="btn btn-primary" onclick="contact_ajax_form_submit('myCatlog','<?php echo translate('cricket_coupon_has_been_added!'); ?>');"><?php echo translate('submit');?> </span>
					</div>
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Contact Form Wrap End -->
                        </div>
                    </div>
                </div>
                <!-- Contact Wrap End -->
            </div>
        </div>
        <!-- Contact Form End -->


    </div>