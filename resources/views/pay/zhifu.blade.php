<!DOCTYPE html>
<html lang="en" style="width: 100%; height: 100%;">
<head>
    <meta charset="UTF-8">
    <title>支付</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
<body style="width: 100%; height: 100%; background: #f7f6f6;">
<div class="main">
    <!-- <div
        style="width: 100%; height: 0.8rem; line-height: 0.8rem; padding-left: 0.3rem; color: #0d57a0; font-size: 0.32rem; position: relative;">请选择支付方式</div>

    <div
  style="width: 100%; height: 2rem; background: white; display: -webkit-flex; -webkit-align-items: center;"
  onclick="yuers()">
  <img src="image/weixuanzhong@2x.png" alt=""
    style="width: 0.32rem; height: 0.32rem; margin-left: 0.3rem;"
    class="yuer"><img src="image/weixin@2x.png" alt=""
    style="width: 0.76rem; height: 0.78rem; margin-left: 0.4rem;">
  <div style="margin-left: 0.6rem">
    <p style="font-size: 0.36rem; color: #585858;">微信支付</p>
    <p style="font-size: 0.28rem; color: #cacaca;">
      微信支付 -->
<!--<span style="color: #fc992c;font-size: 0.28rem;">{{ $personInfo['Data']['Items']['0']['Overageprice']}}元</span>-->
    <!-- </p>
  </div>
  <img src="image/zhankai@3x.png" alt=""
    style="width: 0.26rem; height: 0.46rem; position: absolute; right: 0.5rem;">
</div> -->


    <!--   <div
        style="width: 95%; margin: 0 auto; border: none; border-bottom: 1px solid #aeaeae;"></div>
          <div
              style="width: 100%; height: 2rem; background: white; display: -webkit-flex; -webkit-align-items: center; position: relative;"
              onclick="weixin()">
              <img src="image/weixuanzhong@2x.png" alt=""
                  style="width: 0.32rem; height: 0.32rem; margin-left: 0.3rem;"
                  class="weixin"><img src="image/weixin@2x.png" alt=""
                  style="width: 0.76rem; height: 0.78rem; margin-left: 0.4rem;">
              <div style="margin-left: 0.6rem">
                  <p style="font-size: 0.36rem; color: #585858;">微信支付</p>
                  <p style="font-size: 0.28rem; color: #cacaca;">支持银行卡和微信账号支付</p>
              </div>
              <img src="image/zhankai@3x.png" alt=""
                  style="width: 0.26rem; height: 0.46rem; position: absolute; right: 0.5rem;">
          </div> -->
    <!-- <div style="width: 100%; text-align: center;">
        <input type="submit" value="确定" class="chongzhi" disabled='true'
            data="0">
    </div> -->
</div>

</body>
</html>
<script>
    (function(){
        window.alert = function(name){
            var iframe = document.createElement("IFRAME");
            iframe.style.display="none";
            iframe.setAttribute("src", 'data:text/plain');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
        }
    })();
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
                    // alert("支付成功"+data);
                    // var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
                    var ordercode="{{$ordercode}}";
                    var paypwd=data;
                    var PayPrice="{{$PayPrice}}";
                    var time={{$time}};
                    var BargainOrder="{{$BargainOrder}}";


                    $.ajax({
                        url: 'pay_bupay',
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
                            // console.log(ops);
                            if(ops.Message=='success'){
                                if(ops.Data.code=='success'){
                                    layer.open({
                                        content: '缴费成功'
                                        ,skin: 'msg'
                                        ,time: 2 //2秒后自动关闭
                                    });
                                    setTimeout("window.location.href='user_index'",2000);

                                }else{
                                    layer.open({
                                        content: ops.Data.msg
                                        ,skin: 'msg'
                                        ,time: 2 //2秒后自动关闭
                                    });
                                }

                            }else{
                                layer.open({
                                    content: ops.Message
                                    ,skin: 'msg'
                                    ,time: 2 //2秒后自动关闭

                                });
                            }

                        },
                        error : function(){
                            // alert('请求失败，请稍后执行！');
                            layer.closeAll();
                            layer.open({
                                content: '请求失败，请稍后执行！'
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

        var VoucherID="{{$VoucherID}}";
        var CouponAmount="{{$CouponAmount}}";
        var CouponType="{{$CouponType}}";

        if(data==1){
            window.location.href="pay_lastpayyinliang?bargainordercode=" + bargainordercode + "&ordercode=" + ordercode + "&berthcode=" + berthcode  + "&PayPrice=" + PayPrice + "&time=" + time + "&paytype=4" + "&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;
            //$(".ftc_wzsf").show();
        }else if(data==2){




            $.ajax({
                url: 'pay_lastpayyinliang',
                data: {'ordercode':ordercode,'PayPrice':PayPrice,'bargainordercode':bargainordercode,'berthcode':berthcode,'CouponType':CouponType,'VoucherID':VoucherID,'CouponAmount':CouponAmount,'time':time,},
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
                    //alert(ops.Data.WxResponse.package);
                    //alert(ops.Data.WxResponse.paySign);

                    layer.closeAll();
                    //alert(ops.Data.WxResponse.appid);
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
                                    setTimeout("window.location.href='user_index'",1000);
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