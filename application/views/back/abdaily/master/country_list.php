	<div class="panel-body" id="demo_s">
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="false" data-show-columns="false" data-search="true" >

			<thead>
				<tr>
					<th><?php echo translate('no');?></th>
					<th><?php echo translate('country_name');?></th>
					<?php if($this->crud_model->admin_permission('country_edit') || $this->crud_model->admin_permission('country_delete')){?>
					<th class="text-right"><?php echo translate('options');?></th>
					<?php } ?>
				</tr>
			</thead>
				
			<tbody >
			<?php
				$i = 0;
            	foreach($all_country as $row){
            		$i++;
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $row['country_name']; ?></td>
				<?php if($this->crud_model->admin_permission('country_edit') || $this->crud_model->admin_permission('country_delete')){?>
					<td class="text-right">
						<?php if($this->crud_model->admin_permission('country_edit')){?>
							<a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" href="<?php echo base_url(); ?>admin/master_manage/country/edit/<?php echo $row['country_id']; ?>" > <?php echo translate('edit');?> </a>
						<?php } ?>
						<?php if($this->crud_model->admin_permission('country_delete')){?>
							<a onclick="delete_confirm('<?php echo $row['country_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"> <?php echo translate('delete');?>
							</a>
						<?php } ?>
					</td>
				<?php } ?>
				
			</tr>
            <?php
            	}
			?>
			</tbody>
		</table>
	</div>