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
		 <a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/orders/main"><?php echo translate('Back');?> </a>
	</div>
	<?php 
	$admin = $this->db->select('admin_id,name,pm_id')->get_where('admin')->result_array();
	foreach($admin as $ap){
		$process = $this->crud_model->get_type_name_by_id('process_master',$ap['pm_id'],'pm_name');
		$process = " - ".$process;
		$username[$ap['admin_id']] =$ap['name'].$process;
	}
	$order_status=$_GET['order_status'];
	$order_id = $_GET['order_id'];
	?>	
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
                <!-- LIST -->
                <div class="tab-pane fade active in" id="list" style="margin-top:10px;">
					<div class="orderstable panel-body">
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
										<h5 class="card-title mb-0 flex-grow-1"><?php echo translate('SR. NO.');?> :  <b> <?php echo $data['sr_no']; ?></h5>
										<div class="flex-shrink-0">
											<?php
											if($data['order_status'] == 'done' && $_SESSION['role'] != 1)
											{
												$orderid = $data['orderno'];
												$assign_to = $data['assign_to'];
											 	$sql = "SELECT orderno, SUM(TIMESTAMPDIFF(SECOND, starttime, endtime)) / 3600 AS total_time_spent_seconds FROM ordertimelog where orderno='$orderid' and assignto='$assign_to'";
												$result =$this->db->query($sql)->row();
												if($result != ""){
													echo "Working Hours: ". $result->total_time_spent_seconds;
												}

											}else{
												$orderid = $data['orderno'];
												$assign_to = $data['assign_to'];
											 	$sql = "SELECT orderno, SUM(TIMESTAMPDIFF(SECOND, starttime, endtime)) / 3600 AS total_time_spent_seconds FROM ordertimelog where orderno='$orderid'";
												$result =$this->db->query($sql)->row();
												if($result != ""){
													echo "Working Hours: ". $result->total_time_spent_seconds;
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
											<button class="btn btn-success addMembers-modal" onclick="Start_end_order('<?php echo $data['id']; ?>','<?php echo $data['assign_by']; ?>','<?php echo $data['assign_to']; ?>','<?php echo $data['orderid']; ?>','<?php echo translate('really_want_to_start_time?'); ?>','done')"><i class="fa fa-check me-1 align-bottom"></i> Job Done</button>
										<?php }  } ?>
										</div>
										</div>
									<div class="row" style="margin: 0px -5px;">
									<div class="col-sm-12"><b>Description:</b> <?=$data['job_description'];?></div>
									<div class="col-sm-3"><b>Drawing:</b><br/><?=$data['drawing_no'];?></div>
									<div class="col-sm-3"><b>Qty:</b><br/><?=$data['qty'];?></div>
									<div class="col-sm-3"><b>Material:</b><br/><?=$data['material'];?></div>
									<div class="col-sm-3"><b>Size:</b><br/><?=$data['proposed_raw_material_size'];?></div>
									<div class="col-sm-3"><b>ID no from:</b><br/><?=$data['id_no_from'];?></div>
									<div class="col-sm-3"><b>ID no to:</b><br/><?=$data['id_no_to'];?></div>
									<div class="col-sm-3"><b>Project:</b><br/><?=$data['project'];?></div>
									<div class="col-sm-3"><b>Model:</b><br/><?=$data['model'];?></div>
									</div>
								<?php
								$sql = "SELECT *,orderno, (TIMESTAMPDIFF(SECOND, starttime, endtime)) / 3600 AS total_time_spent_seconds FROM ordertimelog where orderno='$orderid'";
								$resulttime =$this->db->query($sql)->result_array();
								if($resulttime != ""){
									?>
									<table class="table table-bordered">
									<thead>
									<tr>
										<th>SR. NO</th>
										<th>Assigned By</th>
										<th>Work By</th>
										<th>Start Time</th>
										<th>End Time</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=1;
										foreach($resulttime as $r){
											?>
											<tr>
										<td><?php echo $i;?></td>
										<td><?php echo $username[$r['assignby']];?></td>
										<td><?php echo $username[$r['assignto']];?></td>
										<td><?php echo $r['starttime'];?></td>
										<td><?php echo $r['endtime'];?></td>
										</tr>
											<?php 
											$i++;
										}
										?>
									</tbody>
									</table>
									<?php 
								}
								?>
								
								</div>
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