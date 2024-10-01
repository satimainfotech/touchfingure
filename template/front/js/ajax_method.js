	window.addEventListener("keydown", checkKeyPressed, false);
	 
	function checkKeyPressed(e) {
		if (e.keyCode == "13") {
			$(":focus").each(function() {
				if($(this).is('textarea') || $(this).closest('.form-group').find('textarea').length > 0){ 
				} else {
					if($(this).closest('.form-group').find('.bootstrap-tagsinput').length > 0){ 
					} else {
						e.preventDefault();
						$(this).closest('form').find('.enterer').click();
						$(this).closest('form').closest('.modal-content').find('.enterer').click();
					}
				}
			});
		}
	}
	
	$.ajaxPrefilter('script', function(options) { 
		options.cache = true; 
	});
	
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	};

	$(document).on('change','.required',function(){
		var here = $(this);
		var mbe = ' Email address not valid';
		var take = '';
		here.css({borderColor: '#ced4da'});
		
		if (here.attr('type') == 'email'){
			if(isValidEmailAddress(here.val())){
				here.closest('div').find('.require_alert').remove();
			}else{
				here.closest('div').find('.require_alert').remove();
				here.closest('div').append(''
					+'  <span style="color: #f00;position: relative;top: 5px;" id="'+take+'" class="require_alert" >'
					+'      * '+mbe
					+'  </span>'
				);
			}
		} else {
			here.closest('div').find('.require_alert').remove();
		}
		
		var erp = ' Passwords must be at least 6 characters. ';
		if (here.attr('type') == 'password'){
			if($.trim(here.val()).length > 6){
				here.closest('div').find('.require_alert').remove();
			}else{
				here.closest('div').find('.require_alert').remove();
				here.closest('div').append(''
					+'  <span style="color: #f00;position: relative;top: 5px;" id="'+take+'" class="require_alert" >'
					+'      * '+erp
					+'  </span>'
				);
			}
		} else {
			here.closest('div').find('.require_alert').remove();
		}
		
		var erp = ' Mobile Number must be at least 10 characters. ';
		if (here.attr('name') == 'mobile_number'){
			if($.trim(here.val()).length < 10){
				here.closest('div').find('.require_alert').remove();
				here.closest('div').append(''
					+'  <span style="color: #f00;position: relative;top: 5px;" id="'+take+'" class="require_alert" >'
					+'      * '+erp
					+'  </span>'
				);
			}else{
				here.closest('div').find('.require_alert').remove();
			}
		} else {
			here.closest('div').find('.require_alert').remove();
		}
		
		if(here.is('select')){
			here.closest('div').find('.chosen-single').css({borderColor: '#ced4da'});
		}
	});
	$(document).on('change','.custom_require',function(){
		var here = $(this);
		var mbe = ' Email address not valid';
		var take = '';
		here.css({borderColor: '#ced4da'});
		
		if (here.attr('type') == 'email'){
			if(isValidEmailAddress(here.val())){
				here.closest('div').find('.require_alert').remove();
			}else{
				here.closest('div').find('.require_alert').remove();
				here.closest('div').append(''
					+'  <span style="color: #f00;position: relative;top: 5px;" id="'+take+'" class="require_alert" >'
					+'      * '+mbe
					+'  </span>'
				);
			}
		} else {
			here.closest('div').find('.require_alert').remove();
		}
		
		var erp = ' Passwords must be at least 6 characters. ';
		if (here.attr('type') == 'password'){
			if($.trim(here.val()).length > 6){
				here.closest('div').find('.require_alert').remove();
			}else{
				here.closest('div').find('.require_alert').remove();
				here.closest('div').append(''
					+'  <span style="color: #f00;position: relative;top: 5px;" id="'+take+'" class="require_alert" >'
					+'      * '+erp
					+'  </span>'
				);
			}
		} else {
			here.closest('div').find('.require_alert').remove();
		}
		
		var erp = ' Mobile Number must be at least 10 characters. ';
		if (here.attr('name') == 'mobile_number'){
			if($.trim(here.val()).length < 10){
				here.closest('div').find('.require_alert').remove();
				here.closest('div').append(''
					+'  <span style="color: #f00;position: relative;top: 5px;" id="'+take+'" class="require_alert" >'
					+'      * '+erp
					+'  </span>'
				);
			}else{
				here.closest('div').find('.require_alert').remove();
			}
		} else {
			here.closest('div').find('.require_alert').remove();
		}
		
		if(here.is('select')){
			here.closest('div').find('.chosen-single').css({borderColor: '#ced4da'});
		}
	});
	
	function ajax_form_submit(form_id,msg,return_url){
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
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					var buttonp = $('.enterer');
					buttonp.addClass('disabled');
					buttonp.html('processing...');
				},
				success: function(data) {
					if(data == 'done'){
						$('#msg_popup').html('<p style="color:green;font-size:16px">Your enquire has been successfully submited</p>');
						$('#quick_product_modal_button').animate({ scrollTop: 0 }, "slow");
						setTimeout(function () {
							$('#quick_product_modal_button').modal('hide');
							location.reload('true');
						}, 2000);
					}else if(data == 'select_a_texchure'){
						$('#quick_product_modal_button').animate({ scrollTop: 0 }, "slow");
						$('#msg_popup').html('<p style="color:#f00;font-size:16px">Please select a any one Texture</p>');
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Enquire Now');
					}else{
						$('#msg_popup').html('<p style="color:#f00;font-size:16px">OOPS! Something Wrong...</p>');
						setTimeout(function () {
							$('#quick_product_modal_button').modal('hide');
						}, 2000);
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Enquire Now');
					}
					$('.bootbox-close-button').click();
				},
				error: function(e) {
					console.log(e)
				}
			});
		} else {
			$('#quick_product_modal_button').animate({ scrollTop: 0 }, "slow");
			return false;
		}
	}
	
	function contact_ajax_form_submit(form_id,msg){
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
			var nname = here.attr('msggess');
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
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					var buttonp = $('.enterer');
					buttonp.addClass('disabled');
					buttonp.html('processing...');
				},
				success: function(data) {		
				
					if(data == 'done'){
						$('#open_quick_catalog_button').modal('hide');
						$('#show_msg').show().html('<p style="color:#fff;background-color:green;padding:5px 15px;font-size:16px">Your enquire has been successfully submited</p>');
						$('#show_button').show();
						$('#show_button').removeAttr('style');
						$('.show_msg').css('z-index','999999');
						/*setTimeout(function () {
							location.reload('true');
						}, 2000);*/
					}else{
						$('#show_msg').show().html('<p style="color:#fff;background-color:#f00;padding:5px 15px;font-size:16px">OOPS! Something Wrong...</p>');
						$('.show_msg').css('z-index','999999');
						setTimeout(function () {
							$('#show_msg').hide().html('');
						}, 4000);
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit <i class="ml-3 fas fa-chevron-right"></i>');
					}
					$('.bootbox-close-button').click();
				},
				error: function(e) {
					console.log(e)
				}
			});
		} else {
			$('#open_quick_catalog_button').animate({ scrollTop: 0 }, "slow");
			return false;
		}
	}
	
	function contacts_ajax_form_submit(form_id,msg){
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
			var nname = here.attr('msggess');
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
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					var buttonp = $('.enterer');
					buttonp.addClass('disabled');
					buttonp.html('processing...');
				},
				success: function(data) {
					if(data == 'done'){
						$('#show_msg').show().html('<p style="color:#fff;background-color:green;padding:5px 15px;font-size:16px">Your enquire has been successfully submited</p>');
						$('.show_msg').css('z-index','999999');
						setTimeout(function () {
							location.reload('true');
						}, 2000);
					}else{
						$('#show_msg').show().html('<p style="color:#fff;background-color:#f00;padding:5px 15px;font-size:16px">OOPS! Something Wrong...</p>');
						$('.show_msg').css('z-index','999999');
						setTimeout(function () {
							$('#show_msg').hide().html('');
						}, 4000);
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit <i class="ml-3 fas fa-chevron-right"></i>');
					}
					$('.bootbox-close-button').click();
				},
				error: function(e) {
					console.log(e)
				}
			});
		} else {
			$('#quick_product_modal_button').animate({ scrollTop: 0 }, "slow");
			return false;
		}
	}