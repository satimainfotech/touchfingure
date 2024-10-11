<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_order');?></h1>
		<?php //if($this->crud_model->admin_permission('orders')){?>
         <a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/orders/import"><?php echo translate('create_order');?> </a>
		<?php //} ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
                <!-- LIST -->
                <div class="tab-pane fade active in" id="list">
					<div class="orderstable panel-body">
						<div class="reportfilterdiv">
							<!--<form action="<?php echo base_url(); ?>admin/orders/main" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Date</label>
									<input type="date" name="from_date" id="from_datepicker" value="<?php echo @$from_date; ?>" placeholder="From date">
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
								
								<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									<?php if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){ ?>
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/orders/main">Reset</a>
									<?php } ?>
								</div>
							</form>-->
						</div>
						<div class="fixed-table-container">
							<div class="fixed-table-body">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
									<thead>
										<tr>
											<th style="width:4ex"><?php echo translate('ID');?></th>
											<th><?php echo translate('indent_no');?> </th>
											<th><?php echo translate('hsn_code');?> </th>
											<th><?php echo translate('date');?> </th>
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
											<td><?php echo $row['orderno']; ?></td>
											<td><?php echo $row['indent_no']; ?></td>
											<td><?php echo $row['hsn_code']; ?></td>
											<td><?php echo date("d-m-Y",strtotime($row['created_date'])); ?></td>
											<?php if($this->crud_model->admin_permission('order_view') || $this->crud_model->admin_permission('order_status') || $this->crud_model->admin_permission('order_delete')){?>
												<td class="text-right">
													<?php if($this->crud_model->admin_permission('order_view')){ ?>
														<a class="btn btn-success btn-xs btn-labeled margintb5px" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/orders/order_invoice?o_t=<?php echo $row['orderno']; ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
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