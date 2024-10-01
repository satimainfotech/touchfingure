	<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('edit_agent');?></h1>
		<?php if(@$agent != ''){ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/agent?b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/agent?b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/agent<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/agent<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="return_url">
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								foreach($agent_data as $row){
							?>
								<?php
									echo form_open(base_url() . 'admin/agent/agent_add_payment/' . $row['agent_id'], array(
										'class' => 'form-horizontal',
										'method' => 'post',
										'id' => 'agent_edit',
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
																	<label class="control-label" for="demo-hor-1"><?php echo $row['agent_name']; ?></label>
																</div>
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('agent mobile');?></label>
																<div class="col-sm-10">
																<label class="control-label" for="demo-hor-1"><?php echo $row['agent_mobile']; ?></label>
																	
															</div>
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Total Margin Amount');?></label>
																<div class="col-sm-10">
																	<?php
																	$this->db->select_sum('agent_margin_amount');
																	$this->db->where('agent_id', $row['agent_id']);
																	$query = $this->db->get('deal_master');
																	$result = $query->row();
																	echo $sum_agent_margin_amount = $result->agent_margin_amount;
																	?>
																</div>
															</div>
															
															<div class="form-group ">
																<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('Payment');?></label>
																<div class="col-sm-10">
																	<input type="text" name="agent_payment" id="agent_payment" placeholder="<?php echo translate('agent_payment');?>" class="form-control required" value="">
																	<input type="text" name="agent_id" id="agent_id" placeholder="<?php echo translate('agent_id');?>" class="form-control " value="<?php echo $row['agent_id']; ?>">
																	<input type="text" name="agent_name" id="agent_name" placeholder="<?php echo translate('agent_name');?>" class="form-control " value="<?php echo $row['agent_name']; ?>">
																	<input type="text" name="agent_total_pending_amount" id="agent_total_pending_amount" placeholder="<?php echo translate('agent_name');?>" class="form-control " value="<?php echo $sum_agent_margin_amount; ?>">
																	
																</div>
															</div>
															
														
															
																<table class="table table-bordered" id="new_options">
    <thead>
        <tr>
            <th><?php echo translate('Checkbox');?></th>
            <th><?php echo translate('Student Name');?></th>
            <th><?php echo translate('Margin Amount');?></th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($agent_student_data as $ag_prod){
			?>                                                        
            <tr id="options<?php echo $i;?>">
                <td>
                    <input type="checkbox" name="student_id[]" value="<?php echo $ag_prod['deal_id'];?>" data-agent-margin="<?php echo $ag_prod['agent_margin_amount'];?>" class="agent-checkbox">
                </td>
               
                <td>
                    <input value="<?php echo $ag_prod['student_name'];?>" type="text" name="student_name[]" class="form-control required" readonly>
                </td>
                <td>
                    <input value="<?php echo $ag_prod['agent_margin_amount'];?>" type="text" name="amount[]" class="form-control required" readonly>
                </td>
            </tr>
        <?php $i++; } ?>
    </tbody>
</table>


<!-- Input field to display the total sum -->
<div class="col-sm-12 paddingzeroall">
    <label>Total Agent Margin:</label>
    <input type="text" id="total-agent-margin" name="total_agent_margin" readonly class="form-control">
</div>
<div class="col-sm-12 paddingzeroall">
    <label>Remaining Agent Margin:</label>
    <input type="text" id="remaining-agent-margin" name="remaining_agent_margin" readonly class="form-control">
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
											<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-left enterer" onclick="ajax_form_submit('agent_edit','<?php echo translate('successfully_edited!'); ?>','agent');" ><?php echo translate('update');?></span> 
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

$(document).ready(function(){
    $('.agent-checkbox').on('click', function() {
        var total = parseFloat($('#total-agent-margin').val()) || 0; // Get current total, default to 0
        var agentPayment = parseFloat($("#agent_payment").val()); // Get agent payment value
        var currentValue = parseFloat($(this).data('agent-margin')); // Get current checkbox value
		var agent_total_pending_amount= parseFloat($('#agent_total_pending_amount').val());
var remianing_amount = 0;
if(agentPayment>agent_total_pending_amount)
		{
			$("#agent_payment").val('');
			alert("The total is greater than pending amount");
			 $(this).prop('checked', false); 
			
		}
		else
		{
        if ($(this).is(':checked')) {
            // If the checkbox is checked, add its value to the total
            total += currentValue;

            // If the new total exceeds agentPayment, uncheck the checkbox and revert the total
            if (total > agentPayment) {
                $(this).prop('checked', false); // Uncheck the checkbox
                total -= currentValue; // Revert the total
				remianing_amount = 0;

                alert("The total margin exceeds the agent's payment limit. This option has been unselected.");
            }
        } else {
            // If the checkbox is unchecked, subtract its value from the total
            total -= currentValue;
        }

        // Update the total in the input field
        $('#total-agent-margin').val(total.toFixed(2));
		
		
		if(agentPayment<=agent_total_pending_amount)
		{
			remianing_amount = (parseFloat(agentPayment) - parseFloat(total))|| 0;
		}
		
		
		 $('#remaining-agent-margin').val(remianing_amount.toFixed(2));
		}
    });
});


	
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