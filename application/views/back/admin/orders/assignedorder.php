<div id="content-container">
	<style>
		.card {
    background: #fffcf4;
    padding: 15px;
}
</style>
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_order');?></h1>
		<?php //if($this->crud_model->admin_permission('orders')){?>
         <a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/orders/import"><?php echo translate('create_order');?> </a>
		<?php //} ?>
	</div>
	<?php 
	$order_status=$_GET['order_status'];
	$order_id = $_GET['order_id'];
	?>	
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
                <!-- LIST -->
                <div class="tab-pane fade active in" id="list">
					<div class="orderstable panel-body">
						<div class="reportfilterdiv">
							<form action="<?php echo base_url(); ?>admin/orders/assigned_orders" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Order Status</label>
									<select class="normal_select_option" name="order_status">
										<option value="">Select Option</option>
										<option value="assigned" <?php if(@$order_status == "assigned"){ echo 'selected'; }?>>Assigned</option>
										<option value="processing" <?php if(@$order_status == "processing"){ echo 'selected'; }?>>Processing</option>
										<option value="completed" <?php if(@$order_status == "completed"){ echo 'selected'; }?>>Completed</option>
</select>
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Order ID</label>
									<input type="text" name="order_id" value="<?php echo @$order_id; ?>" placeholder="Order ID">
								</div>
								<div class="col-sm-3 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									<?php if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){ ?>
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/orders/assigned_orders">Reset</a>
									<?php } ?>
								</div>
							</form>
						</div>
						<div class="fixed-table-container">
							<div class="fixed-table-body">
								<div id="example" class="col-sm-12" style="width:100%">
									<tbody>
									<?php
										if(!empty($all_sales)){
											$i = 0;
											foreach($all_sales as $data){
											$i++; 
										?>
										<div class="card">
									<div class="row">
									<div class="col-sm-12"><b>Description:</b> <?=$data['job_description'];?></div>
									<div class="col-sm-6">Drawing:<br/><?=$data['drawing_no'];?></div>
									<div class="col-sm-6">Qty:<br/><?=$data['qty'];?></div>
									<div class="col-sm-6">Material:<br/><?=$data['material'];?></div>
									<div class="col-sm-6">Size:<br/><?=$data['proposed_raw_material_size'];?></div>
									<div class="col-sm-6">ID no from:<br/><?=$data['id_no_from'];?></div>
									<div class="col-sm-6">ID no to:<br/><?=$data['id_no_to'];?></div>
									<div class="col-sm-6">Project:<br/><?=$data['project'];?></div>
									<div class="col-sm-6">Model:<br/><?=$data['model'];?></div>
									</div></div>
									<?php } }else{ ?>
										<div style="text-align:center;">
											<td colspan="9">Data Not Found....</td>
										</div>	
									<?php } ?>
									</div>
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