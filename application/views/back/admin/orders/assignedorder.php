<div id="content-container">
	<style>
.card {
    border-radius: 10px;
    background: #56b15536;
    padding: 15px;
    margin-bottom: 5px;
}
.card .row div {
    padding: 6px;
}
.d-flex {
    justify-content: space-between;
    display: flex !important;
    width: 100%;
    align-items: center !important;
}
.card-header.align-items-center.d-flex h4 {
    margin: 0px;
}
</style>
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_order');?></h1>
		<?php if($this->crud_model->admin_permission('orders')){?>
         <a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/orders/import"><?php echo translate('create_order');?> </a>
		<?php } ?>
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
									<label>Select Employee</label>
									<select class="normal_select_option" name="order_status">
										<option value="">ALL</option>
										<option value="assigned" <?php if(@$order_status == "assigned"){ echo 'selected'; }?>>Assigned</option>
										<option value="inprogress" <?php if(@$order_status == "inprogress"){ echo 'selected'; }?>>Processing</option>
										<option value="done" <?php if(@$order_status == "done"){ echo 'selected'; }?>>Completed</option>
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
						<div class="fixed-table-container1">
							<div class="fixed-table-body1">
								<div id="example" style="width:100%;margin:0px 5px;">
									<tbody>
									<?php
										if(!empty($all_sales)){
											$i = 0;
											foreach($all_sales as $data){
												$i++; 
												$result = $this->db->select('otid')->get_where('ordertimelog',array('as_id'=>$data['id'],'endtime'=>NULL))->row();
										?>
										<div class="card">
										<div class="card-header align-items-center d-flex">
										<h5 class="card-title mb-0 flex-grow-1"><?php echo translate('ORDER_NO');?> :  <b> <?php echo $data['orderid']; ?></h5>
										<div class="flex-shrink-0">
											<?php 
											if($data['order_status'] == 'done' && $_SESSION['role'] != 1)
											{
												$orderid = $data['orderid'];
												$assign_to = $data['assign_to'];
											 	$sql = "SELECT orderno, SUM(TIMESTAMPDIFF(SECOND, starttime, endtime)) / 3600 AS total_time_spent_seconds FROM ordertimelog where orderno='$orderid' and assignto='$assign_to'";
												$result =$this->db->query($sql)->row();
												if($result != ""){
													echo "Working Hours: ". $result->total_time_spent_seconds;
												}

											}else{
												$orderid = $data['orderid'];
												$assign_to = $data['assign_to'];
											 	$sql = "SELECT orderno, SUM(TIMESTAMPDIFF(SECOND, starttime, endtime)) / 3600 AS total_time_spent_seconds FROM ordertimelog where orderno='$orderid'";
												$resultt =$this->db->query($sql)->row();
												if($resultt != ""){
													echo "Working Hours: ". $resultt->total_time_spent_seconds;
												}
											if($this->crud_model->admin_permission('orma_track') && $_SESSION['role'] != 1){
											if($result != "") 
											{
											?> 
											<button class="btn btn-warning addMembers-modal" onclick="Start_end_order('<?php echo $result->{'otid'}; ?>','<?php echo $data['assign_by']; ?>','<?php echo $data['assign_to']; ?>','<?php echo $data['orderid']; ?>','<?php echo translate('really_want_to_start_time?'); ?>','end')"><i class="fa fa-clock-o me-1 align-bottom"></i> End Time</button>
											<?php }
											else{
											?>
											<button class="btn btn-warning addMembers-modal" onclick="Start_end_order('<?php echo $data['id']; ?>','<?php echo $data['assign_by']; ?>','<?php echo $data['assign_to']; ?>','<?php echo $data['orderid']; ?>','<?php echo translate('really_want_to_start_time?'); ?>','start')"><i class="fa fa-clock-o me-1 align-bottom"></i> Start Time</button>
											<?php
											} 
											?>
											<button class="btn btn-danger" data-toggle="tooltip" onclick="ajax_modal_order('edit','<?php echo translate('Assign'); ?> order no <?php echo $data['orderno']; ?> to employee','<?php echo translate('successfully_assign!'); ?>','order_assign','<?php echo $data['orderno']; ?>')" data-original-title="Edit" data-container="body"> <i class="fa fa-soccer-ball-o me-1 align-bottom"></i> <?php echo translate('Emergency');?> </button>
											<button class="btn btn-success addMembers-modal" onclick="Start_end_order('<?php echo $data['id']; ?>','<?php echo $data['assign_by']; ?>','<?php echo $data['assign_to']; ?>','<?php echo $data['orderid']; ?>','<?php echo translate('really_want_to_start_time?'); ?>','done')"><i class="fa fa-check me-1 align-bottom"></i> Job Done</button>
										<?php }  } ?>
										</div>
										</div>
									<div class="row" style="margin: 0px -5px;">
									<div class="col-sm-12"><b>Description:</b> <?=$data['job_description'];?></div>
									<div class="col-sm-3"><b>Drawing:</b><br/><?=$data['drawing_no'];?></div>
									<div class="col-sm-3"><b>Qty:</b><br/><?=$data['qty'];?></div>
									<div class="col-sm-3"><b>Material:</b><br/><?=$data['materialname'];?></div>
									<div class="col-sm-3"><b>Size:</b><br/><?=$data['proposed_raw_material_size'];?></div>
									<div class="col-sm-3"><b>ID no from:</b><br/><?=$data['id_no_from'];?></div>
									<div class="col-sm-3"><b>ID no to:</b><br/><?=$data['id_no_to'];?></div>
									<div class="col-sm-3"><b>Project:</b><br/><?=$data['project'];?></div>
									<div class="col-sm-3"><b>Model:</b><br/><?=$data['modelname'];?></div>
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
function Start_end_order(as_id, assign_by, assign_to, orderid, msg, flag) {
    msg = '<div class="modal-title">' + msg + '</div>';
    
    bootbox.confirm(msg, function(result) {
        if (result) {
            // Properly concatenate the URL with parameters
            let url = base_url + 'admin/orders/Startenddone/' + 
                      '?as_id=' + as_id + 
                      '&assign_by=' + assign_by + 
                      '&assign_to=' + assign_to + 
					  '&flag=' + flag + 
                      '&orderid=' + orderid;
            
            ajax_load(url, 'list', 'delete');
            
            $.activeitNoty({
                type: 'danger',
                icon: 'fa fa-check',
                message: flag,
                container: 'floating',
                timer: 3000
            });

            setTimeout(function() {
                location.reload(true); // 'true' should not be a string here
            }, 1000);
        } else {
            $.activeitNoty({
                type: 'danger',
                icon: 'fa fa-minus',
                message: cncle,
                container: 'floating',
                timer: 3000
            });

            setTimeout(function() {
                location.reload(true); // 'true' should not be a string here
            }, 1000);
        }
    });
}

</script>