

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>关于我们</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>
    <style>
        html{
            height: 100%;
        }
        .my_tip1 {
            /*width:100%;
            height: 1.2rem;*/
            display: -webkit-flex;
            -webkit-align-items: center;
            -webkit-justify-content: space-between;
            text-align: left
        }
        .left_10{
            margin-left: 0.4rem;
            width: 100%;
            color: #0065d0;
            font-size: 17px;
        }
        .my_top{
            height: 5rem;
        }
        .my_tip_text{
            flex-shrink: 0;
            -webkit-flex-shrink:0;
            color: #0065d0;
            font-size: 17px;
        }
        .my_footer{
            position: absolute;
            bottom: 20px;
            width: 100%;
        }
        .my_footer p{
            line-height:1.6 ;
            text-align: center;
            color: #636363;
            font-size: 0.32rem;
        }
    </style>
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>
<div
        style="background-color: #ffffff; height: 100%; overflow-y: scroll;">
    <div class="my_top">

        <div style="width: 100%; margin-left: 0px; top: 1.7rem"
             class="my_top1">
            <img src="{{URL::asset('assets/image/logo.png')}}" alt=""
                 style="margin: 0 auto; width: 130px; background: white;">
        </div>
        <div style="position: absolute; top: 4.3rem; width: 100%;">
            <p style="text-align: center; font-size: 0.32rem; color: #636363;">版本：V1.6</p>
        </div>
    </div>
    <div class="my_tip">
        <a href="tel:0757-22908300">
            <div class="my_tip1">
                <span class="img_middle left_10">客服热线</span>
                <span class='my_tip_text'>0757-22908300</span>
                <img src="{{URL::asset('assets/image/my_right.png')}}" alt="" class="img_right">
            </div>
        </a>
        <a href="about_useragreement">
            <div class="my_tip1">
                <span class="img_middle left_10">服务协议</span>
                <img src="{{URL::asset('assets/image/my_right.png')}}" alt="" class="img_right">
            </div>
        </a>


    </div>
    <div class="my_footer">
        <p>@2019-2020 Copyright</p>
        <p>广东东菱智泊停车科技有限公司 版权所有</p>
    </div>
</div>

</body>
</html>
