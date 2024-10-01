<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>visiting card</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap" rel="stylesheet">


  
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
            border-radius: 100%;
            overflow: hidden;
            margin-left: 0px;
            background: #dcd3c2;
			verflow:hidden;
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
        .inner-usrbx{
            padding-left: 180px;
            padding-top: 218px;
        }
        .abh-text-img{
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0px;
            top: 0px;
        }

    </style>
  
  
</head>
<?php

$html = '
<body>
<div class="hb-card-main">
        <img src="'.base_url().'uploads/other_images/abh-text.png" class="abh-text-img" alt="" />
        <div class="inner-usrbx">
            <div class="user-profile">
                <img src="'.base_url().'uploads/abdaily_profile_images/'.$user_detail['profile_image'].'" alt="" />
            </div>
        </div>
       <div class="user-desc">
            <h1>'.$user_detail['name'].'</h1>
            <h4>'.$user_detail['member_type_name'].' Reporter</h4>
            <p>અખંડ ભારત દૈનિક ન્યૂઝ પરિવારમાં આપનું હાર્દિક સ્વાગત છે.</p>
       </div>
    </div>
    
   

</body>';
echo $html;

?>