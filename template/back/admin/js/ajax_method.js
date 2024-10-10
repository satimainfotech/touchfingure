var height = $( window ).height();
var f_h = height/5;
var loading = '<div style="height:'+height+'px; width:100%;">'
			  +'<div class="spinner" style="top:'+f_h+'px;position:relative;">'
			  +'<div class="rect1"></div>'
			  +'  <div class="rect2"></div>'
			  +'  <div class="rect3"></div>'
			  +'  <div class="rect4"></div>'
			  +'  <div class="rect5"></div>'
			  +'</div>';
			  +'</div>';

	
function other_delete(){
  
}
function other_forms(){

}

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
	
	function ajax_load(url,id,type){
		var list = $('#'+id);
		$.ajax({
			url: url, // form action url
    		cache: false,
        	dataType: "html",
			beforeSend: function() {
				if(type !== 'other'){
					list.html(loading); // change submit button text
				}
			},
			success: function(data) {
				if(data !== ''){
					list.html('');
					list.html(data).fadeIn(); // fade in response data
				}
				if(type == 'first'){
					$('#demo-table').bootstrapTable();
					set_switchery();
					$('#demo-table img').each(function() {
						if($(this).attr('src') !== ''){
							if($(this).data('im') !== 'fb'){
						    	$(this).attr('src', $(this).attr('src')+'?random='+new Date().getTime());
							}
						}
					});
				} else if(type=='form') {
					//reloadStylesheets();
			        $('#demo-tp-textinput').timepicker({
			            minuteStep: 5,
			            showInputs: false,
			            disableFocus: true
			        });
			        
				} else if(type=='delete') {
					if(extra == 'order_deletes'){
						setTimeout(function () {
								location.reload(true);
						}, 1000);
					}else if(extra == 'vendor_delete'){
						setTimeout(function () {
								location.reload(true);
						}, 1000);
					}else if(extra == 'product_delete'){
						setTimeout(function () {
								location.reload(true);
						}, 1000);
					}else if(extra == 'master_manage_delete'){
						setTimeout(function () {
								location.reload(true);
						}, 1000);
					}else{
						ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func,'list','first');
						other_delete();
					}
				} else if(type=='other') {
					other();
				} else if(type=='others') {
					others();
				} else {

				}
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	
	function reloadStylesheets() {
	    var queryString = '?reload=' + new Date().getTime();
	    $('link').each(function () {
	        this.href = this.href.replace(/\?.*|$/, queryString);
	    });
	    $('script').each(function () {
	        this.src = this.src.replace(/\?.*|$/, queryString);
	    });

	}
    
	$(document).ready(function() {
		if($('#lang_select').length){
		} else {
			ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func,'list','first');
		}
	});
	function ajax_modal(type,title,noty,form_id,id){
		modal_form(title,noty,form_id);
		ajax_load(base_url+''+user_type+'/'+module+'/'+type+'/'+id,'form','form');
	}

	function ajax_set_list(extra){
		ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func+'/'+extra,'list','first');
	}

	function ajax_set_full(type,title,noty,form_id,id){
		//full_form(title,noty,form_id);
		ajax_load(base_url+''+user_type+'/'+module+'/'+type+'/'+id,'list','form');
	}

	$('#multi_dlt_btn').on('click', function(){
		var ids = $('#hidden_input').val();
		ajax_load(base_url+''+user_type+'/'+module+'/multi_delete/'+ids,'list','delete');
	});

	function delete_confirm(id,msg){
		msg = '<div class="modal-title">'+msg+'</div>';
		bootbox.confirm(msg, function(result) {
			if (result) {
				ajax_load(base_url+''+user_type+'/'+module+'/'+dlt_cont_func+'/'+id,'list','delete');
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-check',
					message : dss,
					container : 'floating',
					timer : 3000
				});
				setTimeout(function () {
					location.reload('true');
				}, 1000);
			}else{
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-minus',
					message : cncle,
					container : 'floating',
					timer : 3000
				});
				setTimeout(function () {
					location.reload('true');
				}, 1000);
			};
		});
	}
	
	function other_confirm(func,id,msg,noty){
		msg = '<div class="modal-title">'+msg+'</div>';
		bootbox.confirm(msg, function(result) {
			if (result) {
				ajax_load(base_url+''+user_type+'/'+module+'/'+func+'/'+id,'list','delete');
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : noty,
					container : 'floating',
					timer : 3000
				});
			} else {
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-minus',
					message : cncle,
					container : 'floating',
					timer : 3000
				});
			};

		});
	}

	function delete_img_confirm(id,msg){
		msg = '<div class="modal-title">'+msg+'</div>';
		bootbox.confirm(msg, function(result) {
			if (result) {
				ajax_load(base_url+''+user_type+'/'+module+'/dlt_img/'+id,'list','delete');
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : dss,
					container : 'floating',
					timer : 3000
				});
			}else{
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-minus',
					message : cncle,
					container : 'floating',
					timer : 3000
				});
			};

		});
	}

    $('#fol').on('click','.submitter', function(){

        //alert('vdv');
        var here = $(this); // alert div for show alert message
        var form = here.closest('form');
        var can = '';
		var ing = here.data('ing');
		var msg = here.data('msg');
		var prv = here.html();
		
		form.find('.summernotes').each(function() {
            var now = $(this);
            now.closest('div').find('.val').val(now.code());
        });
		
        //var form = $(this);
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }

        var a = 0;
        var take = '';
        form.find(".required").each(function(){
       		var txt = '*'+req;
            a++;
            if(a == 1){
                take = 'scroll';
            }
            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
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
                            +'      *Required'
                            +'  </span>'
                        );
                    }

                }
                var topp = 100;

                $('html, body').animate({
                    scrollTop: $("#scroll").offset().top - topp
                }, 500);
                can = 'no';
            }

			if (here.attr('type') == 'email'){
				if(!isValidEmailAddress(here.val())){
					here.css({borderColor: 'red'});
					if(here.closest('div').find('.require_alert').length){
						
					} else {
						here.closest('div').append(''
							+'  <span id="'+take+'" class="label label-danger require_alert" >'
							+'      *'+mbe
							+'  </span>'
						);
					}
					can = 'no';
				}
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
                    here.html(ing); // change submit button text
                },
                success: function() {
                    here.fadeIn();
                    here.html(prv)
                    $.activeitNoty({
                        type: 'success',
                        icon : 'fa fa-check',
                        message : msg,
                        container : 'floating',
                        timer : 3000
                    });
                    if($('body .slider_preview').length){
                    	ajax_set_list();
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
	
	$('#fol').on('click','.app_setting', function(){

        //alert('vdv');
        var here = $(this); // alert div for show alert message
        var form = here.closest('form');
        var can = '';
		var ing = here.data('ing');
		var msg = here.data('msg');
		var prv = here.html();
		
		form.find('.summernotes').each(function() {
            var now = $(this);
            now.closest('div').find('.val').val(now.code());
        });
		
        //var form = $(this);
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }

        var a = 0;
        var take = '';
        form.find(".required").each(function(){
       		var txt = '*'+req;
            a++;
            if(a == 1){
                take = 'scroll';
            }
            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
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
                            +'      *Required'
                            +'  </span>'
                        );
                    }

                }
                var topp = 100;

                $('html, body').animate({
                    scrollTop: $("#scroll").offset().top - topp
                }, 500);
                can = 'no';
            }

			if (here.attr('type') == 'email'){
				if(!isValidEmailAddress(here.val())){
					here.css({borderColor: 'red'});
					if(here.closest('div').find('.require_alert').length){
						
					} else {
						here.closest('div').append(''
							+'  <span id="'+take+'" class="label label-danger require_alert" >'
							+'      *'+mbe
							+'  </span>'
						);
					}
					can = 'no';
				}
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
                    here.html(ing); // change submit button text
                },
                success: function() {
                    here.fadeIn();
                    here.html(prv)
                    $.activeitNoty({
                        type: 'success',
                        icon : 'fa fa-check',
                        message : msg,
                        container : 'floating',
                        timer : 3000
                    });
					setTimeout(function () {
						location.reload('true');
					}, 1000);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        } else {
            return false;
        }
    });

	function form_submit(form_id,noty,e){
		var alerta = $('#form'); // alert div for show alert message
		var form = $('#'+form_id);
		var can = '';
		if(!extra){
			var extra = '';
		}
		form.find('.summernotes').each(function() {
            var now = $(this);
            now.closest('div').find('.val').val(now.code());
        });
		
		//var form = $(this);
	    var formdata = false;
	    if (window.FormData){
	        formdata = new FormData(form[0]);
	    }

		var a = 0;
		var take = '';
		form.find(".required").each(function(){
			var txt = '*'+req;
            a++;
            if(a == 1){
                take = 'scroll';
            }
            var here = $(this);
            if(here.val() == ''){
                if(!here.is('select')){
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
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
                            +'      *Required'
                            +'  </span>'
                        );
                    }

                }
                var topp = 100;
                if(form_id == 'product_add' || form_id == 'product_edit'){
                } else {
	                $('html, body').animate({
	                    scrollTop: $("#scroll").offset().top - topp
	                }, 500);
                }
                can = 'no';
            }

			if (here.attr('type') == 'email'){
				if(!isValidEmailAddress(here.val())){
					here.css({borderColor: 'red'});
					if(here.closest('div').find('.require_alert').length){
	
					} else {
						here.closest('div').append(''
							+'  <span id="'+take+'" class="require_alert" >'
							+'      *'+mbe
							+'  </span>'
						);
					}
					can = 'no';
				}
			}

			take = '';
		});

		if(can !== 'no'){
			if(form_id !== 'vendor_pay'){
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
						buttonp.html(working);
					},
					success: function(data) {
						if(form_id == 'vendor_approval'){
							noty = enb_ven;
						}
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : noty,
							container : 'floating',
							timer : 4000
						});
						$('.bootbox-close-button').click();
						('form_submit_success');
						if(form_id == 'payment_status'){
							setTimeout(function () {
									location.reload(true);
							}, 1000);
						}else if(form_id == 'order_status'){
							setTimeout(function () {
									location.reload(true);
							}, 1000);
						}else{
							ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func+'/'+extra,'list','first');
						}
						
					},
					error: function(e) {
						console.log(e)
					}
				});
			} else {
				//form.html('fff');
				form.submit();
				//alert('ff');
				return false;
			}
		} else {
			if(form_id == 'product_add' || form_id == 'product_edit'){
				var ih = $('.require_alert').last().closest('.tab-pane').attr('id');
				$("[href=#"+ih+"]").click();
			}
			$('body').scrollTo('#scroll');
			return false;
		}
	}
	
	function modal_form(title,noty,form_id){
		bootbox.dialog({
			title: title,
			message:"<div id='form'></div>",
			buttons: {
				success: {
					label: sv,
					className: "btn-purple enterer",
					callback: function() {
						if(form_submit(form_id,noty) !== false){
							return false;
						} else {
							return false;
						}
					}
				},
				danger: {
					label: cnl,
					className: "btn-dark",
					callback: function() {
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-minus',
							message : 'Cancelled',
							container : 'floating',
							timer : 3000
						});
					}
				}
			}
		});
	}

	

	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	};

	if(typeof set_switchery != 'function'){
		window.set_switchery = function(){
			if($('#unit').length){
				$(".u1").each(function(){
					new Switchery(document.getElementById('unit_p_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#unit_p_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/unit_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'unit','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : ppus,
							container : 'floating',
							timer : 3000
						});
						setTimeout(function(){ ajax_set_list(); }, 500);
						} else {
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-check',
							message : pups,
							container : 'floating',
							timer : 3000
						});
						
					  }
					};
				});
			}else if($('#vendr').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('pub_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77', size:'large'});
					var changeCheckbox = document.querySelector('#pub_'+$(this).data('id'));
				});
				$(".sw2").each(function(){
					new Switchery(document.getElementById('spub_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77', size:'large'});
					var changeCheckbox = document.querySelector('#spub_'+$(this).data('id'));
				});
			} else if($('#slid').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('sli_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#sli_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  //alert($(this).data('id'));
					  ajax_load(base_url+''+user_type+'/'+module+'/slider_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'slid','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : spus,
							container : 'floating',
							timer : 3000
						});
						
					  } else {
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-check',
							message : supus,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
			} else if($('#pag').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('pag_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#pag_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  //alert($(this).data('id'));
					  ajax_load(base_url+''+user_type+'/'+module+'/page_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : papus,
							container : 'floating',
							timer : 3000
						});
						
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : paupus,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
			}else if($('#truck').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('truck_b_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#truck_b_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  //alert($(this).data('id'));
					  ajax_load(base_url+''+user_type+'/'+module+'/page_publish_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'pag','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : papus,
							container : 'floating',
							timer : 3000
						});
						
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : paupus,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
			}  else if($('#master').length){
				$(".sw1").each(function(){
					new Switchery(document.getElementById('mas_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#mas_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  ajax_load(base_url+''+user_type+'/'+module+'/approval_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'prod','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : ppus,
							container : 'floating',
							timer : 3000
						});
						} else {
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-check',
							message : pups,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
				$(".sw2").each(function(){
					new Switchery(document.getElementById('pubs_'+$(this).data('id')), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#pubs_'+$(this).data('id'));
					changeCheckbox.onchange = function() {
					  //alert($(this).data('id'));
					  ajax_load(base_url+''+user_type+'/'+module+'/block_set/'+$(this).data('id')+'/'+changeCheckbox.checked,'prod','others');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : pfe,
							container : 'floating',
							timer : 3000
						});
						
					  } else {
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-check',
							message : pufe,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
			}else if($('#genset').length){
				$(".sw5").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  //alert($(this).data('id'));
					  ajax_load(base_url+''+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','others');
					  if(changeCheckbox.checked == true){
						if(set == 'g_login_set'){
							ntsen = glen;
							$('.g_log_ins').show('fast');
						}
						if(set == 'fb_login_set'){
							ntsen = flen;
							$('.fb_log_ins').show('fast');
						}
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : ntsen,
							container : 'floating',
							timer : 3000
						});
						
					  } else {
						if(set == 'g_login_set'){
							ntsds = glds;
							$('.g_log_ins').hide('fast');
						}
						if(set == 'fb_login_set'){
							ntsds = flds;
							$('.fb_log_ins').hide('fast');
						}
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : ntsds,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
				
				$(".sw4").each(function(){
					var h = $(this);
					var id = h.attr('id');
					var set = h.data('set');
					new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
					var changeCheckbox = document.querySelector('#'+id);
					changeCheckbox.onchange = function() {
					  //alert($(this).data('id'));
					  ajax_load(base_url+''+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','othersd');
					  if(changeCheckbox.checked == true){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : su_e,
							container : 'floating',
							timer : 3000
						});
						
					  } else {
						$.activeitNoty({
							type : 'danger',
							icon : 'fa fa-check',
							message : su_d,
							container : 'floating',
							timer : 3000
						});
						
					  }
					  //alert(changeCheckbox.checked);
					};
				});
			}
		}
	}
	
	function FromHTML(from_id,name,o,w) {
		var pdf = new jsPDF(o, 'pt', 'letter')
		
		// source can be HTML-formatted string, or a reference
		// to an actual DOM element from which the text will be scraped.
		, source = $('#'+from_id)[0]

		// we support special element handlers. Register them with jQuery-style 
		// ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
		// There is no support for any other type of selectors 
		// (class, of compound) at this time.
		, specialElementHandlers = {
			// element with id of "bypass" - jQuery style selector
			'#bypassme': function(element, renderer){
				// true = "handled elsewhere, bypass text extraction"
				return true
			}
		}

		margins = {
	      top: 60,
	      bottom: 50,
	      left: 40,
	      right: 40,
	      width: w
	    };
	    // all coords and widths are in jsPDF instance's declared units
	    // 'inches' in this case
	    pdf.fromHTML(
	    	source // HTML string or DOM elem ref.
	    	, margins.left // x coord
	    	, margins.top // y coord
	    	, {
	    		'width': margins.width // max width of content on PDF
	    		, 'elementHandlers': specialElementHandlers
	    	},
	    	function (dispose) {
	    	  // dispose: object with X, Y of the last line add to the PDF 
	    	  //          this allow the insertion of new lines after html
				pdf.save(name+'.pdf');
				$('#export-title').hide();
				$('#export-table').hide();
	        },
	    	margins
	    )

		/*
		pdf.addHTML(document.getElementById(from_id),function() {
			var string = pdf.output('datauristring');
			$('.preview-pane').attr('src', string);
			//pdf.save(name+'.pdf');
		});
		*/
	}

	function FromaHTML(id,name,o){
		var pdf = new jsPDF(o,'px','a4');
		var options = {
	        pagesplit: true
	    };
		pdf.addHTML(document.getElementById(id),options,function() {
			var string = pdf.output('datauristring');
			$('.preview-pane').attr('src', string);
		});
		$('#export-title').show();
			pdf.save(name+'.pdf');
		setTimeout(function() {
			$('#export-title').hide();
			$('#export-table').hide();
		}, 100);
	}

	
	function export_it(type,ignore){
		$('#export-table').show();
		var name = $('#export-table').data('name');
		var o = $('#export-table').data('orientation');
		var w = $('#export-table').data('width');
		if(type == 'pdf'){
			//FromaHTML('export-div',name,o);
			FromHTML('export-div',name,o,w);
		} else {
			$('#export-table').tableExport({type:type,escape:'false',tableName:name,pdfFontSize:10,htmlContent:'true',ignoreColumn:'['+ignore+']'});
			$('#export-table').hide();
		}
	}
	
	function ajax_reset_form(form_id){
		$('input[type="text"],textarea').val('');
		$('#country').find('option:selected').removeAttr('selected').trigger('chosen:updated');
		$('#state').find('option:selected').removeAttr('selected').trigger('chosen:updated');
		$('#city').find('option:selected').removeAttr('selected').trigger('chosen:updated');
		$('#area').find('option:selected').removeAttr('selected').trigger('chosen:updated');
	}
	function ajax_reload_form(form_id){
		location.reload('true');
	}
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
					buttonp.html('Processing...');
				},
				success: function(data) {
					
					
					if(data == 'done'){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : msg,
							container : 'floating',
							timer : 4000
						});
						if(form_id == 'form_edits'){
							var reu = $('#return_url').val();
							r_p_url = reu;
						}else{
							r_p_url = base_url+'admin/'+return_url;
						}
						setTimeout(function () {
							window.location.href = r_p_url;
						}, 1000);
					}else if(data == 'sent'){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-remove',
							message : 'Email successfully sent',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Send');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else if(data == 'not_sent'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'Email not sent',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Send');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else if(data == 'alreday'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'Data Already Exists',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else{
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'OOPS! Something Wrong...',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}
					$('.bootbox-close-button').click();
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
	
	function add_cash_ajax_form_submit(form_id,msg,return_url){
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
					
					if(form_id == 'send_email'){
						buttonp.addClass('disabled');
					    buttonp.html('Sending.....');
					}if(form_id == 'team_member_edit'){
						buttonp.addClass('disabled');
					    buttonp.html(working);
					}
				},
				success: function(data) {
					
					//return false;
					if(data == 'done'){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : msg,
							container : 'floating',
							timer : 4000
						});
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else if(data == 'not_done'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'Transction not added',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else{
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'OOPS! Something Wrong...',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}
					$('.bootbox-close-button').click();
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
	
	
	function inner_ajax_form_submit(form_id,msg){
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
					buttonp.html(working);
				},
				success: function(data) {
					//alert(data);
					//return false;
					if(data == 'done'){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : msg,
							container : 'floating',
							timer : 4000
						});
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else if(data == 'alreday'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'Data Already Exists',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else{
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'SOORY! Somthing Wrong....',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}
					$('.bootbox-close-button').click();
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
	function popup_ajax_form_submit(form_id,msg){
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
					buttonp.html(working);
				},
				success: function(data) {
					if(data == 'done'){
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : msg,
							container : 'floating',
							timer : 4000
						});
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else if(data == 'alreday'){
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'Data Already Exists',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}else{
						$.activeitNoty({
							type: 'danger',
							icon : 'fa fa-remove',
							message : 'SOORY! Somthing Wrong....',
							container : 'floating',
							timer : 4000
						});
						var buttonp = $('.enterer');
						buttonp.removeClass('disabled');
						buttonp.html('Submit');
						setTimeout(function () {
							location.reload('true');
						}, 1000);
					}
					$('#action_data').html('');
					$('#allmodal').modal('hide');
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
	function page_reload(){
		location.reload('true');
	}
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
	
	function delete_popup(id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"confirm_delete(\''+id+'\');\" id="itemss_'+id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function permently_delete_popup(id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"confirm_permently_delete(\''+id+'\');\" id="itemss_'+id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function abandoned_popup(id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"update_abandoned(\''+id+'\');\" id="itemss_'+id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function canceled_popup(id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"update_cancelled(\''+id+'\');\" id="itemss_'+id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function refund_popup(id,match_id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"update_refund(\''+id+'\',\''+match_id+'\');\" id="itemss_'+id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function cancelled_refund_popup(id,match_id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"update_cancelled_refund(\''+id+'\',\''+match_id+'\');\" id="itemss_'+id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function toss_popup(match_id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><div class="model_textfield"><input type="text" id="team_id_'+match_id+'" value="" placeholder="Enter toss winner team id"></div><div class="model_textfield"><textarea id="decision_'+match_id+'" value="" placeholder="Enter toss decision"></textarea></div><span onclick=\"confirm_toss_update(\''+match_id+'\');\" id="itemss_'+match_id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Update</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function confirm_toss_update(match_id){
		var team_id = $('#team_id_'+match_id).val();
		var decision = $('#decision_'+match_id).val();
		$.ajax({
			url: base_url+'admin/match_and_tournament/toss_update',
			dataType: 'html', // request type html/json/xml
			data: {match_id:match_id,decision:decision,team_id:team_id},
			method: 'post',
			cache       : false,
			beforeSend: function() {
				var buttonp = $('.enterer');
				buttonp.addClass('disabled');
				buttonp.html(working);
			},
			success: function(data) {
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Toss decision Successfully updated',
						container : 'floating',
						timer : 4000
					});
				}else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Something Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Update');
				}
				$('#action_data').html('');
				$('#allmodal').modal('hide');
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	
	function set_match_announcement(match_id,anno_status,anno_content){
		if(anno_status == 'yes'){
			var yes_selected = 'selected';
		}else{
			var yes_selected = '';
		}
		if(anno_status == 'no'){
			var no_selected = 'selected';
		}else{
			var no_selected = '';
		}
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">Set Announcement</div><div class="model_textfield"><select id="ano_status_'+match_id+'"><option value="">Choose Status</option><option value="yes" '+yes_selected+'>Yes</option><option value="no" '+no_selected+'>No</option></select></div><div class="model_textfield"><textarea id="anno_content_'+match_id+'" value="" placeholder="Enter toss announcement">'+anno_content+'</textarea></div><span onclick=\"confirm_announcement_update(\''+match_id+'\');\" id="itemss_'+match_id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Set Announcement</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span><div class="announse_text"><p>1. Change in Lineups | IN : Ply Name (IND)  OUT : Ply Name (IND)</p><p>2. The deadline for this match has been extended. Make it count.</p><p>3. Match Delay due to rain.</p><p>4. Match start shortly because bed weather.</p><p>5. If all these contests are not full, the contests will be canceled automatically. </p></div> </div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	
	function confirm_announcement_update(match_id){
		var ano_status = $('#ano_status_'+match_id).val();
		var anno_content = $('#anno_content_'+match_id).val();
		$.ajax({
			url: base_url+'admin/match_and_tournament/announcement_update',
			dataType: 'html', // request type html/json/xml
			data: {match_id:match_id,ano_status:ano_status,anno_content:anno_content},
			method: 'post',
			cache       : false,
			beforeSend: function() {
				var buttonp = $('.enterer');
				buttonp.addClass('disabled');
				buttonp.html(working);
			},
			success: function(data) {
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Announcement Successfully updated',
						container : 'floating',
						timer : 4000
					});
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Something Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Set Announcement');
				}
				$('#action_data').html('');
				$('#allmodal').modal('hide');
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	function set_match_status(match_id,anno_content){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">Set Status</div><div class="model_textfield"><textarea id="anno_content_'+match_id+'" value="" placeholder="Enter Match Status">'+anno_content+'</textarea></div><span onclick=\"confirm_status_update(\''+match_id+'\');\" id="itemss_'+match_id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Set Status</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span><div class="announse_text"><p>1. Starts Shortly</p><p>2. Toss</p><p>3. Play Ongoing</p><p>4. Delayed</p><p>5. Drinks Break </p><p>6. Innings Break </p><p>7. Stumps </p><p>8. Lunch Break </p><p>9. Tea Break </p></div> </div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function confirm_status_update(match_id){
		var anno_content = $('#anno_content_'+match_id).val();
		$.ajax({
			url: base_url+'admin/match_and_tournament/status_update',
			dataType: 'html', // request type html/json/xml
			data: {match_id:match_id,anno_content:anno_content},
			method: 'post',
			cache       : false,
			beforeSend: function() {
				var buttonp = $('.enterer');
				buttonp.addClass('disabled');
				buttonp.html(working);
			},
			success: function(data) {
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Status Successfully updated',
						container : 'floating',
						timer : 4000
					});
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Something Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Set Status');
				}
				$('#action_data').html('');
				$('#allmodal').modal('hide');
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	function delete_team_popup(id,c_id,t_id,msg){
		$('#action_data').html('<div class="panel-body"><div class="delete_model_title">'+msg+'</div><span onclick=\"confirm_team_delete(\''+id+'\',\''+c_id+'\',\''+t_id+'\');\" id="itemss_'+t_id+'" class="btn btn-success btn-md btn-labeled enterer delete_popup_model_button">Yes</span> <span class="btn btn-danger btn-labeled pro_list_btn delete_popup_model_button" onclick=\"cancel_popup();\">Cancel</span></div>');
		$('#allmodal').modal({ backdrop: 'static'});
	}
	function popup_modal(type,id){
		var data_lodas = get_load_data(base_url,user_type,module,type,id);
		$('#action_data').html(data_lodas);
		$('#allmodal').modal({ backdrop: 'static'});
	}	
	
	function get_load_data(use_url,panel_type,panel_module,panel_function,id){
		var list = $('#action_data');
		$.ajax({
			url: use_url+''+panel_type+'/'+panel_module+'/'+panel_function+'/'+id,
    		cache: false,
        	dataType: "html",
			beforeSend: function() {
				list.html(loading);
			},
			success: function(data) {
				if(data !== ''){
					list.html('');
					list.html(data).fadeIn(); // fade in response data
					if(panel_function == 'approval'){
						set_switchery();
					}
					if(panel_function == 'status'){
						set_switchery();
					}
				}
				
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	function cancel_popup(){
		$('#action_data').html('');
		$('#allmodal').modal('hide');
	}
	function confirm_delete(id){
		
		
		$.ajax({
			url: base_url+''+user_type+'/'+module+'/'+delete_function,
			dataType: 'html', // request type html/json/xml
			data: {id:id},
			method: 'post',
			cache       : false,
			beforeSend: function() {
				var buttonp = $('.enterer');
				buttonp.addClass('disabled');
				buttonp.html(working);
			},
			success: function(data) {			
				
			   
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Successfully deleted',
						container : 'floating',
						timer : 4000
					});
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Something Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}
				$('#action_data').html('');
				$('#allmodal').modal('hide');
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	
	function confirm_permently_delete(id){
		$.ajax({
			url: base_url+''+user_type+'/'+module+'/'+delete_function,
			dataType: 'html', // request type html/json/xml
			data: {id:id},
			method: 'post',
			cache       : false,
			beforeSend: function() {
				var buttonp = $('.enterer');
				buttonp.addClass('disabled');
				buttonp.html(working);
			},
			success: function(data) {
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Successfully deleted',
						container : 'floating',
						timer : 4000
					});
					$('#contests_row_'+id).remove();
				}else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Something Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}
				$('#action_data').html('');
				$('#allmodal').modal('hide');
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	
	function confirm_team_delete(id,c_id,t_id){
		$.ajax({
			url: base_url+''+user_type+'/'+module+'/'+delete_function,
			dataType: 'html', // request type html/json/xml
			data: {id:id,c_id:c_id,t_id:t_id},
			method: 'post',
			cache       : false,
			beforeSend: function() {
				var buttonp = $('.enterer');
				buttonp.addClass('disabled');
				buttonp.html(working);
			},
			success: function(data) {
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : 'Successfully deleted',
						container : 'floating',
						timer : 4000
					});
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Something Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}
				$('#action_data').html('');
				$('#allmodal').modal('hide');
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
	
	function master_manage_submit(form_id,msg){
	var form = $('#'+form_id);
	var can = '';
	if(!extra){
		var extra = '';
	}
	
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
		var page_return = $('#page_return_url').val();
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
				buttonp.html(working);
			},
			success: function(data) {
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : msg,
						container : 'floating',
						timer : 4000
					});
					setTimeout(function () {
						window.location.href = page_return;
					}, 1000);
				}else if(data == 'already_exit'){
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : '',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}else{
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Somthing Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}
				$('.bootbox-close-button').click();
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

function form_reset(){
	location.reload('true');
}

function user_ajax_form_submit(form_id,msg,return_url){
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
				buttonp.html(working);
			},
			success: function(data) {
				//return false;
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : msg,
						container : 'floating',
						timer : 4000
					});
					if(form_id == 'users_edit'){
						var reu = $('#return_url').val();
						r_p_url = reu;
					}else if(form_id == 'purchaseed_plan'){
						var reu = $('#return_url').val();
						r_p_url = reu;
					}else{
						r_p_url = base_url+'admin/'+return_url;
					}
					setTimeout(function () {
						window.location.href = r_p_url;
					}, 1000);
				}else if(data == 'user_name_exit'){
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SORRY! User Name Already Exits... Choose Diffrent User Name',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
				}else if(data == 'not_done'){
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'OPPS! Something went wrong...',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
				}else if(data == 'refer_code_not_valid'){
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'Referral Code not valid, Plaese add correct referral code...',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
				}else if(data == 'mobile_email_exit'){
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'Sorry! Mobile Number and email already exists. Please try a different mobile number and email',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
				}
				$('.bootbox-close-button').click();
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
function product_submit(form_id,msg){
	
	
	var form = $('#'+form_id);
	var can = '';
	if(!extra){
		var extra = '';
	}
	
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
		var page_return = $('#return_url').val();
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
				buttonp.html(working);
			},
			success: function(data) {
				
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : msg,
						container : 'floating',
						timer : 4000
					});
					setTimeout(function () {
						window.location.href = page_return;
					}, 1000);
				}else{
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'SOORY! Somthing Wrong....',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
					setTimeout(function () {
						location.reload('true');
					}, 1000);
				}
				$('.bootbox-close-button').click();
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

function lineup_ajax_form_submit(form_id,msg){
	var form = $('#'+form_id);
	var can = '';
	if(!extra){
		var extra = '';
	}
	
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
				buttonp.html('Processing....');
			},
			success: function(data) {
				//return false;
				if(data == 'done'){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : msg,
						container : 'floating',
						timer : 4000
					});
					var reu = $('#return_url').val();
					r_p_url = reu;
					setTimeout(function () {
						window.location.href = r_p_url;
					}, 1000);
				}else if(data == 'not_select'){
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'Please Select a players',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
				}else{
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-remove',
						message : 'OOPS! Something Wrong...',
						container : 'floating',
						timer : 4000
					});
					var buttonp = $('.enterer');
					buttonp.removeClass('disabled');
					buttonp.html('Submit');
				}
				$('.bootbox-close-button').click();
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