<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_testimonials');?></h1>
		<?php if($this->crud_model->admin_permission('testimonials_add')){?>
			<?php if(@$category != ''){?>
				<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/manage_website/testimonials_add?c_i=<?php echo @$category; ?>"><?php echo translate('create_testimonials');?> </a>
			<?php }else{ ?>
				<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin/manage_website/testimonials_add"><?php echo translate('create_testimonials');?> </a>
			<?php } ?>
			
		<?php } ?>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('No.');?></th>
										<th><?php echo translate('image');?></th>
										<th><?php echo translate('name');?></th>
										<th><?php echo translate('designation');?></th>
										<th><?php echo translate('status');?></th>
										<?php if($this->crud_model->admin_permission('testimonials_view') || $this->crud_model->admin_permission('testimonials_status')|| $this->crud_model->admin_permission('testimonials_delete')|| $this->crud_model->admin_permission('testimonials_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_testimonials)){
									$i = $page_id+1;
									foreach($all_testimonials as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									<td>
									<?php if($row['testimonials_image'] != ''){
										if(file_exists('uploads/testimonials_image/'.$row['testimonials_image'])){
									?>
										<img src="<?php echo base_url(); ?>uploads/testimonials_image/<?php echo $row['testimonials_image']; ?>" width="100%" id='testimonials_image_blah' style="width:120px;" />  
									<?php
										} else {
									?>
										<img src="<?php echo base_url(); ?>uploads/testimonials_image/default.jpg" width="100%" id='testimonials_image_blah' style="width:120px;" />
									<?php
										}
									}else{?>
										<img src="<?php echo base_url(); ?>uploads/testimonials_image/default.jpg" width="100%" id='testimonials_image_blah' style="width:120px;" />
									<?php } ?> 
									</td>
									<td>
										<?php echo $row['testimonials_name']; ?>
									</td>
									<td>
										<?php echo $row['designation']; ?>
									</td>
									<td>
										<input id="slide_<?php echo $row['testimonials_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['testimonials_id']; ?>" <?php if($row['testimonials_status']=='Active'){ echo 'checked'; } ?> />
									</td>
									<?php if($this->crud_model->admin_permission('testimonials_view') || $this->crud_model->admin_permission('testimonials_status')|| $this->crud_model->admin_permission('testimonials_delete')|| $this->crud_model->admin_permission('testimonials_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('testimonials_view')){ ?>
												<a href="<?php echo base_url(); ?>admin/manage_website/testimonials_view?b_t=<?php echo $row['testimonials_token']; ?>&b_i=<?php echo $row['testimonials_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('testimonials_edit')){ ?>
												<a href="<?php echo base_url(); ?>admin/manage_website/testimonials_edit?b_t=<?php echo $row['testimonials_token']; ?>&b_i=<?php echo $row['testimonials_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="Edit" data-container="body"><?php echo translate('edit');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('testimonials_delete')){ ?>
												<a onclick="delete_popup('<?php echo $row['testimonials_id']; ?>','<?php echo translate('really_wanf_to_delete_this_testimonials ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
var module = 'manage_website/testimonialss';
var delete_function = 'delete';

function set_select(){
	$('.demo-chosen-select').chosen();
	$('.demo-cs-multiselect').chosen({width:'100%'});
}

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
</script>