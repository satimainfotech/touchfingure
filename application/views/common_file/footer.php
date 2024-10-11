  <!-- Footer Start -->
  <?php $footer_setting = $this->db->get_where('footer_setting',array('footer_id' => '1'))->result_array(); 
		foreach($footer_setting as $f_row){
		?>
        <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <div class="footer-item">
                                <h4 class="text-white mb-4"><?php echo $f_row['description_title']; ?></h4>
                                <p class="mb-3"><?php echo $f_row['content']; ?></p>
								 <div class="position-relative mx-auto rounded-pill">
								 <?php
								echo form_open(base_url() . 'contact/subscribe', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'myCatlog',
								'enctype' => 'multipart/form-data',
								'class' => 'cool-b4-form'
								));
								?>
                                    <input class="form-control rounded-pill w-100 py-3 ps-4 pe-5" type="email" name="email" placeholder="Enter your email">
                                    <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2" id="submitBtn">Subscribe</button>
                             
								</form>
								</div>
								   <div id="show_msg"></div>
								 						   
                                
                            </div>
                        </div>
                    </div>
					
					
					
					
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-white mb-4"><?php echo $f_row['menu_title']; ?></h4>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>">Home </a></li>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>aboutus">About Us</a></li>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>services">Services </a></li>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>faqs">FAQs </a></li>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>community">Community </a></li>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>news">News </a></li>
							<a class="nav-item nav-link" href="<?php echo base_url(); ?>contact">Contact </a></li>
                       
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="text-white mb-4"><?php echo $f_row['address_title']; ?></h4>
                            <a href=""><i class="fa fa-map-marker me-2"></i> <?php echo $f_row['address']; ?></a>
                            <a href=""><i class="fas fa-envelope me-2"></i> <?php echo $f_row['email']; ?></a>
                            <a href=""><i class="fas fa-phone me-2"></i> <?php echo $f_row['contact_one']; ?></a>
                            <a href="" class="mb-3"><i class="fas fa-phone me-2"></i> <?php echo $f_row['contact_two']; ?></a>
                            <div class="d-flex align-items-center">
							<?php $get_social =  $this->db->get_where('web_social_media',array('status' => 'Active'))->result_array(); ?>
							<?php foreach($get_social as $row_s){?>	
<a href="<?php echo $row_s['link']; ?>" class="btn btn-light btn-md-square me-2"><img src="<?php echo base_url(); ?>uploads/web_social_icon/<?php echo $row_s['icon'];?>" alt="Logo" style="height:30px; width:30px;"> 
                    </a>							
								<!--<a class="btn btn-light btn-md-square me-2" href="<?php echo $row_s['link']; ?>"><i class="fab fa-<?php echo $row_s['name']; ?>"></i></a>-->
							<?php } ?>
                                
                            </div>
                        </div>
                    </div>
                   
				   
				    <div class="col-md-4 col-lg-4 col-xl-3">
                        <div class="footer-item d-flex flex-column">
						<h4 class="text-white mb-4">Vistiter Counter</h4>
						<div id="sfcwd3rkal96fq5hjckcdjpsk6k5a8m2rpm"></div><script type="text/javascript" src="https://counter6.optistats.ovh/private/counter.js?c=wd3rkal96fq5hjckcdjpsk6k5a8m2rpm&down=async" async></script><noscript></noscript>
						</div>
						</div>
						
                </div>
            </div>
        </div>
		
		
        <!-- Footer End -->

        		<?php $system_name = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;	?>
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                        <span class="text-body"><a href="#" class="border-bottom text-primary"> <?php date("Y"); ?><i class="fas fa-copyright text-light me-2"></i><?php if($system_name != ''){ echo @$system_name; }else{ echo 'ABDAILYNEWS'; }?></a>, All right reserved.Managed BY TOUCHFINGER SERVICES LLP </span>
                    </div>
                    <div class="col-md-6 text-center text-md-end text-body">
				
                        Designed By <a class="border-bottom text-primary" href="">SATIMA INFOTECH</a> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square back-to-top"><i class="fa fa-arrow-up"></i></a>   
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
	
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/lib/wow/wow.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/lib/easing/easing.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/lib/waypoints/waypoints.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/lib/counterup/counterup.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/lib/owlcarousel/owl.carousel.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/lib/lightbox/js/lightbox.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/abdaily/js/main.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('template/front/js/ajax_method.js')?>"></script>
       </body>

</html>

<?php 
$wt_message = urlencode($f_row['whatsapp_message']); 
$contact = htmlspecialchars($f_row['contact_two'], ENT_QUOTES, 'UTF-8');
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=<?php echo $contact; ?>&text=<?php echo $wt_message; ?>" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
<style>
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	left:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}

</style>

<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault(); // Prevent the default form submission

            var formData = new FormData($('#myCatlog')[0]);

            $.ajax({
                url: "<?php echo base_url(); ?>contact/subscribe",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
					document.getElementById("myCatlog").reset();
                 $('#open_quick_catalog_button').modal('hide');
						$('#show_msg').show().html('<p style="color:#fff;background-color:#f4652b;margin-top:15px;padding:5px 15px;font-size:16px">Your Email Subscribed successfully</p>');
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
		
		setTimeout(function() {
    var anchor = $('#sfcwd3rkal96fq5hjckcdjpsk6k5a8m2rpm a');
    if (anchor.length) {
        anchor.removeAttr('href');
        console.log('Href removed:', anchor.attr('href'));
    } else {
        console.log('Anchor not found');
    }
}, 1000); // Delay of 1 second
		 
        
    });
</script>



</body>
</html>