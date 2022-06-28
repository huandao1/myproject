<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>登陆</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
{{--兼容public.css样式--}}
    <style>
        .aui-toast {
            background: rgba(0, 0, 0, 0.7);
            text-align: center;
            border-radius: 0.25rem;
            color: #ffffff;
            position: fixed;
            z-index: 3;
            top: 45%;
            left: 50%;
            width: 7.5em;
            height:11em;
            margin-left: -3.75em;
            margin-top: -4rem;
            display: none;
        }

        .aui-toast-content {
            margin: 0 0 0.75rem;
        }
        .aui-toast-loading {
            background-color: #ffffff;
            border-radius: 100%;
            margin: 0.75rem 0;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            border: 2px solid #ffffff;
            border-bottom-color: transparent;
            height: 1rem;
            width: 1rem;
            background: transparent !important;
            display: inline-block;
            -webkit-animation: rotate 1s 0s linear infinite;
            animation: rotate 1s 0s linear infinite;
        }
    </style>
</head>
<body>
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
<script src="{{ URL::asset('assets/js/jquery-3.1.1.js') }}"></script>
<script src="{{ URL::asset('assets/layer/layer.js')}}"></script>
<script src="{{ URL::asset('assets/js/hengping.js') }}"></script>
<script src="{{URL::asset('assets/js/aui/aui-toast.js')}}"></script>
<div class="zhuche" style="width: 100%;height:100%;overflow: hidden;background-color: #ffffff;">
    <form action=""  name="form" method="post">
        <!--   <p class="register_top">首次使用需绑定手机号<a href="login1.php" style="color: #0d57a0;font-size:0.38rem;margin-left:2rem;line-height: 1.1rem;height: 1.1rem">去登录</a></p> -->
        <div style="width:100%;text-align:center;margin-top:20px;"><img src="{{ URL::asset('assets/image/logo.png') }}" width ="120" style="display: inline-block"/></div>
        <input type="tel" placeholder="手机号" maxlength="11" class="register_phone" name="phone"  onkeyup="b_submit()" oninput="b_submit()" onproperty="b_submit()" style="width: 6.5rem;height: 0.75rem;line-height:0.75rem; border:none;border: 1px solid #cccccc; margin-top: 0.3rem;border-radius: 5px;margin-left:0.5rem;" value="">

        <div class="register_yanzhen" style="width:7.5rem;display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:flex-start;-webkit-align-items:center;border:none; margin-top: 0.3rem;">
            <input type="tel" placeholder="验证码" class="register_ma" name="authcode" onkeyup="b_submit()" oninput="b_submit()" onproperty="b_submit()"  style="height: 0.75rem;line-height:0.75rem;width:4.5rem;border: none; border: 1px solid #cccccc;border-radius: 5px;margin-left:0.5rem;" value="">
            <input type="button" value="获取验证码" class="register_button"></div>
        <!-- <input type="password" placeholder="确认密码" class="register_check" onblur="check()"> -->
        <!--<input type="text" placeholder="邀请码（选填）" maxlength="4" name="InviteCode" id="InviteCode" style="width: 6.5rem;height: 0.75rem;line-height:0.75rem; border:none;border: 1px solid #cccccc; margin-top: 0.3rem;border-radius: 5px;margin-left:0.5rem;">-->
        <div style="width: 100%;color: red;font-size: 0.26rem;text-align: center;"  id="notice"></div>
        <div style="width: 100%;text-align: center;"><input type="button" value="快速登陆" class="register_submit" disabled="disabled"></div>
        <div style="width:86%;height:40px;" class="size_p">
            <input id="check_useragreement" style="-webkit-appearance:checkbox !important;"  class="ppp"  name="check_user_agreement"    type="checkbox"> <p class="pp">我已阅读并同意<a href="userAgreement.html" target="_blank"><span style="color:#0d57a0;font-size: 13px ;">《用户服务条款》</span></a> </div>
        <span style="margin-left: 0.5rem;float:left"><a href="login_password" style='color:#0d57a0;font-size:0.3rem;'>密码登录</a></span>
        @if ($backurl != "")
        <br><br><br><br><br><br><br><br>
        <span style="margin-left: 0.5rem;float:left;width: 86%;font-size: 0.26rem;text-align: center;">搜索并关注“容桂智泊”公众号无需反复登录，可直接使用</span>
        @endif

    </form>
</div>

</body>
</html>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>

<script>
    var toast = new auiToast({});
    $('.register_button').click(function(){
        var mobile = $.trim($('.register_phone').val());
        if(!(/^1[0-9][0-9]\d{8}$/.test(mobile))){
            layer.open({
                content:'请输入正确的电话号码！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }

        $.ajax({
            url: 'send_sms',
            data: {'phone':mobile},
            method:'post',
            dataType:'json',
            // header: { 'Content-Type': 'application/x-www-form-urlencoded' },
            beforeSend: function () {
                $('.register_button').attr('disabled',true);
                $('.register_button').css('color','#93cbf1');


            },
            success: function (ops) {
                if (ops.RetCode==0){

                    var c = 60;
                    var intervalId = setInterval(function () {
                        c = c - 1;
                        $('.register_button').val(c + 's');

                        if (c == 0) {
                            clearInterval(intervalId);
                            $('.register_button').val('获取验证码');
                            $('.register_button').attr('disabled',false);
                            $('.register_button').css('color','#ffffff');

                        }
                    }, 1000)
                }
                else{
                    layer.open({
                        content:ops.Message+'可直接登录~'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                    setTimeout("window.location.href='login1.php'",2000);
                    return false;
                }
            }
        })

    })


    function b_submit(){
        if( ($('.register_phone').val()!='') && ($('.register_ma').val()!='') ){
            $('.register_submit').css({'background':'#0d57a0'});
            $('.register_submit').attr('disabled',false);
        }
        else{
            $('.register_submit').css({'background':'#93cbf1'});
            $('.register_submit').attr('disabled',true);
        }
    }


    $('.register_submit').click(function () {
        var mobile = $.trim($('.register_phone').val());
        if (!(/^1[0-9][0-9]\d{8}$/.test(mobile))) {
            layer.open({
                content: '请输入正确的电话号码！'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }

        var auth_code = $.trim($('.register_ma').val());

        if ((auth_code == "" || auth_code == null || auth_code == undefined) || !(/\d{6}$/.test(auth_code))) {
            layer.open({
                content: '请输入正确的验证码！'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }
        if ($('#check_useragreement').is(':checked')) {
            var phone = $(".register_phone").val();
            var authcode = $(".register_ma").val();

            $.ajax({
                url: 'login_sms',
                data: {'phone': phone, 'authcode': authcode},
                method: 'post',
                dataType: 'json',
                success: function (ops) {
                    toast.hide();
                    if (ops.code == 0) {
                        if (ops.msg == 'success') {
                            alert(ops.msg);
                            window.location.href = ops.backurl;
                        } else {
                            alert(ops.msg);
                        }

                    }
                },
                error: function (msg) {
                    toast.hide();
                    alert('登录失败');
                }
            })
        } else {
            layer.open({
                content: '请点击同意《用户服务条款》'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            $('#check_useragreement').focus();
            return false;
        }
    })


    b_submit();

    (function() {
        if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {
            handleFontSize();
        } else {
            document.addEventListener("WeixinJSBridgeReady", handleFontSize, false);
        }

        function handleFontSize() {
            // 设置网页字体为默认大小
            WeixinJSBridge.invoke("setFontSizeCallback", {
                "fontSize": 0
            });
            // 重写设置网页字体大小的事件
            WeixinJSBridge.on("menu:setfont", function() {
                WeixinJSBridge.invoke("setFontSizeCallback", {
                    "fontSize": 0
                });
            });
        }
    })();
</script>