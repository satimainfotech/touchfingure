<div>
    <?php
		echo form_open(base_url() . 'admin/staff/role/do_add/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'role_add'
		));
	?>
        <div class="panel-body">
            <div class="form-group margin-top-15">
                <label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('name'); ?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" class="form-control required" placeholder="<?php echo translate('name'); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="demo-hor-2"><?php echo translate('description'); ?></label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control required" placeholder="<?php echo translate('description'); ?>" ></textarea>
                </div>
            </div>
			<div class="form-group">
				<label class="col-sm-2 control-label" for="demo-hor-3"><?php echo translate('permissions'); ?></label>
				<div class="col-sm-6">
					<ul class="roleul">
						<?php 
						foreach($all_permissions as $row1){
						?>
							<li class="<?php if($row1['parent_status'] == 'parent'){ echo 'parent_item'; }else if($row1['parent_status'] == 'sub_parent'){ echo 'sub_parent_item'; }else{ echo 'sub_child';}?>">
								<div class="col-sm-12 paddingallzero">
									<div class="col-sm-6 paddingallzero">
										<h4 ><?php echo ucfirst($row1['name']); ?></h4>
									</div>
									<div class="col-sm-6 paddingallzero text-right">
										<input id="per_<?php echo $row1['permission_id']; ?>" class='sw2' type="checkbox" name="permission[]"  value="<?php echo $row1['permission_id']; ?>" data-id='<?php echo $row1['permission_id']; ?>' />
									</div>
								</div>
							</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-1">
                    <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left" 
                        onclick="ajax_set_full('add','<?php echo translate('add_role'); ?>','<?php echo translate('successfully_added!'); ?>','role_add','')">
                        	<?php echo translate('reset');?>
                    </span>
                </div>
                
                <div class="col-md-1">
                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left" 
                    	onclick="form_submit('role_add')" >
                        	<?php echo translate('save');?>
                    </span>
                </div>
            </div>
        </div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			return false;
		});
		$(".sw2").each(function(){
			new Switchery(document.getElementById('per_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
		});
	});
</script>