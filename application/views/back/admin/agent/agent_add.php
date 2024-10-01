<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('add_agent');?></h1>
		<?php if(@$agent != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/agent?c_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/agent<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin/agent/agent_do_add/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'agent_add',
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
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent name');?></label>
															<div class="col-sm-10">
																<input type="text" name="agent_name" id="demo-hor-1" placeholder="<?php echo translate('Agent name');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent mobile');?></label>
															<div class="col-sm-10">
																<input type="text" name="agent_mobile" id="demo-hor-1" placeholder="<?php echo translate('agent_mobile');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent email');?></label>
															<div class="col-sm-10">
																<input type="text" name="agent_email" id="demo-hor-1" placeholder="<?php echo translate('agent_email');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent Address');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="agent_address" id="agent_address" placeholder="<?php echo translate('agent_address');?>" class="form-control required"></textarea>
															</div>
														</div>
															<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent code');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="agent_code" id="agent_code" placeholder="<?php echo translate('agent_code');?>" class="form-control required"></textarea>
															</div>
														</div>
															<div class="form-group " style="display:none;">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent intrest rate');?></label>
															<div class="col-sm-10">
																<textarea type="text" name="agent_intrest_rate" id="agent_intrest_rate" placeholder="<?php echo translate('agent_intrest_rate');?>" class="form-control "></textarea>
															</div>
														</div>
														<div class="form-group" style="display:none;">
														<label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('Bank branch');?></label>
														<div class="col-sm-10">
															<select name="bank_id" class="demo-chosen-select" data-placeholder="Choose a Branch" id="bank_id" >
																<option value="">Choose Bank - branch - ifsc code </option>
																<?php foreach($bank_data as $b_row){ 
																?>
																	<option value="<?php echo $b_row['bank_id']; ?>" ><?php echo $b_row['bank_name']; ?>-<?php echo $b_row['branch_name']; ?>- <?php echo $b_row['ifsc_code']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<div class="col-sm-12 col-xs-12 paddingzeroall">
															
																<input type="hidden" id="added_new_option_ids" name="added_new_option_ids" value="1">
																<input type="hidden" id="added_total_new_options" name="added_total_new_options" value="1">
															</div>
															<div class="col-sm-12 paddingzeroall" id="new_options">
																<div class="col-sm-12 paddingzeroall pb-5" id="options1" style="float: left;width: 100%;">
																	<input type="hidden" id="new_option_new_idss" value="1">
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('product');?></label>
																			<select name="product[]" class="demo-chosen-select required" data-placeholder="Choose a Product" id="title_1" >
																			<option value="">Choose any product </option>
																			<?php foreach($products_data as $p_row){ 
																			?>
																			<option value="<?php echo $p_row['products_id']; ?>-<?php echo $p_row['products_name']; ?>" ><?php echo $p_row['products_name']; ?></option>
																			<?php } ?>
																			</select>
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('intrest rate');?></label>
																		<input value="0" type="text" name="intrest_rate[]" id="demo-hor-1" placeholder="<?php echo translate('intrest rate');?>" class="form-control required">
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('Days');?></label>
																		<input value="1" type="text" name="days[]" id="demo-hor-1" placeholder="<?php echo translate('intrest rate');?>" class="form-control required">
																	</div>
																	<div class="col-sm-2 col-xs-2 paddingonlyfive">
																		<label class="var_label"><?php echo translate('Due Date Intrest');?></label>
																		<input value="0" type="text" name="due_intrest[]" id="demo-hor-1" placeholder="<?php echo translate('Due Date Intrest Rate');?>" class="form-control required">
																	</div>
																	
																	<div class="col-sm-2 col-xs-2">
																		<span class="add_new_button" onclick="open_new_options();"><i class="fa fa-plus"></i></span>
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
								<div class="panel-footer">
									<div class="row">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " 
											onclick="page_reload(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="ajax_form_submit('agent_add','<?php echo translate('agent_has_been_added!'); ?>','agent');"><?php echo translate('submit');?></span>
									</div>
								</div>
							</form>
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
	
	function agent_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#agent_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#agent_image").change(function() {
		agent_image(this);
	});
	
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	
	function open_new_options(){
		var added_row_id = $('#added_new_option_ids').val();
		var added_total_new_option = $('#added_total_new_options').val();
		var new_row_id = parseInt(added_total_new_option)+1;
		$('#new_options').append("<div class='col-sm-12 paddingzeroall pb-5' id='options"+new_row_id+"' style='float: left;width: 100%;'><input type='hidden' id='new_option_new_idss' value='"+new_row_id+"'><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('product');?></label><select name='product[]' class='demo-chosen-select required' data-placeholder='Choose a Products' id='title_'"+new_row_id+"'><option value=''>Choose any product </option><?php foreach($products_data as $p_row){?><option value='<?php echo $p_row['products_id']; ?>'><?php echo $p_row['products_name']; ?></option><?php } ?></select></div><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('intrest_rate');?></label><input type='text' name='intrest_rate[]' value='0' id='demo-hor-1' placeholder='<?php echo translate('intrest_rate');?>' class='form-control required'></div><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('Days');?></label><input value='1'  type='text' name='days[]' id='demo-hor-1' placeholder='<?php echo translate('intrest rate');?>' class='form-control required'></div><div class='col-sm-2 col-xs-2 paddingonlyfive'><label class='var_label'><?php echo translate('Due Date Intrest');?></label><input value='0'  type='text' name='due_intrest[]' id='demo-hor-1' placeholder='<?php echo translate('Due Date Intrest Rate');?>' class='form-control required'></div><div class='col-sm-2 col-xs-4'><span class='remove_button' onclick='remove_new_options("+new_row_id+");'><i class='fa fa-minus'></i></span></div></div>");
		$('#added_total_new_options').val(new_row_id);
		
		
		
		var selected = new Array();
		$('#new_options #new_option_new_idss').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_ids').val(selected.join(','));
		$('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
	}
	
	function remove_new_options(remove_id){
		var added_new_option_id = $('#options'+remove_id).remove();
		var selected = new Array();
		$('#new_options #new_option_new_idss').each(function () {
			selected.push(this.value);
		});
		$('#added_new_option_ids').val(selected.join(','));
	}
</script>