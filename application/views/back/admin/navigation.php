<nav id="mainnav-container">
    <div id="mainnav">
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content" style="overflow-x:auto;">
                    <ul id="mainnav-menu" class="list-group">
						<?php if($this->crud_model->admin_permission('dashboard')){ ?>
                        <li <?php if($page_name_link=="dashboard"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('dashboard');
									
									
									?>
									
                                </span>
                            </a>
                        </li>
						<?php if($this->crud_model->admin_permission('master_management')){ ?>
                        <li <?php if( $page_name_link=="member_type" || $page_name_link=="gram_panchayat" ||  $page_name_link=="area" || $page_name_link=="gram_panachayat" || $page_name_link=="taluka_m" || $page_name_link=="taluka" || $page_name_link=="division" || $page_name_link=="district_m" || $page_name_link=="country" || $page_name_link=="state" || $page_name_link=="city"  || $page_name_link=="district" || $page_name_link=="area"){?> class="active-sub" 
                        <?php } ?>>
                            <a href="#">
                                <i class="fa fa-file-text"></i>
								<span class="menu-title">
									<?php echo translate('master_management');?>
								</span>
								<i class="fa arrow"></i>
                            </a>
                            <ul class="collapse <?php if( $page_name_link=="member_type" ||  $page_name_link=="process_master" || $page_name_link=="area"){?>in<?php } ?> ">
								<?php if($this->crud_model->admin_permission('country')){ ?>
									<li <?php if($page_name_link=="country"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/master_manage/country/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('Materials');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('member_type')){ ?>
									<li <?php if($page_name_link=="member_type"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/master_manage/member_type/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('Models');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('process_master')){ ?>
									<li <?php if($page_name_link=="process_master"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/master_manage/process_master/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('process_master');?>
										</a>
									</li>
								<?php } ?>
                            </ul>
                        </li>
                        <?php
							}
						?>
						
						<?php
							}
						?>
						
						
                        
                        
                     
            			<?php 
                        	if($this->crud_model->admin_permission('front_setting')){
						?>
                        <li <?php if($page_name_link=="display_settings"|| $page_name_link=="site_settings" || $page_name_link=="application_setting" || $page_name_link=="third_party") {?> class="active-sub" <?php } ?> >
                            <a href="#">
                                <i class="fa fa-desktop"></i>
								<span class="menu-title">
									<?php echo translate('frontend_settings');?>
								</span>
								<i class="fa arrow"></i>
                            </a>
                            <ul class="collapse <?php if($page_name_link=="display_settings"|| $page_name_link=="site_settings" || $page_name_link=="application_setting" || $page_name_link=="third_party"){?>in<?php } ?>" >
                                
								<?php
                                    $tab = $this->uri->segment(3);
									if($this->crud_model->admin_permission('display_setting')){
                                ?>                      
									<li <?php if($page_name_link=="display_settings"){?>class="active-sub"<?php } ?> >
										<a href="#">
											<i class="fa fa-television"></i>
											<span class="menu-title">
												<?php echo translate('display_settings');?>
											</span>
											<i class="fa arrow"></i>
										</a>
										
										<ul class="collapse <?php if($page_name_link=="display_settings"){?>in <?php } ?> " >
											<?php if($this->crud_model->admin_permission('logo')){ ?>
												<li <?php if($tab == 'logo'){ ?>class="active-link"<?php } ?> >
													<a href="<?php echo base_url(); ?>admin/display_settings/logo">
														<i class="fa fa-circle fs_i"></i>
														<?php echo translate('logo');?>
													</a>
												</li>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('favicon')){ ?>
												<li <?php if($tab == 'favicon'){ ?>class="active-link"<?php } ?> >
													<a href="<?php echo base_url(); ?>admin/display_settings/favicon">
														<i class="fa fa-circle fs_i"></i>
														<?php echo translate('favicon');?>
													</a>
												</li>
											<?php } ?>
										</ul>
									</li>
                                <?php } ?>
								<?php
                                    if($this->crud_model->admin_permission('setting')){
                                ?>
                                <li <?php if($page_name_link=="site_settings"){?> class="active-sub"<?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-wrench"></i>
										<span class="menu-title">
											<?php echo translate('settings');?>
										</span>
										<i class="fa arrow"></i>
                                    </a>
                                    <ul class="collapse <?php if($page_name_link=="site_settings"){?>in<?php } ?>" >
                                        <?php
                                            if($this->crud_model->admin_permission('site_setting')){
                                        ?>                      
                                            <li <?php if($page_name_link=="site_settings"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url();?>admin/site_settings/">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('site_settings');?>
                                                </a>
                                            </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <?php
                                    }
                                ?>
                           	</ul>
                        </li>
						<?php
							}
                            ?>
							
							<?php
							
                        	if($this->crud_model->admin_permission('staff')){
						?>
                        <li <?php if($page_name_link=="role" || $page_name_link=="staff" ){?>class="active-sub"<?php } ?> >
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span class="menu-title">
                                	<?php echo translate('staffs');?>
                                </span>
                                <i class="fa arrow"></i>
                            </a>
            
                            <ul class="collapse <?php if($page_name_link=="staff" ||$page_name_link=="role"){?>in<?php } ?>" >
                                <?php
                                    if($this->crud_model->admin_permission('staff_list')){
                                ?>
                                <li <?php if($page_name_link=="staff"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/staff/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('all_staffs');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($this->crud_model->admin_permission('staff_role')){
                                ?>
                                <li <?php if($page_name_link=="role"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>admin/staff/role/">
                                        <i class="fa fa-circle fs_i"></i>
                                        <?php echo translate('staff_permissions');?>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
						<?php
                            }
                        ?>

						
						
						<li>
							<a href="<?php echo base_url(); ?>admin/login/logout/">
								<i class="fa fa-sign-out"></i>
								<span class="menu-title">
									<?php echo translate('logout');?>
								</span>
							</a>
						</li>
                </div>
            </div>
        </div>
    </div>
</nav>