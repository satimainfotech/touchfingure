<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('order_details');?></h1>
		<?php echo $from_date; if(@$from_date != '' || @$to_date != '' || @$order_status != '' || @$order_id != '' || @$customer_name != '' || @$mobile_number != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/orders?from_date=<?php echo @$from_date; ?>&to_date=<?php echo @$to_date; ?>&order_status=<?php echo @$order_status; ?>&order_id=<?php echo @$order_id; ?>&customer_name=<?php echo @$customer_name; ?>&mobile_number=<?php echo @$mobile_number; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/orders<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } 
		?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<?php foreach($orders as $row){ ?>
					<div class="col-md-8 invoicebg margin0auto">
						<div class="tab-content">
							<div id="full" class="tab-pane fade active in">
								<div id="printMe">
									<div style="border: 1px solid rgba(0,0,0,0.10);padding: 0px 15px;">
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 invoceheader">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad-lr-zero">
													<img class="img-responsive logo" src="<?php echo $this->crud_model->logo('home_top_logo'); ?>" alt="Active Super Shop" width="25%">
												</div>
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pad-tlr text-align-right">
													<p>
														<b><?php echo translate('invoice_no');?> : </b> <?php echo $row['order_id']; ?> 
													</p>
													<p >
														
														<b><?php echo translate('order_date'); ?> : </b><?php echo date("d-m-Y",strtotime($row['created_date'])); ?>
													</p>
													
												</div>
											</div>
											
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 paddingfive invoiceinfo text-align-left">
												<h4><?php echo translate('delivery_address');?></h4>
												<p><b><?php echo translate('name');?> : </b><?php echo $row['fist_name']; ?> <?php echo $row['last_name']; ?></p>											
												<p><b><?php echo translate('mobile_number');?> : </b><?php echo $row['phone_number']; ?></p>
												
											</div>
										</div>
										<div class="panel-body pad-lr-zero" id="demo_s">
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
																<th><?php echo translate('Height');?></th>
																<th><?php echo translate('Width');?></th>
																
																<th><?php echo translate('total');?></th>
															</tr>
														</thead>
														<tbody>
															<?php
																$i =1;
																
															
															?>
															<tr>
																<td><?php echo $i; ?></td>
																<td><img style="50px;width:50px;" src="<?php echo base_url(); ?>/uploads/convart_image/<?php echo $row['convart_image']; ?>"></td>
																<td><?php echo $row['height_foot']; ?> feet <?php echo $row['height_inch']; ?> Inch </td>
																<td><?php echo $row['width_foot']; ?> feet <?php echo $row['width_inch']; ?> Inch </td>
																<td><?php echo $row['total']; ?></td>
																
															</tr>
															
															
															<tr>
																<td colspan="4" class="alignright"><b><?php echo translate('Gst');?></b></td>
																<td class="totalwidth"><?php echo '+ '.$row['gst']; ?></td>
															</tr>
															<tr>
																<td colspan="4" class="alignright"><b><?php echo translate('Grand Total');?></b></td>
																<td class="totalwidth"><?php echo $row['grand_total']; ?></td>
															</tr>
														</tbody>
													</table> 
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 text-center print_btn">
										<a class="btn btn-success btn-md btn-labeled fa fa-step-backward margin-bottom-10" href="<?php echo base_url(); ?>admin/orders/"><?php echo translate('back');?> </a>
										<span class="btn btn-success btn-md btn-labeled fa fa-reply margin-bottom-10" onclick="print_invoice();" > <?php echo translate('print');?></span>
										<span>
										<!--<form action="<?php echo base_url(); ?>admin/orders/order_invoice?order_id=<?php echo $order_id; ?>&invoice_user=1" method="post" style="display: inherit;">
											<input type="hidden" name="invoice_type" value="pdf">
											<button type="submit" class="btn btn-success btn-md btn-labeled fa fa-file-pdf-o margin-bottom-10" ><?php echo translate('pdf'); ?></button>
										</form> -->
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript">
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