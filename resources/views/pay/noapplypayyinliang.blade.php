<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微信支付</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
</head>
<body>

</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('assets/layer/layer.js')}}"></script>
<script>
    window.onload=function(){
        var ops={{$rspn}};
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

    }
</script>