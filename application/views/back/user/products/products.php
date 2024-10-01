<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_products');?></h1>
		<?php if($this->crud_model->admin_permission('products_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/products/products_add"><?php echo translate('add_products');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="reportfilterdiv">
							<form action="<?php echo base_url(); ?>admin/products" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
									<label>products Name</label>
									<input type="text" name="b_n" value="<?php echo @$products; ?>" placeholder="products Name">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									<?php if(@$products != ''){ ?>
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/products">Reset</a>
									<?php } ?>
								</div>
							</form>
						</div>
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('No.');?></th>										
										<th><?php echo translate('products name');?></th>
										<th><?php echo translate('Intrest Rate');?></th>
										<th><?php echo translate('No Of Days');?></th>
										<th><?php echo translate('status');?></th>
										
										<?php if($this->crud_model->admin_permission('products_view') || $this->crud_model->admin_permission('products_status')|| $this->crud_model->admin_permission('products_delete')|| $this->crud_model->admin_permission('products_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_products)){
									$i = $page_id+1;
									foreach($all_products as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									
									<td>
										<?php echo $row['products_name']; ?>
									</td>
									<td>
										<?php echo $row['intrest_rate']; ?>
									</td>
									<td>
										<?php echo $row['days']; ?>
									</td>
									<td>
										<input id="slide_<?php echo $row['products_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['products_id']; ?>" <?php if($row['products_status']=='Active'){ echo 'checked'; } ?> />
									</td>
										
									<?php if($this->crud_model->admin_permission('products_view') || $this->crud_model->admin_permission('products_status')|| $this->crud_model->admin_permission('products_delete')|| $this->crud_model->admin_permission('products_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('products_view')){ ?>
												<?php if(@$products != ''){ ?>
													<a href="<?php echo base_url(); ?>admin/products/products_view?b_t=<?php echo $row['products_token']; ?>&b_i=<?php echo $row['products_id']; ?>&b_n=<?php echo @$products; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
												<?php }else{ ?>
													<a href="<?php echo base_url(); ?>admin/products/products_view?b_t=<?php echo $row['products_token']; ?>&b_i=<?php echo $row['products_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
												<?php } ?>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('products_edit')){ ?>
												<?php if(@$products != ''){ ?>
													<a href="<?php echo base_url(); ?>admin/products/products_edit?b_t=<?php echo $row['products_token']; ?>&b_i=<?php echo $row['products_id']; ?>&b_n=<?php echo @$products; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
												<?php }else{ ?>
													<a href="<?php echo base_url(); ?>admin/products/products_edit?b_t=<?php echo $row['products_token']; ?>&b_i=<?php echo $row['products_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
												<?php } ?>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('products_delete')){ ?>
												<a onclick="delete_popup('<?php echo $row['products_id']; ?>','<?php echo translate('really_wanf_to_delete_this_products ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
var module = 'products/productss';
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
function set_products_position(products_id){
	var position_value = $('#p_products_'+products_id).val();
	var base_url = $('#base_url').val();
	if(position_value == ''){
		alert('Enter position');
		return false
	}else{
		$.ajax({
			url : base_url+'products/update_products_position',
			type: 'POST',
			dataType: 'html',
			data: {products_id:products_id,position_value:position_value},
			beforeSend: function() {
				$('#set_button_'+products_id).html('.....');
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