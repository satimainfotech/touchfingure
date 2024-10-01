<div id="content-container">
	<div id="page-title" class="manybutton">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('Dashboard');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in">
						<div class="row" style="margin-top: 30px; margin-bottom: 10px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" _ngcontent-luc-c54="">
								<div class="card" _ngcontent-luc-c54="">
									<div class="card-body transaction-tiles-style" _ngcontent-luc-c54="">
										<div class="d-flex no-block" _ngcontent-luc-c54="">
											<div class="m-r-20 align-self-center mindgame_box">
												<img src="https://cdn.paykun.com/dashboard/v1/icon/transaction.svg" alt="Income" width="50">
											</div>
											<div class="align-self-center" _ngcontent-luc-c54="">
												<h6 class="text-muted m-t-10 m-b-0">Company ACcount Balance Amount </h6>
												<h2 class="m-t-0"><?php /*@$get_winning_amount = @$this->dashboard_model->company_balance();*/ echo "0";  ?>
												</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" _ngcontent-luc-c54="">
								<div class="card" _ngcontent-luc-c54="">
									<div class="card-body transaction-tiles-style" _ngcontent-luc-c54="">
										<div class="d-flex no-block" _ngcontent-luc-c54="">
											<div class="m-r-20 align-self-center mindgame_box">
												<img src="https://cdn.paykun.com/dashboard/v1/icon/transaction.svg" alt="Income" width="50">
											</div>
											<div class="align-self-center" _ngcontent-luc-c54="">
												<h6 class="text-muted m-t-10 m-b-0">Agent Balance</h6>
												<h2 class="m-t-0"><?php /* @$get_winning_cashback_amount = $this->dashboard_model->agent_balance(); */ echo "0";?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" _ngcontent-luc-c54="">
								<div class="card" _ngcontent-luc-c54="">
									<div class="card-body transaction-tiles-style" _ngcontent-luc-c54="">
										<div class="d-flex no-block" _ngcontent-luc-c54="">
											<div class="m-r-20 align-self-center mindgame_box">
												<img src="https://cdn.paykun.com/dashboard/v1/icon/transaction.svg" alt="Income" width="50">
											</div>
											<div class="align-self-center" _ngcontent-luc-c54="">
												<h6 class="text-muted m-t-10 m-b-0">Recovery Amount</h6>
												<h2 class="m-t-0"><?php /* @$get_bonus_amount = $this->dashboard_model->recovery_amount();*/ echo "0"; ?></h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>