<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_category');?></h1>
		<?php if($this->crud_model->admin_permission('category_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/category/category_add"><?php echo translate('create_category');?> </a>
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="reportfilterdiv">
							<form action="<?php echo base_url(); ?>admin/category" method="get">
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px searchboxs">
									<label>Category Name</label>
									<input type="text" name="c_n" value="<?php echo @$category; ?>" placeholder="Category Name">
								</div>
								<div class="col-sm-2 col-xs-6 paddingonlyfive m-b-5px">
									<button class="reportbutton">Search</button>
									<?php if(@$category != ''){ ?>
										<a class="creportbutton" href="<?php echo base_url(); ?>admin/category">Reset</a>
									<?php } ?>
								</div>
							</form>
						</div>
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('No.');?></th>
										<th><?php echo translate('image');?></th>
										<th><?php echo translate('name');?></th>
										<th><?php echo translate('status');?></th>
										<th><?php echo translate('position');?></th>
										<?php if($this->crud_model->admin_permission('category_view') || $this->crud_model->admin_permission('category_status')|| $this->crud_model->admin_permission('category_delete')|| $this->crud_model->admin_permission('category_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_category)){
									$i = $page_id+1;
									foreach($all_category as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									<td>
									<img class="img-md"  src="<?php echo base_url();  ?>uploads/category_image/<?php echo $row['category_image']; ?>"  style="width:120px;"/>
									</td>
									<td>
										<?php echo $row['category_name']; ?>
									</td>
									<td>
										<input id="slide_<?php echo $row['category_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['category_id']; ?>" <?php if($row['category_status']=='Active'){ echo 'checked'; } ?> />
									</td>
									<td class="table_input_field">
										<input type="text" name="p_category_<?php echo $row['category_id']; ?>" id="p_category_<?php echo $row['category_id']; ?>" value="<?php if($row['category_position'] != ''){ echo $row['category_position']; }else{ echo '0'; }?>"><span class="set_button" id="set_button_<?php echo $row['category_id']; ?>" onclick="set_category_position('<?php echo $row['category_id']; ?>');"><i class="fa fa-check"></i>  Set</span>
									</td>
									<?php if($this->crud_model->admin_permission('category_view') || $this->crud_model->admin_permission('category_status')|| $this->crud_model->admin_permission('category_delete')|| $this->crud_model->admin_permission('category_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('category_view')){ ?>
												<?php if(@$category != ''){ ?>
													<a href="<?php echo base_url(); ?>admin/category/category_view?c_t=<?php echo $row['category_token']; ?>&c_i=<?php echo $row['category_id']; ?>&c_n=<?php echo @$category; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
												<?php }else{ ?>
													<a href="<?php echo base_url(); ?>admin/category/category_view?c_t=<?php echo $row['category_token']; ?>&c_i=<?php echo $row['category_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-eye" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
												<?php } ?>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('category_edit')){ ?>
												<?php if(@$category != ''){ ?>
													<a href="<?php echo base_url(); ?>admin/category/category_edit?c_t=<?php echo $row['category_token']; ?>&c_i=<?php echo $row['category_id']; ?>&c_n=<?php echo @$category; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
												<?php }else{ ?>
													<a href="<?php echo base_url(); ?>admin/category/category_edit?c_t=<?php echo $row['category_token']; ?>&c_i=<?php echo $row['category_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('edit');?></a>
												<?php } ?>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('category_delete')){ ?>
												<a onclick="delete_popup('<?php echo $row['category_id']; ?>','<?php echo translate('really_wanf_to_delete_this_category ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
var module = 'category/categorys';
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
function set_category_position(category_id){
	var position_value = $('#p_category_'+category_id).val();
	var base_url = $('#base_url').val();
	if(position_value == ''){
		alert('Enter position');
		return false
	}else{
		$.ajax({
			url : base_url+'category/update_category_position',
			type: 'POST',
			dataType: 'html',
			data: {category_id:category_id,position_value:position_value},
			beforeSend: function() {
				$('#set_button_'+category_id).html('.....');
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
				$('#set_button_'+category_id).html('<i class="fa fa-check"></i>  Set');
			}
		});
	}
}		
</script>