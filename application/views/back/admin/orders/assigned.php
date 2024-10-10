<style>
	.orderDetails.conatiner .col-sm-6,
	.orderDetails.conatiner .col-sm-12 {
    border-bottom: 1px solid #FF9800;
    padding: 10px 10px;
}
</style>
<div id="form">  
<div class="tab-pane fade active in" id="edit">
<?php 
foreach($admin_data as $data){
?>	
<div class="orderDetails conatiner">
<div class="row">
	<div class="col-sm-12">Description:<br/><?=$data['job_description'];?></div>
	<div class="col-sm-6">Drawing:<br/><?=$data['drawing_no'];?></div>
	<div class="col-sm-6">Qty:<br/><?=$data['qty'];?></div>
	<div class="col-sm-6">Material:<br/><?=$data['material'];?></div>
	<div class="col-sm-6">Size:<br/><?=$data['proposed_raw_material_size'];?></div>
	<div class="col-sm-6">ID no from:<br/><?=$data['id_no_from'];?></div>
	<div class="col-sm-6">ID no to:<br/><?=$data['id_no_to'];?></div>
	<div class="col-sm-6">Project:<br/><?=$data['project'];?></div>
	<div class="col-sm-6">Model:<br/><?=$data['model'];?></div>
</div>
<br/>
<?php
echo form_open(base_url() . 'admin/orders/assignto/' . $data['orderno'], array(
	'class' => 'form-horizontal',
	'method' => 'post',
	'id' => 'order_assign'
));
?>
<div class="form-group col-sm-12">
<h4>Assing to:</h4>
<?php
$this->db->select('admin_id,name,pm_id');
$this->db->where('pm_id IS NOT NULL');
$this->db->where('role !=', 1);
$admin = $this->db->get('admin')->result_array();
?>
<select id="assignto" class="form-control demo-chosen-select required" name="assignto">
	<option value="">-select-</option>
	<?php 
	foreach($admin as $a)
	{
	?>
	<option value="<?php echo $a['admin_id'];?>"><?php echo $a['name'];?>- <?php echo $this->crud_model->get_type_name_by_id('process_master',$a['pm_id'],'pm_name'); ?></option>
	<?php
	}
	?>
</select>
<?php
}
?>
</form>
</div></div></div>
<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			return false;
		});
		$('.demo-chosen-select').chosen();
		$('.demo-cs-multiselect').chosen({width:'100%'});
	});
	</script>