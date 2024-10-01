<div>
	<?php
        echo form_open(base_url() . 'admin/slider/slides/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'slides_add',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('slide_banner');?></label>
                <div class="col-sm-6">
                    <span class="pull-left btn btn-default btn-file">
                        <?php echo translate('select_slide_banner');?>
                        <input type="file" name="img" id='imgInp' accept="image">
                    </span>
                    <br><br>
                    <span id='wrap' class="pull-left" >
                        <img src="<?php echo base_url(); ?>uploads/others/photo_default.jpg" 
                        	width="100%" id='blah' > 
                    </span>
                </div>
            </div>
        </div>
	</form>
</div>

<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>

<script>
$(document).ready(function() {
	createColorpickers();
});

function createColorpickers(){

	$('.demo2').colorpicker({
		format: 'rgba'
	});
	
}
</script>