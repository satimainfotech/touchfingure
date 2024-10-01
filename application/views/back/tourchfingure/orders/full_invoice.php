<link href="<?php echo base_url(); ?>template/front/order_pdf.css" rel="stylesheet">
<section class="page-section invoice">
    <div class="container">
    	<?php
			$sale_details = $this->db->get_where('sale',array('sale_id'=>$sale_id))->result_array();
			foreach($sale_details as $row){
		?>
        <div class="row">
            <div class="fulldiv">
                <div class="invoice_body">
                    <div class="invoice-title">
                        <div class="invoice_logo hidden-xs">
                        	<?php
								$home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
							?>
							<img src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo; ?>.png" alt="SuperShop"/>
                        </div>
                        <div class="invoice_info">
                            <p><b><?php echo translate('invoice'); ?> :</b> #<?php echo $row['sale_code']; ?></p>
							<?php 
								$newdate = explode("-",$row['sale_datetime']);
								$newdatey = $newdate[0];
								$newdatem = $newdate[1];
								$newdated = $newdate[2];
								$new_date =  $newdatey.'-'.$newdatem.'-'.$newdated;
								$date = date_create($new_date);
								$order_date = $date->format('d').'<sup>'.$date->format('S').'</sup>'.$date->format('M').' '.$date->format('Y');
							?>
                            <p><b><?php echo translate('order_date'); ?> : </b><?php echo $order_date;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="left-section margin-b-fiftin">
							<?php
								$b_info = json_decode($row['buyer_info'],true);
							?>
                            <address>
                                <strong>
                                    <h4>
                                        <?php echo translate('buyer_details'); ?> :
                                    </h4>
								</strong>
								<p>
									<b><?php echo translate('name'); ?> :</b>
									<?php echo $b_info['name']; ?>
								</p>
								<p>
									<b><?php echo translate('email'); ?> :</b>
									<?php echo $b_info['email']; ?>
								</p>
								<p>
									<b><?php echo translate('phone_no.'); ?> :</b>
									<?php echo $b_info['phone']; ?>
								</p>
                            </address>
                        </div>
                        <div class="right-section margin-b-fiftin text-right-align">
							<address>
                                <strong>
                                    <h4>
                                        <?php echo translate('payment_details'); ?> :
                                    </h4>
                                </strong>
                                <p>
                                    <b><?php echo translate('payment_status'); ?> :</b>
                                    <i><?php echo translate($this->db->get_where('sale', array('sale_id' => $sale_id))->row()->payment_status); ?></i>
                                </p>
                                <p>
                                    <b><?php echo translate('payment_method'); ?> :</b>
                                    <?php if($row['payment_type'] == 'c2'){
                                        echo 'TwoCheckout';
                                    }else{
                                        echo ucfirst(str_replace('_', ' ', $row['payment_type'])); 
                                    }?>
                                </p>
                            </address>
                            
                        </div>
                    </div>
					<div class="row">
                        <div class="left-section margin-b-fiftin">
                            <address>
                                <strong>
                                    <h4>
                                        <?php echo translate('billing_details'); ?> :
                                    </h4>
                                </strong>
                                <?php
									$info = json_decode($row['billing_address'],true);
								?>
                                <p>
                                    <b><?php echo translate('name'); ?> :</b>
                                    <?php echo $info['name']; ?>
                                </p>
                                <p>
                                    <b><?php echo translate('billing_address'); ?> :</b>
                                    <br>
                                    <?php echo $info['address1']; ?> <?php if($info['address2'] != ''){ echo ', '.$info['address2']; } ?> <br/><?php if($info['country'] != ''){ echo $info['country']; } ?> <?php if($info['state'] != ''){ echo ', '.$info['state']; } ?> <?php if($info['city'] != ''){ echo ', '.$info['city']; } ?> <?php if($info['zip'] != ''){ echo ' - '.$info['zip']; } ?><br>
                                    <?php echo translate('phone');?> : <?php echo $info['phone']; ?> <br>
                                    <?php echo translate('e-mail');?> : <?php echo $info['email']; ?>
                                </p>
                            </address>
                        </div>
                        
                        <div class="right-section margin-b-fiftin text-right-align">
                            <address>
                                <strong>
                                    <h4>
                                        <?php echo translate('shipping_details'); ?> :
                                    </h4>
                                </strong>
								<?php
									$info = json_decode($row['shipping_address'],true);
								?>
                                <p>
                                    <b><?php echo translate('name'); ?> :</b>
                                    <?php echo $info['name']; ?>
                                </p>
                                <p>
                                    <b><?php echo translate('address'); ?> :</b>
                                    <br>
                                    <?php echo $info['address1']; ?> <?php if($info['address2'] != ''){ echo ', '.$info['address2']; } ?> <br/><?php if($info['country'] != ''){ echo $info['country']; } ?> <?php if($info['state'] != ''){ echo ', '.$info['state']; } ?> <?php if($info['city'] != ''){ echo ', '.$info['city']; } ?> <?php if($info['zip'] != ''){ echo ' - '.$info['zip']; } ?><br>
                                    <?php echo translate('phone');?> : <?php echo $info['phone']; ?> <br>
                                    <?php echo translate('e-mail');?> : <?php echo $info['email']; ?>
                                </p>
                            </address>
                        </div>
                    </div>
                    
                    
                    <div class="panel panel-default orderitems">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong><?php echo translate('order_items');?></strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th><?php echo translate('no');?></th>
                                            <th><?php echo translate('item');?></th>
                                            <th><?php echo translate('options');?></th>
                                            <th><?php echo translate('quantity');?></th>
                                            <th><?php echo translate('unit_cost');?></th>
                                            <th><?php echo translate('total');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$product_details = json_decode($row['product_details'], true);
											$i = 0;
											$total = 0;
											$discounted = array();
											$counter = 0;
											foreach ($product_details as $row1) {
												$discounted[] = $row1['discounted_amount'];
												$i++;
										?>
                                        <tr class="<?= ($counter % 2 == 0) ? 'even' : 'odd' ?>">
                                            <td><?php echo $i; ?></td>
                                            <td class="text-center"><?php echo $row1['name']; ?></td>
                                            <td class="text-center">
                                            <?php 
												$option = json_decode($row1['option'],true);
												foreach ($option as $l => $op) {
													if($l !== 'color' && $op['value'] !== '' && $op['value'] !== NULL){
											?>
												<?php echo $op['title'] ?> : 
												<?php 
													if(is_array($va = $op['value'])){ 
														echo $va = join(', ',$va); 
													} else {
														echo $va;
													}
												?>
												<br>
											<?php
													}
												} 
											?>
                                            </td>
                                            <td class="text-right"><?php echo $row1['qty']; ?></td>
                                            <td class="text-right">
												<?php if($row1['origanl_price'] == '' ){
													$price = $row1['price'];	
												}else{	
													$price = $row1['origanl_price'];
												}
												echo currency($price);
												?>
                                            </td>
                                            <td class="text-right">
												<?php 
												if($row1['origanl_price'] == '' ){
													$price = $row1['price'];	
												}else{	
													$price = $row1['origanl_price'];
												}
												echo currency($price*$row1['qty']); 
													$total += $price*$row1['qty']; 
												?>
                                            </td>
                                        </tr>
                                        <?php
											$counter++;
											}
										?>
                                        <tr>
                                        	<td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-right-align totalbg">
                                            	<strong>
                                            		<?php echo translate('sub_total');?> :
                                                </strong>
                                            </td>
                                            <td class="thick-line text-right-align totalbgp">
                                            	<?php echo currency($total);?>
                                            </td>
                                        </tr>
										<?php if(array_sum($discounted) != 0){ ?>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-right-align totalbg">
													<strong>
														<?php echo translate('discount');?> :
													</strong>
												</td>
												<td class="no-line text-right-align totalbgp">
													<?php echo currency(array_sum($discounted));?>
												</td>
											</tr>
										<?php } ?>
										<?php if($row['vat'] != 0){ ?>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-right-align totalbg">
													<strong>
														<?php echo translate('tax');?> :
													</strong>
												</td>
												<td class="no-line text-right-align totalbgp">
													<?php echo currency($row['vat']);?>
												</td>
											</tr>
										<?php } ?>
										<?php if($row['shipping'] != 0){ ?>
											<tr>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line"></td>
												<td class="no-line text-right-align totalbg">
													<strong>
														<?php echo translate('shipping');?> :
													</strong>
												</td>
												<td class="no-line text-right-align totalbgp">
													<?php echo currency($row['shipping']);?>
												</td>
											</tr>
										<?php } ?>
                                        <tr>
                                        	<td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-right-align totalbg">
                                            	<strong>
                                            		<?php echo translate('grand_total');?> :
                                                </strong>
                                            </td>
                                            <td class="no-line text-right-align totalbgp">
                                            	<?php echo currency($row['grand_total']);?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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