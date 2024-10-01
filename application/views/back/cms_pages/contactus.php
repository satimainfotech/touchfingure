
<?php foreach($contactus_data as $contact_row){ 

?>
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
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="form-title text-center">
                                <h2 class="title">Sent Us A Message</h2>
                            </div>
                            <!-- Contact Form Wrap Start -->
                            <div class="contact-form-wrap">
                               <?php
								echo form_open(base_url() . 'contact/submit_enquiry', array(
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
                                                <input class="form-control required" name="name" type="text" placeholder="Your Name" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" name="email" type="email" placeholder="Your Email" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" type="text" name="phone" placeholder="Your Number" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <input class="form-control required" type="text" name="subject" placeholder="Subject" required>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-12">
                                            <!-- Single Form Start -->
                                            <div class="single-form">
                                                <textarea class="form-control required" name="message" placeholder="Write A Message"></textarea>
                                            </div>
                                            <!-- Single Form End -->
                                        </div>
                                        <div class="col-md-12">
                                            <!--  Single Form Start -->
											<div class="col-md-12 form-btn text-center">
											<span class="btn btn-primary" onclick="contact_ajax_form_submit('myCatlog','<?php echo translate('inquiry_coupon_has_been_added!'); ?>');"><?php echo translate('submit');?> </span>
											</div>
                                            <!--  Single Form End -->
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

        <!-- Contact Info Start -->
        <div class="section contact-info-section">
            <div class="container">
                <!-- Contact Info Wrap Start -->
                <div class="contact-info-wrap">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <!--Single Contact Info Start -->
                            <div class="single-contact-info text-center">
                                <div class="info-icon color-2">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="info-content">
                                    <h5 class="title">Telephone</h5>
                                    <p><?php echo $contact_row['contact_one']; ?></p>
                                </div>
                            </div>
                            <!--Single Contact Info End -->
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <!--Single Contact Info Start -->
                            <div class="single-contact-info text-center">
                                <div class="info-icon color-1">
                                    <i class="flaticon-email"></i>
                                </div>
                                <div class="info-content">
                                    <h5 class="title">Drop Your Mail</h5>
                                    <p><?php echo $contact_row['email']; ?></p>
                                </div>
                            </div>
                            <!--Single Contact Info End -->
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <!--Single Contact Info Start -->
                            <div class="single-contact-info text-center">
                                <div class="info-icon color-3">
                                    <i class="flaticon-pin"></i>
                                </div>
                                <div class="info-content">
                                    <h5 class="title">Location</h5>
                                    <p><?php echo $contact_row['office_address']; ?></p>
                                </div>
                            </div>
                            <!--Single Contact Info End -->
                        </div>
                    </div>
                </div>
                <!-- Contact Info Wrap End -->
            </div>
        </div>
        <!-- Contact Info End -->

        <!-- Contact Map Start -->
        <div class="section contact-map-section">
            <div class="contact-map-wrap">
               <div class="mapouter"><div class="gmap_canvas"><iframe width="1663" height="430" id="gmap_canvas" src="<?php echo $contact_row['office_address_map']; ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
            </div>
        </div>
        <!-- Contact Map End -->

    </div>
	
<?php } ?>