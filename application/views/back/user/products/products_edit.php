	<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_products');?></h1>
		<?php if(@$products != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/products?b_n=<?php echo @$products; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/products?b_n=<?php echo @$products; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/products<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/products<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($products_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/products/products_update/' . $row['products_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'form_edits',
										'enctype' => 'multipart/form-data'
									));
								?>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
										<div class="panel-body">
											<div class="tab-base">
												 <div class="tab-content">
													<div id="vendor_details" class="tab-pane fade active in">
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('products name');?></label>
																<div class="col-sm-10">
																	<input type="text" name="products_name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control required" value="<?php echo $row['products_name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Intrest Rate');?></label>
																<div class="col-sm-10">
																	<input type="text" name="intrest_rate" id="demo-hor-1" placeholder="<?php echo translate('Intrest Rate');?>" class="form-control required" value="<?php echo $row['intrest_rate']; ?>">
																</div>
															</div>
															<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('No of Days');?></label>
															<div class="col-sm-10">
																<input type="text" name="days" id="days" placeholder="<?php echo translate('No Of Days');?>" value="<?php echo $row['days']; ?>" class="form-control required">
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
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('successfully_edited!'); ?>');" ><?php echo translate('update');?></span> 
										</div>
									</div>
								</form>
							<?php } ?>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function other(){
	    set_select();
    }
    $(document).ready(function() {
        set_select();
	});
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	
	
</script>