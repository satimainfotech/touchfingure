
        <!-- Page Banner Start -->
        <div class="section page-banner-section">
            <div class="shape-2"></div>
            <div class="container">
                <div class="page-banner-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Page Banner Content Start -->
                            <div class="page-banner text-center">
                                <h2 class="title">Event List</h2>
                                <ul class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Event List</li>
                                </ul>
                            </div>
                            <!-- Page Banner Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Banner End -->

        <!-- Event List Start -->
        <div class="meeta-event-list section-padding">
            <div class="container">
                <div class="meeta-event-list-wrap">
                    <!-- Event List Top Bar Start -->
                    <div class="event-list-top-bar">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="event-list-search">
                                   <?php
								echo form_open(base_url() . 'events/index', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'myCatlog',
								'enctype' => 'multipart/form-data',
								'class' => 'cool-b4-form'
								));
								?>
                                        <div class="row g-0">
                                            <div class="col-md-5">
                                                <div class="single-form">
                                                    <i class="fas fa-search"></i>
                                                    <input type="text" name="event" value="<?php if(isset($event)){ echo $event;} ?>" placeholder="Search Event">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="single-form form-border">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <input type="text" name="location" value="<?php if(isset($city)){ echo $city;} ?>" placeholder="Location">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-btn">
                                                    <button class="btn btn-primary">Find Event</button> 
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                    </div>
                    <!-- Event List Top Bar End -->
                    <!-- Event List Bottom Bar Start
                    <div class="event-list-bottom-bar">
                        <div class="event-list-btn">
                            <a class="event-btn" href="#"><i class="flaticon-back"></i></a>
                            <a class="event-btn" href="#"><i class="flaticon-next"></i></a>
                        </div>
                    </div>
                    <!-- Event List Bottom Bar End -->
                    <!-- Event List Content Start -->
                    <div class="event-list-content-wrap">
                        <div class="tab-content">
                           
                            <div class="tab-pane show active" id="list">
                                <!-- Event List Item Start -->
									<?php $i = 1; foreach($event_data as $event_row){ ?>			
                                <div class="event-list-item event-list d-lg-flex align-items-center">
                                    <div class="event-img">
                                        <a href="<?php echo base_url(); ?>events/details/<?php echo $event_row['event_id'];?>"><img src="<?php echo base_url(); ?>uploads/event_main_images/<?php echo $event_row['main_event_image']; ?>" height="200" width="340" alt=""></a>
                                    </div>
                                    <div class="event-list-content">
                                        <div class="event-price">
                                        
                                            <span class="cat"><?php echo $event_row['city_name'];?></span>
                                        </div>
                                        <h3 class="title"><a href="<?php echo base_url(); ?>events/details/<?php echo $event_row['event_id'];?>"><?php echo $event_row['event_name'];?> </a></h3>
                                        <div class="meta-data">
                                            <span><i class="fas fa-map-marker-alt"></i> <?php echo $event_row['start_date'];?> <?php echo $event_row['end_date'];?><?php echo $event_row['event_time'];?> </span>
                                            <span><i class="fas fa-map-marker-alt"></i>   <?php echo $event_row['address'];?> </span>
                                        </div>
                                        <div class="event-desc">
                                            <p><?php echo $event_row['description'];?></p>
                                        </div>
										
										<div class="event-price">
                                            <span class="cat"><a  href="<?php echo base_url(); ?>events/details/<?php echo $event_row['event_id'];?>/entrypass">Entry Pass</a> </span>
                                            <span class="cat"><a href="<?php echo base_url(); ?>events/details/<?php echo $event_row['event_id'];?>/stall">Book Stall</a></span>
                                        </div>
                                       </div>
                                    <span class="event-time"><span><?php echo $i; ?></span></span>
                                </div>
								<?php $i++;} ?>
                                <!-- Event List Item EEnd -->
                                
                              
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
        <!-- Event List End -->
    </div>

