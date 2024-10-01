   

        <section class="about-1">
            <div class="container">
			<?php $ic = 2; $i=0; foreach($all_our_range as $row): $i++; $oddEven = ($i % 2) ? 'odd':'even';?>
			<?php if($oddEven == 'odd'){ ?>
                <div class="animate__animated animate__fadeInLeft row hideonmobile" style="margin:10px 0 30px 0;">                        
                    <div class="col-md-2">
                        <hr style="border:none; width:100%; height:1px; background:#cfcfcf;" />
                    </div>
                    <div class="col-md-2">
                        <div class="ot-counter">
                            <span>0<?php echo $i;?></span>                                
                        </div>
                    </div>
                    <div class="col-md-8">
                        <hr style="border:none; width:100%; height:1px; background:#cfcfcf;" />
                    </div>
                </div>
                <div class="animate__animated animate__fadeInLeft animate__delay-1s row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="category_slider owl-theme owl-carousel">
                            <div class="carousel-items">
                                <div class="icon-box icon-box--bg-img icon-box--icon-top icon-box--is-line-hover text-center">
                                    <div class="icon-main">
                                        <img src="img/products/our-range-nexa-01.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-items">
                                <div class="icon-box icon-box--bg-img icon-box--icon-top icon-box--is-line-hover text-center">
                                    <div class="icon-main">
                                        <img src="img/products/our-range-nexa-01.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 align-self-center">
                        <div class="about-content-1 ml-xl-70">
                            <div class="ot-heading">
                                <img src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['brand_image']; ?>" />
                            </div>
                            <br />
                            <p><?php echo $row['our_range_content']; ?></p>
                            <div class="ot-button">
                                <img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_1']; ?>" style="padding:0 10px 0 0;" /> 
                                <span style="border-left: 1px solid black; padding:0 10px 0 10px;"></span> <img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_2']; ?>" /> 
                                <span style="border-left: 1px solid black; padding:0 10px 0 10px;""></span> <img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_3']; ?>" style="width: 50px;" />
                            </div>
                            <br />
                            <a href="<?php echo base_url(); ?>our_range/product/<?php echo $row['our_range_id']; ?>/<?php echo $row['our_range_slug']; ?>" class="octf-btn octf-btn-primary btn-slider btn-large">View All Products</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" class="octf-btn octf-btn-light border-hover-light"  data-toggle="modal" onclick="open_quick_catalog_button();" style="border:1px solid #ff0000;">e-Catalogue</a>
                        </div>
                    </div>
                </div>
			<?php } if($oddEven == 'even'){ ?>
                <div class="animate__animated animate__fadeInLeft row hideonmobile" style="margin:10px 0 30px 0;">                        
                    <div class="col-md-8">
                        <hr style="border:none; width:100%; height:1px; background:#cfcfcf;" />
                    </div>
                    <div class="col-md-2">
                        <div class="ot-counter">
                            <span>0<?php echo $i;?></span>                                
                        </div>
                    </div>
                    <div class="col-md-2">
                        <hr style="border:none; width:100%; height:1px; background:#cfcfcf;" />
                    </div>
                </div>
                <div class="animate__animated animate__fadeInLeft animate__delay-1s row column-reverse">                        
                    <div class="col-lg-8 col-md-12 align-self-center">
                        <div class="about-content-1 ml-xl-70">
                            <div class="ot-heading">
                                <img src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['brand_image']; ?>" />
                            </div>
                            <br />
                            <p><?php echo $row['our_range_content']; ?></p>
                            <div class="ot-button">
                                <img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_1']; ?>" style="padding:0 10px 0 0;" /> 
                                <span style="border-left: 1px solid black; padding:0 10px 0 10px;"></span> <img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_2']; ?>" /> 
                                <span style="border-left: 1px solid black; padding:0 10px 0 10px;""></span> <img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_3']; ?>" style="width: 50px;" />
                            </div>
                            <br />
                            <a href="<?php echo base_url(); ?>our_range/product/<?php echo $row['our_range_id']; ?>/<?php echo $row['our_range_slug']; ?>" class="octf-btn octf-btn-primary btn-slider btn-large">View All Products</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="#" class="octf-btn octf-btn-light border-hover-light"  data-toggle="modal" onclick="open_quick_catalog_button();" style="border:1px solid #ff0000;">e-Catalogue</a>
							
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="category_slider owl-theme owl-carousel">
                            <div class="carousel-items">
                                <div class="icon-box icon-box--bg-img icon-box--icon-top icon-box--is-line-hover text-center">
                                    <div class="icon-main">
                                        <img src="img/products/our-range-hifive-02.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-items">
                                <div class="icon-box icon-box--bg-img icon-box--icon-top icon-box--is-line-hover text-center">
                                    <div class="icon-main">
                                        <img src="img/products/our-range-hifive-02.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			<?php }   endforeach; ?>
            </div>
        </section>



<?php /* ?><section class="portfoiliobg ourbg" style="background: url(../images/ourrangebg.png); background-size: 100% 100%;background-repeat:no-repeat;">
	<div class="container brandSlider my-5">
	<?php $ic = 2; $i=0; foreach($all_our_range as $row): $i++; $oddEven = ($i % 2) ? 'odd':'even';?>
		<div class="row <?php echo $oddEven; ?>">
			<?php if($oddEven == 'odd'){ ?>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
					<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_main_image']; ?>" class="img-fluid brandslideimg">
				</div>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 align-self-center">
					<div class="brandContent">
						<img src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['brand_image']; ?>" class="brandImg">
						<?php echo $row['our_range_content']; ?>
						<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_1']; ?>" class="pl-0"><span
							style="border-left: 1px solid black;"></span>
						<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_2']; ?>"><span style="border-left: 1px solid black;"></span>
						<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_3']; ?>" style="width: 60px;">
						<div class="mt-3">
							<a href="<?php echo base_url(); ?>our_range/product/<?php echo $row['our_range_id']; ?>/<?php echo $row['our_range_slug']; ?>" class="btn btnRed">View All Product</a>
							<a href="" class="btn btnRedOutline" data-toggle="modal" onclick="open_quick_catalog_button();">E-CATALOGUE</a>
						</div>
					</div>
				</div>
			<?php }else{ ?>
				<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 align-self-center order-md-1 order-2">
					<div class="brandContent">
						<img src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['brand_image']; ?>" class="brandImg">
						<?php echo $row['our_range_content']; ?>
						<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_1']; ?>" class="pl-0"><span
							style="border-left: 1px solid black;"></span>
						<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_2']; ?>"><span style="border-left: 1px solid black;"></span>
						<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_image_3']; ?>" style="width: 60px;">
						<div class="mt-3">
							<a href="<?php echo base_url(); ?>our_range/product/<?php echo $row['our_range_id']; ?>/<?php echo $row['our_range_slug']; ?>" class="btn btnRed">View All Product</a>
							<a href="" class="btn btnRedOutline" data-toggle="modal" onclick="open_quick_catalog_button();">E-CATALOGUE</a>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 order-md-2 order-1">
					<img src="<?php echo base_url();?>uploads/our_range_image/<?php echo $row['our_range_main_image']; ?>" class="img-fluid brandslideimg">
				</div>
			<?php } ?>
		</div>
		<hr>
		<?php endforeach; ?>
	</div>			
</section><?php */ ?>
<div class="modal" id="open_quick_catalog_button">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			<div class="modal-body">
				<?php
					echo form_open(base_url() . 'homepage/submit_contact_enquiry/', array(
						'class' => 'form-horizontal',
						'method' => 'post',
						'id' => 'myCatlog',
						'enctype' => 'multipart/form-data',
						'class' => 'cool-b4-form'
					));
				?>
					<h2 class="text-center pt-4">Contact Us</h2>
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control required" name="name" id="name" msggess="Enter your full Name">
								<label for="name">Enter your full Name</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control required" name="name" id="city" msggess="Enter your city">
								<label for="city">Enter your city</label>
							</div>
						</div>
						<div class="col-md-12">

							<div class="form-group">
								<input type="phone" class="form-control required" name="phone" id="phone" msggess="Enter your phone Number">
								<label for="phone">enter your phone Number</label>
							</div>
							<div class="form-group">
								<input type="email" class="form-control required" name="email" id="email" msggess="Enter your Email">
								<label for="email">enter your Email</label>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<textarea name="message" id="message" class="form-control"></textarea>
								<label for="message">Enter your Message</label>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-right mt-3">
						<span class="btn modalBtn enterer" onclick="contact_ajax_form_submit('myCatlog','<?php echo translate('cricket_coupon_has_been_added!'); ?>');"><?php echo translate('submit');?> <i class="ml-3 fas fa-chevron-right"></i></span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function open_quick_catalog_button(){
		$('#myCatlog')[0].reset();
		$('#open_quick_catalog_button').modal({ backdrop: 'static'});
	}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url('template/front/js/jquery.elevatezoom.js')?>"></script> 