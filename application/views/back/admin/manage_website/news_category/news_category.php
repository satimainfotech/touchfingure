<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_news_category');?></h1>
		<?php if($this->crud_model->admin_permission('news_category_add')){?>
			<a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right custombutton" href="<?php echo base_url(); ?>admin//manage_website/news_category_add"><?php echo translate('create_news_category');?> </a>
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
										<th><?php echo translate('status');?></th>
										<?php if($this->crud_model->admin_permission('news_category_view') || $this->crud_model->admin_permission('news_category_status')|| $this->crud_model->admin_permission('news_category_delete')|| $this->crud_model->admin_permission('news_category_edit')){?>
											<th class="text-right"><?php echo translate('options');?></th>
										<?php } ?>
									</tr>
								</thead>				
								<tbody >
								<?php
								if(!empty($all_news_category)){
									$i = $page_id+1;
									foreach($all_news_category as $row){
								?>                
								<tr>
									<td><?php echo $i++; ?></td>
									<td>
									<img class="img-md"  src="<?php echo base_url();  ?>uploads/news_category_image/<?php echo $row['news_category_image']; ?>"  style="width:120px;"/>
									</td>
									<td>
										<?php echo $row['news_category_name']; ?>
									</td>
									<td>
										<input id="slide_<?php echo $row['news_category_id']; ?>" class="slide" type="checkbox" data-id="<?php echo $row['news_category_id']; ?>" <?php if($row['news_category_status']=='yes'){ echo 'checked'; } ?> />
									</td>
									<?php if($this->crud_model->admin_permission('news_category_view') || $this->crud_model->admin_permission('news_category_status')|| $this->crud_model->admin_permission('news_category_delete')|| $this->crud_model->admin_permission('news_category_edit')){?>
										<td class="text-right">
											<?php if($this->crud_model->admin_permission('news_category_view')){ ?>
												<a href="<?php echo base_url(); ?>admin//manage_website/news_category_view?b_c_t=<?php echo $row['news_category_token']; ?>&b_c_i=<?php echo $row['news_category_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="proof" data-container="body"><?php echo translate('view');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('news_category_edit')){ ?>
												<a href="<?php echo base_url(); ?>admin//manage_website/news_category_edit?b_c_t=<?php echo $row['news_category_token']; ?>&b_c_i=<?php echo $row['news_category_id']; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="Edit" data-container="body"><?php echo translate('edit');?></a>
											<?php } ?>
											<?php if($this->crud_model->admin_permission('news_category_delete')){ ?>
												<a onclick="delete_popup('<?php echo $row['news_category_id']; ?>','<?php echo translate('really_wanf_to_delete_this_news_category ?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"><?php echo translate('delete');?></a>
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
var user_type = 'admin/abdaily';
var module = 'manage_website/news_categorys';
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
	
</script>