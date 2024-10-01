<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>visiting card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        *{
            margin: 0px;
            padding: 0px;
            font-family: "Maven Pro", sans-serif;
        }
        .card-main{
			
            position: relative;
            width: 800px;
            margin: 0 auto;
            padding: 100px 0px;           
            background-size: cover;
        }
        .card-com{
         
            max-width: 600px;
            height: 360px;
            width: 600px;
            margin: 0 auto;
            background: url('<?php echo base_url(); ?>uploads/other_images/abdaily_bg.png') no-repeat center;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
        }
        .name-text{           
            
            text-align: center;
            position: absolute;
            bottom: -3px;
            left: 0px;
        }
		.name-text img{           
            width: 100%;
           
        }
        .name-text h1{
            color: #fff;
            font-size: 30px;
            text-transform: uppercase;
        }
        .top-img{
            text-align: center;
        }
        .top-img img{
            max-width:350px;
        }
        .top-img img{
            display: block;
            margin: 0 auto;
        }
        .ft-logo{
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .ft-logo img{
            max-width:100%;
        }
		
        .card-inner{
            display: flex; 
            height: 100%;
        }
        .left-logo-in{
            width: 50%;
            height: 100%;
            position: relative;
        }
        .left-logo-in img{
            max-width: 85%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .right-card-adr{
            width: 50%;
            height: 100%;
           
            
        }
        .inner-right{
            padding-right: 20px;
            padding-top: 30px;
        }
        .topname{
            text-align: left;
			margin-top:5px;
			margin-left:-9px;
        }
        .topname h2{
            color: #401180;
            font-size: 20px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .topname p{
            font-size: 17px;
            color: #401180;
            position: relative;
        }
        .topname p::after{
            content: "";
            background: #401180;
            height: 2px;
            width: 50%;
            position: absolute;
            bottom: 7px;
            right: 0px;
        }
        .adrleft ul li{
            display: flex;
            margin-bottom: 1px;
        }
        .adrleft{
            padding-top: 4px;
            margin-left: -10px;
        }
        .adr-text{
            width: 80%;
            text-align: left;
			margin-top:8px;
        }
        .adr-text p{
            text-align: left;
            font-size: 14px;
            color: #401180;
            line-height: 20px;
        }
        
        .icon-br{
            width: 38px;
            height: 35px;
            
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .icon-br img{
            max-width:33px;
            width: 100%;
        }
        .adr-text-right{
            width: 80%;
            text-align: left;
            display: flex;
            align-items: center;
            padding-left: 10px;
        }
        .adr-text-right strong{
            font-size: 18px;
            color: #401180;
            font-weight: 600;
        }
        .adr-text{
            padding-left: 20px;
        }
		
		

       
    </style>
</head>
<body>
    
    <div class="card-main" id="capture">
        <div class="card-com">
           
            <div class="ft-logo">
                <img src="<?php echo base_url(); ?>uploads/other_images/logo_front.png" alt="" />
            </div>
            <div class="name-text">
               <img src="<?php echo base_url(); ?>uploads/other_images/downborder.png" alt="" />
            </div>
        </div>
        <div class="card-com">
            <div class="card-inner">
                <div class="left-logo-in">
                    <img src="<?php echo base_url(); ?>uploads/other_images/logo_front.png" alt="" />
                </div>
                <div class="right-card-adr">
                    <div class="inner-right">
                        <div class="topname">
                            <h2><?php echo $user_detail['name']; ?></h2>
                            <p><strong><?php if($user_detail['member_type_id'] == '8') { echo "Area" ; }else { echo $user_detail['member_type_name']; }?> Reporter</strong></p>
                        </div>
                        <div class="adrleft">
                            <ul>
                                <li>
                                    <div class="icon-br">
                                        <img src="<?php echo base_url(); ?>uploads/other_images/phon.png" alt="" />
                                    </div>
                                    <div class="adr-text">
                                         <p><strong>+ 91 <?php echo $user_detail['mobile']; ?></strong></p>
                                    </div>
									
                                </li>
                                <li>
                                    <div class="icon-br">
                                        <img src="<?php echo base_url(); ?>uploads/other_images/mail.png" alt="" />
                                    </div>
                                    <div class="adr-text">
                                        <p> <strong>www.abdailynews.com</strong></p>
                                    </div>
                                </li>
								<li>
                                    <div class="icon-br">
                                        <img src="<?php echo base_url(); ?>uploads/other_images/email.png" alt="" />
                                    </div>
                                    <div class="adr-text">
                                          <p><strong>akhandbharatdainik@gmail.com</strong></p>
                                    </div>
                                </li>
								<li>
                                    <div class="icon-br">
                                        <img src="<?php echo base_url(); ?>uploads/other_images/address.png" alt="" />
                                    </div>
                                    <div class="adr-text">
                                          <p><strong><?php echo $user_detail['address']; ?></strong></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
						 <div class="name-text">
               <img src="<?php echo base_url(); ?>uploads/other_images/front_border.png" alt="" />
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


<script>
    // Wait until the document is fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Capture the div with id #capture
        html2canvas(document.querySelector("#capture"), { 
            scale: 2 // Increase the scale for higher resolution
        }).then(canvas => {
            const imgData = canvas.toDataURL("image/png");
            const { jsPDF } = window.jspdf; // Access jsPDF correctly
            const pdf = new jsPDF();
            
            const imgWidth = 190; // PDF width minus margins
            const pageHeight = pdf.internal.pageSize.height;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;
            let position = 0;
            
            // Add image to PDF
            pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            // Add more pages if content is longer than one page
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Save the generated PDF
            pdf.save('visiting_card.pdf');
        });
    });
</script>