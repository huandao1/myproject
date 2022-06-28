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
<div class="ftc_wzsf">
    <div class="srzfmm_box">
        <div class="qsrzfmm_bt clear_wl">
            <img src="{{URL::asset('assets/image/xx_03.jpg')}}" class="tx close fl">
            <img src="{{URL::asset('assets/image/yue@2x.png')}}" class="tx fl">
            <span class="fl">请输入支付密码</span></div>
        <div class="zfmmxx_shop">
            <div class="mz">泊通停车</div>
            <div class="zhifu_price">￥@php echo number_format($PayPrice,2);@endphp</div></div>
        <ul class="mm_box">
            <li></li><li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>
    <div class="numb_box">
        <div class="xiaq_tb">
            <img src="{{URL::asset('assets/image/jftc_14.jpg')}}" height="10"></div>
        <ul class="nub_ggg">
            <li><a href="javascript:void(0);" class="zf_num">1</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">2</a></li>
            <li><a href="javascript:void(0);" class="zf_num">3</a></li>
            <li><a href="javascript:void(0);" class="zf_num">4</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">5</a></li>
            <li><a href="javascript:void(0);" class="zf_num">6</a></li>
            <li><a href="javascript:void(0);" class="zf_num">7</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">8</a></li>
            <li><a href="javascript:void(0);" class="zf_num">9</a></li>
            <li><a href="javascript:void(0);" class="zf_empty">清空</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">0</a></li>
            <li><a href="javascript:void(0);" class="zf_del">删除</a></li>
        </ul>
    </div>
    <div class="hbbj"></div>
</div>
</body>
</html>
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
                            // console.log(ops);
                            if(ops.Message=='success'){
                                if(ops.Data.result.code=='success'){
                                    layer.open({
                                        content: '缴费成功'
                                        ,skin: 'msg'
                                        ,time: 2 //2秒后自动关闭
                                    });
                                    setTimeout("window.location.href='pay_jishi'",2000);

                                }else{
                                    layer.open({
                                        content: ops.Data.result.msg
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
        var data=2

        var bargainordercode = "{{$BargainOrder}}";
        var berthcode="{{$berthcode}}";
        var ordercode="{{$ordercode}}";
        var PayPrice="{{$PayPrice}}";
        var time="{{$time}}";

        var VPNMId="{{$VPNMId}}";
        var VoucherID="{{$VoucherID}}";
        var CouponAmount="{{$CouponAmount}}";
        var CouponType="{{$CouponType}}";

        window.location.href="renewapplypayyinliang.php?ordercode=" + ordercode + "&berthcode=" + berthcode  + "&PayPrice=" + PayPrice + "&time=" + time + "&trade_type=1&paytype=4" + "&VPNMId=" + VPNMId+  "&VoucherID=" + VoucherID +"&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;;
        //$(".ftc_wzsf").show();


    })()

</script>