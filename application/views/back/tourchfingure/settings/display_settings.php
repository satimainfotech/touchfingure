<input type="hidden" name="tab_name" value="<?php echo $tab_name; ?>" id="tab_name"/>
<div id="content-container"> 
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs" style="display:none;">
                    <li>
                        <a data-toggle="tab" href="#tab-2" id="logo"><?php echo translate('logo');?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-3" id="favicon"><?php echo translate('favicon');?></a>
                    </li>
                </ul>
				<div class="tab-content bg_grey">
                	<span id="genset"></span>
                	<div id="tab-2" class="tab-pane fade">
                        <div id="logo_set">
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade">
                         <div id="favicon_set">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<script>
var base_url = '<?php echo base_url(); ?>'
var user_type = 'admin';
var module = 'display_settings/logo_settings';
var list_cont_func = 'show_all';
var dlt_cont_func = 'delete_logo';

$('#logo').on('click',function(){
	$("#logo_set").load("<?php echo base_url()?>admin/display_settings/logo_part/");
});
$('#favicon').on('click',function(){
	$("#favicon_set").load("<?php echo base_url()?>admin/display_settings/favicon_part/");
});
$(document).ready(function() {
	var tab_name= $('#tab_name').val();
	if(tab_name=="logo"){
		$('#logo').click();
	}
	else if(tab_name=="favicon"){
		$('#favicon').click();
	}
	$("form").submit(function(e){
		return false;
	});
});
</script>

<style>
.img-fixed{
	width: 100px;	
}
.cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}
 
.cc-selector input:active +.drinkcard-cc
{
	opacity: 1;
	border:4px solid #169D4B;
}
.cc-selector input:checked +.drinkcard-cc{
	-webkit-filter: none;
	-moz-filter: none;
	filter: none;
	border:4px solid black;
}
.drinkcard-cc{
	cursor:pointer;
	background-size:contain;
	background-repeat:no-repeat;
	display:inline-block;
	-webkit-transition: all .6s ease-in-out;
	-moz-transition: all .6s ease-in-out;
	transition: all .6s ease-in-out;
	-webkit-filter:opacity(.7);
	-moz-filter:opacity(.7);
	filter:opacity(.7);
	border:4px solid transparent;
	border-radius:5px !important;
}
.drinkcard-cc:hover{
	-webkit-filter:opacity(1);
	-moz-filter: opacity(1);
	filter:opacity(1);
	border:4px solid #8400C5;
			
}

</style>