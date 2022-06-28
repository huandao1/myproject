<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if (deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <title>登录</title>
</head>
<body>
<div class="main">
    <div style="width:100%;text-align:center;margin-top:20px;"><img src="{{ URL::asset('assets/image/logo.png') }}" width="120" align="center"/>
    </div>
    <!--   <p class="register_top">登录账号<a href="zhuce.php" style="color: #0d57a0;font-size:0.38rem;margin-left:4rem;line-height: 1.1rem;height: 1.1rem">去注册</a></p> -->
    <form action="login_password" method="post">
        @csrf
        <input type="tel" placeholder="手机号" name="phone" maxlength="11" class="login1"
               style="width: 6.5rem;height: 0.85rem;line-height:0.85rem;padding-left: 0.2rem;border:none;border: 1px solid #bfbfbf;border-radius: 5px;margin-top: 0.5rem;margin-left: 0.5rem;"
               onkeyup="b_submit()" value="{{$phone}}"><br>
        <input type="password" placeholder="密码" id="id_password" maxlength="20"
               style="width:6.5rem;height: 0.85rem;line-height:0.85rem;width:6.5rem;border: none;padding-left: 0.2rem;border:1px solid #bfbfbf;border-radius: 5px;margin-top: 0.58rem;margin-left: 0.5rem;"
               name="password" class="login2" onkeyup="b_submit()">
        <div style="margin-top:0rem;width: 100%;text-align: center;">
            <input type="button" value="登录" class="login3" style="margin-top:0.5rem;" disabled="true" onclick="c_submit()">
        </div>
        <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:space-between;-webkit-align-items:center;margin-top:0.4rem;">
            <a href="login_fgetpay" style='color:#0d57a0;font-size:0.32rem;margin-left:  0.75rem;'>忘记密码？</a><a
                    href="login_sms" style="color: #0d57a0;font-size:0.32rem;margin-right: 0.75rem;">验证码登陆</a></div>

        <input type="hidden" name="url" id="url" value="{{$url}}">
    </form>
</div>
</body>
</html>
<script src="{{URL::asset('assets/js/before.js') }}"></script>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js') }}"></script>
<script src="{{URL::asset('assets/layer/layer.js') }}"></script>
<script>
    function b_submit() {
        if ($('.login1').val() != '' && $('.login2').val() != '') {
            $('.login3').css({'background': '#0d57a0'});
            $('.login3').attr('disabled', false);
        } else {
            $('.login3').css({'background': '#93cbf1'});
            $('.login3').attr('disabled', true);
        }
    }

    function b_submit1() {

        if ($('.login2').val() != '') {
            $('.imagea').attr('src', '{{URL::asset('assets/image/show_mi.png') }}');
        }
    }

    function c_submit(){
        var mobile = $.trim($('.login1').val());
        var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
        var password=$.trim($('.login2').val());
        var url=$.trim($('#url').val());
        if (!myreg.test(mobile)) {
            layer.open({
                content: '请输入正确的电话号码！'
                , skin: 'msg'
                , time: 2 //2秒后自动关闭
            });
            return false;
        }else{
            $.ajax({
                url: 'login_password',
                data: {'phone':mobile,'password':password,'url':url},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method:'post',
                dataType:'json',
                success: function (ops) {
                    if (ops.code == 0) {
                        if (ops.msg == 'success') {
                            alert('登录成功!');
                            window.location.href = ops.backurl;
                        }else{
                            if(ops.RetCode == 1004){
                                alert(ops.msg);
                                window.location.href = ops.backurl;
                            }else if(ops.RetCode == 1005){
                                alert(ops.msg);
                                window.location.href = ops.backurl;
                            }else{
                                alert(ops.msg);
                            }
                        }

                    }
                }
            })
        }
    }

    var token = "{{session('AccessToken')}}}";
    var openid = "{{session('openid')}}";
    localStorage.setItem("token", token);
    localStorage.setItem("openid", openid);


    $(document).ready(function () {
        var phone_value = $('.login1').val();
        var password_value = $('.login2').val();
        if ((phone_value != null && phone_value != "undefined" && phone_value != "") && (password_value != null && password_value != "undefined" && password_value != "")) {
            $('.login3').css({'background': '#0d57a0'});
            $('.login3').attr('disabled', false);
        }
    });
</script>