<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('division_details');?></h1>
		<?php
			if(@$country != '' || @$state != '' || @$division != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/division?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&c_n=<?php echo @$division; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/master_manage/division?c_i=<?php echo @$country; ?>&s_i=<?php echo @$state; ?>&c_n=<?php echo @$division; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="page_return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/master_manage/division<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/abdaily/master_manage/division<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="page_return_url">
		<?php } 
		?>
	</div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php 
							foreach($division_data as $row)
							{ 
						?>
							<div id="content-container paddingtbzero">
							<div class="row">
								<div class="col-sm-12">
									<div class="panel-body view_table">
										<table class="table table-striped talbeMRb" style="border-radius:3px;">
											<tr>
												<th class="custom_td minwidth210px"><?php echo translate('status');?></th>
												<td class="custom_td"><div class="label label-<?php if($row['division_status'] == 'active'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php echo $row['division_status']; ?></div></td>
											</tr>
											<tr>
												<th class="custom_td minwidth210px"><?php echo translate('state_name');?></th>
												<td class="custom_td"><?php echo $row['state_name'];?></td>
											</tr>
											<tr>
												<th class="custom_td minwidth210px"><?php echo translate('division_name');?></th>
												<td class="custom_td"><?php echo $row['division_name'];?></td>
											</tr>
										</table>
									  </div>
									</div>
								</div>					
							</div>					
						<?php 
							}
						?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>       
<style>
.custom_td{
border: 1px solid #ddd !important;
max-width:150px;
min-width:150px;
width:150px;
}
.table {
    width: auto !important;
    max-width: 100%;
    margin-bottom: 20px;
	min-width: 50% !important;
}
</style>