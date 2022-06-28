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

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>

    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <meta http-equiv="refresh" content="100">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>异常上报</title>

    <script src="{{URL::asset('assets/js/lCalendar.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

    <link rel="stylesheet" href="{{URL::asset('assets/css/lCalendar.css')}}">
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style>
        *{
            margin: 0px;
            padding:0px;
            /*font-size: 0.36rem;*/
            color:black;
        }
        a{
            text-decoration: none;

        }
        input[type=button],input[type=tel],input[type=number],input[type=submit], input[type=text], button {
            cursor: pointer;
            -webkit-appearance: none;
        }
        body{
            background: #ffffff;
            width: 7.5rem;
            margin: 0 auto;
            overflow:hidden;
            overflow-y:auto;
            /*text-align: center;*/

            /*background: red;*/
        }
    </style>
</head>
<body>
<div style='width: 7.5rem;height: 0.9rem;border-bottom: 1px solid #29aaff;display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:flex-start;-webkit-align-items:center;'><img src="{{URL::asset('assets/image/left.png')}}" alt="" style="width: 0.8rem;height: 0.8rem;margin-left: 0.2rem" onclick="back()"><div style="width: 6rem;height: 0.8rem;text-align: center;line-height: 0.8rem;color:#29aaff;font-size: 0.4rem;">停车时间选择</div></div>

<div style='width: 7.5rem;height: 2rem;margin-top:1.2rem;text-align: center;'>
    <p style="font-size:0.36rem;color:#29aaff">请重新选择离场时间</p>
    <input id="demo2" type="text" readonly="" name="input_date" placeholder="日期和时间选择" data-lcalendar="2010-01-11,2025-12-31" style="margin-top: 0.2rem;text-align: center;width:4rem;height:0.7rem;border:none;border:1px solid #bbbbbb;font-size:0.34rem;"/>
</div>

<div style="width: 7.5rem;margin-top: 1rem;text-align: center;"><button style="width: 6.5rem;height: 1rem;background: #0d57a0;border-radius: 0.16rem;border: none;color: #ffffff;font-weight: bold;font-size:0.42rem" onclick="shijian()">确定</button></div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>

<script>


    var calendardatetime = new lCalendar();
    calendardatetime.init({
        'trigger': '#demo2',
        'type': 'datetime'
    });
    function back(){
        // alert('11');
        window.history.back();
    }
    function shijian(){
        var ordercode="{{$BargainOrderCode}}";
        var memberberthendparkingtime=$('#demo2').val();
        if(memberberthendparkingtime==''){
            alert('请先选择离场时间！');
            return;
        }else{
            $.ajax({
                url: 'pay_yichang1',
                data: {'ordercode':ordercode,'memberberthendparkingtime':memberberthendparkingtime},
                method:'post',
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                success: function (ops) {

                    // $('.berth').html(ops.Data.msg);
                    if(ops.Message=='success'){
                        alert(ops.Data.msg);
                        window.history.go(-1);
                    }else{
                        alert(ops.Message);
                    }

                }


            })
        }
    }
</script>
