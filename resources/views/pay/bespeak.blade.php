<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>次日续时详情页</title>
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
    <div style="display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-between;width: 100%;height: 1.1rem;border-bottom:1px solid #ebebeb; "><a href="pay_lubpark" style="display:-webkit-flex;-webkit-align-items: center;margin-left: 0.3rem; "><img src="{{URL::asset('assets/image/fanhui.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;"><span style="color: #333333">我要停车</span></a><a href="pay_guize" style="color: #0a9dff;margin-right: 0.3rem;">次日续时规则</a></div>
    <div style="width: 100%;text-align: center;"><img src="{{URL::asset('assets/image/wancheng.png')}}" alt="" style="width: 3rem;height: 3rem;margin-top:0.4rem"></div>
    <p style="margin-top:0.5rem;margin-left:0.4rem;color:#333333;font-size: 0.45rem; ">{{$datas1['Data']['data']['SectionName']}}—{{$datas1['Data']['data']['AreaName']}}—{{$datas1['Data']['data']['BerthCode']}}</p>
    <p style="margin-left:0.5rem;margin-top:0.15rem;color:#888888">申请时段：<span style="color:#888888">@php echo substr($datas1['Data']['data']['ApplyTime'],0,16);@endphp—{{$datas1['Data']['data']['endtime']}}</span>  </p>
    <p style="margin-left:0.5rem;margin-top:0.15rem;color:#888888">申请时长：<span style="color:#888888">{{$datas1['Data']['data']['ApplyDuration']}}</span>分钟  </p>
    <p style="margin-left:0.5rem;margin-top:0.15rem;color:#888888">应付金额：<span style="color:#ff4242;font-size:0.38rem;">{{$datas1['Data']['data']['PayPrice']}}</span>元  </p>
    <p style="margin-left:0.5rem;margin-top:0.15rem;color:#888888">当前余额：<span style='color:#ff4242;font-size:0.38rem;'>{{$personInfo['Data']['Items']['0']['Overageprice']}}</span>元  </p>
    <div style="width: 100%;text-align: center;"><input type="button" value="取消订单" class="cibutton" style="background:#0d57a0"></div>

</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script>
    $('.cibutton').click(function(){
        if(confirm("确定取消次日续时订单吗？")){
            window.location.href='pay_BespeakCancel';
        }else{
            return false;
        }
    })
</script>