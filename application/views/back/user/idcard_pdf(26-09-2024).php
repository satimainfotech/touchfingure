

<meta charset="UTF-8">
<style>
.card {
  	border:1px solid #ccc;
  border-radius:8px;
  text-align: center;  
  float:left;
  width:47%;
 margin-left :5px !important;
 -webkit-box-shadow: 0px 0px 27px -6px rgba(0,0,0,0.39);
-moz-box-shadow: 0px 0px 27px -6px rgba(0,0,0,0.39);
box-shadow: 0px 0px 27px -6px rgba(0,0,0,0.39);
margin:10px;
}
.card.back
{
	padding:0 15px;	
	border:1px solid #ccc;
	width:281px;
	margin-left:20px;
}
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}


</style>
<?php

$html = '
	<section style="width: 100%">
	<body class="clearfix">
		<div class="card" >
		<div style=" background-color: red;
            color: white;
            padding: 0px;border-radius:8px 8px 0px 0px;
            text-align: center;"><h1 style="margin:0px;font-size:70px;">PRESS</h1></div>
		<img  src="'.base_url().'uploads/other_images/ab_logo.png" style="height:100px;width:150px;"><br>
		<div style="border-radius: 100%;overflow:hidden;"><img src='.base_url().'uploads/abdaily_profile_images/'.$user_detail['profile_image'].' style="height:100px;width:100px;border: 2px solid #000;border-radius: 100%;overflow:hidden;" /></div>
		<p class="title"><b>'.strtoupper($user_detail['name']).' '.strtoupper($user_detail['lastname']).'</b><br>
		<b style="font-size:10px;">'.strtoupper($user_detail['member_type_name']).' REPORTER</b><br>
		ID :ABD2024000'.$user_detail['id'].'<br>
		<p><img   src="'.base_url().'uploads/other_images/signature.png" style="height:25px;width:150px;"></p>
		<p>Authorised Signature<br>
		<span style="color:red;">RNI NO : GUJGUJ/2011/39896</span>
		<span style="color:#FF5733;">www.abdailynews.com</span>
  
</div>

<div class="card back">
	<h1 style="padding:0px 0;padding-top: 2px;margin:0px;margin-top: 10px; font-weight: 500;">INSTRUCTIONS</h1>
	<p style="text-align:left; margin-left:5px;font-size:16px;" >This Id Card Holder is Authorised To<br>
	Take An Interviews, Photography Or<br>
	Videography To Collect Report On<br>
	Behalf of AKHAND BHARAT NEWS PAPER<br></p>
	
	<p style="text-align:left; margin-left:5px;font-size:16px;">Misuse Of this Card Stands As<br>
	Automatically Cancalled.</p>
	
	<p style="text-align:left; margin-left:5px;font-size:16px;">IF FOUND PLEASE RETURN TO <br>
	Agency Department <br>
	Akhand Bharat <br>
	First Floor 125, Shri Rang Plaza 95, <br>
	Gift City , road , Randesan<br>
	Gandhinagar , Gujarat<br>
	Pincode :382007<br>
	Mobile No : (+91 990-9441-697)<br><br>
	<br>
</div>
</body>

	</section>	
';

	echo $html;

?>


