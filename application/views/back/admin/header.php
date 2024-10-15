<header id="navbar">
    <div id="navbar-container" class="boxed">
        <!--Brand logo & name-->
        <div class="navbar-header">
            <a href="<?php echo base_url(); ?><?php echo $this->session->userdata('title'); ?>" class="navbar-brand">
                <img src="<?php echo $this->crud_model->logo('admin_login_logo'); ?>" alt="<?php echo $system_name;?>" class="brand-icon" style="padding:5px 5px 10px 5px;">
                <div class="brand-title">
                    <span class="brand-text"><?php echo $system_name;?></span>
                </div>
            </a>
        </div>
        <!--End brand logo & name-->

        <!--Navbar Dropdown-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">
                <!--Navigation toogle button-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle">
                        <i class="fa fa-navicon fa-lg"></i>
                    </a>
                </li>
                <!--End Navigation toogle button-->
            </ul>
            
            <ul class="nav navbar-top-links pull-right">
				<li id="dropdown-user" class="dropdown notificationss">
					<a href="<?php echo base_url(); ?>template/back/#" data-toggle="dropdown" class="dropdown-toggle text-right">
						<i class="fa fa-bell"></i><span class="notificationcount"><?php echo $this->db->get_where('notification',array('notification_user_id'=>$_SESSION['admin_id'],'notification_read'=>0))->num_rows(); ?></span>
					</a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right with-arrow panel-default notificationshow">
						<h3>Notifications</h3>
                        <?php $noti = $this->db->limit('5')->order_by('notification_id','desc')->get_where('notification',array('notification_user_id'=>$_SESSION['admin_id']))->result_array();  ?>
						<ul>
						<?php if(!empty($noti)){ foreach($noti as $noi){ 
							?>
							<li class="<?php if($noi['notification_read'] == '0'){ echo 'notread'; }?>"><?php echo $noi['notification_content'];?></a></li>
						<?php } }else{ echo "<li>Notifications not found...</li>"; } ?>
						</ul>
						<h4><a href="<?php echo base_url();?>admin/notification">View All</a></h4>
                    </div>
                </li>
                <li id="dropdown-user" class="dropdown">
                    <div class="username hidden-xs">
						<?php 
							echo $this->session->userdata('admin_name');
						?>
					</div>
                </li>
                <!--End user dropdown-->
            </ul>
        </div>
    </div>
</header>
<input type="hidden" value="<?php echo base_url(); ?>admin/" id="base_url">
