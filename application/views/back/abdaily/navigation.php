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
                            <ul class="collapse <?php if( $page_name_link=="member_type" ||  $page_name_link=="gram_panchayat" ||  $page_name_link=="area" || $page_name_link=="gram_panachayat" || $page_name_link=="taluka_m" || $page_name_link=="taluka" || $page_name_link=="division" || $page_name_link=="district_m" ||  $page_name_link=="country" || $page_name_link=="state" || $page_name_link=="city" || $page_name_link=="district" || $page_name_link=="area"){?>in<?php } ?> ">
								<?php if($this->crud_model->admin_permission('country')){ ?>
									<li <?php if($page_name_link=="country"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/country/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('country');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('state')){ ?>
									<li <?php if($page_name_link=="state"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/state/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('state');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('division')){ ?>
									<li <?php if($page_name_link=="division"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/division/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('division');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('district')){ ?>
									<li <?php if($page_name_link=="district"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/district/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('district');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('district_m')){ ?>
									<li <?php if($page_name_link=="district_m"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/district_m/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('district-M');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('taluka')){ ?>
									<li <?php if($page_name_link=="taluka"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/taluka/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('taluka');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('taluka_m')){ ?>
									<li <?php if($page_name_link=="taluka_m"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/taluka_m/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('taluka-M');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('gram_panchayat')){ ?>
									<li <?php if($page_name_link=="gram_panachayat'"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/gram_panchayat/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('gram panachayat');?>
										</a>
									</li>
								<?php } ?>
								
								<?php /*if($this->crud_model->admin_permission('city')){ ?>
									<li <?php if($page_name_link=="city"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/city/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('city');?>
										</a>
									</li>
								<?php } */?>
								<?php if($this->crud_model->admin_permission('area')){ ?>
									<li <?php if($page_name_link=="area"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/area/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('area');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('member_type')){ ?>
									<li <?php if($page_name_link=="member_type"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/member_type/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('member_type');?>
										</a>
									</li>
								<?php } ?>
                            </ul>
                        </li>
                        <?php
							}
						?>
						<li <?php if($page_name_link=="user"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/abdaily/user">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('users');?>
                                </span>
                            </a>
                        </li>
						
						<?php
							}
						?>
						
                        <li <?php if($page_name_link=="payment_receipt" || $page_name_link=="news" || $page_name_link=="faq" || $page_name_link=="team" ||  $page_name_link=="services" || $page_name_link=="web_social_media" || $page_name_link=="sliders" || $page_name_link=="cms_pages" || $page_name_link=="testimonials" || $page_name_link=="second_sliders" || $page_name_link=="our_technology" || $page_name_link=="cms_pages" || $page_name_link=="our_network" || $page_name_link=="brand" || $page_name_link=="footer_setting" || $page_name_link=="header_setting" || $page_name_link=="category"){?> class="active-sub" 
                        <?php } ?>>
                            <a href="#">
                                <i class="fa fa-file-text"></i>
								<span class="menu-title">
									<?php echo translate('manage_website');?>
								</span>
								<i class="fa arrow"></i>
                            </a>
                            <ul class="collapse <?php if( $page_name_link=="payment_receipt" || $page_name_link=="news" || $page_name_link=="faq" || $page_name_link=="team" || $page_name_link=="services" || $page_name_link=="web_social_media" || $page_name_link=="sliders" || $page_name_link=="cms_pages" || $page_name_link=="testimonials" || $page_name_link=="second_sliders" || $page_name_link=="our_technology"|| $page_name_link=="cms_pages"|| $page_name_link=="our_network" || $page_name_link=="footer_setting" || $page_name_link=="header_setting" || $page_name_link=="brand" || $page_name_link=="category"){?>in<?php } ?> ">
                            <?php if($this->crud_model->admin_permission('social_media') ){ ?>
									<li <?php if($page_name_link=="web_social_media"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/social_media/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('social_media');?>
										</a>
									</li>
								<?php } ?>
									<?php if($this->crud_model->admin_permission('our_technology')){ ?>
									<li <?php if($page_name_link=="our_technology"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/our_technology/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('Statics');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('slider')){ ?>                      
									<li <?php if($page_name_link=="sliders"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url();?>admin/abdaily/manage_website/sliders/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('homepage slider');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('second_sliders')){ ?>                      
									<li <?php if($page_name_link=="second_sliders"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url();?>admin/abdaily/manage_website/second_sliders/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('Page slider');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('team')){ ?>
									<li <?php if($page_name_link=="team"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/team/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('team');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('services')){ ?>
									<li <?php if($page_name_link=="services"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/services/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('services');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('faq')){ ?>
									<li <?php if($page_name_link=="faq"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily//manage_website/faq/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('faq');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('cms_pages')){ ?>
									<li <?php if($page_name_link=="cms_pages"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/cms_pages/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('cms_pages');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('news')){ ?>
									<li <?php if($page_name_link=="news"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/news/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('newss');?>
										</a>
									</li>
								<?php } ?>
								
								<?php if($this->crud_model->admin_permission('testimonials')){ ?>
									<li <?php if($page_name_link=="testimonials"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/testimonials/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('Client Testimonial');?>
										</a>
									</li>
								<?php } ?>
								
								
								
							
								
									<?php if($this->crud_model->admin_permission('footer_setting')){ ?>
									<li <?php if($page_name_link=="footer_setting"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/footer_setting/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('footer_setting');?>
										</a>
									</li>
								<?php } ?>
								
								<?php if($this->crud_model->admin_permission('header_setting')){ ?>
									<li <?php if($page_name_link=="header_setting"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/header_setting/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('header_setting');?>
										</a>
									</li>
								<?php } ?>
								
								
								<?php if($this->crud_model->admin_permission('payment_receipt')){ ?>
									<li <?php if($page_name_link=="payment_receipt"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/manage_website/payment_receipt/">
											<i class="fa fa-star fs_i"></i>
											<?php echo translate('payment_receipt');?>
										</a>
									</li>
								<?php } ?>
									
                            </ul>
                        </li>
						
                        <li <?php if($page_name_link=="contact_enquire"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/abdaily/contact_enquire">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('contact_enquires');?>
                                </span>
                            </a>
                        </li>
                        
                         <li <?php if($page_name_link=="subscribers"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/abdaily/subscribers">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('Email subscribers');?>
                                </span>
                            </a>
                        </li>
						
                     
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
													<a href="<?php echo base_url(); ?>admin/abdaily/display_settings/logo">
														<i class="fa fa-circle fs_i"></i>
														<?php echo translate('logo');?>
													</a>
												</li>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('favicon')){ ?>
												<li <?php if($tab == 'favicon'){ ?>class="active-link"<?php } ?> >
													<a href="<?php echo base_url(); ?>admin/abdaily/display_settings/favicon">
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
                                                <a href="<?php echo base_url();?>admin/abdaily/site_settings/">
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
                                    <a href="<?php echo base_url(); ?>admin/abdaily/staff/">
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
                                    <a href="<?php echo base_url(); ?>admin/abdaily/staff/role/">
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