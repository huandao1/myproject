<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>我的车牌</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>


    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style type="text/css">
        .main div:nth-last-child(2)
        {
            margin-bottom: 1rem
        }
    </style>
</head>
<body>
<div class="main">
    <div style="position: absolute;top:30%;left:34%;display: none" class="download">
        <img src="{{URL::asset('assets/image/21.gif')}}" alt="" style="width:2.3rem;height:2.3rem">
    </div>
@if(!empty($arrdata['Data']['Items']))
<!-- <p class="register_top">请选择你要缴费的车牌</p> -->
    @foreach($arrdata['Data']['Items'] as $key => $value)
    @if($value['Bind']==1)
    <div style="width: 100%;height: 1.1rem;border: none;border-bottom: 1px solid #bfbfbf;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;background: white;"><img src="{{URL::asset('assets/image/bangxuan.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;margin-left: 0.4rem;"><span style="margin-left: 0.1rem;color: #0d57a0;font-size:0.38rem;">{{$value['CarNo']}}</span> <div  style="margin-right: 0.4rem;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/moxuan.png')}}" alt="" style="width: 0.85rem;height:0.85rem;margin-right: 0.1rem"  onclick="bangding('{{$value['CarNo']}}')"><img src="{{URL::asset('assets/image/bangjian.png')}}" alt="" style="width: 0.8rem;height:0.8rem;" onclick="del('{{$value['CarNo']}}')"></div></div>
    @else
    <div style="width: 100%;height: 1.1rem;border: none;border-bottom: 1px solid #bfbfbf;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;background: white;"><img src="{{URL::asset('assets/image/bangweixuan.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;margin-left: 0.4rem;"><span style="margin-left: 0.1rem;color: #0d57a0;font-size:0.38rem;">{{$value['CarNo']}}</span> <div  style="margin-right: 0.4rem;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/moxuan.png')}}" alt="" style="width: 0.85rem;height:0.85rem;margin-right: 0.1rem"  onclick="bangding('{{$value['CarNo']}}')"><img src="{{URL::asset('assets/image/bangjian.png')}}" alt="" style="width: 0.8rem;height:0.8rem;" onclick="del('{{$value['CarNo']}}')"></div></div>
    @endif
    @endforeach
    @else
    <div style="width:100%;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-top:0.7rem;"><img src="{{URL::asset('assets/image/noth.png')}}" alt=""  style="width: 2rem;height:2rem"><div style="margin-top: 0.3rem;width: 100%;text-align:center"><span style="color: #fb415b;font-size: 0.3rem;">温馨提示：</span><span style="color: #0d57a0;font-size: 0.3rem;">请您先添加爱车车牌！</span></div></div>
    @endif
    <div style="width: 100%;height:1rem;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: center;background: white;position: fixed;left: 0px;bottom: 0px;" onclick="window.location.href='chepai';"><img src="{{URL::asset('assets/image/jiajia.png')}}" alt="" style="width: 0.65rem;height: 0.65rem;"><span style="font-size:0.36rem;color: #0d57a0;margin-left: 0.1rem; letter-spacing: 2px;">添加新车牌</span></div>
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
    function del(obj){
        if(confirm("确定取消绑定吗？")){
            $.ajax({
                url: 'carno',
                data: {'CarNo':obj},
                method:'post',
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                // header: { 'Content-Type': 'application/x-www-form-urlencoded' },
                beforeSend: function () {
                    layer.open({
                        type: 2
                    });
                },
                success: function (ops) {
                    layer.closeAll();

                    // $('.berth').html(ops.Data.msg);
                    if(ops.Message=='success'){
                        alert("取消绑定成功!");
                        window.location.href="chepaicheck";
                    }else{
                        alert(ops.Message);
                        window.location.href="chepaicheck";

                    }


                }


            })
        }else{
            return false;
        }
    }
    function bangding(obj){
        if(confirm("确定修改该车牌为默认车牌吗？")){
            $.ajax({
                url: 'morenche',
                data: {'CarNo':obj},
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                method:'post',
                dataType:'json',
                // header: { 'Content-Type': 'application/x-www-form-urlencoded' },
                beforeSend: function () {
                    layer.open({
                        type: 2
                    });
                },
                success: function (ops) {
                    layer.closeAll();

                    // $('.berth').html(ops.Data.msg);
                    if(ops.Message=='success'){
                        alert("修改默认车牌成功!");
                        window.location.href="chepaicheck";
                    }else{
                        alert(ops.Message);
                        window.location.href="chepaicheck";

                    }


                }


            })
        }else{
            return false;
        }
    }
</script>