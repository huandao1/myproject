<!DOCTYPE html>
<html lang="en" style="width: 100%; height: 100%;">
<head>
    <meta charset="UTF-8">
    <title>支付</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/zhifu.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>
    <style>
        .main {
            width: 100%;
            overflow: auto;
        }
        .chongzhi {
            width:100%
        }
    </style>

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
            style="width: 0.76rem; height: 0.78rem; margin-left: 0.4rem;flex-shrink:0;-webkit-flex-shrink:0;">
        <div style="margin-left: 0.6rem;width:100%">
            <p style="font-size: 0.36rem; color: #585858;">微信支付</p>
            <p style="font-size: 0.28rem; color: #cacaca;">
                微信支付
            </p>
        </div>
        <img src="image/zhankai@3x.png" alt=""
            style="width: 0.26rem; height: 0.46rem; flex-shrink:0;-webkit-flex-shrink:0;margin-right:15px">
    </div> -->

    <!-- <div
        style="width: 95%; margin: 0 auto; border: none; border-bottom: 1px solid #aeaeae;"></div>
    <div
        style="width: 100%; height: 2rem; background: white; display: -webkit-flex; -webkit-align-items: center; position: relative;"
        onclick="weixin()">
        <img src="image/weixuanzhong@2x.png" alt=""
            style="width: 0.32rem; height: 0.32rem; margin-left: 0.3rem;"
            class="weixin"><img src="image/weixin@2x.png" alt=""
            style="width: 0.76rem; height: 0.78rem; margin-left: 0.4rem;flex-shrink:0;-webkit-flex-shrink:0;">
        <div style="margin-left: 0.6rem;width:100%">
            <p style="font-size: 0.36rem; color: #585858;">微信支付</p>
            <p style="font-size: 0.28rem; color: #cacaca;">支持银行卡和微信账号支付</p>
        </div>
        <img src="image/zhankai@3x.png" alt=""
            style="width: 0.26rem; height: 0.46rem; flex-shrink:0;-webkit-flex-shrink:0;margin-right:15px">
    </div>-->
    <!-- <div style="width: 100%; text-align: center;padding: 0 0.5rem;">
        <input type="submit" value="确定" class="chongzhi" disabled='true' data="0">
    </div> -->
</div>
<!-- <div class="ftc_wzsf">
		<div class="srzfmm_box">
			<div class="qsrzfmm_bt clear_wl">
				<img src="image/xx_03.jpg" class="tx close fl"> <img
					src="image/yue@2x.png" class="tx fl"> <span class="fl">请输入支付密码</span>
			</div>
			<div class="zfmmxx_shop">
				<div class="mz">泊通停车</div>
				<div class="zhifu_price">￥<?php echo number_format($PayPrice,2);?></div>
			</div>
			<ul class="mm_box">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<div class="numb_box">
			<div class="xiaq_tb">
				<img src="image/jftc_14.jpg" height="10">
			</div>
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
		</div> -->
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

    var ordercode="{{$ordercode}}";
    var PayPrice="{{$PayPrice}}";

    var VoucherID="{{$VoucherID}}";
    var CouponAmount="{{$CouponAmount}}";
    var CouponType="{{$CouponType}}";

    (function(){
        var data=1

        var ordercode = "{{$ordercode}}";
        var PayPrice="{{$PayPrice}}";
        if(data==1){
            window.location.href="pay_noapplypayyinliang?ordercode=" + ordercode + "&PayPrice=" + PayPrice + "&paytype=4" + "&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;
            //$(".ftc_wzsf").show();
        }else if(data==2){
            window.location.href="pay_noapplypayyinliang?ordercode=" + ordercode + "&PayPrice=" + PayPrice + "&paytype=2" + "&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;
        }
    })()
</script>