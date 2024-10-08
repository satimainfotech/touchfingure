<div id="content-container">/

	<div id="page-title">

		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('view_our_network_information');?></h1>
		<a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn custombutton" href="<?php echo base_url(); ?>admin/abdaily/manage_website/our_network<?php if(@$page_id == ''){ }else{ echo "?page=$page_id"; } ?>"><?php echo translate('back');?> </a>
	</div>

	<div class="tab-base">

		<div class="panel">

			<div class="panel-body">

				<div class="tab-content">

					<div class="tab-pane fade active in" id="list">

						<div class="viewpages panel-body">

							<?php

								foreach($our_network_data as $row){

							?>

								<div id="content-container paddingtbzero">

									<div class="row">

										<div class="col-sm-12">

											<div class="panel-body">

												<table class="table table-striped talbeMRb" style="border-radius:3px;">
													<tr>

														<th class="custom_td min_width"><?php echo translate('state');?></th>

														<td class="custom_td"><?php echo $row['our_net_state'];?></td>

													</tr>
													<tr>

														<th class="custom_td min_width"><?php echo translate('name');?></th>

														<td class="custom_td"><?php echo $row['our_net_title'];?></td>

													</tr>
													<tr>

														<th class="custom_td min_width"><?php echo translate('Address');?></th>
														<td class="custom_td"><?php echo $row['our_net_address'];?></td>

													</tr>
													<tr>

														<th class="custom_td min_width"><?php echo translate('contact');?></th>

														<td class="custom_td"><?php echo $row['our_net_contact'];?></td>

													</tr>

													<tr>

														<th class="custom_td min_width"><?php echo translate('status');?></th>

														<td class="custom_td"><div class="label label-<?php if($row['our_net_status'] == 'Active'){ ?>purple<?php } else { ?>danger<?php } ?>"><?php if($row['our_net_status'] == 'Active'){echo 'Active';}else{echo 'De-active';} ?></div></td>

													</tr>
													
													<tr>

														<th class="custom_td min_width"><?php echo translate('map');?></th>

														<td class="custom_td">
														<iframe src="<?php echo $row['our_net_map'];?>" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
														</td>

													</tr>
													
												</table>

											</div>

										</div>

									</div>					

								</div>

							<?php } ?>

						</div>

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

.min_width{

	min-width:150px;

}

.custom_td{

	border-left: 1px solid #ddd;

	border-right: 1px solid #ddd;

	border-bottom: 1px solid #ddd;

}

</style>