

      <!-- Page Banner Start -->
        <div class="section page-banner-section">
            <div class="shape-2"></div>
            <div class="container">
                <div class="page-banner-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Banner Content Start -->
                            <div class="page-banner text-center">
                                <h2 class="title">Gallery</h2>
                                <ul class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                                </ul>
                            </div>
                            <!-- Page Banner Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Banner End -->

        <!-- Gallery Start -->
        <div class="meeta-gallery meeta-gallery-2 section-padding">
            <div class="container">


                <div class="row g-0">
                      <?php foreach($sub_category_data as $sub_category_row){ ?>
                    <div class="col-lg-4 col-sm-6">

                        <!-- Single Gallery Start -->
                        <div class="single-gallery">
                            <div class="gallery-image">
                                <img src="<?php echo base_url(); ?>uploads/sub_category_image/<?php echo $sub_category_row['sub_category_image']; ?>" alt="<?php echo $sub_category_row['sub_category_name'];?>">
                            </div>
                            <div class="gallery-content">
                                <div class="gallery-content-wrap">
                                    <a href="<?php echo base_url(); ?>uploads/sub_category_image/<?php echo $sub_category_row['sub_category_image']; ?>" class="gallery-plus image-popup">
                                        <span></span>
                                    </a>
                                    <h4 class="gallery-title"><a href="#"><?php echo $sub_category_row['sub_category_name'];?></a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- Single Gallery End -->

                    </div>
				<?php } ?> </div>

            </div>
        </div>
        <!-- Gallery End -->

    </div>
