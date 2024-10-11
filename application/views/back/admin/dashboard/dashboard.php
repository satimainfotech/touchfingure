<style>
	.card{
		margin-bottom:0px;
	}
</style>
	<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('Dashboard');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<?php 
					if($_SESSION['role']== 1){
					?>
					<div class="tab-pane fade active in">
					<div class="row" style="margin-top: 30px; margin-bottom: 10px;">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body" style="background:linear-gradient(103.59deg, #009396 0%, #6cb945 100%) !important; border-radius:10px;" _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">Total Staff </h6>
									<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('admin',array('role !='=>1))->num_rows(); echo $get_winning_amount;  ?>
										</h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body "  style="background:linear-gradient(to right, #90caf9, #047edf 99%) !important; border-radius:10px;"  _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">
									
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">New Order</h6>
										<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('order',array('order_status'=>NULL))->num_rows(); echo $get_winning_amount;  ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body" style="background:linear-gradient(to right, #84d9d2, #07cdae) !important;border-radius:10px;" _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">										
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">Assigned Order</h6>
										<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('order',array('order_status'=>'assigned'))->num_rows(); echo $get_winning_amount;  ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body" style="background:linear-gradient(to right, #ffbf96, #fe7096) !important;border-radius:10px;"  _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">
									
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">Completed</h6>
										<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('order',array('order_status'=>'done'))->num_rows(); echo $get_winning_amount;  ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					</div>					
					</div>
					<?php } else{
					?>
					<div class="tab-pane fade active in">
					<div class="row" style="margin-top: 30px; margin-bottom: 10px;">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body "  style="background:linear-gradient(to right, #90caf9, #047edf 99%) !important; border-radius:10px;"  _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">
									
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">New Order</h6>
										<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('order_assign',array('status'=>'new','assign_to'=>$_SESSION['admin_id']))->num_rows(); echo $get_winning_amount;  ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body" style="background:linear-gradient(to right, #84d9d2, #07cdae) !important;border-radius:10px;" _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">										
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">In Progress</h6>
										<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('order_assign',array('status'=>'inprogress','assign_to'=>$_SESSION['admin_id']))->num_rows(); echo $get_winning_amount;  ?></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" _ngcontent-luc-c54="">
						<div class="card" _ngcontent-luc-c54="">
							<div class="card-body" style="background:linear-gradient(to right, #ffbf96, #fe7096) !important;border-radius:10px;"  _ngcontent-luc-c54="">
								<div class="d-flex no-block" _ngcontent-luc-c54="">
									
									<div class="align-self-center" _ngcontent-luc-c54="">
										<h6 class="m-t-10 m-b-0">Completed</h6>
										<h2 class="m-t-0"><?php @$get_winning_amount = @$this->db->get_where('order_assign',array('status'=>'done','assign_to'=>$_SESSION['admin_id']))->num_rows(); echo $get_winning_amount;  ?></h2>
									</div>
								</div>
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
	
	
</div>