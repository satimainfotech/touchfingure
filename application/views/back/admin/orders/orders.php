<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_order');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
                <!-- LIST -->
                <div class="tab-pane fade active in" id="list">
					<div class="orderstable panel-body">
						<div class="reportfilterdiv">
							<form action="<?php echo base_url(); ?>admin/orders" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>From Date</label>
									<input type="date" name="from_date" id="from_datepicker" value="<?php echo @$from_date; ?>" placeholder="From date">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>To date</label>
									<input type="date" name="to_date" value="<?php echo @$to_date; ?>" id="to_datepicker"  placeholder="To date">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Order Status</label>
									<select class="normal_select_option" name="order_status">
										<option value="">Select Option</option>
										<?php foreach($order_status_data as $ors){ ?>
											<option value="<?php echo $ors['order_status_id']; ?>" <?php if(@$order_status == $ors['order_status_id']){ echo 'selected'; }?>><?php echo $ors['order_status_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Order ID</label>
									<input type="text" name="order_id" value="<?php echo @$order_id; ?>" placeholder="Order ID">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Customer Name</label>
									<input type="text" name="customer_name" value="<?php echo @$customer_name; ?>" placeholder="Customer Name">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Mobile Number</label>
									<input type="text" name="mobile_number" value="<?php echo @$mobile_number; ?>" placeholder="Mobile Number">
								</div>
								<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									<?php if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){ ?>
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/orders">Reset</a>
									<?php } ?>
								</div>
							</form>
						</div>
						<div class="fixed-table-container">
							<div class="fixed-table-body">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th style="width:4ex"><?php echo translate('ID');?></th>
											<th><?php echo translate('order_id');?></th>
											<th ><?php echo translate('first name');?> </th>
											<th ><?php echo translate('last name');?> </th>
											<th ><?php echo translate('wall name');?> </th>
											<th ><?php echo translate('Phone number');?> </th>
											<th ><?php echo translate('Category');?> </th>
											<th ><?php echo translate('theme');?> </th>
											<th ><?php echo translate('Image');?> </th>
											<th ><?php echo translate('Height Feet');?> </th>
											<th ><?php echo translate('Height Inch');?> </th>
											<th ><?php echo translate('Width Feet');?> </th>
											<th ><?php echo translate('Width Inch');?> </th>
											<th ><?php echo translate('Total');?> </th>
											<th ><?php echo translate('Gst');?> </th>
											<th ><?php echo translate('Grand Total');?> </th>
											<th><?php echo translate('date');?></th>											
											<?php if($this->crud_model->admin_permission('order_view') || $this->crud_model->admin_permission('order_status_update') || $this->crud_model->admin_permission('order_delete')){?>
												<th class=""><?php echo translate('options');?></th>
											<?php } ?>
										</tr>
									</thead>
										
									<tbody>
									<?php
										if(!empty($all_sales)){
											$i = 0;
											foreach($all_sales as $row){
											$i++; 
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['order_id']; ?></td>
											<td><?php echo $row['first_name']; ?></td>
											<td><?php echo $row['last_name']; ?></td>
											<td><?php echo $row['wall_name']; ?></td>
											<td><?php echo $row['phone_number']; ?></td>
											<td><?php echo $row['category']; ?></td>
											<td><?php echo $row['theme']; ?></td>
											<td><a href="<?php echo base_url(); ?>/uploads/convart_image/<?php echo $row['convart_image']; ?>" download><img style="50px;width:50px;" src="<?php echo base_url(); ?>/uploads/convart_image/<?php echo $row['convart_image']; ?>"></a></td>
											<td><?php echo $row['height_foot']; ?></td>
											<td><?php echo $row['height_inch']; ?></td>
											<td><?php echo $row['width_feet']; ?></td>
											<td><?php echo $row['width_inch']; ?></td>
											<td><?php echo $row['total']; ?></td>
											<td><?php echo $row['gst']; ?></td>
											<td><?php echo $row['grand_total']; ?></td>
											<td><?php echo date("d-m-Y",strtotime($row['created_date'])); ?></td>
											
											<?php if($this->crud_model->admin_permission('order_view') || $this->crud_model->admin_permission('order_status') || $this->crud_model->admin_permission('order_delete')){?>
												<td class="text-right">
													<?php if($this->crud_model->admin_permission('order_view')){ ?>
														<?php if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){?>
															<a class="btn btn-success btn-xs btn-labeled margintb5px" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/orders/order_invoice?o_t=<?php echo $row['order_token']; ?>&o_i=<?php echo $row['order_id']; ?>&from_date=<?php echo @$from_date; ?>&to_date=<?php echo $to_date; ?>&order_status=<?php echo $order_status; ?>&order_id=<?php echo @$order_id; ?>&customer_name=<?php echo @$customer_name; ?>&mobile_number=<?php echo @$mobile_number; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
														<?php }else{ ?>
															<a class="btn btn-success btn-xs btn-labeled margintb5px" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/orders/order_invoice?o_t=<?php echo $row['order_token']; ?>&o_i=<?php echo $row['order_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
														<?php } ?> 
													<?php } ?>
												</td>
											<?php } ?>
										</tr>
									<?php } }else{ ?>
										<tr style="text-align:center;">
											<td colspan="9">Data Not Found....</td>
										</tr>	
									<?php } ?>
									</tbody>
								</table>
							</div>  
						</div>  
					</div>  
					<div class="custom_pagination">
						<?php echo $links; ?>
					</div>
                </div>
			</div>
        </div>
	</div>
</div>