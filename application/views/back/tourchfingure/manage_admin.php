<div id="content-container">
    <div id="page-title">
        <center>
        	<h1 class="page-header text-overflow custompagetitle"><?php echo translate('manage_profile')?></h1>
        </center>
    </div>
    <div class="row">
    	<div class="col-md-12">
            <div class="col-md-12 margin-top-10">
            	<div class="panel panel-bordered panel-dark">
					<?php
						$admin_data = $this->db->get_where('admin', array(
							'admin_id' => $this->session->userdata('admin_id')
						))->result_array();
						foreach ($admin_data as $row) {
					?>
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('manage_details')?></h3>
                        </center>
                    </div>
                    <div class="panel-body">  
						<?php
                            echo form_open(base_url() . 'admin/manage_mind1992gameadmin/manage_admins/update_profile/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post'
                            ));
                        ?>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-1">
                                    	<?php echo translate('name');?>
                                        	</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" value="<?php echo $row['name']; ?>" id="demo-hor-1" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-2">
										<?php echo translate('email');?>
                                        	</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" value="<?php echo $row['email']; ?>" id="demo-hor-2" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-3">
										<?php echo translate('phone');?>
                                        	</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" id="demo-hor-3" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-4">
										<?php echo translate('address');?>
                                        	</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="address" value="<?php echo $row['address']; ?>" id="demo-hor-4" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="btn btn-info submitter enterer" data-ing='<?php echo translate('updating..'); ?>' data-msg='<?php echo translate('profile_updated!'); ?>'>
									<?php echo translate('update_profile');?>
                                    	</span>
                            </div>
                        </form>
                    </div>
                </div>
            	<div class="panel panel-bordered panel-dark margin-top-10">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('change_password')?>s</h3>
                        </center>
                    </div>
                    <div class="panel-body">  
						<?php
                                echo form_open(base_url() . 'admin/manage_mind1992gameadmin/manage_admins/update_password/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post'
                                ));
                            ?>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-5">
                                        	<?php echo translate('current_password');?>
                                            	</label>
                                        <div class="col-sm-6">
                                            <input type="password" name="password" value="" id="demo-hor-5" class="form-control required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-6">
                                        	<?php echo translate('new_password*');?>
                                            	</label>
                                        <div class="col-sm-6">
                                            <input type="password" name="password1" value="" id="demo-hor-6" class="form-control pass pass1 required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="demo-hor-7">
                                        	<?php echo translate('confirm_password');?>
                                            	</label>
                                        <div class="col-sm-6">
                                            <input type="password" name="password2" value="" id="demo-hor-7" class="form-control pass pass2 required">
                                        </div>
                                        <div id="pass_note">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="btn btn-info pass_chng disabled enterer" disabled='disabled' data-ing='<?php echo translate('updating..'); ?>' data-msg='<?php echo translate('password_updated!'); ?>'>
                                    	<?php echo translate('update_password');?>
                                    		</span>
                                </div>
                        	</form>
                    </div>
                </div>
               <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(".pass").blur(function() {
		var pass1 = $(".pass1").val();
		var pass2 = $(".pass2").val();
		if (pass1 !== pass2) {
			$("#pass_note").html('' + '  <span class="require_alert" >' + ' <?php echo translate('password_mismatched'); ?>' + '  </span>');
			$(".pass_chng").attr("disabled", "disabled");
			$(".pass_chng").addClass("disabled");
		} else if (pass1 == pass2) {
			$("#pass_note").html('');
			$(".pass_chng").removeAttr("disabled");
			$(".pass_chng").removeClass("disabled");
		}
	});
	
	$('.pass_chng').on('click', function() {
	
		var here = $(this); // alert div for show alert message
		var form = here.closest('form');
		var can = '';
		var ing = here.data('ing');
		var msg = here.data('msg');
		var prv = here.html();
	
		var formdata = false;
		if (window.FormData) {
			formdata = new FormData(form[0]);
		}
	
		var a = 0;
		var take = '';
		form.find(".required").each(function() {
			var txt = '*<?php echo translate('required'); ?>';
			a++;
			if (a == 1) {
				take = 'scroll';
			}
			var here = $(this);
			if (here.val() == '') {
				if (!here.is('select')) {
					here.css({
						borderColor: 'red'
					});
	
					if (here.closest('div').find('.require_alert').length) {
	
					} else {
						here.closest('div').append('' + '  <span id="' + take + '" class="label label-danger require_alert" >' + '      ' + txt + '  </span>');
					}
				}
				var topp = 100;
	
				$('html, body').animate({
					scrollTop: $("#scroll").offset().top - topp
				}, 500);
				can = 'no';
			}
	
			take = '';
		});
	
		if (can !== 'no') {
			$.ajax({
				url: form.attr('action'),
				type: 'POST',
				dataType: 'html',
				data: formdata ? formdata : form.serialize(),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					here.html(ing);
				},
				success: function(data) {
					here.fadeIn();
					here.html(prv);
					if (data == 'updated') {
						$.activeitNoty({
							type: 'success',
							icon: 'fa fa-check',
							message: msg,
							container: 'floating',
							timer: 3000
						});
					} else if (data == 'pass_prb') {
						$.activeitNoty({
							type: 'danger',
							icon: 'fa fa-check',
							message: '<?php echo translate('incorrect_password!'); ?>',
							container: 'floating',
							timer: 3000
						});
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		} else {
			return false;
		}
	});

    var base_url = '<?php echo base_url(); ?>';

</script>