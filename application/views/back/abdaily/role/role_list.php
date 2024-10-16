<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="false" data-show-columns="false" data-search="true" >

        <thead>
            <tr>
                <th><?php echo translate('no');?></th>
                <th><?php echo translate('name');?></th>
                <?php if($this->crud_model->admin_permission('staff_role_edit') || $this->crud_model->admin_permission('staff_role_delete')){?>
				<th class="text-right"><?php echo translate('options'); ?></th>
				<?php } ?>
            </tr>
        </thead>
            
        <tbody >
        <?php
            $i = 0;
            foreach($all_roles as $row){
                $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?></td>
			<?php if($this->crud_model->admin_permission('staff_role_edit') || $this->crud_model->admin_permission('staff_role_delete')){?>
				<td class="text-right">
					<?php if($row['role_id'] != '1'){ ?>
						<?php if($this->crud_model->admin_permission('staff_role_edit')){?>
							<a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" onclick="ajax_set_full('edit','<?php echo translate('edit_role'); ?>','<?php echo translate('successfully_edited!'); ?>','role_edit','<?php echo $row['role_id']; ?>')" data-original-title="Edit" data-container="body"> <?php echo translate('edit');?> </a>
						<?php } ?>
						<?php if($this->crud_model->admin_permission('staff_role_delete')){?>
							<a onclick="delete_confirm('<?php echo $row['role_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" data-container="body"> <?php echo translate('delete');?> </a>
						<?php } ?>
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