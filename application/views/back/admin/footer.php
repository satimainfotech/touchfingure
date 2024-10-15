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
<!-- Bootstrap Modal -->
<div class="modal fade" id="notificationModalball" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel">New Order Assigned</h5>
      </div>
      <div class="modal-body text-center">
        <h2 class="textnotifyp">You have new notifications. Do you want to mark them as read?</h2>
	</div>
    </div>
  </div>
</div>
<script>

function StopYesterday() {
          $.ajax({
              url: '<?php echo site_url();?>/admin/orders/stopyesterday',  // Update this URL
              method: 'POST',
              dataType: 'json',
              success: function(response) {
                  if (response.status === 'success') {
                      alert(response.notification_content);
            location.reload(true);
                  }
              }
          });
      }
      StopYesterday();
</script>
<?php 
if($_SESSION['role'] !=1){?>
<script>
 
	 $(document).ready(function(){
        function checkNotifications() {
			$('#notificationModalball').modal('hide');
            $.ajax({
                url: base_url+'/admin/orders/get_notification_count',  // Update this URL
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.count > 0) {
							// Play sound alert
							$('#notificationModalball').modal('show');
							$('.textnotifyp').html(response.notification_content);
							var audio = new Audio(base_url+'uploads/bell.mp3');
							audio.play();
					}
                }
            });
        }
        setInterval(checkNotifications, 50000);
    });
	function markNotificationsAsRead(p) {
            $.ajax({
                url: base_url+'/admin/orders/mark_notifications_read?p='+p,  // Update this URL
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                       alert(response.notification_content);
					   location.reload(true);
                    }
                }
            });
        }
	</script>
  <?php } ?>