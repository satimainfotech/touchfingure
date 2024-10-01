<?php foreach($who_we_are_data as $row){ ?>
	<section class="pt-5">
		<div class="container my-5">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
					<div class="redTitle ">
						<h1><?php echo $row['section_one_title']; ?></h1>
					</div>
				</div>
				<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 order-lg-1 order-2">					
					<div class="abtWrapper">
						<?php echo $row['section_one_content']; ?>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-lg-2 order-1">
					<div class="">
						<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['who_we_are_image']; ?>" class="img-fluid mt-80">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- whyreddmica -->
	<section class="whyBg ">		
		<!-- our unique technology -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="redTitle">
						<h1><?php echo $row['section_two_title']; ?></h1>
						<?php echo $row['section_two_content']; ?>
					</div>						
				</div>
			</div>
			<div class="row pt-5">
				<?php $i=0; foreach($our_technology as $row_ot){ ?>
				<?php if($i == '4'){ ?>
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
				<?php }else if($i == '5'){ ?>
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
				<?php }else if($i == '3'){ ?>
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
				<?php }else{ ?>
					<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12 ">
				<?php }?>
						<div class="iconWrapper">
							<img src="<?php echo base_url(); ?>uploads/our_technology_image/<?php echo $row_ot['our_technology_image']; ?>">
							<h6><?php echo $row_ot['our_technology_title']; ?></h6>
						</div>
					</div>
				<?php $i++; } ?>
				</div>
		</div>
	</section>

	<!-- aboutbanner -->
	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 px-0">
					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['section_three_image']; ?>" class="img-fluid abt-bnr">
				</div>
			</div>
		</div>
	</section>
	<!-- vision-mission section -->
	<section>
		<div class="container py-5 pt-5">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
					<div class="row">
						<div class="col-md-12">
							<div class="redTitle innrTitl">
								<?php echo $row['section_four_content']; ?>
							</div>						
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
					<img src="<?php echo base_url(); ?>uploads/other_images/<?php echo $row['section_four_image']; ?>" class="img-fluid">
				</div>
			</div>
		</div>
	</section>
<?php } ?>