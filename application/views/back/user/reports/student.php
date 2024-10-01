<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_student');?></h1>
		
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="reportfilterdiv">
							<form action="<?php echo base_url(); ?>admin/deal" method="get">
							    <div class="col-sm-3">
							        	<label>Agent Name</label>
															<select name="agent_id" class="demo-chosen-select" data-placeholder="Choose a Agent" id="agent_id" >
																<option value="">Choose Agent</option>
																<?php foreach($agent_data as $a_row){ 
																?>
																	<option value="<?php echo $a_row['agent_id']; ?>" ><?php echo $a_row['agent_name']; ?></option>
																<?php } ?>
															</select>
														</div>
								 <div class="col-sm-3">
								     	<label>Investor Name</label>
															<select name="company_id" class="demo-chosen-select" data-placeholder="Choose a Investor" id="company_id" >
																<option value="">Choose Investor</option>
																<?php foreach($investor_data as $invest_row){ 
																?>
																	<option value="<?php echo $invest_row['investor_id']; ?>" ><?php echo $invest_row['investor_name']; ?></option>
																<?php } ?>
															</select>
														</div>
								<div style="display:none;" class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
									<label>deal Name</label>
									<input type="text" name="b_n" value="<?php echo @$deal; ?>" placeholder="Sponser Name">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/deal">Reset</a>
									
								</div>
							</form>
						</div>
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('No.');?></th>		
																
										<th><?php echo translate('Student name');?></th>
										<th><?php echo translate('Student mobile');?></th>
										<th><?php echo translate('loan amount');?></th>
										<th><?php echo translate('loan remaining amount');?></th>
										<th><?php echo translate('Product Name');?></th>
										<th><?php echo translate('Agent name');?></th>
										<th><?php echo translate('Agent Percentage');?></th>											
										<th><?php echo translate('Agent Marign Amount');?></th>
										<th><?php echo translate('Investor Name');?></th>
										<th><?php echo translate('Investor Percentage');?></th>										
										<th><?php echo translate('Investor Margin Amount');?></th>
										<th><?php echo translate('deal_date');?></th>
										<th><?php echo translate('Expiry_date');?></th>
										
										
										
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_deal)){
									$i = $page_id+1;
									foreach($all_deal as $row){										
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									<td>
										<?php echo $row['student_name']; ?>
									</td>
									<td>
										<?php echo $row['student_mobile']; ?>
									</td>
									<td>
										<?php echo $row['loan_amount']; ?>
									</td>
									<td>
										<?php echo $row['loan_final_amount']; ?>
									</td>
									<td>
										<?php echo $row['product_name']; ?>
									</td>
									<td>
										<?php echo $row['agent_name']; ?>
									</td>
									<td>
										<?php echo $row['agent_intrest_rate']; ?>%
									</td>
									<td>
										<?php echo $row['agent_margin_amount']; ?> 
									</td>
									<td>
										<?php echo $row['investor_name']; ?>
									</td>
									<td>
										<?php echo $row['investor_intrest_rate']; ?>%
									</td>
									<td>
										<?php echo $row['investor_margin_amount']; ?> 
									</td>
									<td>
										<?php echo date("d-m-Y",strtotime($row['deal_date'])); ?> 
									</td>
									
									<td>
										<?php echo @$row['deal_expiry_date']; ?>
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
var module = 'deal/deals';
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
function set_deal_position(deal_id){
	var position_value = $('#p_deal_'+deal_id).val();
	var base_url = $('#base_url').val();
	if(position_value == ''){
		alert('Enter position');
		return false
	}else{
		$.ajax({
			url : base_url+'deal/update_deal_position',
			type: 'POST',
			dataType: 'html',
			data: {deal_id:deal_id,position_value:position_value},
			beforeSend: function() {
				$('#set_button_'+deal_id).html('.....');
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