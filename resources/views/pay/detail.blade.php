<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账单详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/js/hengping.css')}}"></script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style type="text/css">
        .headinfo{
            color: white;
            font-size: 0.3rem;
            margin-left: 0.3rem;
            max-width: 3rem;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            display: block;
            float: left;
        }
        .icpic{width: 0.7rem;height: 0.7rem}
        .ins{
            color: #a9a9a9;font-size:0.3rem;margin-left: 0.1rem
        }
        .cons{color:#3d3d3d;font-size:0.32rem;margin-left: 0.1rem;}
        .fins{font-size:0.32rem;color: #fe4241;margin-left: 0.1rem;}
    </style>
</head>
<body>
<div class="main">
    @foreach($arrdata1['Data']['Items'] as $key => $value)
        <div class="pay_detail {{$value['BargainOrderCode']}} {{$key}}" style="display: none;">
        <div class="pay_detail1"><span class="headinfo">{{$value['ParkingName']}}</span><span style="color:white;font-size:0.3rem;float: right;padding-right: 0.75rem">车牌号:{{$value['PlateNumber']}}</span></div>
        <div class="pay_detail2"><img src="{{URL::asset('assets/image/parkStart.png')}}" alt="" class="icpic"><span class="ins">入场时间：</span><span class="cons">{{$value['BerthStartParkingTime']}}</span></div>
        <div class="pay_detail3"><img src="{{URL::asset('assets/image/parkEnd.png')}}" alt=""  class="icpic"><span class="ins">离场时间：</span><span class="cons">{{$value['BerthEndParkingTime']}}</span></div>
        <div class="pay_detail4"><img src="{{URL::asset('assets/image/times.png')}}" alt=""  class="icpic"><span class="ins">停车时长：</span><span class="cons">
                @php
                $parklen=intval((strtotime($value['BerthEndParkingTime'])-strtotime($value['BerthStartParkingTime']))/60);

                if ($parklen>=60){
                    echo intval($parklen/60)."小时";
                }
                if ($parklen<60)
                    echo $parklen;
                else echo $parklen%60;
                @endphp
                分钟</span></div>
        <div class="pay_detail5"><img src="{{URL::asset('assets/image/pay.png')}}" alt=""  class="icpic"><span class="ins">实际金额：</span><span>￥{{$value['ActualPrice']}}</span></div>
        <hr class="hr_line">
    </div>
        @endforeach
    @foreach($arrdata2['Data']['Items'] as $key => $value)
        <div class="pay_detail {{$value['BargainOrderCode']}} {{$key}}" style="display: none;">
        <div class="pay_detail1"><span style="color:white;font-size:0.3rem;margin-left: 0.3rem;margin-right: 0.3rem">{{$value['BerthCode']}}</span><span style="color:white;" >订单号：{{$value['BargainOrderCode']}}</span></div>
        <div class="pay_detail2"><img src="{{URL::asset('assets/image/parkStart.png')}}" alt="" class="icpic"><span class="ins">开始时间：</span><span class="cons">{{$value['BerthStartParkingTime']}}</span></div>
        <div class="pay_detail3"><img src="{{URL::asset('assets/image/parkEnd.png')}}" alt=""  class="icpic"><span class="ins">结束时间：</span><span class="cons">{{$value['BerthEndParkingTime']}}</span></div>
        <div class="pay_detail3"><img src="{{URL::asset('assets/image/car.png')}}" alt=""  class="icpic"><span class="ins">车牌号码：</span><span class="cons">{{$value['PlateNumber']}}</span></div>
        <div class="pay_detail4"><img src="{{URL::asset('assets/image/times.png')}}" alt=""  class="icpic"><span class="ins">停车时长：</span><span class="cons">
            @php
                $parklen=intval((strtotime($value['BerthEndParkingTime'])-strtotime($value['BerthStartParkingTime']))/60);
                if ($parklen>=60){
                    echo intval($parklen/60)."小时";
                }
                if ($parklen<60)
                    echo $parklen;
                else echo $parklen%60@endphp分钟</span></div>
        <div class="pay_detail5">
            <img src="{{URL::asset('assets/image/pay.png')}}" alt=""  class="icpic">
            @if($value['PayStatus']==22 || $value['PayStatus']==12)
            <span class="ins">实际金额：
                </span>
            <span>￥{{$value['PayPrice']}}
                元
                </span>
            @elseif($value['PayStatus']==21 || $value['PayStatus']==11)
            <span class="ins">实际金额：
                </span>
            <span>￥{{$value['ActualPrice']}}元
                    <span style="font-size:0.3rem;color: #3d3d3d;">(已退还￥{{$value['RefundPrice']}}元)
                    </span>
                </span>
            @elseif($value['PayStatus']==2)
            <span class="ins">实际金额：
                </span>
            <span>￥{{$value['ActualPrice']}}元
                </span>
             @elseif($value['PayStatus']==31)
            <span class="ins">实际金额：</span>
            <span>￥{{$value['ActualPrice']}}元
                    <span style="font-size:0.3rem;color: #3d3d3d;">(已退还￥{{$value['RefundPrice']}}元)
                    </span>
                </span>
           @endif
        </div>
        <hr class="hr_line">
    </div>
        @endforeach
    <p style="width:7rem; margin:0.25rem auto;text-align: left;color: #236586;font-size: 0.24rem;line-height: 0.5rem">订单退还金额将在3-5个工作日原路返还，请注意账号变动情况</p>
</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script>
    function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
    }
    $(document).ready(function(){
        var BargainOrderCode=getQueryString('num');
        var key=getQueryString('key');

        $('.'+BargainOrderCode+'.'+key).css({'display':'block'});
    })
</script>