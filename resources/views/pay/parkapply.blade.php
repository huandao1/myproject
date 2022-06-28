<!DOCTYPE html>
<html lang="en" style="width: 100%;height: 100%;">
<head>
    <meta charset="UTF-8">
    <title>支付</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/zhifu.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>



    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body style="width: 100%;height: 100%;background: #f7f6f6;">
<div class="main">
</div>
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
    function yuers(){
        var data=$('.chongzhi').attr("data");
        // alert(data);
        if(parseInt(data)!=1){
            $('.yuer').attr("src","{{URL::asset('assets/image/xuanzhong@2x.png')}}");
            $('.weixin').attr("src","{{URL::asset('assets/image/weixuanzhong@2x.png')}}");

            $('.chongzhi').attr('data',"1");
            $('.chongzhi').attr('disabled',false);
            $('.chongzhi').css({'background':'#0d57a0'});

        }else{
            $('.yuer').attr("src","{{URL::asset('assets/image/weixuanzhong@2x.png')}}");
            $('.chongzhi').attr('data',"0");
            $('.chongzhi').attr('disabled',true);
            $('.chongzhi').css({'background':'#93cbf1'});


        }
    }
    function weixin(){
        var data=$('.chongzhi').attr("data");
        // alert(data);
        if(parseInt(data)!=2){
            $('.weixin').attr("src","{{URL::asset('assets/image/xuanzhong@2x.png')}}");
            $('.yuer').attr("src","{{URL::asset('assets/image/weixuanzhong@2x.png')}}");

            $('.chongzhi').attr('data',"2");
            $('.chongzhi').attr('disabled',false);
            $('.chongzhi').css({'background':'#0d57a0'});

        }else{
            $('.weixin').attr("src","{{URL::asset('assets/image/weixuanzhong@2x.png')}}");
            $('.chongzhi').attr('data',"0");
            $('.chongzhi').attr('disabled',true);
            $('.chongzhi').css({'background':'#93cbf1'});


        }
    }
    //关闭浮动
    $(".close").click(function(){
        $(".ftc_wzsf").hide();
        $(".mm_box li").removeClass("mmdd");
        $(".mm_box li").attr("data","");
        i = 0;
    });
    //数字显示隐藏
    $(".xiaq_tb").click(function(){
        $(".numb_box").slideUp(500);
    });
    $(".mm_box").click(function(){
        $(".numb_box").slideDown(500);
    });
    //----
    var i = 0;
    $(".nub_ggg li .zf_num").click(function(){

        if(i<6){
            $(".mm_box li").eq(i).addClass("mmdd");
            $(".mm_box li").eq(i).attr("data",$(this).text());
            i++
            if (i==6) {
                setTimeout(function(){
                    var data = "";
                    $(".mm_box li").each(function(){
                        data += $(this).attr("data");
                    });

                    var ordercode="{{$ordercode}}";
                    var paypwd=data;
                    var PayPrice="{{$PayPrice}}";
                    var time={{$time}};
                    var BargainOrder="{{$BargainOrder}}";

                    $.ajax({
                        url: 'pay_bupay1',
                        data: {'ordercode':ordercode,'paypwd':paypwd,'PayPrice':PayPrice,'time':time,'BargainOrder':BargainOrder},
                        method:'post',
                        dataType:'json',
                        headers: {
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        beforeSend: function () {
                            layer.open({
                                type: 2
                                ,content: '处理请求中，请稍等...'
                            });
                        },
                        success: function (ops) {
                            layer.closeAll();
                            if(ops.Message=='success'){
                                if(ops.Data.result.code=='success'){
                                    alert('缴费成功');
                                    setTimeout("window.location.href='pay_jishi'",2000);

                                }else{
                                    alert(ops.Data.result.msg);
                                }

                            }else{
                                alert(ops.Message);
                            }

                        },
                        error : function(){
                            // alert('请求失败，请稍后执行！');
                            layer.closeAll();
                            alert('请求失败，请稍后执行！');
                        },
                        complete: function () {
                            // $(".download").hide();
                            $(".mm_box li").removeClass("mmdd");
                            $(".mm_box li").attr("data","");
                            i = 0;
                            $(".ftc_wzsf").hide();

                        }


                    })

                },100);


            };
        }
    });

    $(".nub_ggg li .zf_del").click(function(){
        if(i>0){
            i--
            $(".mm_box li").eq(i).removeClass("mmdd");
            $(".mm_box li").eq(i).attr("data","");
        }
    });

    $(".nub_ggg li .zf_empty").click(function(){
        $(".mm_box li").removeClass("mmdd");
        $(".mm_box li").attr("data","");
        i = 0;
    });
    (function(){
        var data=1

        var bargainordercode = "{{$BargainOrder}}";
        var berthcode="{{$berthcode}}";
        var ordercode="{{$ordercode}}";
        var PayPrice="{{$PayPrice}}";
        var time="{{$time}}";
        var PlateNumber="{{$PlateNumber}}";
        var VPNMId="{{$VPNMId}}";
        var VoucherID="{{$VoucherID}}";
        var CouponAmount="{{$CouponAmount}}";
        var CouponType="{{$CouponType}}";

        if(data==1){
            window.location.href="pay_parkapplypayyinliang?bargainordercode=" + bargainordercode + "&ordercode=" + ordercode + "&berthcode=" + berthcode  + "&PayPrice=" + PayPrice + "&time=" + time + "&PlateNumber=" + PlateNumber +"&paytype=4"+"&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;;

        }else if(data==2){
            var ordercode="{{$ordercode}}";

            var PayPrice="{{$PayPrice}}";

            var BargainOrder="{{$BargainOrder}}";



            $.ajax({
                url: 'pay_parkapplypayyinliang',
                data: {'ordercode':ordercode,'PayPrice':PayPrice,'time':time,'bargainordercode':bargainordercode,'CouponAmount':CouponAmount,'PlateNumber':PlateNumber,'CouponType':CouponType,'VoucherID':VoucherID,'berthcode':berthcode},
                method:'get',
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    layer.open({
                        type: 2
                        ,content: '支付请求中，请稍等...'
                    });
                },
                success: function (ops) {
                    layer.closeAll();
                    if (ops.RetCode!=0){
                        console.log("111");
                        layer.open({
                            content: ops.Message
                            ,skin: 'msg'
                            ,time: 2 //2秒后自动关闭
                        });
                        // setTimeout("window.history.go(-1)",1000);
                        return false;
                    }


                    //alert(ops.Data.result.WxResponse.appid);
                    function onBridgeReady(){
                        WeixinJSBridge.invoke(
                            'getBrandWCPayRequest', {
                                "appId":ops.Data.result.WxResponse.appId,     //公众号名称，由商户传入
                                "timeStamp":ops.Data.result.WxResponse.timeStamp,         //时间戳，自1970年以来的秒数
                                "nonceStr":ops.Data.result.WxResponse.nonceStr, //随机串
                                "package":ops.Data.result.WxResponse.package,
                                "signType":"MD5",         //微信签名方式：
                                "paySign":ops.Data.result.WxResponse.paySign //微信签名


                                // "appId":ops.appId,     //公众号名称，由商户传入
                                //"timeStamp":ops.timeStamp,         //时间戳，自1970年以来的秒数
                                // "nonceStr":ops.nonceStr, //随机串
                                //"package":ops.package,
                                //"signType":"MD5",         //微信签名方式：
                                // "paySign":ops.paySign//微信签名
                            },
                            function(res){
                                //alert(res.err_code+res.err_desc+res.err_msg);
                                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                                    layer.open({
                                        content: '支付成功'
                                        ,skin: 'msg'
                                        ,time: 2 //2秒后自动关闭
                                    });
                                    setTimeout("window.location.href='pay_jishi?id=1'",1000);
                                }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                                else{
                                    layer.open({
                                        content: '支付失败'
                                        ,skin: 'msg'
                                        ,time: 2 //2秒后自动关闭
                                    });
                                    // setTimeout("window.history.go(-1)",1000);

                                }
                            }
                        );
                    }
                    if (typeof WeixinJSBridge == "undefined"){
                        if( document.addEventListener ){
                            document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                        }else if (document.attachEvent){
                            document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                            document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                        }
                    }else{
                        onBridgeReady();
                    }


                },
                error : function(){
                    // alert('请求失败，请稍后执行！');
                    layer.closeAll();
                    layer.open({
                        content: '支付请求失败，请稍后执行！'
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                },
                complete: function () {
                    // $(".download").hide();
                    $(".mm_box li").removeClass("mmdd");
                    $(".mm_box li").attr("data","");
                    i = 0;
                    $(".ftc_wzsf").hide();

                }


            })
        }

    })()

</script>