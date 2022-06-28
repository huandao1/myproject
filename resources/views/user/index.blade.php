<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人中心</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>
    <style>
        .my_tip1 {
            /*width:100%;
            height: 1.2rem;*/
            display: -webkit-flex;
            -webkit-align-items: center;
            -webkit-justify-content: space-between;
            text-align: left;
            display: flex;
            box-sizing: border-box;
        }
        .img_middle {
            margin-left: 10px;
            display: flex;
            align-items: center;
            display: -webkit-flex;
            -webkit-align-items: center;
            width: 100%;
        }
        .img_icon{
            width: 12px
        }
        .my_tip1__point{
            margin-left: 5px;
            width: 7px;
            height: 7px;
            background: red;
            border-radius: 50%;
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
        style="background-color: #ffffff; height: 100%; overflow-y: auto; overflow-x: hidden">
    <div class="my_top">
        <img src="{{URL::asset('assets/image/bg.png')}}" alt=""
             style="width: 7.5rem; height: 3.14rem;">
        <div style="width: 100%; margin-left: 0px; top: 0.8rem"
             class="my_top1">
            <img src="{{$headimgurl}}" alt="" style="margin: 0 auto; width: 1.6rem; height: 1.6rem; border-radius: 1rem; background: white;">
        </div>
        <div style="position: absolute; top: 2.5rem; width: 100%">
            <p style="text-align: center; font-size: 0.36rem; color: #0d57a0;">{{$personInfo['Data']['Items'][0]['MobileNO']}}</p>
        </div>
    </div>
    <div class="my_tip">
        <a href="pay_zhangdan"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/my_02.jpg')}}" alt="" class="img_left"><span
                        class="img_middle">账单明细</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                                                           class="img_right">
            </div></a> <a href="pay_noapply"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/bujiao.png')}}" alt=""
                     style="margin-left: 0.42rem; width: 0.51rem; height: 0.51rem;"><span
                        class="img_middle">欠费补缴</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                                                           class="img_right">
            </div></a> <a href="Coupon"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/coupon_icon.png')}}" alt=""
                     style="margin-left: 0.42rem; width: 0.51rem; height: 0.51rem;"><span
                        class="img_middle">优惠券</span><img
                        src="{{URL::asset('assets/image/my_right.png')}}" alt="" class="img_right">
            </div></a>
        <a href="cardlist"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/month.png')}}" alt="" class="img_left"><span
                        class="img_middle">月卡管理</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                                                           class="img_right">
            </div></a>

        <a href="javascript:void(0);" id='couponTip'><div class="my_tip1">
                <img src="{{URL::asset('assets/image/usecouponIcon.png')}}" alt="" class="img_left">
                <span class="img_middle couponText">限时抽奖活动
						<img src="{{URL::asset('assets/image/fire.png')}}" alt="" class="img_icon">
					</span>

                <img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                     class="img_right">
            </div></a>

        <a href="chepaicheck"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/pipi.png')}}" alt="" class="img_left"><span
                        class="img_middle">车牌管理<span class='my_tip1__point'></span></span>
                <img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                     class="img_right">
            </div></a>
        <a href="invoice"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/invoice.png')}}" alt=""
                     class="img_left"><span
                        class="img_middle">电子发票</span><img
                        src="{{URL::asset('assets/image/my_right.png')}}" alt="" class="img_right">
            </div></a>
        <a href="login_passwordjump"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/my_03.jpg')}}" alt="" class="img_left"><span
                        class="img_middle">修改密码</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                                                           class="img_right">
            </div></a>
        <a href="about"><div class="my_tip1">
                <img src="{{URL::asset('assets/image/about.png')}}" alt="" class="img_left"><span
                        class="img_middle">关于我们</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                                                           class="img_right">
            </div>
        </a>

        <div class="my_tip1" onclick="jiebang()">
            <img src="{{URL::asset('assets/image/logout.png')}}" alt="" class="img_left"><span
                    class="img_middle">退出登录</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                                                       class="img_right">
        </div>

    </div>
</div>

</body>
<script>
    window.alert = function(name){
        var iframe = document.createElement("IFRAME");
        iframe.style.display="none";
        iframe.setAttribute("src", 'data:text/plain,');
        document.documentElement.appendChild(iframe);
        window.frames[0].window.alert(name);
        iframe.parentNode.removeChild(iframe);
    };
    window.confirm = function (message) {
        var iframe = document.createElement("IFRAME");
        iframe.style.display = "none";
        iframe.setAttribute("src", 'data:text/plain,');
        document.documentElement.appendChild(iframe);
        var alertFrame = window.frames[0];
        var result = alertFrame.window.confirm(message);
        iframe.parentNode.removeChild(iframe);
        return result;
    };
</script>
<script src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script src="https://cdn.bootcss.com/crypto-js/3.1.9-1/crypto-js.js"></script>
<script>
    var token="{{$AccessToken}}";
    var openid="{{$openid}}";
    localStorage.setItem("token",token);
    localStorage.setItem("openid",openid);

    var refer =document.referrer;
    var http = window.location.protocol;
    var domain=document.domain;


    function jiebang(){
        layer.open({
            content: '你确定要退出登录吗？'
            ,btn: ['退出', '取消']
            ,skin: 'footer'
            ,yes: function(index){
                // layer.open({content: '执行删除操作'})
                layer.close(index);
                window.location.href="login_out";
            }
        });
    }
    $('#couponTip').on('click', function(){
        // console.log('aaa')
        var phone = <?php echo $personInfo['Data']['Items'][0]['MobileNO']; ?>;
        var aseKey = "1608708167657654"     //秘钥必须为：8/16/32位
        var message = phone.toString()


        //加密 DES/AES切换只需要修改 CryptoJS.AES <=> CryptoJS.DES
        var encrypt = CryptoJS.AES.encrypt(message, CryptoJS.enc.Utf8.parse(aseKey), {
            mode: CryptoJS.mode.ECB,
            padding: CryptoJS.pad.Pkcs7
        }).toString();
        console.log(encodeURIComponent(encrypt))
        window.location.href = 'http://ba.rgparking.cn/Lottery/Web/Lottery/Entry.do?mobileNumber=' + encodeURIComponent(encrypt)
    })

</script>
</html>