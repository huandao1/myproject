<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>申请成功</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>

    <style type="text/css">

        body{font-family: 华文细黑,"Microsoft YaHei",微软雅黑, SimSun, 宋体,Tahoma, Arial, Helvetica, sans-serif;}
        #header {
            float: left;
            width: 100%;
            height: 50px;
            padding: 0px 2%;
            position: fixed;
            left: 0px;
            top: 0px;
            z-index: 99999;
            background-color: #0d57a0;
            color: #fff;
        }

        #header a.backtitle {
            float: left;
            height: 50px;
            line-height: 50px;
            color: #fff;
            background: url(./Image/ico_arrow_white_left.png) no-repeat left center;
            -moz-background-size: auto 40%;
            -khtml-background-size: auto 40%;
            -webkit-background-size: auto 40%;
            -o-background-size: auto 40%;
            background-size: auto 40%;
        }
        a {
            text-decoration: none;
            background-color: transparent;
            -webkit-transition: all 0.30s ease 0s;
            -moz-transition: all 0.30s ease 0s;
            -o-transition: all 0.30s ease 0s;

        }
        #header {padding-left:0}
        #header a.backtitle {font-size:20px;  width:100%; text-align:center; background-position:10px center}
        .paper {
            padding-top: 30%;
            padding-left: 16px;
            padding-right: 16px;
        }

        .btn-block{
            width: 100%;
            height: 1rem;
            background: #0d57a0;
            border-radius: 0.16rem;
            border: none;
            color: #ffffff;
            font-weight: bold;
            font-size: 0.4rem;
        }
        .paper .info{display:-webkit-flex;-webkit-align-items:center;-webkit-justify-content:space-between;width: 4.6rem; position: relative;left: 15%;}
    </style>
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>

<header id="header">
    <a class="backtitle" href="">停车订单</a>
</header>
<section>
    <div class="paper" >
        <div class="info">
            <img src="{{URL::asset('assets/image/wancheng.png')}}" style="height: 2.1rem;">
            <strong style="color:#3d64b0;font-size: 0.5rem">申请成功</strong>
        </div>
        <button class="btn-block" onclick="delay()">确定</button>
    </div>

</section>
</body>
<script src="{{URL::asset('assets/layer/layer.js')}}"></script>
<script type="text/javascript">

    function delay(){
        layer.open({
            type:2
            ,time: 3 ,//2秒后自动关闭
            end: function(){
                window.location.href='pay_jishi?id=1'
            }
        });


    }
</script>
</html>