<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>付费方式说明</title>
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
    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;margin-top:0.3rem;margin-left: 0.5rem;color: #1f1f1f;font-size: 0.4rem;"><img src="{{URL::asset('assets/image/dd_03.jpg')}}" alt="" style="width: 0.36rem;height: 0.36rem;margin-right: 0.1rem;">预付费</div>
    <div style="width: 6.5rem;margin: 0 auto;font-size: 0.32rem;padding-top: 0.1rem;color: #666666">
        预付费是指车主使用路边停车进行停车申请时，在输入泊位号后需要选择购买时长，系统会根据该泊位号的类型，以及购买时长自动计算出应缴金额，车主需要先付费；在车主驶离泊位时，系统会根据车主实际的停车时长来进行多退少补。
    </div>
    <hr style='width: 7rem;margin-left:0.25rem;margin-top:0.3rem;border: 1px solid #666666;'>
    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;margin-top:0.3rem;margin-left: 0.5rem;color: #1f1f1f;font-size: 0.4rem;"><img src="{{URL::asset('assets/image/dd_03.jpg')}}" alt="" style="width: 0.36rem;height: 0.36rem;margin-right: 0.1rem;">后付费</div>
    <div style="width: 6.5rem;margin: 0 auto;font-size: 0.32rem;padding-top: 0.1rem;color: #666666">
        后付费是指车主使用路边停车进行停车申请时，在输入泊位号后无需选择购买时长即可成功提交停车申请。当车主将车辆驶离泊位后，系统会根据此次实际的停车时长自动生成一笔待缴费的订单，需要车主方便时进行手动补缴。如果在订单结束后的48小时内仍然没有缴清待缴费的订单，车主将不能使用后付费模式停车，直到车主缴清待缴的停车费用方可继续使用。
    </div>
</div>
</body>
