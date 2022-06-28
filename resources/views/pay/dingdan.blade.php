<!DOCTYPE html>
<html lang="en" style="width: 100%;height: 100%;">
<head>
    <meta charset="UTF-8">
    <title>订单详情</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>
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
</head>
<body style="width: 100%;height: 100%;background: #f7f6f6;">
<div class="main">
    <div style="width: 7rem;height: 7.03rem;margin:0 auto;margin-top: 0.5rem;z-index: 1">
        <img src="{{URL::asset('assets/image/zhifu@3x2.png')}}image/zhifu@3x2.png" alt="" style='width: 7rem;height: 7.03rem;' onclick="return false;">
    </div>
    <div style="width: 7rem;height: 7.03rem;margin:0 auto;margin-top: -7.03rem;z-index: 2;position: relative;">
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #cacaca;position: absolute;left: 0;top:0.86rem;">泊位编号</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #585858;position: absolute;left: 1.4rem;top:0.86rem;">{{$arrdata['Data']['BerthCode']}}</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #cacaca;position: absolute;left: 0;top:1.70rem;">路段名称</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #585858;position: absolute;left: 1.4rem;top:1.70rem;">{{$arrdata['Data']['SectionName']}}</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #cacaca;position: absolute;left: 0;top:2.58rem;">停车时间</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #585858;position: absolute;left: 1.4rem;top:2.58rem;">{{$arrdata['Data']['BerthStartParkingTime']}}</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #cacaca;position: absolute;left: 0;top:3.56rem;">停车时长</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #585858;position: absolute;left: 1.4rem;top:3.56rem;">{{$chi_time}}</p>

        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #cacaca;position: absolute;left: 0;top:4.49rem;">停车优惠券</p>
        <p style="width: 100%;padding-left: 1rem;font-size: 0.26rem;color: #0d57a0;position: absolute;left: 1.4rem;top:4.49rem;" @if($i>0)onclick="show_coupon()"@endif><span id="coupon_tips">{{$i}}张可用</span></p>

        <p style="width: 100%;padding-left: .8rem;font-size: 0.28rem;color: #ffffff;position: absolute;left: 0;top:6.13rem;">停车计费</p>
        <p style="width: 100%;padding-left: 2.2rem;font-size: 0.46rem;color: red;position: absolute;left: 0;top:6rem;"><span class="jiaofei">￥{{$price}}</span></p>
        <input type="hidden" name="pay_monney0" class="pay_monney0" value="{{$arrdata['Data']['ActualPrice']}}">
        <input type="hidden" name="pay_monney" class="pay_monney" value="{{$price}}">
        <div style="width: 100%;height: 0.54rem;display: -webkit-flex;-webkit-align-items: center;position: absolute;left: 0;top:6.1rem;;padding-left: 4.5rem;"><div style="width: 1.5rem;height: 0.5rem;border:1px solid white;border-radius: 0.07rem;text-align: center;line-height: 0.5rem;font-size: 0.32rem;color: #0d57a0;background: white;" onclick="fukuan()">马上付款</div></div>
    </div>

    <div  style="display: none;background-color: #f5f5f5;width:100%;height:100%;position: fixed;z-index:9999999;top: 0; bottom:0; overflow-y:scroll; overflow-x:hidden;" id="coupons">
        <input type="hidden" name="selected_coupon_id" id="selected_coupon_id" value="0">
        <input type="hidden" name="last_coupon_price" id="last_coupon_price" value="0">
        <input type="hidden" name="selected_coupon_type" id="selected_coupon_type" value="0">
        <input type="hidden" name="hasmj" id="hasmj" value="0">
        @if($coupon_list['Data']['Count']>0)
        <input type="hidden" name="have_coupon" id="have_coupon" value="1">
        @else
        <input type="hidden" name="have_coupon" id="have_coupon" value="0">
        @endif
        <div class="coupon_true" style="margin-bottom: 60px">
            @if(count($coupon_list['Data']['DiscountData'])>0)
                @foreach($res as $s=>$t)
                    @if(in_array($t['PaymentType'], $py))
                        <div class="opt">
                            <div class="squaredThree">
                                <input type="radio" name="coupon_id" id="radio{{$t['VPNMId']}}"
                                       value="{{$t['VPNMId']}}-{{$VPMoney}}-{{$t['VoucherType']}}"
                                       class="check">
                                <label for="myCheck"></label>
                            </div>
                            <div class="coupon_img0" onclick="change_coupon_select_status({{$t['VPNMId']}})">
                                <p class="coupon_top"><span
                                            class="coupon_size">· </span>@if($t['AppeType'] == 1)广发银行CGB@else满减券@endif
                                </p>

                                <p class="coupon_left">使用期限：{{$t['EffTime']}}
                                    -{{$t['FailureTime']}}</p>
                                <p class="coupon_right">
                                    <span>@if($t['VoucherType'] == 1)小时@else￥@endif</span>{{$t['VPMoney']}}
                                </p>
                                <p class="coupon_money">满{{$t['FSMoney']}}元可用</p>
                                <img src="{{URL::asset('assets/image/bank'.$t['AppeType'].'png')}}" class="apptype"/>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
                @if($coupon_list['Data']['Count'] > 0)
                    @foreach($coupon_list['Data']['Items'] as $k=>$v)
                        @if(in_array($v['PaymentType'], $py))
                            <div class="opt">
                                <div class="squaredThree">
                                    <input type="radio" name="coupon_id" id="radio{{$v['VoucherId']}}"
                                           value="{{$v['VoucherId']}}-{{$v['VPMoney']}}-{{$v['VoucherType']}}"
                                           class="check">
                                    <label for="myCheck"></label>
                                </div>
                                <div class="coupon_img0"
                                     onclick="change_coupon_select_status({{$v['VoucherId']}})">
                                    <p class="coupon_top"><span
                                                class="coupon_size">· </span> @if($v['AppeType'] == 1)广发银行CGB@else优惠券@endif
                                    </p>

                                    <p class="coupon_left">使用期限：{{$v['EffTime']}}
                                        -{{$v['FailureTime']}}</p>
                                    <p class="coupon_right">
                                        <span>
                                            @if($v['VoucherType'] == 1)
                                                小时
                                            @else
                                                ￥
                                            @endif
                                            </span>{{$v['VPMoney']}}
                                    </p>
                                    <img src="{{URL::asset('assets/image/bank'.$t['AppeType'].'png')}}"
                                         class="apptype"/>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
        </div>
        <button class="coupon_button" style="position: fixed;bottom: 1px;z-index:9999" onclick="select_coupon()">确 定</button>
    </div>

</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('assets/layer/layer.js')}}"></script>

<script>
    function fukuan(){
        var BargainOrder="@php echo isset($arrdata['Data']['BargainOrderCode'])?$arrdata['Data']['BargainOrderCode']:0;@endphp";

        var berthcode="@php echo isset($arrdata['Data']['BerthCode'])?$arrdata['Data']['BerthCode']:0;@endphp";
        var time="@php echo isset($arrdata['Data']['RemainTime'])?round($arrdata['Data']['RemainTime']/60):0;@endphp";

        $.ajax({
            url: 'pay_OrderHaveArrears',
            data: {'BargainOrder':BargainOrder},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                layer.open({
                    type: 2
                });
            },
            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                layer.closeAll();
                if(ops.Message=='success'&&ops.Data.code=='finished'){


                    var PayPrice=ops.Data.data.ArrearsPrice;

                    var ordercode=ops.Data.data.ArrearsOrderCode;


                    var VoucherID = $('#selected_coupon_id').val();
                    var CouponAmount = $('#last_coupon_price').val();
                    var CouponType = $('#selected_coupon_type').val();
                    var VPNMId;
                    if ($('#hasmj').val()==0)
                    { VoucherID=$('#selected_coupon_id').val();
                        VPNMId=-1;
                    }
                    else{
                        VoucherID=-1;
                        VPNMId=$('#hasmj').val();
                    }

                    if(parseFloat(PayPrice)>0){
                        window.location.href='pay_zhifu?ordercode='+ordercode+'&PayPrice='+PayPrice+'&berthcode='+berthcode+'&time='+time+'&BargainOrder='+BargainOrder+ "&VPNMId=" + VPNMId +"&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;
                    }else{
                        console.log(ops)

                    }

                }else if(ops.Message=='success'&&ops.Data.code=='finishing'){
                    setTimeout("fukuan()",5000);
                }else{
                    layer.open({
                        content: ops.Data.msg||ops.Message
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                }


            },
            error: function(){
                layer.closeAll();
                layer.open({
                    content: "请求失败，请稍后执行！"
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
            }


        })



    }

    function show_coupon(){
        document.getElementById('coupons').style.display='block';
        return true;
    }

    function change_coupon_select_status(radio_id){
        if ($("#radio" + radio_id).parents(".opt").find(".coupon_money").length>0) {
            $("#hasmj").val(radio_id)

        }
        if($("#radio" + radio_id).is(":checked"))
            $("#radio" + radio_id).prop("checked",false);
        else
            $("#radio" + radio_id).prop("checked",true);
    }

    //选择使用优惠券
    function select_coupon(){
        document.getElementById('coupons').style.display='none';
        var coupon_value = $("input[name='coupon_id']:checked").val();


        //未选择任何优惠券
        if(coupon_value==undefined){
            var last_coupon_price = $("#last_coupon_price").val();
            //之前有选择优惠券
            if(last_coupon_price>0){
                var coupon_tips = "{{$coupon_list['Data']['AvailableCount']}}张可用";
                $("#coupon_tips").html(coupon_tips);


                var need_pay_price = $('.pay_monney').val();

                $('.jiaofei').html("￥" + need_pay_price);

                $("#last_coupon_price").val(0);
                $("#selected_coupon_id").val(0);
                $("#selected_coupon_type").val(0);
            }

        }else{

            var coupon_arr = coupon_value.split('-');
            if(coupon_arr[1]>0){

                $("#coupon_tips").html("-" + coupon_arr[1]);
                $("#selected_coupon_id").val(coupon_arr[0]);
                $("#selected_coupon_type").val(coupon_arr[2]);

                //var orig_price_txt = $('.jiaofei').html();
                //var price = orig_price_txt.substring(1);

                var need_pay_price = $('.pay_monney').val();
                var last_coupon_price = $("#last_coupon_price").val();

                var new_price = parseFloat(Number(need_pay_price) - Number(coupon_arr[1])).toFixed(2);

                if(new_price<0)
                    new_price = 0;

                $("#last_coupon_price").val(coupon_arr[1]);
                $('.pay_monney0').val(new_price);
                $('.jiaofei').html("￥" + new_price);
                //alert("选中的radio的值是：" + coupon_arr[0]);
            }
        }
        return true;

    }


</script>