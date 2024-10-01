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
        ul, li, ol{
            list-style: none;
        }
        .card-main{
            position: relative;
            width: 800px;
            margin: 0 auto;
            padding: 50px 0px;
         
            background-size: cover;
        }
        .card-com{
            border: 2px solid #2b2a29;
            width: 600px;
            height: 360px;
            margin: 0 auto;
            background: #dfdfdf;
            margin-bottom: 20px;
            text-align: center;
            position: relative;
        }
        .name-text{
            background: #545454;
            padding: 4px 0px;
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 0px;
            left: 0px;
        }
        .name-text h1{
            color: #fff;
            font-size: 34px;
            text-transform: uppercase;
        }
        .top-img{
            text-align: center;
        }
        .top-img img{
            width:350px;
        }
        .top-img img{
            display: block;
            margin: 0 auto;
        }
        .ft-logo{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .ft-logo img{
            width: 250px;
        }
        .card-inner{
            height: 100%;
        }
        .left-logo-in{
            width: 300px;
            height: 100%;
            position: relative;
            float: left;
        }
        .left-logo-in img{
            width: 200px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .right-card-adr{
            width: 300px;
            height: 100%;
            background: #545454;
            float: right;
        }
        .inner-right{
            padding-right: 20px;
            padding-top: 30px;
        }
        .topname{
            text-align: right;
        }
        .topname h2{
            color: #fff;
            font-size: 30px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .topname p{
            font-size: 17px;
            color: #fff;
            position: relative;
        }
        .topname p::after{
            content: "";
            background: #f5642d;
            height: 2px;
            width: 60px;
            position: absolute;
            bottom: -10px;
            right: 0px;
        }
        .adrleft ul li{
            display: flex;
            margin-bottom: 14px;
        }
        .adrleft{
            padding-top: 43px;
            margin-left: -20px;
        }
        .adr-text{
            width: 80%;
            text-align: left;
        }
        .adr-text p{
            text-align: left;
            font-size: 14px;
            color: #fff;
            line-height: 26px;
        }
        
        .icon-br{
            width: 38px;
            height: 38px;
            background: #f5642d;
            border-radius: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .icon-br img{
            width:24px;
        }
        .adr-text-right{
            width: 80%;
            text-align: left;
            display: flex;
            align-items: center;
            padding-left: 20px;
        }
        .adr-text-right strong{
            font-size: 23px;
            color: #fff;
            font-weight: 600;
        }
        .adr-text{
            padding-left: 20px;
        }

        .icon-br::after{
            content: "";
            width: 28px;
            height: 54px;
            background: url('<?php echo base_url(); ?>uploads/other_images/line.png') no-repeat center;      
            background-size: 100% 100%;      
            position: absolute;
            right: -7px;
        }

        .adrleft ul li:last-child .icon-br::after{
            left: -7px;
            background: url('<?php echo base_url(); ?>uploads/other_images/2-line.png') no-repeat center;  
            background-size: 100% 100%;             
        }

    </style>
       

    
</head>
<?php

$html = '
<body>
    
    <div class="card-main">
        <div class="card-com">
            <div class="top-img">
                <img style="width:300px;" src="'.base_url().'uploads/other_images/rni-img.jpg" alt="" />
            </div>
            <div class="ft-logo">
                <img style="width:250px;" src="'.base_url().'uploads/other_images/logo.png" alt="" />
            </div>
            <div class="name-text">
                <h1>'.$user_detail['name'].'</h1>
            </div>
        </div>
        <div class="card-com">
            <div class="card-inner">
                <div class="left-logo-in">
                    <img style="width:200px;" src="'.base_url().'uploads/other_images/logo-2.png" alt="" />
                </div>
                <div class="right-card-adr">
                    <div class="inner-right">
                        <div class="topname">
                            <h2>'.$user_detail['name'].'</h2>
                            <p>'.$user_detail['member_type_name'].' Reporter</p>
                        </div>
                        <div class="adrleft">
                            <ul>
                                <li>
                                    <div class="icon-br">
                                        <img style="width:24px;" src="'.base_url().'uploads/other_images/icon-01.jpg" alt="" />
                                    </div>
                                    <div class="adr-text-right">
                                        <strong>+91 '.$user_detail['mobile'].'</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon-br">
                                        <img style="width:24px;" src="'.base_url().'uploads/other_images/icon-02.jpg" alt="" />
                                    </div>
                                    <div class="adr-text">
                                        <p>'.$user_detail['address'].'</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>';
echo $html;

?>