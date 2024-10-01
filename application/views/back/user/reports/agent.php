<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('Agent Report');?></h1>
		
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