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
            width: 950px;
            height: 690px;
            margin: 20px;
            overflow: hidden;
            position: relative;
           border: 1px solid rgba(100, 100, 111, 0.2);
        }
        .ptn-bg::before{
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/appointment_letter.jpg') no-repeat center;
            background-size: cover;
            width: 690px;
            height: 950px;
            position: absolute;
            top: 0;
            left: 0;
        }
		 .ptns-bg::before{
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/bg-ptns.jpg') no-repeat center;
            background-size: cover;
            width: 420px;
            height: 690px;
            position: absolute;
            top: 0;
            left: 0;
        }
       
        .top-logo{
            margin-top: 60px;
        }
        .top-logo img{
            width: 190px;
        }
        .center-md{
            width: 900px;
            margin: 0 auto;
            text-align: center;
			position: relative;
			margin-top:370px;
        }
        .avatar{
            width: 215px;
            height: 215px;
            position: relative;
            overflow: hidden;
            margin: 0 auto;
            margin-top: 20px;
            margin-bottom: 10px;
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
            margin-bottom: 10px;
        }
        .top-text h3{
            font-size: 35px;
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
            margin-top: -8px;
			margin-left:32px;
        }
        .sign-cn-img img{
            width: 180px;
        }
        .center-int{
            width: 380px;
            margin: 0 auto;
            margin-top: 30px;
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
			line-height:22px;
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
            <div class="center-md">               
                <div class="main-info">
                    <div class="top-text">
                        <h3><?php echo $user_detail['name']; ?></h3>
                    </div>
                    <div class="inner-info">
                        <p style="font-size:15px;">Agency Address : Shri Rang Plaza 95, Gift City Road, Randesan,Gandhinagar, Gujarat-382007</p>
                        <p>Is an authorized advertisement agency to place advertisements on behalf of</p>
                        <p>their clients in Akhand Bharat Daily Newspapaer.</p>
                        <p>This certificate is valid from  <?php echo date("d-m-Y",strtotime($user_detail['created_date'])); ?> to onwards</p>
                       
                   </div>
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
            pdf.save('id_card.pdf');
        });
    });
</script>

