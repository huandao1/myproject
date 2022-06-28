<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>次日续时规则</title>
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
    <div style="width: 7rem;margin: 0 auto;font-size: 0.36rem;padding-top: 0.2rem;">
        1. 如果您在今日00:00-7:29停车，工作日您可以提前申请今日7:30-20:00的收费时段，非工作日您可以提前申请今日7:30-18:00的收费时段。<br><br>
        2. 如果您在今日7:30-24:00停车，工作日您可以提前申请明日7:30-20:00的收费时段，非工作日您可以提前申请明日7:30-18:00的收费时段。<br><br>
        3. 次日续时申请完成时系统不扣费，不计时。<br><br>
        4. 在免费时段结束，申请的收费时段开始时间为7:30，系统自动替您完成停车缴费操作，并会进行扣费和计时。<br><br>
        5. 日前，只有全日类型的泊位支持次日续时功能。因为次日续时申请的时段不允许跨禁停时段、免费时段、所有请您谅解。
    </div>
</div>
</body>
</html>