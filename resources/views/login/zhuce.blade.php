<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>注册</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>
<div class="zhuche" style="width: 100%;height:100%;overflow: hidden;background-color: #ffffff;">
    <form action="zhuce" method="post">
    @csrf
        <div style="width:100%;text-align:center;margin-top:20px;"><img src="{{URL::asset('assets/image/logo.png')}}" width="120"
                                                                        align="center"/></div>
        <input type="tel" placeholder="手机号" maxlength="11" class="register_phone" name="phone" onkeyup="b_submit()"
               style="width: 6.5rem;height: 0.75rem;line-height:0.75rem; border:none;border: 1px solid #cccccc; margin-top: 0.3rem;border-radius: 5px;margin-left:0.5rem;"
               value="{{$phone}}">
        <input type="password" placeholder="密码" class="register_mi" name="password" onchange="setpwd()" maxlength="20"
               style="width: 6.5rem;height: 0.75rem;line-height:0.75rem;border:none;border: 1px solid #cccccc;border-radius: 5px;margin-left: 0.5rem;margin-top: 0.3rem;"
               value="{{$password1}}">
        <div style="width:7.5rem;display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:flex-start;-webkit-align-items:center;border:none; margin-top: 0.3rem;">
            <input type="text" onkeyup="b_submit()" class="vcode"
                   style="height: 0.75rem;line-height:0.75rem;width:4.5rem;border: none;border: none;border: 1px solid #cccccc;border-radius: 5px;margin-left: 0.5rem;"
                   name='vcode' placeholder="输入图像验证码"><img id="checkpic" onclick="this.src='{{captcha_src()}}'+Math.random()" src="{{captcha_src()}}"
                                                           style="margin-left: 0.2rem;    height: 0.73rem;width: 1.8rem;"/>
        </div>
        <div class="register_yanzhen"
             style="width:7.5rem;display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:flex-start;-webkit-align-items:center;border:none; margin-top: 0.3rem;">
            <input type="tel" placeholder="验证码" class="register_ma" name="authcode" maxlength="6" onkeyup="b_submit()"
                   style="height: 0.75rem;line-height:0.75rem;width:4.5rem;border: none; border: 1px solid #cccccc;border-radius: 5px;margin-left:0.5rem;"
                   value="{{$authcode}}"><input type="button"
                                                                                                    value="获取验证码"
                                                                                                    class="register_button">
        </div>
        <!-- <input type="password" placeholder="确认密码" class="register_check" onblur="check()"> -->
        <div style="width: 100%;color: red;font-size: 0.26rem;text-align: center;" id="notice"></div>
        <div style="width: 100%;text-align: center;"><input type="button" value="快速注册" class="register_submit"
                                                            disabled="disabled"></div>
        <div style="width:86%;height:40px;" class="size_p">
            <input id="check_useragreement" style="-webkit-appearance:checkbox !important;" class="ppp"
                   name="check_user_agreement" type="checkbox">
            <p class="pp">我已阅读并同意<a href="userAgreement.html" target="_blank"><span
                            style="color:#0d57a0;font-size: 13px ;">《用户服务条款》</span></a></div>
        <span style="margin-left: 0.5rem;float:left"><a href="login_fgetpay"
                                                        style='color:#0d57a0;font-size:0.3rem;'>忘记密码？</a></span>
        <span style="float:right;margin-right:0.5rem;"><a href="login_sms"
                                                          style='color:#0d57a0;font-size:0.3rem;'>立即登录</a></span>
    </form>
</div>
</body>
</html>
<script src="{{URL::asset('assets/js/before.js') }}"></script>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js') }}"></script>
<script src="{{URL::asset('assets/layer/layer.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>

<script>
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
                            $('.register_button').css('color','white');
                        }
                    }, 1000)
                }
                else{
                    layer.open({
                        content:ops.Message+'可直接登录~'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                    setTimeout("window.location.href='login_sms'",2000);
                    return false;
                }
            }
        })

    })
    function check(){
        if($.trim($('.register_mi').val())!=$.trim($('.register_check').val())){
            $('#notice').html("两次输入密码不一致！");
        }
    }

    function b_submit(){
        if($('.register_phone').val()!='' && $('.register_mi').val()!=''){
            $('.register_submit').css({'background':'#0d57a0'});
            $('.register_submit').attr('disabled',false);
        }
        else{
            $('.register_submit').css({'background':'#93cbf1'});
            $('.register_submit').attr('disabled',true);
        }
    }



    function checkpwd(v){
        var reg = /^[A-Za-z0-9]{6,20}$/;
        console.log(reg.test(v));
        if(reg.test(v)){
            return true;

        }else{
            return false;
        }
    }
    function setpwd(){
        if(!checkpwd($('.register_mi').val())){
            $('#notice').html('密码必须为6~20位数字或英文字母');
            $('.register_submit').css({'background':'#93cbf1'});
            $('.register_submit').attr('disabled',true);
        }
        else{
            b_submit();
            $('#notice').html('');
        }
    }

    $('.register_submit').click(function(){
        var mobile = $.trim($('.register_phone').val());
        if(!(/^1[0-9][0-9]\d{8}$/.test(mobile))){
            layer.open({
                content:'请输入正确的电话号码！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }


        var invite_code = $.trim($('#InviteCode').val());
        if( (invite_code != "" && invite_code != null && invite_code != undefined) && !(/\d{4}$/.test(invite_code))){
            layer.open({
                content:'请输入正确的邀请码！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }

        if($('#check_useragreement').is(':checked')){
            var phone=$(".register_phone").val();
            var password=$(".register_mi").val();
            var vcode=$(".vcode").val();
            var authcode=$(".register_ma").val();

            $.ajax({
                url: 'zhuce',
                data: {'phone':phone,'password':password,'vcode':vcode,'authcode':authcode},
                method:'post',
                dataType:'json',
                success: function (ops) {
                    if (ops.code == 0) {
                        if (ops.msg == 'success') {
                            alert('注册成功!');
                            window.location.href = 'pay_noapply';
                        }else{
                            if(ops.RetCode == 1001){
                                alert('注册失败，验证码不匹配!');
                            }else if(ops.RetCode == 1002){
                                alert('您好，您的手机已注册!');
                                window.location.href = 'login_sms';
                            }else if(ops.RetCode == 1004){
                                alert('注册失败，密码不正确!');
                            }else{
                                alert(ops.msg);
                            }
                        }

                    }
                },
                error:function(msg){
                    var json=JSON.parse(msg.responseText);
                    json = json.errors;
                    for ( var item in json) {
                        for ( var i = 0; i < json[item].length; i++) {
                            console.log(json[item][i]);
                            if(json[item][i] == 'validation.captcha'){
                                alert("图形验证码错误");
                                break;
                            }
                        }
                    }
                }
            })
        }else{
            layer.open({
                content:'请点击同意《用户服务条款》'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            $('#check_useragreement').focus();
            return false;
        }



    })

</script>