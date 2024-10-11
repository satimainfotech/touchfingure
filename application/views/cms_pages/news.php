<?php foreach($home_page_data as $home_row){ 
$slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'news'))->row()->second_slider_image;
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
           <!-- Blog Start -->
        <div class="container-fluid blog py-5">
            <div class="container py-5">
			<div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <form action="<?php echo base_url(); ?>news" class="form-horizontal" method="post">
                <div class="row g-3"> <!-- g-3 to control gutter (spacing between columns) -->
                    <!-- Name Input -->
					<div class="col-lg-4 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <div class="form-floating">
                            <input type="date" class="form-control" id="dates" name="dates" placeholder="Date">
                            <label for="name">Find Date</label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-lg-4 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                    </div>

                    <!-- Reset Button -->
                    <div class="col-lg-4 col-md-6 mb-3"> <!-- Add margin-bottom for mobile view -->
                        <button class="btn btn-primary w-100 py-3" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    
                
                <div class="row g-4 justify-content-center">
				<?php foreach($news_master as $news_row){ ?>
				
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="blog-item bg-light rounded p-4" style="background-image: url(img/bg.png);">
                            <div class="mb-4">
                                <h4 class="text-primary mb-2"><?php echo $news_row['news_name']; ?></h4>
                                
                            </div>
                            <div class="project-img">
                                <img src="<?php echo base_url(); ?>uploads/abdaily_news_image/<?php echo $news_row['news_image']; ?>" class="img-fluid w-100 rounded" alt="Image">
                               
                            </div>
							 <div class="my-4">
                            </div>
							<a class="btn btn-primary rounded-pill py-2 px-4" href="<?php echo base_url(); ?>jq-3d-flip-book/index.php?name=<?php echo $news_row['news_inner_image']; ?>">Read More</a>
							<a class="btn btn-primary rounded-pill py-2 px-4" href="<?php echo base_url(); ?>uploads/abdaily_news_inner_image/<?php echo $news_row['news_inner_image']; ?>" download><?php if (!empty($news_row['news_inner_image'])): ?>

							<span>Download</span>   
							</a>
							<?php else: ?>
							<span>No PDF available</span>
							<?php endif; ?></a>
                        </div>
                    </div>
					
				<?php } ?>
                </div>
            </div>
        </div>
        <!-- Blog End -->

 
 <?php } ?>
 
 
 
 