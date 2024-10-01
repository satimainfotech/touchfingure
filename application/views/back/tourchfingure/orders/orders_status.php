<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_order_status');?></h1>
		<?php echo $from_date; if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/orders?from_date=<?php echo @$from_date; ?>&to_date=<?php echo @$to_date; ?>&order_status=<?php echo @$order_status; ?>&order_id=<?php echo @$order_id; ?>&customer_name=<?php echo @$customer_name; ?>&mobile_number=<?php echo @$mobile_number; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/orders?from_date=<?php echo @$from_date; ?>&to_date=<?php echo @$to_date; ?>&order_status=<?php echo @$order_status; ?>&order_id=<?php echo @$order_id; ?>&customer_name=<?php echo @$customer_name; ?>&mobile_number=<?php echo @$mobile_number; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/orders<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/orders<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } 
		?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<?php foreach($orders as $row){ ?>
					<div class="col-md-8 bordered invoicebg">
						<div class="tab-content">
							<div id="full" class="tab-pane fade active in">
								<div id="printMe">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoceheader">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad-all-zero">
												<img class="img-responsive logo" src="<?php echo $this->crud_model->logo('home_top_logo'); ?>" alt="Active Super Shop" width="25%">
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad-tlr text-align-right">
												<p>
													<b><?php echo translate('invoice_no');?> : </b> <?php echo order_id_with_prefix($row['order_id']); ?> 
												</p>
												<p >
													<?php 
													    date_default_timezone_set("Asia/Kolkata");
														if($row['order_date'] != ''){
															$from_timess = $row['order_date'];
															$show_time = date('d M, Y h:i:s A', $from_timess); 
														}else{
															$show_time = ''; 
														}
													?>
													<b><?php echo translate('order_date'); ?> : </b><?php echo $show_time;?>
												</p>
												
											</div>
										</div>
										
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingfive invoiceinfo text-align-left">
											<h4><?php echo translate('delivery_address');?></h4>
											<p><b><?php echo translate('name');?> : </b><?php echo $row['order_user_name']; ?></p>
											<p><b><?php echo translate('contact_no');?> : </b><?php echo $row['order_mobile_number']; ?></p>
											<p><b><?php echo translate('address');?> : </b><?php echo $row['order_address']; ?></p>
											<p><b><?php echo translate('mobile_number');?> : </b><?php echo $row['order_mobile_number']; ?></p>
											<p><b><?php echo translate('order_status');?> : </b><?php echo translate($row['order_status_name']); ?></p>
										</div>
									</div>
									<div class="panel-body pad-lt-zero" id="demo_s">
										<div class="panel panel-bordered panel-dark shadow-none">
											<div class="panel-heading">
												<h1 class="panel-title"><?php echo translate('order_items');?></h1>
											</div>
											<div class="table-responsive">
												<table class="table table-bordered table-striped">
													<thead>
														<tr>
															<th><?php echo translate('no');?></th>
															<th><?php echo translate('item');?></th>
															<th><?php echo translate('quantity');?></th>
															<th><?php echo translate('points');?></th>
															<th><?php echo translate('total');?></th>
														</tr>
													</thead>
													<tbody>
														<?php
															$i =0;
															$total = 0;
															foreach ($orders_items as $row1) {
																$i++;
														?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $row1['order_product_title'].' ( '.$row1['order_item_unit_value'].' '.$row1['order_item_unit_type'].' )'; ?></td>
															<td><?php echo $row1['order_product_qty']; ?></td>
															<td>
																<?php $price = $row1['order_product_DP']; ?>
																<?php echo $price; ?>
															</td>
															<td>
																<?php echo $price*$row1['order_product_qty']; $total += $price*$row1['order_product_qty']; 
																?>
															</td>
														</tr>
														<?php
															}
														?>
														<tr>
															<td colspan="4" class="alignright"><b><?php echo translate('sub_total_points');?></b></td>
															<td class="totalwidth"><?php echo $total; ?></td>
														</tr>
														<tr>
															<td colspan="4" class="alignright"><b><?php echo translate('Product points');?></b></td>
															<td class="totalwidth"><?php echo '- '.$row['order_product_discounted_DP']; ?></td>
														</tr>
														<tr>
															<td colspan="4" class="alignright"><b><?php echo translate('grand_points');?></b></td>
															<td class="totalwidth"><?php echo $row['order_grand_DP']; ?></td>
														</tr>
													</tbody>
												</table> 
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 invoicebg">
						<?php
							echo form_open(base_url() . 'admin/orders/status_update/'.$row['order_id'], array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'form_edits',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="form-group">
								<label class="col-sm-12 control-label text-left" for="demo-hor-2"><?php echo translate('status');?></label>
								<div class="col-sm-12">
									<select name="status" class="demo-chosen-select required" data-placeholder="Choose a status" id="status">
										<option value="">Choose one</option>
										<?php 
										$orderstatus = $row['order_status']; 
										$update_order_status = $row['update_order_status']; 
										$ex_update_order_status = explode(",",$update_order_status);
										foreach($orders_status as $c_row){ 
										?>
											<option value="<?php echo $c_row['order_status_id']; ?>" <?php if(@$orderstatus == $c_row['order_status_id']){ echo 'selected'; }?> <?php if(in_array($c_row['order_status_id'],$ex_update_order_status)){ echo 'disabled'; }?>><?php echo $c_row['order_status_name']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-sm-12 paddingallzero" id="traking_details">
								<div class="form-group">
									<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('traking_id');?></label>
									<div class="col-sm-12">
										<input type="text" name="traking_id" id="demo-hor-1" placeholder="<?php echo translate('traking_id');?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 control-label text-left" for="demo-hor-1"><?php echo translate('traking_link');?></label>
									<div class="col-sm-12">
										<input type="text" name="traking_link" id="demo-hor-1" placeholder="<?php echo translate('traking_link');?>" class="form-control">
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
									<div class="col-md-10">
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('Status_successfully updated!'); ?>');" ><?php echo translate('submit');?></span>
									</div>
								</div>
							</div>
						</form>
					</div>
				<?php } ?>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });	
	function print_invoice() {
		var contents = document.getElementById("printMe").innerHTML;
		var frame1 = document.createElement('iframe');
		frame1.style.visibility = "hidden";
		//frame1.style.width = "100%";
		//frame1.style.height = "500px";
		frame1.name = "frame1";
		document.body.appendChild(frame1);
		var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
		frameDoc.document.open();
		frameDoc.document.write('<link rel=\"stylesheet\" type=\"text/css\" href=\"'+base_url+'template/back/admin/css/common.min.css\"><link rel=\"stylesheet\" type=\"text/css\" href=\"'+base_url+'template/back/admin/css/bootstrap.min.css\">');
		frameDoc.document.write(contents);
		frameDoc.document.close();
		setTimeout(function () {
			window.frames["frame1"].focus();
			window.frames["frame1"].print();
			document.body.removeChild(frame1);
		}, 500);
		return false;
	}
</script>