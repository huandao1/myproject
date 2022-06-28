<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改账户密码</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>

    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>
<div class="main">
    <form action="login_passwordedit" class="changeperson" method="post">
              @csrf
        <input type="password" placeholder="当前密码" class="register_phone" name="originpsw" onkeyup ="b_submit()" maxlength="20" style="width: 6.5rem;height: 0.85rem;line-height:0.85rem;margin-left: 0.5rem;border: 1px solid #bfbfbf;border-radius: 5px;margin-top:1rem;">

        <input type="password" placeholder="新密码" class="register_mi" name="newpsw" onkeyup ="b_submit()" maxlength="20" style="width: 6.5rem;height: 0.85rem;line-height:0.85rem;margin-left: 0.5rem;border: 1px solid #bfbfbf;border-radius: 5px;margin-top:0.58rem;">
        <input type="password" placeholder="确认新密码" class="register_check" onkeyup ="b_submit()" maxlength="20" style="width: 6.5rem;height: 0.85rem;line-height:0.85rem;margin-left: 0.5rem;border: 1px solid #bfbfbf;border-radius: 5px;margin-top:0.58rem;">
        <div style="width: 100%;color: red;font-size: 0.26rem;text-align: center;"  id="notice"></div>
        <div style="width: 100%;text-align: center;"><input type="submit" value="确认修改" class="register_submit" disabled="true"></div>


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
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script>
    function check(v){
        var reg = /^(?![^a-zA-Z]+$)(?!\D+$)[0-9a-zA-Z]{8,16}$/;
        console.log(reg.test(v));
        if(reg.test(v)){
            return true;

        }else{
            return false;
        }
    }
    function checkpwd(){

        if (!check($('.register_mi').val())) {
            $('#notice').html("请输入8~16位数字和英文字母组合的密码！");
            return true;

        }
        else if($.trim($('.register_check').val())!=$.trim($('.register_mi').val())){

            $('#notice').html("两次输入密码不一致！");
            return true;
        }
        else{
            return false;
        }

    }

    function b_submit(){
        if($('.register_phone').val()==''|| $('.register_mi').val()==''){
            $('.register_submit').css({'background':'#93cbf1'});
            $('.register_submit').attr('disabled',true);
        }
        else if(checkpwd()){
            $('.register_submit').css({'background':'#93cbf1'});
            $('.register_submit').attr('disabled',true);
        }
        else{
            $('#notice').html("");
            $('.register_submit').css({'background':'#0d57a0'});
            $('.register_submit').attr('disabled',false);
        }
    }
</script>