<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow custompagetitle"><?php echo translate('Send_notification');?></h1>
	</div>
	<?php //echo "<pre>"; print_r($this->session->userdata());?>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="list">
						<div class="viewpages panel-body">
							<?php
								echo form_open(base_url() . 'admin/send_all_notification/send_all', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => 'send_all_notification',
									'enctype' => 'multipart/form-data'
								));
							?>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customtabcontentview">
									<div class="panel-body">
										<div class="tab-base">
											<div class="tab-content">
												<div id="vendor_details" class="tab-pane fade active in">
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="form-group ">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
															<div class="col-sm-10">
																<input type="text" name="title" id="demo-hor-1" placeholder="<?php echo translate('title');?>" class="form-control required">
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-1"><?php echo translate('type');?></label>
															<div class="col-sm-10">
																<select id="type" name="type" class="demo-chosen-select required" placeholder="Type">
																	<option value="">Select Type</option>
																	<option value="normal">Without Image</option>
																	<option value="image">With Image</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-13"><?php echo translate('message'); ?></label>
															<div class="col-sm-10">
																<textarea rows="9"  class="editertextarea" data-height="200" name="message"></textarea>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label responsivezero" for="demo-hor-2">
																<?php echo translate('image');?>
															</label>
															<div class="col-sm-10 responsivezero">
																<span class="pull-left btn btn-default btn-file">
																	<?php echo translate('select_image');?>
																	<input type="file" name="notification_image" id="notification_image" accept="image">
																</span>
																<span id="notification_image_wrap" class=" show_iin_image" style="width: 200px;float:right;border:1px solid #ddd;border-radius:5px;padding:5px">
																	<img src="<?php echo base_url(); ?>uploads/notification_image/default.png" width="100%" id='notification_image_blah' />
																</span>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label" for="demo-hor-13"><?php echo translate('emoji'); ?></label>
															<div class="col-sm-10 emojiicon">
																<p> <span>🏏</span><span>🏑</span><span>🏒</span><span>🏸</span><span>🏓</span><span>🥍</span><span>🎳</span><span>🥅</span><span>⛳</span><span>🎉</span><span>🌞</span><span>☔</span></p>
																
																<p> <span>🕛</span><span>🕧</span><span>🕐</span><span>🕜</span><span>🕑</span><span>🕝</span><span>🕒</span><span>🕞</span><span>🕓</span><span>🕟</span><span>🕔</span><span>🕠</span><span>🕕</span><span>🕡</span><span>🕖</span><span>🕢</span><span>🕗</span><span>🕣</span><span>🕘</span><span>🕤</span><span>🕙</span><span>🕥</span><span>🕚</span><span>🕦</span></p>
																
																<p> <span>⏳</span><span>⌛</span><span>⏰</span><span>⏱️</span><span>🏟️</span></p>
																<p> <span>💸</span><span>🗣️</span><span>🎺</span><span>🎷</span><span>🎤</span><span>💵</span><span>💴</span><span>💷</span><span>💶</span><span>💳</span><span>✔️</span></p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-left " 
											onclick="page_reload(); "><?php echo translate('reset');?>
										</span>
										<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left enterer" onclick="send_ajax_form_submit('send_all_notification','<?php echo translate('notification_successfully_sended!'); ?>');"><?php echo translate('submit');?></span>
									</div>
									<span id="show_count"></span>
									<span id="total_count"></span>
								</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$(function () {
		$('.textarea').wysihtml5();
	})
</script>
<script>
    function other_forms(){}
	
    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	function other(){
	    set_select();
    }
    $(document).ready(function() {
        set_select();
	});
	$('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	
	function send_ajax_form_submit(form_id,msg){
		var form = $('#'+form_id);
		var can = '';
		if(!extra){
			var extra = '';
		}
		form.find('.summernotes').each(function() {
            var now = $(this);
            now.closest('div').find('.val').val(now.code());
        });
		
		var formdata = false;
	    if (window.FormData){
	        formdata = new FormData(form[0]);
	    }

		var a = 0;
		var take = '';
		form.find(".required").each(function(){
			var here = $(this);
			var nname = here.attr('placeholder');
			var req = nname;
			var txt = '* '+req;
            a++;
            if(a == 1){
                take = 'scroll';
            }
            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '* '+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
						var nnn = here.closest('div .form-control').attr('name');
                        here.closest('div').append(''
                            +'  <span id="'+nnn+'" class="label label-danger require_alert" >'
                            +'      '+txt
                            +'  </span>'
                        );
                    }
                } else if(here.is('select')){
                    here.closest('div').find('.chosen-single').css({borderColor: 'red'});
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      * Required'
                            +'  </span>'
                        );
                    }

                }
                var topp = 100;
                can = 'no';
            }

			take = '';
		});

		if(can !== 'no'){
			$.ajax({
				url: form.attr('action'),
				type: 'POST',
				dataType: 'html',
				data: formdata ? formdata : form.serialize(),
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					var buttonp = $('.enterer');
					buttonp.addClass('disabled');
					buttonp.html('Sending.....');
				},
				success: function(data) {
					if(data == 'sended'){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-remove',
							message : 'Notification successfully send',
							container : 'floating',
							timer : 4000
						});
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else if(data == 'not_sent'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'Somthing went wrong...',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Send');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		} else {
			$('body').scrollTo('#scroll');
			return false;
		}
	}
	
	function notification_image(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#notification_image_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#notification_image").change(function() {
		notification_image(this);
	});
</script>