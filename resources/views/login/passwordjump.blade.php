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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账户安全</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>


    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>
<a href="login_passwordedit"><div style="width: 100%;height:1.2rem;border-bottom:1px solid #dadada;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;"><div style="margin-left: 0.4rem;color: #333333;font-size: 0.32rem;">修改账户密码</div><img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="margin-right: 0.3rem;"></div></a>
<!--<a href="changepay.php"><div style="width: 100%;height:1.2rem;border-bottom:1px solid #dadada;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;"><div style="margin-left: 0.4rem;color: #333333;font-size: 0.32rem;">修改支付密码</div><img src="image/my_right.png" alt="" style="margin-right: 0.3rem;"></div></a>
<a href="getpay.php"><div style="width: 100%;height:1.2rem;border-bottom:1px solid #dadada;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;"><div style="margin-left: 0.4rem;color: #333333;font-size: 0.32rem;">找回支付密码</div><img src="image/my_right.png" alt="" style="margin-right: 0.3rem;"></div></a>-->
<!--<div style="width: 100%;height:1.2rem;border-bottom:1px solid #dadada;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;" onclick="jiebang()"><div style="margin-left: 0.4rem;color: #333333;font-size: 0.32rem;">退出登录</div><img src="image/my_right.png" alt="" style="margin-right: 0.3rem;"></div>-->

</body>
</html>
<script>
    function jiebang(){
        layer.open({
            content: '你确定要退出登录吗？'
            ,btn: ['退出', '取消']
            ,skin: 'footer'
            ,yes: function(index){
                // layer.open({content: '执行删除操作'})
                layer.close(index);
                window.location.href="person_safe1.php";
            }
        });
    }
</script>
