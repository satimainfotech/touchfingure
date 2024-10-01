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
        @font-face {
		font-family: 'Neothic';
		src: url('<?php echo base_url(); ?>template/fonts/Neothic.woff2') format('woff2'),
		url('<?php echo base_url(); ?>template/fonts/Neothic.woff') format('woff');
		font-weight: normal;
		font-style: normal;
		font-display: swap;
        }


        .hb-card-main{
            width: 680px;
            margin: 0 auto;
            height: 680px;
            background: url('<?php echo base_url(); ?>uploads/other_images/bg.png') no-repeat center;
            background-size: cover;
            position: relative;
        }
        .hb-card-main::before{
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/abh-text.png') no-repeat center;
            background-size: cover;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
        }
        .hb-card-main::after{
            content: "";
            background: url('<?php echo base_url(); ?>uploads/other_images/round.png') no-repeat center;
            background-size: cover;
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
        }
        .user-profile{
            width: 312px;
            height: 312px;
            position: absolute;
            top: 56%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 100%;
          
			
        }
        .user-desc{
            position: absolute;
            width: 490px;
            margin: 0 auto;
            text-align: center;
            left: 0;
            right: 0;
            bottom: 60px;
            z-index: 2;
        }
        .user-desc h1{
            text-transform: uppercase;
            color: #880d08;
            font-size: 30px;
            font-family: 'Neothic';
            background: #fff;
            display: inline-block;
            margin-bottom: 6px;
        }
        .user-desc h4{
            font-size: 20px;
            text-transform: uppercase;
            color: #880d08;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .user-desc p{
            font-size: 20px;
            text-transform: uppercase;
            color: #880d08;
        }

    </style>
</head>
<body>
    
    <div class="hb-card-main" id="capture">
       <div class="user-profile">
            <img src="<?php echo base_url();?>uploads/abdaily_profile_images/<?php echo $user_detail['profile_image'];?>" style="height:300px;width:300px;border-radius: 100%;" alt="" />
       </div>
       <div class="user-desc">
            <h1><?php echo $user_detail['name'];?></h1>
            <h4><?php echo $user_detail['member_type_name'];?> Reporter</h4>
            <p>અખંડ ભારત દૈનિક ન્યૂઝ પરિવારમાં આપનું હાર્દિક સ્વાગત છે.</p>
       </div>
    </div>

</body>
</html>

<script>
    // Wait until the document is fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Capture the div with id #capture
        html2canvas(document.querySelector("#capture")).then(canvas => {
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
            pdf.save('congratulations.pdf');
        });
    });
</script>

