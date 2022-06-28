<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <title>我的优惠券</title>
    <style type="text/css">
        .VPNum{font-size: 0.2rem;}
        .VPMoney{font-size: .70rem; }
        .coupon_right {
            font-size: .30rem;
            color: #ffffff;
            position: absolute;
            right: 0.6rem;
            top: 0.6rem;
            display: block;
            min-width: 1rem;
        }
    </style>
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
</head>
<style type="text/css">
    .apptype{
        position: absolute;
        top: 10px;
        width: 84px;
        z-index: 999;
        left: 3.0rem;
    }
</style>
<script>
    var deviceWidth = document.documentElement.clientWidth;
    if(deviceWidth > 750) deviceWidth = 750;
    document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
</script>
<body style="background-color: #f5f5f5;width:100%;height:100%;">
<div class="main">
    <div class="zhangdan_top">
        <div class="zhangdan_top1" onclick="show_pay(1)">
            <div class="coupon">可使用（{{$coupon_list['Data']['AvailableCount']}}）</div>
        </div>
        <div class="zhangdan_top2" onclick="show_park1(this,2)">
            <div class="coupon">已使用（{{$coupon_list['Data']['UsedCount']}}）</div>
        </div>
        <div class="zhangdan_top3" onclick="show_park1(this,0)">
            <div class="coupon">已过期（{{$coupon_list['Data']['DisableCount']}}）</div>
        </div>
    </div>
</div>
<div class="coupon_true">
    @foreach($coupon_list['Data']['DiscountData'] as $k => $v)
        @if ($v['VoucherStatus']==1)
            @php
                $name="优惠券";
                if ($v['AppeType']==1) {
                    $name="广发银行(CGB)";
                }
            @endphp
            <div class="coupon_img0">
                <p class="coupon_top">
                    <span class="coupon_size">· </span>{{$name}}
                </p>
                <p class="coupon_left" style="font-size:0.25rem">
                    @php
                        if ($v['UseType']==0) {

                            if($v['IsPDA'] == 1){
                                echo "仅公共停车场&收费告知单可用";
                            }else {
                                echo "仅公共停车场可用";
                            }
                        }

                        else if($v['UseType'] == 1){
                            if($v['PaymentType'] == 0) {
                                if($v['IsPDA'] == 1)
                                    echo "路内通用(收费告知单可用)";
                                else
                                    echo "仅预付费&后付费可用";
                            }else if($v['PaymentType'] == 1){
                                if($v['IsPDA'] == 1)
                                    echo "仅预付费&收费告知单可用";
                                else
                                    echo "仅预付费可用";
                            }else if($v['PaymentType'] == 2){
                                if($v['IsPDA'] == 1)
                                    echo "仅后付费&收费告知单可用";
                                else
                                    echo "仅后付费可用";
                            }
                        }else if($v['UseType'] == 2){
                            if($v['IsPDA'] == 1)
                                echo "全场通用(收费告知单可用)";
                            else
                                echo "全场通用";
                        }

                    @endphp</p>
                <p class="coupon_left" style="font-size:0.2rem">使用期限:{{$v['EffTime']}}至{{$v['FailureTime']}}</p>
                <p class="coupon_right">
                    @if($v['VoucherType']==1)
                        <span>小时</span>
                        {{$v['VPMoney']}}
                    @else
                        <span>￥</span>
                        <span class="VPMoney">{{$v['VPMoney']}}</span>
                    @endif
                    <br>
                    <span class="VPNum">满{{$v['FSMoney']}}元可用</span>
                </p>
                <img src="{{URL::asset('assets/image/bank'.$v['AppeType'].'.png')}}" class="apptype"/>
            </div>
        @endif
    @endforeach
        @foreach($coupon_list['Data']['Items'] as $k => $v)
            @if($v['VoucherStatus']==1)
                @php
                    $name="优惠券";
                    if ($v['AppeType']==1) {
                        $name="广发银行(CGB)";
                    }
                @endphp
                <div class="coupon_img0">
                    <p class="coupon_top">
                        <span class="coupon_size">· </span>{{$name}}
                    </p>
                    <p class="coupon_left" style="font-size:0.25rem">
                        @php
                            if ($v['UseType']==0) {

                                if($v['IsPDA'] == 1){
                                    echo "仅公共停车场&收费告知单可用";
                                }else {
                                    echo "仅公共停车场可用";
                                }
                            }

                            else if($v['UseType'] == 1){
                                if($v['PaymentType'] == 0) {
                                    if($v['IsPDA'] == 1)
                                        echo "路内通用(收费告知单可用)";
                                    else
                                        echo "仅预付费&后付费可用";
                                }else if($v['PaymentType'] == 1){
                                    if($v['IsPDA'] == 1)
                                        echo "仅预付费&收费告知单可用";
                                    else
                                        echo "仅预付费可用";
                                }else if($v['PaymentType'] == 2){
                                    if($v['IsPDA'] == 1)
                                        echo "仅后付费&收费告知单可用";
                                    else
                                        echo "仅后付费可用";
                                }
                            }else if($v['UseType'] == 2){
                                if($v['IsPDA'] == 1)
                                    echo "全场通用(收费告知单可用)";
                                else
                                    echo "全场通用";
                            }
                        @endphp</p>
                    <p class="coupon_left" style="font-size:0.2rem">使用期限:{{$v['EffTime']}}至{{$v['FailureTime']}}</p>

                    <p class="coupon_right">
                        @if($v['VoucherType']==1)
                            <span>小时</span>{{$v['VPMoney']}}
                        @else
                            <span>￥</span>
                            <span class="VPMoney">
                    {{$v['VPMoney']}}
               </span>@endif<br>
                        <span class="VPNum">可用数量：{{$v['VPNum']}}</span></p>
                    <img src="{{URL::asset('assets/image/bank'.$v['AppeType'].'.png')}}" class="apptype"/>
                </div>
            @endif
        @endforeach
</div>
<div class="coupon_false" id="coupon_invalid"></div>

</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
</script>
<script>
    function show_pay(){
        $('.coupon').css({'borderBottom':'none','color':'black'});
        $('.zhangdan_top1 .coupon').css({'borderBottom':"2px solid #0d57a0",'color':'#0d57a0'});
        $('.coupon_true').css({'display':'block'});
        $('.coupon_false').css({'display':'none'});
    }
    function show_park1(obj,status){
        $(obj).siblings().find('.coupon').css({'borderBottom':'none','color':'black'});
        $(obj).find(".coupon").css({'borderBottom':"2px solid #0d57a0",'color':'#0d57a0'});
        $('.coupon_false').css({'display':'block'});
        $('.coupon_true').css({'display':'none'});
        $("#coupon_invalid").html("");
        $.ajax({
            url: 'get_coupon_list',
            data: {'pageSize':9999,'VoucherStatus':status},
            method:'post',
            dataType:'json',
            beforeSend: function () {
                layer.open({
                    type: 2

                });
            },
            success: function (ops) {

                $.each(ops.Data.DiscountData, function (index, obj) {
                    if (obj.VoucherStatus==status) {
                        var tet;
                        var name;

                        name="优惠券";




                        if (obj['UseType']==0) {

                            if(obj['IsPDA'] == 1){
                                tet= "仅公共停车场&收费告知单可用";
                            }else {
                                tet= "仅公共停车场可用";
                            }
                        }

                        else if(obj['UseType'] == 1){
                            if(obj['PaymentType'] == 0) {
                                if(obj['IsPDA'] == 1)
                                    tet= "路内通用(收费告知单可用)";
                                else
                                    tet= "仅预付费&后付费可用";
                            }else if(obj['PaymentType'] == 1){
                                if(obj['IsPDA'] == 1)
                                    tet= "仅预付费&收费告知单可用";
                                else
                                    tet= "仅预付费可用";
                            }else if(obj['PaymentType'] == 2){
                                if(obj['IsPDA'] == 1)
                                    tet= "仅后付费&收费告知单可用";
                                else
                                    tet= "仅后付费可用";
                            }
                        }else if(obj['UseType'] == 2){
                            if(obj['IsPDA'] == 1)
                                tet= "全场通用(收费告知单可用)";
                            else
                                tet="全场通用";
                        }

                        if(obj.VoucherType==1){
                            var div_string = '<div class="coupon_img0">' +
                                '<p class="coupon_top"><span class="coupon_size" >· </span>'+name+'</p>' +
                                '<p class="coupon_left" style="font-size:0.25rem">' +tet+ '</p>' +
                                '<p class="coupon_left">使用期限：' + obj.EffTime + '至' + obj.FailureTime + '</p>' +
                                '<p class="coupon_right"><span>￥</span><span class="VPMoney">' + obj.VPMoney + '</span></p>' +
                                '</div>';
                        }else{
                            var div_string = '<div class="coupon_img0">' +
                                '<p class="coupon_top"><span class="coupon_size" >· </span>'+name+'</p>' +
                                '<p class="coupon_left" style="font-size:0.25rem">' +tet+ '</p>' +
                                '<p class="coupon_left">使用期限：' + obj.EffTime + '至' + obj.FailureTime + '</p>' +
                                '<p class="coupon_right"><span>￥</span><span class="VPMoney">' + obj.VPMoney + '</span></p>' +
                                '</div>';
                        }
                        $("#coupon_invalid").append(div_string);
                    }
                });
                $.each(ops.Data.Items, function (index, obj) {
                    if (obj.VoucherStatus==status) {
                        var tet;
                        var name;

                        name="优惠券";



                        if (obj['UseType']==0) {

                            if(obj['IsPDA'] == 1){
                                tet= "仅公共停车场&收费告知单可用";
                            }else {
                                tet= "仅公共停车场可用";
                            }
                        }

                        else if(obj['UseType'] == 1){
                            if(obj['PaymentType'] == 0) {
                                if(obj['IsPDA'] == 1)
                                    tet= "路内通用(收费告知单可用)";
                                else
                                    tet= "仅预付费&后付费可用";
                            }else if(obj['PaymentType'] == 1){
                                if(obj['IsPDA'] == 1)
                                    tet= "仅预付费&收费告知单可用";
                                else
                                    tet= "仅预付费可用";
                            }else if(obj['PaymentType'] == 2){
                                if(obj['IsPDA'] == 1)
                                    tet= "仅后付费&收费告知单可用";
                                else
                                    tet= "仅后付费可用";
                            }
                        }else if(obj['UseType'] == 2){
                            if(obj['IsPDA'] == 1)
                                tet= "全场通用(收费告知单可用)";
                            else
                                tet="全场通用";
                        }

                        if(obj.VoucherType==1){
                            var div_string = '<div class="coupon_img0">' +
                                '<p class="coupon_top"><span class="coupon_size" >· </span>'+name+'</p>' +
                                '<p class="coupon_left" style="font-size:0.25rem">' +tet+ '</p>' +
                                '<p class="coupon_left">使用期限：' + obj.EffTime + '至' + obj.FailureTime + '</p>' +
                                '<p class="coupon_right"><span>￥</span><span class="VPMoney">' + obj.VPMoney + '</span></p>' +
                                '</div>';
                        }else{
                            var div_string = '<div class="coupon_img0">' +
                                '<p class="coupon_top"><span class="coupon_size" >· </span>'+name+'</p>' +
                                '<p class="coupon_left" style="font-size:0.25rem">' +tet+ '</p>' +
                                '<p class="coupon_left">使用期限：' + obj.EffTime + '至' + obj.FailureTime + '</p>' +
                                '<p class="coupon_right"><span>￥</span><span class="VPMoney">' + obj.VPMoney + '</span></p>' +
                                '</div>';
                        }
                        $("#coupon_invalid").append(div_string);
                    }
                });
                layer.closeAll();
            }
        });
    }
    show_pay();
</script>