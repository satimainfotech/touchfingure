<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_product_enquire_details');?></h1>
		<?php
			if(@$category != '' || @$sub_category != '' || @$product_name != '' || @$from_date != '' || @$to_date != '' || @$our_range != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product_enquire?c_i=<?php echo @$category; ?>&sc_i=<?php echo @$sub_category; ?>&p_n=<?php echo @$product_name; ?>&f_d=<?php echo $from_date; ?>&t_d=<?php echo $to_date; ?>&or_i=<?php echo $our_range; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/product_enquire<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
					<?php 
					foreach($product_enquire_data as $row)
					{ 
					?>
						<div class="row">
						<div class="col-md-12">
							<div class="text-center pad-all">
								<div class="col-md-6">
									<div class="productdetaildiv">
										<h3>Enquire Product Details</h3>
										<table class="table table-striped" style="border-radius:3px;">
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td"><?php echo $row['product_name']?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('category');?></td>
												<td class="custom_td">
													<?php  if($row['category_name'] != ''){ echo $row['category_name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('sub-category');?></td>
												<td class="custom_td">
													<?php  if($row['sub_category_name'] != ''){ echo $row['sub_category_name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('our_range');?></td>
												<td class="custom_td">
													<?php  if($row['our_range_name'] != ''){ echo $row['our_range_name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('brand');?></td>
												<td class="custom_td">
													<?php  if($row['brand_name'] != ''){ echo $row['brand_name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
										</table>
										<?php if($row['product_details'] != ''){ ?>
										<?php
											$decode_data = json_decode($row['product_details'],true);
											$total_row = array();
											for($j=1; $j<=count($decode_data); $j++){ 
												$total_row[] = $j;
											} 
											
											$final_total_row = implode(",",$total_row);
										?>
											<table class="table table-striped" style="border-radius:3px;">
												<?php foreach($decode_data as $rows){ ?>
													<tr>
														<td class="custom_td_title"><?php echo $rows['option_name'];?></td>
														<td class="custom_td"><?php echo $rows['option_value']?></td>
													</tr>
												<?php }?>
											</table>
										<?php } ?>
										<h3>Selected Texture</h3>
										<?php if($row['selected_items'] != ''){ ?>
										
										<?php
											$decode_datas = json_decode($row['selected_items'],true);
											//echo "<pre>"; print_r($decode_datas);
											$total_rows = array();
											for($js=1; $js<=count($decode_datas); $js++){ 
												$total_rows[] = $js;
											} 
											
											$final_total_rows = implode(",",$total_rows);
										?>
											<table class="table table-striped" style="border-radius:3px;">
												<?php foreach($decode_datas as $rowss){ ?>
													<tr>
														<td class="custom_td_title"><?php echo $rowss['title'];?></td>
														<td class="custom_td"><img src="<?php echo base_url(); ?>uploads/product_op_image/<?php echo $rowss['image']; ?>" style="width:100px;"></td>
													</tr>
												<?php }?>
											</table>
										<?php } ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="productdetaildiv">
										<h3>User Details</h3>
										<table class="table table-striped" style="border-radius:3px;">
											<tr>
												<td class="custom_td_title"><?php echo translate('name');?></td>
												<td class="custom_td"><?php echo $row['name']?></td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('email');?></td>
												<td class="custom_td">
													<?php  if($row['email'] != ''){ echo $row['email']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('phone');?></td>
												<td class="custom_td">
													<?php  if($row['phone'] != ''){ echo $row['phone']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('city');?></td>
												<td class="custom_td">
													<?php  if($row['city'] != ''){ echo $row['city']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('company_name');?></td>
												<td class="custom_td">
													<?php  if($row['company_name'] != ''){ echo $row['company_name']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
											<tr>
												<td class="custom_td_title"><?php echo translate('message');?></td>
												<td class="custom_td">
													<?php  if($row['message'] != ''){ echo $row['message']; }else { echo '- - - N/A - - -'; }  ?>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<hr>
							</div>
						</div>
					</div>		
					<?php 
						}
					?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>     
<style>
.productdetaildiv table td.custom_td_title{
	border-bottom: 1px solid #ddd !important;
	background-color: #eee !important;
	position: inherit !important;
	min-width:200px;
}
</style>    