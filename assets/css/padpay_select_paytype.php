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
<?php
 $time = time();
$peccpicecode= isset($_GET['peccpicecode']) ? $_GET['peccpicecode'] : '';
$arrearsPrice=isset($_GET['arrearsPrice']) ? $_GET['arrearsPrice'] : '';
$citycode=isset($_GET['citycode']) ? $_GET['citycode'] : '';
$carno=isset($_GET['carno']) ? $_GET['carno'] : '';
 $secure_key = SecretKey;
 $appid = AppId;
 $DeviceToken=DeviceToken;
 // $accessToken='YTqDptcimjfEezsjskC8U/Q8nAQOXrhg12I/ScRHIETjg4urdLo21kSt0nndGDyf';
 $array=array('AppId'=>$appid,'Nonce'=>$time,'UserOpenId'=>$_SESSION['openid'],'LoginType'=>1,'DeviceToken'=>$DeviceToken,);
 $signArr = array();
 foreach ($array as $k=>$v) {
    if (strlen($v) > 0) $signArr[$k] = $k . '=' . $v;
 }
 ksort($signArr);
 $array['Sign'] = base64_encode(hash_hmac('sha256', implode('&', $signArr), $secure_key, true));

 $data= json_encode($array);
 $url=URL.'/api/Users/Login';
 $resdata = json_decode(curl_request($url,$data),true);
 if($resdata['RetCode']==0){
   $_SESSION['AccessToken']=$resdata['Data']['AccessToken'];
    $sql="UPDATE potong set accesstoken='{$_SESSION['AccessToken']}',addtime='{$time}' where openid='{$_SESSION['openid']}'";
    $res=mysql_query($sql,$conn);
    // var_dump($data);
    // var_dump($resdata);die();
   echo "<script>window.location.href='dingdan_noapply.php?ordercode=".$peccpicecode."&carCode=".$carno."'</script>";
    die();

 }


if(empty($peccpicecode) || empty($arrearsPrice) || empty($citycode)){
	echo "<script>alert('参数错误');</script>"; exit;
}
?>
<!DOCTYPE html>
<html lang="en" style="width: 100%; height: 100%;">
<head>
<meta charset="UTF-8">
<title>支付</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
<link rel="stylesheet" href="css/public.css">
<link rel="stylesheet" href="css/zhifu.css">
<script src="layer/layer.js"></script>
<script src="hengping.js"></script>

<script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>
<body style="width: 100%; height: 100%; background: #f7f6f6;">
	<div class="main">
		<div
			style="width: 100%; height: 0.8rem; line-height: 0.8rem; padding-left: 0.3rem; color: #0d57a0; font-size: 0.32rem; position: relative;">请选择支付方式</div>
		<div
			style="width: 100%; height: 2rem; background: white; display: -webkit-flex; -webkit-align-items: center;"
			onclick="yuers()">
			<img src="image/weixuanzhong@2x.png" alt=""
				style="width: 0.32rem; height: 0.32rem; margin-left: 0.3rem;"
				class="yuer"><img src="image/yinliang@2x.png" alt=""
				style="width: 0.76rem; height: 0.78rem; margin-left: 0.4rem;">
			<div style="margin-left: 0.6rem">
				<p style="font-size: 0.36rem; color: #585858;">银联支付</p>
				<p style="font-size: 0.28rem; color: #cacaca;">
					银联支付
					<!--<span style="color: #fc992c;font-size: 0.28rem;"><?php echo $personInfo['Data']['Items']['0']['Overageprice']; ?>元</span>-->
				</p>
			</div>
			<img src="image/zhankai@3x.png" alt=""
				style="width: 0.26rem; height: 0.46rem; position: absolute; right: 0.5rem;">
		</div>
		<div
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
		</div>
		<div style="width: 100%; text-align: center;">
			<input type="submit" value="确定" class="chongzhi" disabled='true'
				data="0">
		</div>
	</div>
	<div class="ftc_wzsf">
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
		</div>
		<div class="hbbj"></div>
	</div>
</body>
</html>
<script src="js/jquery-3.1.1.js"></script>
<script>
    function yuers(){
      var data=$('.chongzhi').attr("data");
      // alert(data);
      if(parseInt(data)!=1){
          $('.yuer').attr("src","image/xuanzhong@2x.png");
          $('.weixin').attr("src","image/weixuanzhong@2x.png");

          $('.chongzhi').attr('data',"1");
          $('.chongzhi').attr('disabled',false);
          $('.chongzhi').css({'background':'#0d57a0'});

      }else{
          $('.yuer').attr("src","image/weixuanzhong@2x.png");
          $('.chongzhi').attr('data',"0");
          $('.chongzhi').attr('disabled',true);
          $('.chongzhi').css({'background':'#93cbf1'});


      }
    }
    function weixin(){
      var data=$('.chongzhi').attr("data");
      // alert(data);
      if(parseInt(data)!=2){
          $('.weixin').attr("src","image/xuanzhong@2x.png");
          $('.yuer').attr("src","image/weixuanzhong@2x.png");

          $('.chongzhi').attr('data',"2");
          $('.chongzhi').attr('disabled',false);
          $('.chongzhi').css({'background':'#0d57a0'});

      }else{
          $('.weixin').attr("src","image/weixuanzhong@2x.png");
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
                    var peccpicecode="<?php echo $peccpicecode; ?>";
                    var PayPrice="<?php echo $PayPrice; ?>";
					var BargainOrder="<?php echo $BargainOrder; ?>";
					

                     $.ajax({
                        url: 'bupay1.php', 
                        data: {'peccpicecode':peccpicecode,'paypwd':paypwd,'PayPrice':PayPrice,'time':time,'BargainOrder':BargainOrder},
                        method:'post',
                        dataType:'json',
                        // header: { 'Content-Type': 'application/x-www-form-urlencoded' },
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
                                    setTimeout("window.location.href='person.php'",2000);

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
        $('.chongzhi').click(function(){
             var data=$('.chongzhi').attr("data");
			 var peccpicecode = "<?php echo $peccpicecode; ?>";
					var arrearsPrice="<?php echo $arrearsPrice; ?>";
					var citycode="<?php echo $citycode; ?>";	
             if(data==1){
				window.location.href="padpay_pay.php?peccpicecode=" + peccpicecode + "&arrearsPrice=" + arrearsPrice + "&citycode=" + citycode  + "&trade_type=1";
                //$(".ftc_wzsf").show();
             }else if(data==2){
				window.location.href="padpay_pay.php?peccpicecode=" + peccpicecode + "&arrearsPrice=" + arrearsPrice + "&citycode=" + citycode  + "&trade_type=2";
             }

        })

</script>