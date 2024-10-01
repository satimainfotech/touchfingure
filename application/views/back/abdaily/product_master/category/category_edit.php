<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_team');?></h1>
		<?php if(@$team != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/team?c_n=<?php echo @$team; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/team?c_n=<?php echo @$team; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/team<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/team<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($team_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/abdaily/team/team_update/' . $row['team_id'], array(
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
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
																<div class="col-sm-10">
																	<input type="text" name="team_name" id="demo-hor-1" placeholder="<?php echo translate('name');?>" class="form-control" value="<?php echo $row['team_name']; ?>">
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('position');?></label>
																<div class="col-sm-10">
																	<input type="text" name="position" id="demo-hor-1" placeholder="<?php echo translate('position');?>" class="form-control" value="<?php echo $row['position']; ?>">
																</div>
															</div>
															<div class="form-group">
																<label class="col-sm-2 control-label" for="demo-hor-2">
																	<?php echo translate('image');?>
																</label>
																<div class="col-sm-10">
																	<span class="pull-left btn btn-default btn-file">
																		<?php echo translate('select_image');?>
																		<input type="file" name="team_image" id='team_image' accept="image">
																	</span>
																	<span id='team_image_wrap' class=" show_iin_image" style="width: 200px;float:right; border:1px solid #ddd;border-radius:5px;padding:5px">
																		<?php
																		if($row['team_image'] != ''){
																			if(file_exists('uploads/abdaily_team_image/'.$row['team_image'])){
																		?>
																			<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/<?php echo $row['team_image']; ?>" width="100%" id='team_image_blah' />  
																		<?php
																			} else {
																		?>
																			<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/default.jpg" width="100%" id='team_image_blah' />
																		<?php
																			}
																		}else{?>
																			<img src="<?php echo base_url(); ?>uploads/abdaily_team_image/default.jpg" width="100%" id='team_image_blah' />
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
	
	function team_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#team_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#team_image").change(function() {
		team_image(this);
	});
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>