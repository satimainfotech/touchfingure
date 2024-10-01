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
									<?php echo translate('dashboard');?>
                                </span>
                            </a>
                        </li>
						<?php if($this->crud_model->admin_permission('master_management')){ ?>
                        <li <?php if($page_name_link=="country" || $page_name_link=="state" || $page_name_link=="city"  || $page_name_link=="district" || $page_name_link=="area"){?> class="active-sub" 
                        <?php } ?>>
                            <a href="#">
                                <i class="fa fa-file-text"></i>
								<span class="menu-title">
									<?php echo translate('master_management');?>
								</span>
								<i class="fa arrow"></i>
                            </a>
                            <ul class="collapse <?php if($page_name_link=="country" || $page_name_link=="state" || $page_name_link=="city" || $page_name_link=="district" || $page_name_link=="area"){?>in<?php } ?> ">
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
								<?php if($this->crud_model->admin_permission('district')){ ?>
									<li <?php if($page_name_link=="district"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/district/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('district');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('city')){ ?>
									<li <?php if($page_name_link=="city"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/city/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('city');?>
										</a>
									</li>
								<?php } ?>
								<?php if($this->crud_model->admin_permission('area')){ ?>
									<li <?php if($page_name_link=="area"){?> class="active-link" <?php } ?> >
										<a href="<?php echo base_url(); ?>admin/abdaily/master_manage/area/">
											<i class="fa fa-circle fs_i"></i>
											<?php echo translate('area');?>
										</a>
									</li>
								<?php } ?>
                            </ul>
                        </li>
                        <?php
							}
						?>
						
						<li <?php if($page_name_link=="bank"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/bank">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('bank');?>
                                </span>
                            </a>
                        </li>
						<li <?php if($page_name_link=="products"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/products">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('products');?>
                                </span>
                            </a>
                        </li>
						<li <?php if($page_name_link=="agent"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/agent">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('Agent');?>
                                </span>
                            </a>
                        </li>
						<li <?php if($page_name_link=="investor"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/investor">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('Company');?>
                                </span>
                            </a>
                        </li>
						<li <?php if($page_name_link=="deal"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>admin/deal">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('Student');?>
                                </span>
                            </a>
                        </li>
						<?php } ?>
						
						<li <?php if($page_name_link=="reports_agent"|| $page_name_link=="reports_investor" || $page_name_link=="reports_student" ) {?> class="active-sub" <?php } ?> >
                            <a href="#">
                                <i class="fa fa-desktop"></i>
								<span class="menu-title">
									<?php echo translate('Reports');?>
								</span>
								<i class="fa arrow"></i>
                            </a>
						
						<ul class="collapse?php <?php if($page_name_link=="reports_agent"|| $page_name_link=="reports_investor" || $page_name_link=="reports_student" ) {?> in<?php } ?>" >
                                
								                      
									<li <?php if($page_name_link=="reports_agent"){?>class="active-sub"<?php } ?> >
										<a href="<?php echo base_url(); ?>admin/reports/agent">
											<i class="fa fa-television"></i>
											<span class="menu-title">
												<?php echo translate('Agent');?>
											</span>
											<i class="fa arrow"></i>
										</a>
										</li>
										<li <?php if($page_name_link=="reports_investor"){?>class="active-sub"<?php } ?> >
										<a href="<?php echo base_url(); ?>admin/reports/investor">
											<i class="fa fa-television"></i>
											<span class="menu-title">
												<?php echo translate('investor');?>
											</span>
											<i class="fa arrow"></i>
										</a>
										</li>
										<li <?php if($page_name_link=="reports_student"){?>class="active-sub"<?php } ?> >
										<a href="<?php echo base_url(); ?>admin/reports/student">
											<i class="fa fa-television"></i>
											<span class="menu-title">
												<?php echo translate('student');?>
											</span>
											<i class="fa arrow"></i>
										</a>
										</li>
									</ul>
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