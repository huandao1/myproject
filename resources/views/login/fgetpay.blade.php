<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>找回登录密码</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/public.css') }}">
    <script src="{{ URL::asset('assets/js/hengping.js') }}"></script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>
<div class="main">
    <form action="" method="post">
         @csrf
        <input type="tel" placeholder="请输入绑定的手机号" class="register_phone" name="phone"   onkeyup="b_submit()" style="width: 6.5rem;height: 0.85rem;line-height:0.85rem;margin-left: 0.5rem;border: 1px solid #bfbfbf;border-radius: 5px;margin-top:1rem;" value="@if(!empty(old('phone'))){{old('phone')}}@endif">
        <div class="register_yanzhen" style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:flex-start;-webkit-align-items:center;margin-top:0.58rem;border: none;"><input type="tel" placeholder="获取验证码" value="@if(!empty(old('authcode'))){{old('authcode')}}@endif" class="register_ma" name="authcode" onchange="button_use()"   style="height: 0.85rem;line-height:0.85rem;width:4.5rem;border: 1px solid #bfbfbf;border-radius: 5px;text-indent: 0.2rem;margin-left: 0.5rem;"><input type="button" value="获取验证码" class="register_button"></div>
        <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:flex-start;-webkit-align-items:center;margin-top:0.58rem;"><input type="text" onkeyup="b_submit()"  class="vcode" style="height: 0.85rem;line-height:0.85rem;width:4.5rem;border: 1px solid #bfbfbf;border-radius: 5px;text-indent: 0.2rem;margin-left: 0.5rem;" name='vcode' placeholder="输入图像验证码"><img id="checkpic" onclick="this.src='{{captcha_src()}}'+Math.random()" src="{{captcha_src()}}" style="margin-left: 0.2rem; "/></div>
        <input type="password" placeholder="新密码(6-20位)" class="register_mi" name="PayPsw" style="width: 6.5rem;height: 0.85rem;line-height:0.85rem;margin-left: 0.5rem;border: 1px solid #bfbfbf;border-radius: 5px;margin-top:0.58rem;" maxlength="20" onkeyup="p_submit()">
        <div style="width: 100%;color: red;font-size: 0.26rem;text-align: center;"  id="notice"></div>
        <div style="width: 100%;text-align: center;"><input type="submit" value="下一步" class="register_submit" disabled="true"></div>


    </form>
</div>
</body>
</html>
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
<script src="{{URL::asset('assets/layer/layer.js')}}"></script>

<script>
    @if ($errors->any())
     @foreach ($errors->all() as $error)
       @if($error == 'validation.captcha')

          alert("图形验证码错误");
        @endif
      @endforeach

    @endif

    $('.register_button').click(function(){
        var mobile = $('.register_phone').val();
        if(!(/^1[3|4|5|6|7|9|8][0-9]\d{8}$/.test(mobile))){
            layer.open({
                content:'请输入正确的电话号码！'
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }

        $.ajax({
            url: 'send_forgetsms',
            data: {'phone':mobile},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (ops) {
                if (ops.RetCode==0){
                    var c = 60;
                    var intervalId = setInterval(function () {
                        c = c - 1;
                        $('.register_button').val(c + 's');
                        $('.register_button').attr('disabled',true);

                        if (c == 0) {
                            clearInterval(intervalId);
                            $('.register_button').val('获取验证码');
                            $('.register_button').attr('disabled',false);
                        }
                    }, 1000)
                }
                else{
                    alert("获取验证码失败!");
                    return false;
                }
            }
        })

    })
    function checkpwd(v){
        var reg = /^[A-Za-z0-9]{6,20}$/;
        console.log(reg.test(v));
        if(reg.test(v)){
            return true;

        }else{
            return false;
        }
    }
    function button_use(){
        if($('.register_ma').val().length!=6){
            $('#notice').html('请输入正确六位验证码');
            $('.register_submit').attr('disabled',true);
            $('.register_submit').css({'background':'#93cbf1'});
        }
        else{
            $('#notice').html('');
        }
    }
    function p_submit(){
        if (checkpwd($('.register_mi').val())) {
            $('#notice').html("");
            $('.register_submit').attr('disabled',false);
            $('.register_submit').css({'background':'#0d57a0'});

        }
        else{
            $('#notice').html('密码必须为6~20位数字或英文字母');
            $('.register_submit').attr('disabled',true);
            $('.register_submit').css({'background':'#93cbf1'});
        }
    }
    function b_submit(){
        if($('.vcode').val()==''||$('.register_phone').val()==''){
            $('.register_submit').attr('disabled',true);
            $('.register_submit').css({'background':'#93cbf1'});


        }
    }
    $("form").submit(function(){
        if($('.vcode').val()==''||$('.register_phone').val()==''|$(".register_ma").val()==''){
            $('.notice').html('请输入完整信息');
            return false;
        }
    })


</script>