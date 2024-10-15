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
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('report');?></h1>

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
							<form action="<?php echo base_url(); ?>admin/orders/report" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<label>Select Employee</label>
									<select class="normal_select_option" name="employee">
										<?php 
										if($_SESSION['role'] != 1)
										{	?>
											<option value="<?php echo $_SESSION['admin_id'];?>"><?php echo $_SESSION['admin_name'];?></option><?php
										}else{ ?> 
										<option value="">ALL</option>
										<?php 										
										$this->db->select('admin_id,name,pm_id');
										$this->db->where('pm_id IS NOT NULL');
										$this->db->where('role !=', 1);
										$admin = $this->db->get('admin')->result_array();
										foreach($admin as $a)
										{
											$employee = $a['admin_id'];
										?>
										<option <?php if($employee == $a['admin_id']){ echo "selected";}?> value="<?php echo $a['admin_id'];?>"><?php echo $a['name'];?>- <?php echo $this->crud_model->get_type_name_by_id('process_master',$a['pm_id'],'pm_name'); ?></option>
										<?php
										}
										?><?php } ?>
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
							<div class="table-responsive1">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><?php echo translate('no');?></th>
										<th><?php echo translate('item');?></th>
										<th><?php echo translate('Start Time');?></th>
										<th><?php echo translate('End time');?></th>										
										<th><?php echo translate('total');?> Hours</th>
									</tr>
									</thead><tbody>
									<?php 
									foreach($all_sales as $as){ ?> 
									<tr>
										<td><?php echo $as['orderno'];?></td>
										<td><?php echo $as['job_description'];?></td>
										<td><?php echo $as['starttime'];?></td>
										<td><?php echo $as['endtime'];?></td>										
										<td><?php echo $as['total_time_spent_seconds'];?></td>
									</tr>
									<?php } ?>
								
								
								</tbody>
							</table>
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
</script>