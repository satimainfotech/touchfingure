<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('create_orders');?></h1>
	<?php if($this->crud_model->admin_permission('staff_role_add')){?>
        <a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/orders"><?php echo translate('back');?> </a>
        <?php } ?>
    </div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php
							echo form_open(base_url() . 'admin/orders/import', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'area_add',
								'enctype' => 'multipart/form-data'
							));
						?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
								<div class="panel-body">
									<div class="tab-base">
										<div class="tab-content">
											<div id="vendor_details" class="tab-pane fade active in">
                                            <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>	
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paddingfive">
													<div class="form-group">
														<label class="col-sm-3 control-label paddingfive" for="demo-hor-1"><?php echo translate('select_file');?></label>
														<div class="col-sm-9 paddingfive">													
                                                        <input type="file" name="file" class="form-control required" accept=".xlsx, .xls" required>
                                                    </div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-footer">
								<div class="row">
                                        <input type="submit" class="btn btn-success p-3 btn-md btn-labeled fa fa-upload pull-left enterer" value="Upload File">
								</div>
							</div>
						</form>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>    

<style>
    input.btn.enterer {
    padding: 6px 10px !important;
}
</style>
