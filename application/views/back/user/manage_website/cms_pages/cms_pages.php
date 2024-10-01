<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('cms_pages');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="orderstable panel-body">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th><?php echo translate('Sr.no');?></th>
										<th><?php echo translate('page name');?></th>
										<th class="text-right"><?php echo translate('options');?></th>
									</tr>
								</thead>				
								<tbody >
									<tr>
										<td>1</td>
										<td>Home Page</td>
										<td class="text-center">
											<a href="<?php echo base_url(); ?>admin/manage_website/cms_pages/home_page/1" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="home_page_edit" data-container="body"><?php echo translate('edit');?></a>
										</td>
									</tr>
									
									<tr>
										<td>3</td>
										<td>Contact Us</td>
										<td class="text-center">
											<a href="<?php echo base_url(); ?>admin/manage_website/cms_pages/contactus/1" class="btn btn-xs btn-success btn-labeled fa fa-pencil" data-toggle="tooltip" data-original-title="home_page_edit" data-container="body"><?php echo translate('edit');?></a>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="achievement" style="display:none;"></span>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'manage_website/achievements';
	var delete_function = 'delete';
</script>