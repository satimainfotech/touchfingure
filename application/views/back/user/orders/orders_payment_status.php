<div>
	<?php
        echo form_open(base_url() . 'admin/orders/sales/delivery_payment_set/' . $order_id, array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'payment_status',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
			<?php
                if($payment_status !== ''){
			?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('payment_status'); ?></label>
                        <div class="col-sm-6">
						<select name="payment_status" onchange="(this.value,this)" class="demo-chosen-select" data-placeholder="Choose a payment status" tabindex="-1" data-hide-disabled="true" id="payment_status" style="display: none;">
							<option value="">Choose one</option>
							<?php 
							$ex_update_order_status = explode(",",$update_payment_status);
							foreach($payment_status_data as $oss){ ?>
								<option value="<?php echo $oss['order_status_id']; ?>" <?php if(@$payment_status == $oss['order_status_id']){ echo 'selected'; }?> <?php if(in_array($oss['order_status_id'],$ex_update_order_status)){ echo 'disabled'; }?>><?php echo $oss['order_status_name']; ?></option>
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
	var payment_status = '<?php echo $payment_status; ?>';
    $('.demo-chosen-select').chosen();
    $('.demo-cs-multiselect').chosen({width:'100%'});
	if(payment_status == 'paid'){
		$("button.enterer").attr("disabled", true);
	}else{
		$('button.enterer').attr('disabled',false);
	}
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	
</script>
<div id="reserve"></div>