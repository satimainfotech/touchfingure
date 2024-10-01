<?php $slider_image = $this->db->get_where('second_sliders',array('slider_type' => 'register'))->row()->second_slider_image;
$image =  base_url().'uploads/second_slider_image/'.$slider_image; ?>


  <!-- Header Start -->
      <div class="container-fluid bg-breadcrumb" style="background: url(<?php echo $image; ?>);">
            <div class="bg-breadcrumb-single"></div>
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s"></h4>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                   
                </ol>    
            </div>
        </div>
        <!-- Header End -->
        <!-- Contact Start -->
        <div class="container-fluid contact bg-light py-5">
            <div class="container py-5">
                <div class="row ">
                   
				   <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
                    <div class="col-lg-12 wow fadeInRight" data-wow-delay="0.3s">
                        	<?php
							echo form_open(base_url() . 'register/register_added/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => 'register_add',
								'enctype' => 'multipart/form-data'
							));
						?>
						
                            
							 <div class="row g-3">
                            <?php if($this->session->flashdata('message')): ?>
							<div class="alert alert-success">
							<?php echo $this->session->flashdata('message'); ?>
							</div>
							<?php endif; ?>
							<div class="col-lg-12 col-xl-6">
									<div class="form-floating">
										<select id="gender" name="gender" placeholder="Select a gender" class="form-control demo-chosen-select required" required>
											<option value="">Select Gender</option>
											<option value="male"><?php echo ucfirst('male'); ?></option>
											<option value="female"><?php echo ucfirst('female'); ?></option>
											
										</select>
									</div>
                                </div>
								<div class="col-lg-12 col-xl-6">
								<div class="form-floating">
									<select id="member_type_id" onchange="display_member(this.value);" name="member_type_id" placeholder="Select a member type" class="form-control demo-chosen-select required" >
										<option value="">Select a member type</option>
										<?php foreach($member_type_data as $member_type_row) { ?>
										<option value="<?php echo $member_type_row['member_type_id']; ?>"><?php echo $member_type_row['member_type_name']; ?></option>
										<?php } ?>
									</select>
								</div>
								</div>
                                <div class="col-lg-12 col-xl-6 1">
									<div class="form-floating">
										<select onchange="get_state(this.value);" id="country" name="country" placeholder="Select a country" class="form-control demo-chosen-select required" readonly >
											<option value="">Select a Country</option>
											<?php foreach($country_data as $country_row) { ?>
											<option value="<?php echo $country_row['country_id']; ?>" selected><?php echo $country_row['country_name']; ?></option>
											<?php } ?>
										</select>
									</div>
                                </div>
								<div class="col-lg-12 col-xl-6  2 ">
									<div class="form-floating">
										<select id="state" onchange="get_division(this.value); " name="state" placeholder="Select a state" class="form-control demo-chosen-select required" readonly>
											<option value="">Select State</option>
											
										</select>
									</div>
                                </div>
								<div class="col-lg-12 col-xl-6 3">
									<div class="form-floating">
										<select id="division" name="division" onchange="get_district(this.value); get_district_m(this.value);" placeholder="Select a division" class="form-control demo-chosen-select " >
											<option value="">Select Division</option>
											
										</select>
									</div>
                                </div>
								<div class="col-lg-12 col-xl-6 4 district">
									<div class="form-floating">
										<select id="district" name="district" onchange="get_taluka(this.value);" placeholder="Select a district" class="form-control demo-chosen-select " >
											<option value="">Select District</option>
											
										</select>
									</div>
                                </div>
                                <div class="col-lg-12 col-xl-6 5 district_m">
									<div class="form-floating">
										<select id="district_m" name="district_m" onchange="get_taluka_m(this.value);" placeholder="Select a district" class="form-control demo-chosen-select " >
											<option value="">Select District-M</option>
											
										</select>
									</div>
                                </div>
								<div class="col-lg-12 col-xl-6 6 district">
									<div class="form-floating">
										<select id="taluka" name="taluka" onchange="get_gram_panchayat(this.value);" placeholder="Select a taluka" class="form-control demo-chosen-select " >
											<option value="">Select Taluka</option>
											
										</select>
									</div>
                                </div>
                                <div class="col-lg-12 col-xl-6 7 district_m">
									<div class="form-floating">
										<select id="taluka_m" name="taluka_m" onchange="get_gram_panchayat(this.value);" placeholder="Select a taluka" class="form-control demo-chosen-select " >
											<option value="">Select Taluka-M</option>
											
										</select>
									</div>
                                </div>
								<div class="col-lg-12 col-xl-6 8">
									<div class="form-floating">
										<select id="gram_panchayat" name="gram_panchayat" placeholder="Select a taluka" class="form-control demo-chosen-select " >
											<option value="">Select Gram Panchayat</option>
											
										</select>
									</div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control required" id="mobile" name="mobile" placeholder="Mobile" required>
                                        <label for="email">Mobile</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name	" required>
                                        <label for="phone">Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="email" required>
                                        <label for="project">Email</label>
                                    </div>
                                </div>
                                
                               <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="adharcard" id="adharcard" placeholder="adharcard" required>
                                        <label for="Adharcard">Adharcard</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="pancard" name="pancard" placeholder="pancard" >
                                        <label for="Pancard">Pancard</label>
                                    </div>
                                </div>
								 <div class="col-lg-12 col-xl-6"  style="display:none">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="	" >
                                        <label for="Password">Password</label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6"  style="display:none">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="pancard" >
                                        <label for="confirm_password">Confirm Password</label>
                                    </div>
                                </div>
								<div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="police_station_name" name="police_station_name" placeholder="police_station_name" required>
                                        <label for="police_station_name">Police Station Name</label>
                                    </div>
                                </div>
								<div class="col-12">
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control" name="address" id="address" placeholder="Address" style="height: 160px" required></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                </div>
								
								 <div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                       <input type="file" name="profile_main_images" accept="image" id="profile_main_images" class="form-control" required>
                                        <label for="confirm_password">Profile Image</label>
                                    </div>
                                </div>
								<div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                       <input type="file" name="adharcard_main_images" accept="image" id="adharcard_main_images" class="form-control" required>
                                        <label for="confirm_password">Adharcard Image</label>
                                    </div>
                                </div>
								<div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                       <input type="file" name="pancard_main_images" accept="image" id="pancard_main_images" class="form-control" required>
                                        <label for="confirm_password">Pancard Image</label>
                                    </div>
                                </div>
								
								<div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
									<span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="profile_main_images_wrap">
									<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="profile_main_images_blah" />
									</span>
                                    </div>
                                </div>
								<div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                       <span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="adharcard_main_images_wrap">
									<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="adharcard_main_images_blah" />
									</span>
                                    </div>
                                </div>
								<div class="col-lg-12 col-xl-4">
                                    <div class="form-floating">
                                      <span style="width: 50%;float:left; border:1px solid #ddd;border-radius:5px; padding:5px;margin-top:10px;" id="pancard_main_images_wrap">
									<img src="<?php echo base_url(); ?>uploads/other_images/default.png" width="100%" id="pancard_main_images_blah" />
									</span>
                                    </div>
                                </div>
								
								<div class="col-12 d-flex align-items-center">
									<input type="checkbox" name="terms" id="terms" class="me-2" required>
									<label for="terms" class="form-label mb-0" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#termsModal">
									I Agree to Terms & Conditions
									</label>
								</div>
                                <div class="col-6">
                                    <button class="btn btn-primary w-100 py-3" onclick="ajax_form_submit('register_add','<?php echo translate('user_has_been_added!'); ?>','register');">Submit</button>
                                </div>
                                 <div class="col-6">
                                    <button class="btn btn-primary w-100 py-3" onclick="form_reset(); ">Reset</button>
                                </div>
                                <div id="msg_popup"></div>
                            </div>
                        </form>
                    </div>
                  
                </div>
            </div>
        </div>
		
			<!-- Modal Structure -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="termsModalLabel">Terms & Conditions</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Content of Terms & Conditions goes here -->
        <p>આપ શ્રી ને અખંડ ભારત ન્યુઝ પરિવારમાં જોડાવા બદલ અભિનંદન પાઠવીએ છીએ.આપ શ્રી ને નીચે મુજબની શરતોએ નિમણૂક પત્ર આપીએ છીએ.</p>
      <p>1. સદર નિમણૂક બિલકુલ માનદ ધોરણે આપીએ છીએ.</p>  
      <p>2. સદર નિમણૂક પત્રકાર તરીકે ની અપેક્ષાઓ સાથે શિસ્ત ના ધોરણો સ્વીકાર કરવાનીશરતે જ માન્ય રહેશે.</p>
      <p>3. સદર નિમણૂક બાદ અખંડ ભારત ન્યુઝ પરિવાર ની તમામ સુચનાઓ કે જેમાં પરિસ્થિતિમુજબ થતા ફેરફાર ને અમલમાં મૂકવાના રહેશે.</p>
      <p>4. ધંધાકીય જાહેરાતો મા આપને મળવા પાત્ર રકમ આપના બેન્ક ખાતામાં સીધા જ ચુકવણીકરવામાં આવશે </p>
      <p>5. આપના કાર્યક્ષેત્ર ના પોલીસ સ્ટેશનમાં આપનું વેરીફીકેશન અત્રે થી કરવામાં આવશે તથા આપનાનામની નોંધણી કરવામાં આવશે </p>
      <p>6. અસામાન્ય પરિસ્થિતિમાં સીધા જ અત્રે ની કચેરીમાં ફોન થી સંપકૅ કરી ને સમાચાર બનાવવા. </p>
      <p>7. આપશ્રી દ્વારા વોટ્સએપ પર જ સમાચાર અત્રે સમય મર્યાદામાં મોકલી આપવા રહેશે</p>
      <p>8. આપે મોકલાવેલ સમાચારની ક્રમાનુસારતા,અગત્યતા, અસરકારકતા વગેરે ને ધ્યાને લઈ ને જ છાપવામાં આવશે.</p>
      <p>9. સદર નિમણૂક અખંડ ભારત ન્યુઝ પરિવાર ની શરતોએ અમલ કરતા રહેશે. ગેરશિસ્ત અથવાઅન્ય અનિવાર્ય સંજોગોમાં આપોઆપ નિમણૂક રદ્દ કરવામાં આવશે.</p>
      <p>10. જરૂર જણાયેઅથવા અત્રે થી જણાવવામાં આવે ત્યારે આપશ્રીએ પ્રેસ કાર્યાલય ખાતે રૂબરૂમાં પણ આવવું પડશે તેની ખાસ નોંધ લેવી.</p>
      <p>11. આપના દ્વારા મોકલવામાં આવેલા સમાચારો / માહિતીનીસત્યતા આપની વ્યક્તિગતજવાબદારી રહેશે, જેમાં અખંડ ભારત ડેઇલી ન્યૂઝ પેપરની રહેશે નહિ.</p>
      <p>12. તમે જે જગ્યા માટે રજીસ્ટ્રેશન કરી રહ્યા છો તો તે જગ્યા ના ચોકકસ પૂરાવા હોવ જોઈએ. જેમ કે આધાર કાર્ડ, લાઈટ બિલ વગેરે... આવા ચોકકસ પુરવા હોય તોજ રજીસ્ટ્રેશન કરવુ.</p>
      <p>13.રજીસ્ટ્રેશન પ્રોસેસ અપ્રુવ થઈ જશે પછી પેમેન્ટ રિફંડ થશે નહીં.</p>
      <p>14. રજીસ્ટ્રેશન કરી પછી 24 કલાકમાં રજીસ્ટ્રેશન પ્રોસેસ અપ્રુવ થાઈ જશે એની નોંધ લેવી.</p>
      <p>15. જો ભૂલથી રજીસ્ટ્રેશન આને પેમેન્ટ પ્રોસેસ થઈ ગયું હોય તો 9909441697 નંબર ઉપર 24 કલાક ની અંદર જાણ કરવાની રહેશે.</p>
      <p>16. રજીસ્ટ્રેશન ના 24 કલાક પછી રિફંડ માટે કરેલા કોલ માન્ય ગણાશે નહીં.</p>
      <p>17. કોઈપણ લીગલ કામકાજ અર્થે ન્યાયક્ષેત્ર ગાંધીનગર રહેશે એની નોંધ લેવી.</p>
      <p>18. જો કોઈપણ કારણોસર રજીસ્ટ્રેશન રદ કરવામાં આવે અથવા ટર્મિનેટ કરવામાં આવે તો અખંડ ભારત દૈનિક તરફથી આપેલ આઈડી કાર્ડ, અપોઈન્ટમેન્ટ લેટર, વીઝીટીંગ કાર્ડ જેવી ઈમ્પોર્ટન્ટ વસ્તુઓ પરત કરવાની રહેશે.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
        <!-- Contact End -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script>
		/*  set_select();*/
		
		get_state(1);
		get_division(1);
		
		  
		  $("#profile_main_images").change(function() {
			profile_main_images(this);
		});
		
		$("#adharcard_main_images").change(function() {
		adharcard_main_images(this);
		});
		
		$("#pancard_main_images").change(function() {
		pancard_main_images(this);
		});

		function set_select(){
		$('.demo-chosen-select').chosen();
		$('.demo-cs-multiselect').chosen({width:'100%'});
		}
	
		function profile_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#profile_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function adharcard_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#adharcard_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	function pancard_main_images(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#pancard_main_images_blah').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	function display_member(id) {
    // Loop through numbers 1 to 6
    for (let i = 1; i <= 8; i++) {
        // Check if the current number is less than the provided id
        if (i <= id) {
            // Show the element with the class of the current number
            $("." + i).show();
        } else {
            // Hide the element with the class of the current number
            $("." + i).hide();
        }
    }
    
    if(id == 4)
    {
		
		 $(".district_m").hide();
		  $(".district").show();
	}
	else if(id == 5)
	{
		
		 $(".district").hide();
		  $(".district_m").show();
	}
	
	else if(id == 6)
	{
		
		 $(".district_m").hide();
		  $(".district").show();
	}
	
	else if(id == 7)
	{
		
		 $(".district").hide();
		  $(".district_m").show();
	}
	
	
	
}
	
	function get_state(country){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_state',
				type: 'POST',
				dataType: 'html',
				data: {country:country},
				success: function(data){
					
					if(data != ''){
						$('#state').html(data);
					}
				}
			});
		}
		
		function get_division(state){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_division',
				type: 'POST',
				dataType: 'html',
				data: {state:state},
				success: function(data){
					
					if(data != ''){
						$('#division').html(data);
					}
				}
			});
		}
		
		function get_district(division){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_district',
				type: 'POST',
				dataType: 'html',
				data: {division:division},
				success: function(data){
					
					if(data != ''){
						$('#district').html(data);
						
					}
				}
			});
		}
		
		function get_district_m(division){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_district_m',
				type: 'POST',
				dataType: 'html',
				data: {division:division},
				success: function(data){
					
					if(data != ''){
						
						$('#district_m').html(data);
					}
				}
			});
		}
		function get_taluka(district){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_taluka',
				type: 'POST',
				dataType: 'html',
				data: {district:district},
				success: function(data){
					
					if(data != ''){
						$('#taluka').html(data);
					}
				}
			});
		}
		
		function get_taluka_m(district_m){
			
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_taluka_m',
				type: 'POST',
				dataType: 'html',
				data: {district_m:district_m},
				success: function(data){
					
					if(data != ''){
						$('#taluka_m').html(data);
					}
				}
			});
		}
		
		
		function get_gram_panchayat(taluka){
		var base_url = $('#base_url').val();		
			$.ajax({
				url : base_url+'register/get_gram_panchayat',
				type: 'POST',
				dataType: 'html',
				data: {taluka:taluka},
				success: function(data){
					
					if(data != ''){
						$('#gram_panchayat').html(data);
					}
				}
			});
		}
	
	
	

</script>


 
