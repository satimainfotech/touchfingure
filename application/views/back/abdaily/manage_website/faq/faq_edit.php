<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_faq');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/manage_website/faq<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/manage_website/faq<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($faq_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/abdaily/manage_website/faq_update/' . $row['faq_id'], array(
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
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
																<div class="col-sm-10">
																	<input type="text" name="faq_name" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control" value="<?php echo $row['faq_name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('discription');?></label>
																<div class="col-sm-10">
																	<textarea rows="9"  class="textarea" data-height="200" name="faq_desicription"><?php echo $row['faq_desicription']; ?></textarea>
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
	
    $(document).ready(function() {
        set_select();
	});
    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	
	function faq_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#faq_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#faq_image").change(function() {
		faq_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>