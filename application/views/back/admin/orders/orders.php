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
							<form action="<?php echo base_url(); ?>admin/orders" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Date</label>
									<input type="date" name="from_date" id="from_datepicker" value="<?php echo @$from_date; ?>" placeholder="From date">
								</div>
								<!--
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Order Status</label>
									<select class="normal_select_option" name="order_status">
										<option value="">Select Option</option>
										<?php foreach($order_status_data as $ors){ ?>
											<option value="<?php echo $ors['order_status_id']; ?>" <?php if(@$order_status == $ors['order_status_id']){ echo 'selected'; }?>><?php echo $ors['order_status_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								-->
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Order ID</label>
									<input type="text" name="order_id" value="<?php echo @$order_id; ?>" placeholder="Order ID">
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
											<th><?php echo translate('sr_no');?></th>
											<th ><?php echo translate('job_description');?> </th>
											<th ><?php echo translate('drawing_no');?> </th>
											<th ><?php echo translate('qty');?> </th>
											<th ><?php echo translate('material');?> </th>
											<th ><?php echo translate('proposed_raw_material_size');?> </th>
											<th ><?php echo translate('approx_fim_cost');?> </th>
											<th ><?php echo translate('id_no_from');?> </th>
											<th ><?php echo translate('project');?> </th>
											<th ><?php echo translate('model');?> </th>
											<th ><?php echo translate('gst_rate');?> </th>
											<th><?php echo translate('created_date');?></th>											
											<?php if($this->crud_model->admin_permission('or_view') || $this->crud_model->admin_permission('order_status_update') || $this->crud_model->admin_permission('or_delete')){?>
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
											<td><?php echo $row['sr_no']; ?></td>
											<td><?php echo $row['orderno']; ?></td>
											<td><?php echo $row['job_description']; ?></td>
											<td><?php echo $row['drawing_no']; ?></td>
											<td><?php echo $row['qty']; ?></td>
											<td><?php echo $row['material']; ?></td>
											<td><?php echo $row['proposed_raw_material_size']; ?></td>
											<td><?php echo $row['approx_fim_cost']; ?></td>
											<td><?php echo $row['id_no_from']; ?></td>
											<td><?php echo $row['project']; ?></td>
											<td><?php echo $row['model']; ?></td>
											<td><?php echo $row['gst_rate']; ?></td>
											<td><?php echo date("d-m-Y",strtotime($row['created_date'])); ?></td>
											<?php if($this->crud_model->admin_permission('or_view') || $this->crud_model->admin_permission('order_status') || $this->crud_model->admin_permission('or_delete')){?>
												<td class="text-right">
													<?php /* if($this->crud_model->admin_permission('or_view')){ ?>
														<?php if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){?>
															<a class="btn btn-success btn-xs btn-labeled margintb5px" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/orders/order_invoice?o_t=<?php echo $row['orderno']; ?>&o_i=<?php echo $row['order_id']; ?>&from_date=<?php echo @$from_date; ?>&to_date=<?php echo $to_date; ?>&order_status=<?php echo $order_status; ?>&order_id=<?php echo @$order_id; ?>&customer_name=<?php echo @$customer_name; ?>&mobile_number=<?php echo @$mobile_number; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
														<?php }else{ ?>
															<a class="btn btn-success btn-xs btn-labeled margintb5px" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/orders/order_invoice?o_t=<?php echo $row['orderno']; ?>&o_i=<?php echo $row['order_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" data-original-title="View" data-container="body"><?php echo translate('view'); ?></a>
														<?php } ?> 
													<?php } 
													*/
													?>

													<?php if($this->crud_model->admin_permission('or_delete')){?>
														<?php if($row['orderno'] !== '1'){ ?>
															<a onclick="delete_confirm_order('<?php echo $row['orderno']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip"data-original-title="Delete" data-container="body"> <?php echo translate('delete');?> </a>
														<?php } ?>
													<?php } ?>
													<?php if($this->crud_model->admin_permission('orma_add')){?>
													<a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" onclick="ajax_modal_order('edit','<?php echo translate('Assign'); ?> order no <?php echo $row['orderno']; ?> to employee','<?php echo translate('successfully_assign!'); ?>','order_assign','<?php echo $row['orderno']; ?>')" data-original-title="Edit" data-container="body"> <?php echo translate('assign');?> </a>
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
<script>
	function ajax_modal_order(type,title,noty,form_id,id){
		modal_form(title,noty,form_id);
		ajax_load(base_url+'admin/orders/assign/'+id,'form','form');
	}
	function delete_confirm_order(id,msg){
		msg = '<div class="modal-title">'+msg+'</div>';
		bootbox.confirm(msg, function(result) {
			if (result) {
				ajax_load(base_url+'admin/orders/deleteorder/'+id,'list','delete');
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-check',
					message : dss,
					container : 'floating',
					timer : 3000
				});
				setTimeout(function () {
					location.reload('true');
				}, 1000);
			}else{
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-minus',
					message : cncle,
					container : 'floating',
					timer : 3000
				});
				setTimeout(function () {
					location.reload('true');
				}, 1000);
			};
		});
	}
	</script>