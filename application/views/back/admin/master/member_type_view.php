<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('member_model_details');?></h1>
		<?php
			if(@$member_type != ''){
		?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/master_manage/member_type?c_n=<?php echo @$member_type; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/master_manage/member_type?c_n=<?php echo @$member_type; ?><?php if(@$page_id == ''){ }else{ echo "&page=$page_id"; } ?>" id="page_return_url">
		<?php }else{ ?>
			<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/master_manage/member_type<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
			<input type="hidden" value="<?php echo base_url(); ?>admin/master_manage/member_type<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>" id="page_return_url">
		<?php } 
		?>
	</div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in">
						<?php 
							foreach($member_type_data as $row)
							{ 
						?>
							<div id="content-container paddingtbzero">
							<div class="row">
								<div class="col-sm-12">
									<div class="panel-body view_table">
										<table class="table table-striped talbeMRb" style="border-radius:3px;">
											<tr>
												<th class="custom_td minwidth210px"><?php echo translate('status');?></th>
												<td class="custom_td"><div class="label label-<?php if($row['member_type_status'] == 'active'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php echo $row['member_type_status']; ?></div></td>
											</tr>
											<tr>
												<th class="custom_td minwidth210px"><?php echo translate('member_type_name');?></th>
												<td class="custom_td"><?php echo $row['member_type_name'];?></td>
											</tr>
											<tr>
												<th class="custom_td minwidth210px"><?php echo translate('fees');?></th>
												<td class="custom_td"><?php echo $row['fees'];?></td>
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