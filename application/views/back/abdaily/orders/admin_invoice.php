<link href="<?php echo base_url(); ?>template/front/order_pdf.css" rel="stylesheet">
<section class="page-section invoice">
    <div class="container">
    	<?php foreach($orders as $row){ ?>
        <div class="col-md-8 bordered invoicebg margin0auto">
			<div class="tab-content">
				<div id="full" class="tab-pane fade active in">
					<div id="fullinvoce">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 invoceheader">
								<div class="col-lg-6 col-md-6 col-sm-6 pad-all">
									<img class="img-responsive logo" src="<?php echo $this->crud_model->logo('home_top_logo'); ?>" alt="Active Super Shop" width="25%">
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 pad-tlr text-align-right">
									<p>
										<b><?php echo translate('invoice_no');?> : </b> <?php echo order_id_with_prefix($row['order_id']); ?> 
									</p>
									<p >
										<?php 
											$newdate = explode("-",$row['order_date']);
											$newdatey = $newdate[0];
											$newdatem = $newdate[1];
											$newdated = $newdate[2];
											$new_date =  $newdatey.'-'.$newdatem.'-'.$newdated;
											$date = date_create($new_date);
											$order_date = $date->format('d').'<sup>'.$date->format('S').'</sup>'.$date->format('M').' '.$date->format('Y');
										?>
										<b><?php echo translate('order_date'); ?> : </b><?php echo $order_date;?>
									</p>
									<p><b><?php echo translate('name');?> : </b><?php echo $row['order_user_name']; ?></p>
									<p><b><?php echo translate('contact_no');?> : </b><?php echo $row['order_mobile_number']; ?></p>
								</div>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 pad-top">
								<div class="col-lg-12 col-md-12 col-sm-12 invoiceinfo text-align-left iniddate">
									<p><b><?php echo translate('order_status');?> : </b><?php echo translate($row['order_status_name']); ?></p>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 invoiceinfo text-align-left iniddate">
									
									<h4><?php echo translate('payment_detail');?></h4>
									<p><b><?php echo translate('payment_status');?> : </b><?php echo translate($row['order_paymnet_status']); ?></p>
									<p>
									<?php 
										$newdate = explode("-",$row['order_date']);
										$newdatey = $newdate[0];
										$newdatem = $newdate[1];
										$newdated = $newdate[2];
										$new_date =  $newdatey.'-'.$newdatem.'-'.$newdated;
										$date = date_create($new_date);
										$order_date = $date->format('d').'<sup>'.$date->format('S').'</sup>'.$date->format('M').' '.$date->format('Y');
									?>
									<b><?php echo translate('payment_date');?> : </b><?php echo $order_date;?></p>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 invoiceinfo text-align-right">
									<h4><?php echo translate('delivery_address');?></h4>
									<b><?php echo translate('address');?> : </b>
									<?php echo $row['order_address'].', '.$row['city_name']; ?>
									<br>
									<b><?php echo translate('mobile_number');?> : </b><?php echo $row['order_mobile_number']; ?> <br>
									<b><?php echo translate('alternet_mobile_number');?> : </b><?php echo $row['order_alternet_mobile_number']; ?> <br>
								</div>
						   </div>
						</div>
						<div class="panel-body" id="demo_s">
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
												<th><?php echo translate('unit_cost');?></th>
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
												<td><?php echo $row1['order_product_title'].' ( '.$row1['sale_unit_qty'].' '.$row1['order_product_qty_unit'].' )'; ?></td>
												<td><?php echo $row1['order_product_qty']; ?></td>
												<td>
													<?php $price = $row1['order_product_price']; ?>
													<?php echo currency('','def').$this->cart->format_number($price); ?>
												</td>
												<td>
													<?php echo currency('','def').$this->cart->format_number($price*$row1['order_product_qty']); $total += $price*$row1['order_product_qty']; 
													?>
												</td>
											</tr>
											<?php
												}
											?>
											<tr>
												<td colspan="4" class="alignright"><b><?php echo translate('sub_total_amount');?></b></td>
												<td class="totalwidth"><?php echo currency('','def').$this->cart->format_number($total); ?></td>
											</tr>
											<tr>
												<td colspan="4" class="alignright"><b><?php echo translate('Product Discount');?></b></td>
												<td class="totalwidth"><?php echo '- '.currency('','def').$this->cart->format_number($row['order_product_total_discount_amount']); ?></td>
											</tr>
											<tr>
												<td colspan="4" class="alignright"><b><?php echo translate('Coupon Discount');?></b></td>
												<td class="totalwidth"><?php echo '- '.currency('','def').$this->cart->format_number($row['order_discounted_amount']); ?></td>
											</tr>
											<tr>
												<td colspan="4" class="alignright"><b><?php echo translate('delivery Charge');?></b></td>
												<td class="totalwidth"><?php echo '+ '.currency('','def').$this->cart->format_number($row['order_delivery_amout']); ?></td>
											</tr>
											<tr>
												<td colspan="4" class="alignright"><b><?php echo translate('grand_total');?></b></td>
												<td class="totalwidth"><?php echo currency('','def').$this->cart->format_number($row['order_grand_amount']); ?></td>
											</tr>
										</tbody>
									</table> 
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 text-center print_btn">
							<a class="btn btn-success btn-md btn-labeled fa fa-step-backward margin-bottom-10" href="<?php echo base_url(); ?>admin/orders/"><?php echo translate('back');?> </a>
							<span class="btn btn-success btn-md btn-labeled fa fa-reply margin-bottom-10" onclick="printfull('fullinvoce')" > <?php echo translate('print');?></span>
							<span>
							<form action="<?php echo base_url(); ?>admin/orders/order_invoice?order_id=<?php echo $order_id; ?>&invoice_user=1" method="post" style="display: inherit;">
								<input type="hidden" name="invoice_type" value="pdf">
								<button type="submit" class="btn btn-success btn-md btn-labeled fa fa-file-pdf-o margin-bottom-10" ><?php echo translate('pdf'); ?></button>
							</form>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php
			}
		?>
    </div>
</section>