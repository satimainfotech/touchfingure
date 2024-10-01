<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_a_about');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/about<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<input type="hidden" value="<?php echo base_url(); ?>admin/about<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($about_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/about/update/' . $row['about_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'form_edits',
										'enctype' => 'multipart/form-data'
									));
								?>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview fulllabel">
										<div class="panel-body">
											<div class="tab-base">
												 <div class="tab-content">
													<div id="vendor_details" class="tab-pane fade active in">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
																<div class="col-sm-12">
																	<input type="text" name="about_title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control required" value="<?php echo $row['about_title']; ?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2">
																	<?php echo translate('about_image');?>
																</label>
																<div class="col-sm-12">
																	<span class="pull-left btn btn-default btn-file">
																		<?php echo translate('select_image');?>
																		<input type="file" name="about_image" id='about_image' accept="image">
																	</span>
																	<span id="about_image_wrap" class=" show_iin_image" style="width: 460px;float:left;border:1px solid #ddd;border-radius:5px;padding:5px;margin-top: 5px;">
																		<?php
																			if($row['about_image'] != ''){
																				if(file_exists('uploads/about_image/'.$row['about_image'])){
																			?>
																				<img src="<?php echo base_url(); ?>uploads/about_image/<?php echo $row['about_image']; ?>" width="100%" id="about_image_blah" />  
																			<?php
																				} else {
																			?>
																				<img src="<?php echo base_url(); ?>uploads/about_image/default.jpg" width="100%" id="about_image_blah" />
																			<?php
																				}
																			}else{?>
																				<img src="<?php echo base_url(); ?>uploads/about_image/default.jpg" width="100%" id="about_image_blah" />
																			<?php }
																		?> 
																	</span>
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
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('form_edits','<?php echo translate('about_successfully_updated!'); ?>');"><?php echo translate('update');?></span> 
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
<script type="text/javascript">
    
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
    
	$(document).ready(function() {
        set_select();
    });
	function about_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#about_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#about_image").change(function() {
		about_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>