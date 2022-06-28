<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>选择车牌</title>
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
<div class="main">
    <div style="position: absolute;top:30%;left:34%;display: none" class="download">
        <img src="{{URL::asset('assets/image/21.gif')}}" alt="" style="width:2.3rem;height:2.3rem">
    </div>
    @if(!empty($arrdata['Data']['Items']))
        <p class="register_top">请选择你要缴费的车牌</p>
        @foreach($arrdata['Data']['Items'] as $key => $value)
            @if($value['Bind']==1)
                <div class="carli"
                     style="width: 100%;height: 1.1rem;border: none;border-bottom: 5px solid #e6e6e6;background: white;">
                    <img src="{{URL::asset('assets/image/bangxuan.png')}}" alt=""
                         style="width: 0.45rem;height: 0.45rem;margin-left: 0.4rem;margin-top: 0.35rem;float: left;"><span
                            style="margin-left: 0.1rem;color: #0d57a0;font-size:0.32rem;float: left;line-height: 1.1rem">{{$value['CarNo']}}</span><img src="{{URL::asset('assets/image/gopay.png')}}"
                            style="width: 0.45rem;float: right;margin-right: 0.4rem;margin-top: 0.35rem"></div>
            @else
                <div class="carli"
                     style="width: 100%;height: 1.1rem;border: none;border-bottom: 5px solid #e6e6e6;background: white;">
                    <img src="{{URL::asset('assets/image/bangweixuan.png')}}" alt=""
                         style="width: 0.45rem;height: 0.45rem;margin-left: 0.4rem;margin-top: 0.35rem;float: left;"><span
                            style="margin-left: 0.1rem;color: #0d57a0;font-size:0.32rem;float: left;line-height: 1.1rem">{{$value['CarNo']}}</span>
                    <img src="{{URL::asset('assets/image/gopay.png')}}"
                         style="width: 0.45rem;float: right;margin-right: 0.4rem;margin-top: 0.35rem"></div>
            @endif
        @endforeach
    @endif
    <div style="width: 100%;height:1rem;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: center;background: white;position: fixed;left: 0px;bottom: 0px;" onclick="window.location.href='chepai?source=first';"><img src="{{URL::asset('assets/image/jiajia.png')}}" alt="" style="width: 0.65rem;height: 0.65rem;"><span style="font-size:0.36rem;color: #0d57a0;margin-left: 0.1rem; letter-spacing: 2px;">添加新车牌</span></div>
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
    $(function(){
        $(".carli").click(function(){
            var carno=$(this).find("span").text();
            window.location.href="pay_jishi?CarNo="+carno+"&id=2";
        })
    })
</script>