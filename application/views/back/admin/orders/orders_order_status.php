<div>
	<?php
        echo form_open(base_url() . 'admin/orders/sales/order_status_set/' . $order_id, array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'order_status',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
			<?php
                if($order_status !== ''){
            ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('order_status'); ?></label>
                    <div class="col-sm-6">
						<select name="order_status" onchange="(this.value,this)" class="demo-chosen-select" data-placeholder="Choose a order_status" tabindex="-1" data-hide-disabled="true" id="order_status" style="display: none;">
							<option value="">Choose one</option>
							<?php 
							$ex_update_order_status = explode(",",$update_order_status);
							foreach($order_status as $oss){ ?>
								<option value="<?php echo $oss['order_status_id']; ?>" <?php if(@$orderstatus == $oss['order_status_id']){ echo 'selected'; }?> <?php if(in_array($oss['order_status_id'],$ex_update_order_status)){ echo 'disabled'; }?>><?php echo $oss['order_status_name']; ?></option>
							<?php } ?>
						</select>
                    </div>
                </div>
            <?php
            	}
            ?>
        </div>
    </form>
</div>
<script type="text/javascript">

    $('.demo-chosen-select').chosen();
    $(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>