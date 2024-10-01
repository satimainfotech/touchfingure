<div class="onactionloader" id="onactionloader" style="display:none"></div>
<div id="allmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="text-align:center;">
		<div class="modal-content">
			<div class="modal-body" id="action_data">
				
			</div>
		</div>
	</div>
</div>
<footer id="footer">
    <p class="pad-lft">&#0169; 2019 - <?php echo date('Y'); ?> <?php echo $system_title;?></p>
</footer>
<script>
$(document).ready(function () {
	$(".number").keypress(function (e) {
	 	var charCode = (e.which) ? e.which : e.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
   });
});
</script>