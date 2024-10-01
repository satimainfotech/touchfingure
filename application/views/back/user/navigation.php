<nav id="mainnav-container">
    <div id="mainnav">
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content" style="overflow-x:auto;">
                    <ul id="mainnav-menu" class="list-group">
						
                        <li <?php if($page_name_link=="dashboard"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>login/dashboard">
                                <i class="fa fa-tachometer"></i>
                                <span class="menu-title">
									<?php echo translate('dashboard');?>
                                </span>
                            </a>
                        </li>
						
						
            			
						
						
						
						<li>
							<a href="<?php echo base_url(); ?>login/logout/">
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