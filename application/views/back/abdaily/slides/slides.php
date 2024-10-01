<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_main_slider');?></h1>
		<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right custombutton" onclick="ajax_modal('add','<?php echo translate('add_slides'); ?>','<?php echo translate('successfully_added!');?>','slides_add','')"> <?php echo translate('create_slides');?> </button>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'slider/slides';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';

	$(document).ready(function(){
        $(".sw").each(function(){
            var h = $(this);
            var id = h.attr('id');
            var set = h.data('set');
            new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = document.querySelector('#'+id);
            changeCheckbox.onchange = function() {
              ajax_load(base_url+'index.php/'+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','othersd');
              if(changeCheckbox.checked == true){
                $.activeitNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : s_e,
                    container : 'floating',
                    timer : 3000
                });
                
              } else {
                $.activeitNoty({
                    type : 'danger',
                    icon : 'fa fa-check',
                    message : s_d,
                    container : 'floating',
                    timer : 3000
                });
                
              }
            };
        });
    }); 
</script>