<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Vertical Business Card</title>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        
        body {
            margin: 0;
            font-family: Roboto, Arial, Helvetica, sans-serif;
            position: relative;
        }
        h1, h2, h3, h4, p{
            margin: 0px;
        }
        ul, li, ol {
            margin: 0px;
            padding: 0px;
            list-style: none;
        }
        .business2 {
            display: flex;
            align-items: center;
            min-height: 100vh;
            justify-content: center;
            background-color: #fff;
        }
        .business2 .front, .business2 .back{
            background: #fff;
            width: 420px;
            height: 690px;
            margin: 20px;
            overflow: hidden;
            position: relative;
           border: 1px solid rgba(100, 100, 111, 0.2);
        }
        .ptn-bg::before{
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/bg-ptn.jpg') no-repeat center;
            background-size: cover;
            width: 420px;
            height: 690px;
            position: absolute;
            top: 0;
            left: 0;
        }
        /*.ptn-bg::after{
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/3.png') no-repeat center;
            background-size: cover;
            width: 149px;
            height: 169px;
            position: absolute;
            bottom: 0;
            right: 0;
        }*/
        .top-logo{
            margin-top: 30px;
        }
        .top-logo img{
            width: 190px;
        }
        .center-md{
            width: 350px;
            margin: 0 auto;
            text-align: center;
			position: relative;
        }
        .avatar{
            width: 215px;
            height: 215px;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .avatar .img{
			width: 207px;
            height: 207px;
            border-radius: 100%;
            overflow: hidden;
            border: 4px solid #f06836; 
        }
        .avatar .img img{
			width: 100%;
			height: 100%;
			display: block;
			object-fit: cover;
			min-height: 100%;
			min-width: 100%;
			max-width: 100%;
			max-height: 100%;
        }
        .top-text{
            text-align: center;
            margin-bottom: 20px;
        }
        .top-text h3{
            font-size: 24px;
            color: #390c83;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .top-text p{
            font-size: 18px;
            color: #390c83;
            font-weight: 500;
            text-transform: uppercase;
        }
        .main-info ul{
            width: 300px;
            margin: 0 auto;
        }
        .main-info ul li{
            text-align: left;
            line-height: 26px;
        }
        .main-info ul li span{
            font-size: 16px;
            color: #390c83;
        }
        .main-info ul li span:first-child {
            width: 115px;
            display: inline-block;
        }
        .main-info ul li span:last-child {
            margin-left: 5px;
        }
        .sign-cn-img{
            margin-top: 10px;
        }
        .sign-cn-img img{
            width: 180px;
        }
        .center-int{
            width: 380px;
            margin: 0 auto;
            margin-top: 110px;
			position: relative;
        }
        .top-txt{
            text-align: center;
            margin-bottom: 30px;
        }
        .top-txt h2{
            background: #fd6129;
            color: #fff;
            text-transform: uppercase;
            display: inline-block;
            padding: 10px 15px;
            border-radius: 24px;
            font-size: 37px;
        }
        .inner-info p{
            font-size: 18px;
            color: #390c83;
        }
        .text-jst p{
            text-align: justify;
            margin-bottom: 20px;
        }
        .text-jst p:last-child{
            margin-bottom: 0px;
        }
        .ptn-tx{
            width: 40px;
            height: 170px;
            background: #41107e;
        }
        .ptn-tx.right{
            position: absolute;
            top: 0;
            right: 0px;
        }
        .ptn-tx.right::after{
            content: "";
            border-top: 0px solid transparent;
            border-bottom: 50px solid transparent;
            border-left: 40px solid #41107e;
            width: 10px;
            height: 0px;
            position: absolute;
            bottom: -49px;
            right: -10px;
        }
        .prs-text h3{
            position: absolute;
            color: #fff;
            font-size: 24px;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        .ptn-tx.left{
            position: absolute;
            bottom: 0;
            left: 0px;
        }
        .ptn-tx.left::before{
            content: "";
            border-top: 0px solid transparent;
            border-bottom: 50px solid #41107e;
            border-right: 40px solid transparent;
            width: 10px;
            height: 0px;
            position: absolute;
            top: -49px;
            left: -10px;
        }
    </style>

</head>
<body>

    <div class="business2" id="capture">
        <div class="front ptn-bg">
		<div class="ptn-tx right prs-text">
                    <h3>P<br />R<br />E<br />S<br />S</h3>
                </div>
            <div class="center-md">
                

                <div class="top-logo">
                    <img src="<?php echo base_url(); ?>uploads/other_images/abdaily_logo.png" alt="logo" />
                </div>
                <div class="avatar">
                    <div class="img">
                        <img src="<?php echo base_url(); ?>uploads/abdaily_profile_images/<?php echo $user_detail['profile_image']; ?>" alt="" />
                    </div>
                </div>
                <div class="main-info">
                    <div class="top-text">
                        <h3><?php echo $user_detail['name']; ?></h3>
                        <p><?php echo $user_detail['member_type_name']; ?> Reporter</p>
                    </div>
                    <ul>
                        <li><span>ID No</span> : <span><?php echo $user_detail['id']; ?></span></li>
                        <li><span>Phone</span> : <span><?php echo $user_detail['mobile']; ?>  </span></li>
                        <li><span>Blood Group</span> : <span>O+</span></li>
                        <li><span>D.O.I.</span> : <span><?php echo date("d-m-Y",strtotime($user_detail['created_date'])); ?></span></li>
                        <li><span>Validity</span> : <span>Lifetime</span></li>
                    </ul>
                </div>
                <div class="sign-cn-img">
                    <img src="<?php echo base_url(); ?>uploads/other_images/sign.jpg" alt="" />
                </div>

                
            </div>
			<div class="ptn-tx left"></div>
        </div>
        <div class="back ptn-bg">
            <div class="center-int">
                <div class="top-txt">
                    <h2>Instructions</h2>
                </div>
                <div class="inner-info">
                    <div class="text-jst">
				<p >This holder of Card is Authorised To
				Take An Interviews, Photography Or
				Videography To Collect Report On
				Behalf of AKHAND BHARAT NEWS PAPER</p>

				<p >Misuse of this Card Stands As
				Automatically Cancalled.</p>

				<p >The holder of this Card will be liable 
				for any kind of misuse.</p>
			

                    </div>
                   
					<p >IF FOUND PLEASE RETURN TO</p>
					<p >Agency Department </p>
					<p >Akhand Bharat </p>
					<p >First Floor 125, Shri Rang Plaza 95, </p>
					<p >Gift City , road , Randesan</p>
					<p >Gandhinagar , Gujarat</p>
					<p >Pincode :382007</p>
					<p >Mobile No : (+91 990-9441-697)</p>
					<p >Website : www.abdailynews.com</p>
					<p>Email : akhandbharatdainik@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- partial -->
  
</body>
</html>
<script>
    // Wait until the document is fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Capture the div with id #capture
        html2canvas(document.querySelector("#capture"), {
            scale: 3, // Increase the scale for higher resolution (3x)
            useCORS: true, // Enable cross-origin images to be captured
            allowTaint: true, // Allow cross-origin tainting (optional)
            logging: true, // Enable logging for debugging
            windowWidth: document.documentElement.scrollWidth, // Full width of the content
            windowHeight: document.documentElement.scrollHeight // Full height of the content
        }).then(canvas => {
            const imgData = canvas.toDataURL("image/png", 1.0); // Get high-quality image (1.0 = max quality)
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4'); // A4 size PDF

            const imgWidth = 210; // A4 width in mm
            const pageHeight = pdf.internal.pageSize.height;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;

            // Add image to PDF
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            // Add more pages if content is longer than one page
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Save the generated high-resolution PDF
            pdf.save('visiting_card.pdf');
        });
    });
</script>

<?php echo die; ?>

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
		<div style="border-radius: 15px;overflow:hidden;"><img src='.base_url().'uploads/abdaily_profile_images/'.$user_detail['profile_image'].' style="height:100px;width:100px;border: 2px solid #000;border-radius: 100%;overflow:hidden;" /></div>
		<p class="title"><b>'.strtoupper($user_detail['name']).' '.strtoupper($user_detail['lastname']).'</b><br>
		<b style="font-size:10px;">'.strtoupper($user_detail['member_type_name']).' REPORTER</b><br>
		ID :ABD2024000'.$user_detail['id'].'<br>
		Issue Date : '.strtoupper(date("d-m-Y",strtotime($user_detail['created_date']))).'
		<br>
		Validity : Liftime </p>
		<p><img src="'.base_url().'uploads/other_images/signature.png" style="height:25px;width:150px;"></p>
		<p><img src="'.base_url().'uploads/other_images/stamp.png" style="height:100px;width:100px;"></p>
		<p>Authorised Signature<br>
		<span style="color:red;">RNI NO : GUJGUJ/2011/39896</span>
		<span style="color:#FF5733;">www.abdailynews.com</span>
  
</div>

<div class="card back">
	<h1 style="padding:0px 0;padding-top: 2px;margin:0px;margin-top: 10px; font-weight: 500;">INSTRUCTIONS</h1>
	<p style="text-align:justify; margin-left:5px;font-size:16px;" >This holder of Card is Authorised To
	Take An Interviews, Photography Or
	Videography To Collect Report On
	Behalf of AKHAND BHARAT NEWS PAPER</p>
	
	<p style="text-align:justify; margin-left:5px;font-size:16px;">Misuse of this Card Stands As
	Automatically Cancalled.</p>
	
	<p style="text-align:justify; margin-left:5px;font-size:16px;">The holder of this Card will be liable 
	for any kind of misuse.</p>
	
	<p style="text-align:justify; margin-left:5px;font-size:16px;">IF FOUND PLEASE RETURN TO <br>
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


