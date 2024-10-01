<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_agent');?></h1>
		<?php if($this->crud_model->admin_permission('agent_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/agent/agent_add"><?php echo translate('add_agent');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="reportfilterdiv">
							<form action="<?php echo base_url(); ?>admin/agent" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
									<label>agent Name</label>
									<input type="text" name="b_n" value="<?php echo @$agent; ?>" placeholder="Sponser Name">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									<?php if(@$agent != ''){ ?>
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/agent">Reset</a>
									<?php } ?>
								</div>
							</form>
						</div>
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('No.');?></th>										
										<th><?php echo translate('agent name');?></th>
										<th><?php echo translate('agent mobile');?></th>
										<th><?php echo translate('agent email');?></th>
										<th><?php echo translate('agent code');?></th>
										<th><?php echo translate('Total Intrest');?></th>										
										<th><?php echo translate('Total Pending Intrest');?></th>
										<th><?php echo translate('Total Due Intrest Payment');?></th>									
										<th><?php echo translate('Total Student');?></th>
										<th><?php echo translate('Total Active Student');?></th>
										<th><?php echo translate('status');?></th>
										<th><?php echo translate('position');?></th>
										<?php if($this->crud_model->admin_permission('agent_view') || $this->crud_model->admin_permission('agent_status')|| $this->crud_model->admin_permission('agent_delete')|| $this->crud_model->admin_permission('agent_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_agent)){
									$i = $page_id+1;
									foreach($all_agent as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									
									<td>
										<?php echo $row['agent_name']; ?>
									</td>
									<td>
										<?php echo $row['agent_mobile']; ?>
									</td>
									<td>
										<?php echo $row['agent_email']; ?>
									</td>
									<td>
										<?php echo $row['agent_code']; ?>
									</td>
									<td>
										<?php
											$this->db->select_sum('agent_margin_amount');
											$this->db->where('agent_id', $row['agent_id']);
											$query = $this->db->get('deal_master');
											$result = $query->row();
											echo $sum_agent_margin_amount = $result->agent_margin_amount;
										?>
									</td>
									<td>
										<?php $this->db->select_sum('student_amount');
											$this->db->where('agent_id', $row['agent_id']);
											$query = $this->db->get('agent_payment');
											$result = $query->row();
											echo $sum_agent_margin_amount - $result->student_amount; ?>
									</td>
									<td>
										<?php 
										$this->db->select('remaining_agent_margin');
										$this->db->where('agent_id', $row['agent_id']);
										$this->db->order_by('agent_payment_id', 'DESC'); // Assuming 'id' is the primary key or 
										$this->db->limit(1); // Limit to one result
										$query = $this->db->get('agent_payment');
										echo $result = $query->row()->remaining_agent_margin;
										  ?>
									</td>
									<td>
									<?php  								
										$this->db->from('deal_master');
										$this->db->where('agent_id', $row['agent_id']);
										echo  $total_students = $this->db->count_all_results();
									
									?>
									</td>
									<td>
										<?php $this->db->from('deal_master');
										$this->db->where('agent_id', $row['agent_id']);
										$this->db->where('deal_status', 'De-active');
										echo  $total_students = $this->db->count_all_results(); ?>
									</td>
									<td>
										<input id="slide_<?php echo $row['agent_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['agent_id']; ?>" <?php if($row['agent_status']=='Active'){ echo 'checked'; } ?> />
									</td>
										<td class="table_input_field">
										<input type="text" name="p_sub_category_<?php echo $row['agent_id']; ?>" id="p_agent_<?php echo $row['agent_id']; ?>" value="<?php if($row['agent_position'] != ''){ echo $row['agent_position']; }else{ echo '0'; }?>"><span class="set_button" id="set_button_<?php echo $row['agent_id']; ?>" onclick="set_agent_position('<?php echo $row['agent_id']; ?>');"><i class="fa fa-check"></i>  Set</span>
									</td>
									<?php if($this->crud_model->admin_permission('agent_view') || $this->crud_model->admin_permission('agent_status')|| $this->crud_model->admin_permission('agent_delete')|| $this->crud_model->admin_permission('agent_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('agent_view')){ ?>
											<a href="<?php echo base_url(); ?>admin/agent/agent_payment?b_t=<?php echo $row['agent_token']; ?>&b_i=<?php echo $row['agent_id']; ?>&b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('Payment');?></a>
												<?php if(@$agent != ''){ ?>
													<a href="<?php echo base_url(); ?>admin/agent/agent_view?b_t=<?php echo $row['agent_token']; ?>&b_i=<?php echo $row['agent_id']; ?>&b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
												<?php }else{ ?>
													<a href="<?php echo base_url(); ?>admin/agent/agent_view?b_t=<?php echo $row['agent_token']; ?>&b_i=<?php echo $row['agent_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
												<?php } ?>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('agent_edit')){ ?>
												<?php if(@$agent != ''){ ?>
													<a href="<?php echo base_url(); ?>admin/agent/agent_edit?b_t=<?php echo $row['agent_token']; ?>&b_i=<?php echo $row['agent_id']; ?>&b_n=<?php echo @$agent; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
												<?php }else{ ?>
													<a href="<?php echo base_url(); ?>admin/agent/agent_edit?b_t=<?php echo $row['agent_token']; ?>&b_i=<?php echo $row['agent_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
												<?php } ?>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('agent_delete')){ ?>
												<a onclick="delete_popup('<?php echo $row['agent_id']; ?>','<?php echo translate('really_wanf_to_delete_this_agent ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
											<?php } ?>
										</td>
									<?php } ?>
								</tr>
								<?php
									}
								}else{ ?>
									<tr style="text-align:center;">
										<td colspan="9">Data Not Found....</td>
									</tr>	
								<?php } ?>
								</tbody>
							</table>
						</div>
						<?php echo $links; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="vendr"></div>
<script>
var base_url = '<?php echo base_url(); ?>'
var user_type = 'admin';
var module = 'agent/agents';
var delete_function = 'delete';
$(document).ready(function(){
	set_switchery();
});
function set_switchery(){
	$(".slide").each(function(){
		new Switchery(document.getElementById('slide_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
		var changeCheckbox = document.querySelector('#slide_'+$(this).data('id'));
		changeCheckbox.onchange = function() {
		  ajax_load(base_url+'index.php/'+user_type+'/'+module+'/status_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'','');
		  if(changeCheckbox.checked == true){
			$.activeitNoty({
				type: 'success',
				icon : 'fa fa-check',
				message : ppus,
				container : 'floating',
				timer : 3000
			});
			
		  } else {
			$.activeitNoty({
				type: 'danger',
				icon : 'fa fa-check',
				message : pups,
				container : 'floating',
				timer : 3000
			});
			
		  }
		};
	});
}
function set_agent_position(agent_id){
	var position_value = $('#p_agent_'+agent_id).val();
	var base_url = $('#base_url').val();
	if(position_value == ''){
		alert('Enter position');
		return false
	}else{
		$.ajax({
			url : base_url+'agent/update_agent_position',
			type: 'POST',
			dataType: 'html',
			data: {agent_id:agent_id,position_value:position_value},
			beforeSend: function() {
				$('#set_button_'+agent_id).html('.....');
			},
			success: function(data){
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Position successfully saved...',
						container : 'floating',
						timer : 3000
					});
				}else{
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'OOPS! Somthing went wrongs...',
						container : 'floating',
						timer : 3000
					});
				}
				$('#set_button_'+sub_category_id).html('<i class="fa fa-check"></i>  Set');
			}
		});
	}
}	

</script>