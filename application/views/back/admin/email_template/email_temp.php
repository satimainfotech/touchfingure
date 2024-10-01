<html>
    <body>
    	<div style="background-color:#fff;border:1px solid #eee;float:left;width:90%;font-family: roboto;">
    		<div style="padding: 5px 0px;background-color: #eee;color:#fff;float:left;width:100%">
    			<div style="width:25%;padding: 5px 15px;margin:0 auto;text-align:left;float:left">
					<?php 
						$home_top_logo = $this->db->get_where('general_settings',array('type' => 'home_top_logo'))->row()->value;
						$logo = base_url().'uploads/logo_image/logo_'.$home_top_logo.'.png';
						$site_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
					?>
					<a href="<?php echo base_url(); ?>"><img style="display:block;max-width:100px;height:auto" src="<?php echo $logo; ?>" alt="" /></a>
    			</div>
				<h4 style="float: right;width: auto;margin: 0;line-height: 38px;padding: 0px 15px;color: #000;">
					Product Enquire Details
				</h4>
    		</div>
    		<div style="padding:15px;float:left;width:100%">
				<div style="float:left;width:100%;">
					<h4> User Details </h4>
					<ul style="list-style:none;padding: 0;line-height:25px;">
						<li><b>Name : </b> <?php echo $q_data['name']; ?></li>
						<li><b>Email : </b> <?php echo $q_data['email']; ?></li>
						<li><b>Phone : </b> <?php echo $q_data['phone']; ?></li>
						<li><b>City : </b> <?php echo $q_data['city']; ?></li>
						<li><b>Company Name : </b> <?php echo $q_data['company_name']; ?></li>
						<li><b>Message : </b> <?php echo $q_data['message']; ?></li>
					</ul>
				</div>
    			<?php $get_product_details = $this->db->get_where('product',array('product_id'=>$q_data['product_id']))->result_array(); 
				if(!empty($get_product_details)){
					$product_name = $get_product_details[0]['product_name'];
					$product_details = $get_product_details[0]['product_details'];
					$product_image = $get_product_details[0]['main_product_image'];
				}else{
					$product_name = "";
					$product_details = '';
					$product_image = '';
				}
				?>
				<div style="float:left;width:100%;">
					<h4> Product Details </h4>
					<div style="width:230px;float:left;margin-right:10px;background-image:url(<?php echo base_url(); ?>uploads/product_image/<?php echo $product_image; ?>);height: 230px;background-position: center;background-size: cover;"></div>
					<div style="width:70%;float:left;margin-left:5px;">
						<h3 style="margin-top: 0;"><?php echo $product_name; ?></h3>
						<table style="width: auto;margin-bottom: 1rem;color: #212529;font-size: 14px;background-color: #e8e8e8;">
							<tbody>
								<?php if($product_details != ''){ ?>
								<?php
									$decode_data = json_decode($product_details,true);
									$total_row = array();
									for($j=1; $j<=count($decode_data); $j++){ 
										$total_row[] = $j;
									} 
									
									$final_total_row = implode(",",$total_row);
								?>
									<?php foreach($decode_data as $rows){ ?>
										<tr style="background-color: rgba(0,0,0,.05);">
											<td style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;color: #212529;font-size: 14px;"><span><?php echo $rows['option_name'];?></span></td>
											<td style="padding: .75rem;vertical-align: top;border-top: 1px solid #dee2e6;color: #212529;font-size: 14px;"><span><?php echo $rows['option_value']?></span></td>
										</tr>
									<?php }?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<div style="float:left;width:100%;">
					<h4> Selected Texture </h4>
					<?php $selected_itemss = json_decode($q_data['selected_items']); 
					foreach($selected_itemss as $s_row){ ?>
						<div style="width:180px;float:left;margin-right:10px;background-image:url(<?php echo base_url(); ?>uploads/product_op_image/<?php echo $s_row->image; ?>);height: 200px;background-position: center;background-size: cover;position: relative"><h6 style="background-color: #fff;text-align: center;position: absolute;width: 95%;bottom: 0;padding: 5px;text-transform: capitalize;font-size: 14px;margin: 0;word-break: break-all;"><?php echo $s_row->title; ?></h6></div>
					<?php } ?>
				</div>
    		</div>
    		<div style="padding: 5px 0px;background-color: #eee;color:#000;text-align:center;float:left;width:100%">
				<?php $year = date('Y'); ?>
				<div style="text-align: center;float:left;width: 100%;margin-bottom:1px;margin-top: 2px;padding-left: 0;">
					Copyright 2021<?php if($year > '2021'){ echo ' - '.$year; } ?> © <?php echo $site_name?>. All Rights Reserved by <a href="<?php echo base_url(); ?>">Reddmica</a></a>
				</div>
    		</div>
    	</div>
    </body>
</html>