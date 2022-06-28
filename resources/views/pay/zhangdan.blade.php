<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>账单明细</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
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
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body>
<div class="main">

    <div class="div1">
        @if (!empty($arrdata0['Data']['Items']))
            @foreach($arrdata0['Data']['Items'] as $key => $value)
                @if ($arrdata0['Data']['Items'][$key]['mounth']!=$arrdata0['Data']['Items'][$key-1]['mounth'])
        <p style="width: 100%;height: 0.8rem;line-height: 0.8rem;padding-left: 0.2rem;border-top:1px solid #c4c0c0;background: #f5f5f5;color: #323232;">@php $he = explode('-',$value['day']);  echo $he[0];@endphp月</p>
            @endif
        <div style="display: -webkit-flex;-webkit-justify-content: space-between;height: 1.2rem;-webkit-align-items: center;">
           <div style="margin-left: 0.3rem;">
                <div style="color: #989898;font-size:0.32rem">{{$value['day']}}</div>
                <div style="color: #989898;font-size:0.22rem;margin-top: 0.1rem;">{{$value['hour']}}</div>
            </div>
            <div style="margin-right: 0.3rem;">
               <div style="color: #fa3735;font-size:0.32rem">+{{$value['OrderFee']}}</div>
                <div style="color: #989898;font-size:0.22rem;margin-top: 0.1rem;">
                    @if ($value['PayType'] == 1)
                         余额支付
                    @elseif ($value['PayType'] == 2)
                        微信支付
                    @else
                        支付宝支付
                    @endif
                </div>

           </div>
        </div>
            @endforeach
        @else
            <div style="width:100%;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-top:0.7rem;"><img src="{{URL::asset('assets/image/noth.png')}}" alt="" width="" style="width: 2rem;height:2rem"><div style="margin-top: 0.3rem;"><span style="color: #fb415b;font-size: 0.3rem;">温馨提示：</span><span style="color: #0d57a0;font-size: 0.3rem;">您当前没有充值记录</span></div></div>
        @endif
    </div>


    <div class="div2">
        @if (!empty($arrdata1['Data']['Items']))
            @foreach($arrdata1['Data']['Items'] as $key => $value)
        @if ($arrdata1['Data']['Items'][$key]['mounth']!=$arrdata1['Data']['Items'][$key-1]['mounth'])
                    <p style="width: 100%;height: 0.8rem;line-height: 0.8rem;padding-left: 0.2rem;border-top:1px solid #c4c0c0;background: #f5f5f5;color: #323232;"><?php $he = explode('-',$value['day']);  echo $he[0]; ?>月</p>
         @endif
        <a href="paydetail.php?num={{$value['BargainOrderCode']}}&key={{$key}}">
            <div style="display: -webkit-flex;-webkit-justify-content: space-between;height: 1.2rem;-webkit-align-items: center;">
                <div style="margin-left: 0.3rem;">
                    <div style="color: #989898;font-size:0.32rem">{{$value['day']}}</div>
                    <div style="color: #989898;font-size:0.22rem;margin-top: 0.1rem;">{{$value['hour']}}</div>
                </div>
                <div style="margin-right: 0.3rem;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;">
                    <div style="color: #fa3735;font-size:0.32rem">￥{{$value['ActualPrice']}}</div>
                    <div style="color: #989898;font-size:0.22rem;margin-top: 0.1rem;">
                        @if ($value['PayStatus']==21)
                            缴费订单
                        @elseif ($value['PayStatus']==22)
                            续费订单
                        @elseif ($value['PayStatus']==31)
                            后付费缴费
                       @endif
                    </div>

                </div>
            </div>
        </a>
            @endforeach
        @else
        <div style="width:100%;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-top:0.7rem;"><img src="{{URL::asset('assets/image/noth.png')}}" alt="" width="" style="width: 2rem;height:2rem"><div style="margin-top: 0.3rem;"><span style="color: #fb415b;font-size: 0.3rem;">温馨提示：</span><span style="color: #0d57a0;font-size: 0.3rem;">您当前没有停车场停车记录</span></div></div>
       @endif
    </div>
    <div class="div3">
        @if (!empty($arrdata2['Data']['Items']))
       @foreach ($arrdata2['Data']['Items'] as $key => $value)
                @if (($key == 0) || ($key>0 && $arrdata2['Data']['Items'][$key]['mounth']!=$arrdata2['Data']['Items'][$key-1]['mounth']))
                <p style="width: 100%;height: 0.8rem;line-height: 0.8rem;padding-left: 0.2rem;border-top:1px solid #c4c0c0;background: #f5f5f5;color: #323232;">@php $he = explode('-',$value['day']);  echo $he[0];@endphp月</p>
                    @endif
                @if ($value['PayStatus']!=-1)
                       <a href="pay_detail?num={{$value['BargainOrderCode']}}&key={{$key}}">
                            <div style="display: -webkit-flex;-webkit-justify-content: space-between;height: 1.2rem;-webkit-align-items: center;">
                                <div style="margin-left: 0.3rem;">
                                    <div style="color: #989898;font-size:0.32rem">{{$value['day']}}</div>
                                    <div style="color: #989898;font-size:0.22rem;margin-top: 0.1rem;">{{$value['hour']}}</div>
                                </div>
                                <div style="margin-right: 0.3rem;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;">
                                    <div style="color: #fa3735;font-size:0.32rem">￥@if ($value['PayStatus']==21 || $value['PayStatus']==11){{$value['ActualPrice']}}@elseif ($value['PayStatus']==22 || $value['PayStatus']==12){{$value['PayPrice']}}@elseif ($value['PayStatus']==31){{$value['ActualPrice']}}@elseif ($value['PayStatus']==2){{$value['ActualPrice']}}@endif</div>
                                    <div style="color: #989898;font-size:0.22rem;margin-top: 0.1rem;">@if ($value['PayStatus']==21)缴费订单@elseif ($value['PayStatus']==11)预付费订单@elseif ($value['PayStatus']==12)续费订单@elseif ($value['PayStatus']==31)后付费缴费@elseif ($value['PayStatus']==2)缴费订单@endif</div>

                                </div>
                            </div>
                        </a>
                @endif
               @endforeach
        @else
        <div style="width:100%;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-top:0.7rem;"><img src="{{URL::asset('assets/image/noth.png')}}" alt="" style="width: 2rem;height:2rem"><div style="margin-top: 0.3rem;"><span style="color: #fb415b;font-size: 0.3rem;">温馨提示：</span><span style="color: #0d57a0;font-size: 0.3rem;">您当前没有停车记录</span></div></div>
       @endif
    </div>

</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script>
    function show_pay(){
        $('.zhangdan_top2').css({'borderBottom':'none','color':'black'});
        $('.zhangdan_top3').css({'borderBottom':'none','color':'black'});

        $('.zhangdan_top1').css({'borderBottom':"2px solid #0d57a0",'color':'#0d57a0'});

        $('.div1').css({'display':'block'});

        $('.div2').css({'display':'none'});
        $('.div3').css({'display':'none'});

    }
    function show_park(){
        $('.zhangdan_top1').css({'borderBottom':'none','color':'black'});
        $('.zhangdan_top3').css({'borderBottom':'none','color':'black'});

        $('.zhangdan_top2').css({'borderBottom':"2px solid #0d57a0",'color':'#0d57a0'});

        $('.div2').css({'display':'block'});
        $('.div1').css({'display':'none'});
        $('.div3').css({'display':'none'});

    }
    function show_park1(){
        $('.zhangdan_top1').css({'borderBottom':'none','color':'black'});
        $('.zhangdan_top2').css({'borderBottom':'none','color':'black'});

        $('.zhangdan_top3').css({'borderBottom':"2px solid #0d57a0",'color':'#0d57a0'});

        $('.div3').css({'display':'block'});
        $('.div1').css({'display':'none'});
        $('.div2').css({'display':'none'});

    }
    show_park1();
</script>