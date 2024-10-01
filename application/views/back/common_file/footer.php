  
   <!-- Footer Start -->
    <div class="meeta-footer-section" style="background-image: url(<?php echo base_url(); ?>uploads/images/shape/shape-6.png);">

        <!-- Footer Widget Start -->
        <div class="footer-widget text-center">
            <div class="container">

                <!-- Footer Logo Start -->
                <div class="footer-logo">
                    <a href="index.html"><img src="<?php echo base_url(); ?>uploads/images/logo-2.png" alt="Logo"></a>
                </div>
              
                <!-- Footer widget Social Start -->
                <div class="footer-widget-social">
				<?php foreach($social_media_data as $social_row){ ?>
										<li class="social-icons-facebook"><a href="<?php echo $social_row['link'];?>" target="_blank" title="<?php echo $social_row['name'];?>"><img src="<?php echo base_url(); ?>uploads/web_social_icon/<?php echo $social_row['icon'];?>" style="height:28px; width:28px;"></a></li>
										<?php } ?>
                   <!-- <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-dribbble"></i></a>
                    <a href="#"><i class="fab fa-behance"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>-->
                </div>
                <!-- Footer widget Social End -->

                <!-- Footer Copyright Start -->
                <div class="footer-copyright">
                    <p><?php date("Y"); ?> Copyright <?php if($system_name != ''){ echo @$system_name; }else{ echo 'REDDMICA'; }?> Designed by  . All Rights Reserved</p>
                </div>
                <!-- Footer Copyright End -->

            </div>
        </div>
        <!-- Footer Widget End -->

    </div>
	<a  class="whats-app" href="#" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>
    <!-- Footer End -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->



	
	<script type="text/javascript" src="<?=base_url('template/front/js/vendor/modernizr-3.11.7.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/vendor/jquery-1.12.4.min.js')?>"></script>
	
	<script type="text/javascript" src="<?=base_url('template/front/js/popper.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/bootstrap.min.js')?>"></script>
	
	<script type="text/javascript" src="<?=base_url('template/front/js/swiper-bundle.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/all.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/back-to-top.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/jquery.magnific-popup.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('template/front/js/jquery.counterup.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/waypoints.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/aos.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/jquery.nice-select.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/main.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('template/front/js/ajax_method.js')?>"></script>

</body>
</html>  
  
  