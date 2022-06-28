<script src="{{URL::asset('assets/layer/layer.js')}}"></script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>路面停车</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/zhifu.css')}}">
    <script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style type="text/css">
        .notify .notify-bg {
            position: fixed;
            background-color:#d3dce1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9998;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
        }
        .notify .notify-bg .notify-container {
            background: #fff;
            position: relative;
            width: 88%;
            /*height: 65%;*/
            min-height: 68%;
            padding: 0 0 10PX;
            margin:5% auto;
            overflow-y: scroll;
            -webkit-overflow-scrolling: touch;
            /*transform: translate(-50%, -50%);*/
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .notify .notify-bg .notify-container .notify-content article p {
            margin: 0.1rem auto;
            line-height: 24px;
            max-height: 70%;
            overflow-y: scroll;
            text-indent: 22px;
            -webkit-overflow-scrolling : touch;
        }

        .notify .notify-bg .notify-container .notify-content h2 {
            text-align: center;
        }
        .notify .notify-ok {
            background: #0a9dff;
            color: #fff;
            font-size: 18px;
            border-radius: 3px;
            padding: 6px 14px;
            margin: 0 auto;
            display: block;
        }
        .notify .notify-bg .notify-container .notify-content article {
            padding:  10px 20px;
        }
    </style>
</head>

<body>
<div style="width: 100%;overflow: hidden;background: #f5f5f5;">
    <div class="body">
        <div style="position: absolute;top:30%;left:34%;display: none" class="download">
            <img src="{{URL::asset('assets/image/21.gif')}}" alt="" style="width:2.3rem;height:2.3rem">
        </div>
        <p class="powei">请输入泊位号</p>
        <form action="pay_lubpark" method="post" id="form1">
            @csrf
            <ul class="ulpw">
                <li class="lipw1" onclick="puts(this)"></li>
                <li class="lipw2" onclick="puts(this)"></li>
                <li class="lipw3" onclick="puts(this)"></li>
                <li class="lipw4" onclick="puts(this)"></li>
                <li class="lipw5" onclick="puts(this)"></li>
                <li class="lipw6" onclick="puts(this)"></li>
            </ul>

            <div class="light"><img src="{{URL::asset('assets/image/light1.png')}}" alt="" style="width: 0.3rem;height: 0.3rem"><span class="light_font">请输入地面上标记的6位泊位号</span></div>

            @if($arr_data['Data']['ApplicationType']==3)
            <div class="yufu3">
                <p class="powei1">付费方式</p>
                <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:space-between;-webkit-align-items:center;margin-top:0.2rem;">
                    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.32rem;color: #666666;margin-left: 0.6rem;" onclick="yuxuan()">
                        <img src="{{URL::asset('assets/image/houxuan.png')}}" alt="" style="width: 0.35rem;height: 0.35rem;margin-right: 0.1rem;">预付费</div>
                    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.32rem;color: #666666;margin-left:-1.2rem;color: #666666;" onclick="houxuan()">
                        <img src="{{URL::asset('assets/image/houwei.png')}}" alt="" style="width: 0.35rem;height: 0.35rem;margin-right: 0.1rem;">后付费</div>
                    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.24rem;color: #666666;margin-right: 0.4rem;color: #666666;" onclick="fangshi()" class="fufeia">付费方式说明<img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.36rem;height: 0.36rem;"></div></div>

                <p class="powei1">请选择停车时长</p>
                <div class="choose_time">
                    <div class="choose_time1">
                        <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia1">
                        <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia2">

                    </div>

                    <div class="choose_time2">
                        <div><span class="hour_time">00</span>小时</div><div><span class="minute_time">00</span>分钟</div>
                        <input type="hidden" name="times" class="times">
                    </div>

                    <div class="choose_time3">
                        <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian1">
                        <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian2">

                    </div>

                </div>
                <p class="powei1" id="leave_time"></p>
                <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.3rem;color: #666666;margin-right: 0.4rem;margin-top:0.15rem;line-height:30px;float: right" onclick="choosechepai()">选择车牌<img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;margin-left: 0.05rem"></div>
                <div style="margin-top:0.38rem;" class="choosechepai"><span style="margin-left: 0.6rem;font-size: 0.3rem;line-height:30px;color: #666666;">请选择当前停车车牌</span></div>


                <div style="display:inline-block;width:100%;margin-top:0.2rem;">
                    <div style="float:left;font-size:0.3rem;color: #0d57a0;margin-left: 0.6rem;margin-top:0.3rem;">停车优惠券</div>
                    <div style="float: right;font-size:0.24rem;color: #666666;margin-right: 0.4rem;color: #666666;margin-top:0.3rem;" onclick="show_coupon()"><span id="coupon_tips"></span><img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.36rem;height: 0.36rem;"></div></div>


                <p class="pay_monney">缴费金额</p>
                <p class="pay_monney1"><span style="color: #ff3334;font-weight: bold;font-size: 0.4rem;" class="jiaofei">￥0.00</span></p>
                <input type="hidden" name="pay_monney" value="0.00" class="pay_monney0">
                <div style="text-align:center;width: 100%;"><input type="button" value="立即支付" class="pay_monney2" style="background: #93cbf1;margin-top: 0.2rem;" disabled="true"></div>

            </div>
            <div class="houfu3" style="display: none;">
                <p class="powei1">付费方式</p>
                <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:space-between;-webkit-align-items:center;margin-top:0.2rem;"><div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.25rem;color: #666666;margin-left: 0.6rem;" onclick="yuxuan()"><img src="{{URL::asset('assets/image/houwei.png')}}" alt="" style="width: 0.35rem;height: 0.35rem;margin-right: 0.1rem;">预付费</div><div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.25rem;color: #666666;margin-left:-1.2rem;color: #666666;" onclick="houxuan()"><img src="{{URL::asset('assets/image/houxuan.png')}}" alt="" style="width: 0.35rem;height: 0.35rem;margin-right: 0.1rem;">后付费</div><div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.24rem;color: #666666;margin-right: 0.4rem;color: #666666;" onclick="fangshi()" class="fufeia">付费方式说明<img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.36rem;height: 0.36rem;"></div></div>

                <div style="width:6.5rem;margin-left:0.5rem;margin-top:0.5rem;height: 3.6rem;display:-webkit-flex;-webkit-flex-direction:column;-webkit-align-items:center;-webkit-justify-content:center;border: 1px solid #e4e4e4;background: white;" class="weishu"><img src="{{URL::asset('assets/image/boweixinxi@2x.png')}}" alt="" style="width: 1.8rem;height: 1.8rem"><span style="font-size:0.25rem;color:#afaeae;margin-top:0.3rem; ">输入泊位号即可显示泊位信息</span></div>

                <div style="width:6.5rem;margin-left:0.5rem;margin-top:0.5rem;height: 3.6rem;border: 1px solid #e4e4e4;background: white;display: none;" class="yishu">

                    <img src="{{URL::asset('assets/image/charge_rule.png')}}" width="100%" height="100%" alt="" border="0">
                </div>
                <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.3rem;color: #666666;margin-right: 0.6rem;margin-top:0.3rem;line-height:30px;float: right" onclick="choosechepai()">选择车牌<img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;margin-left: 0.05rem"></div>
                <div style="margin-top:0.3rem;" class="choosechepai"><span style="margin-left: 0.6rem;font-size: 0.3rem;line-height:30px;color: #666666;">请选择当前停车车牌</span></div>

                <div style="text-align:center;width: 100%;"><input type="button" value="确定" class="pay_monney3" style="background: #93cbf1;" disabled="disabled" ></div>
            </div>
            @elseif($arr_data['Data']['ApplicationType']==2 || $arr_data['Data']['ApplicationType']==0)
            <p class="powei1">请选择停车时长</p>
            <div class="choose_time">
                <div class="choose_time1">
                    <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia1">
                    <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia2">

                </div>

                <div class="choose_time2">
                    <div><span class="hour_time">00</span>小时</div><div><span class="minute_time">00</span>分钟</div>
                    <input type="hidden" name="times" class="times">
                </div>

                <div class="choose_time3">
                    <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian1">
                    <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian2">

                </div>

            </div>
            <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.3rem;color: #666666;margin-left: 0.6rem;margin-top:0.15rem;" onclick="choosechepai()">选择车牌<img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;margin-left: 0.05rem"></div>
            <div style="margin-top:0.08rem;" class="choosechepai"><span style="margin-left: 0.6rem;font-size: 0.3rem;line-height:30px;color: #666666;">请选择当前停车车牌</span></div>
            <p class="pay_monney">缴费金额</p>
            <p class="pay_monney1"><span style="color: #ff3334;font-weight: bold;font-size: 0.4rem;" class="jiaofei">￥0.00</span></p>
            <input type="hidden" name="pay_monney" value="0.00" class="pay_monney0">
            <div style="text-align:center;width: 100%;"><input type="button" value="立即支付" class="pay_monney2" style="background: #93cbf1;margin-top: 0.2rem;" disabled="true"></div>

            @elseif($arr_data['Data']['ApplicationType']==1)
            <div style="width:6.5rem;margin-left:0.5rem;margin-top:0.5rem;height: 3.6rem;display:-webkit-flex;-webkit-flex-direction:column;-webkit-align-items:center;-webkit-justify-content:center;border: 1px solid #e4e4e4;background: white;" class="weishu"><img src="{{URL::asset('assets/image/boweixinxi@2x.png')}}" alt="" style="width: 1.8rem;height: 1.8rem"><span style="font-size:0.32rem;color:#afaeae;margin-top:0.3rem; ">输入泊位号即可显示泊位信息</span></div>

            <div style="width:6.5rem;margin-left:0.5rem;margin-top:0.5rem;height: 3.6rem;border: 1px solid #e4e4e4;background: white;display: none;" class="yishu">

                <img src="{{URL::asset('assets/image/charge_rule.png')}}" width="100%" height="100%" alt="" border="0">
            </div>
            <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.36rem;color: #666666;margin-left: 0.6rem;margin-top:0.15rem;" onclick="choosechepai()">选择车牌<img src="{{URL::asset('assets/image/chexuan.png')}}" alt="" style="width: 0.45rem;height: 0.45rem;margin-left: 0.05rem"></div>
            <div style="margin-top:0.08rem;" class="choosechepai"><span style="margin-left: 0.6rem;font-size: 0.3rem;line-height:30px;color: #666666;">请选择当前停车车牌</span></div>

            <div style="text-align:center;width: 100%;"><input type="button" value="立即支付" class="pay_monney3" style="background: #93cbf1;margin-top: 0.2rem;" disabled="disabled" ></div>
            @endif
        </form>
        <!--<div class="detail_phone1">
                <p style="font-size: 0.24rem;font-style: '宋体';">服务提供：深圳市凯达富智慧交通科技有限公司</p>
                <p style="font-size: 0.24rem">客服电话:0755-86700413</p>

            </div>-->
    </div>
    <div class="ftc_wzsf">
        <div class="srzfmm_box">
            <div class="qsrzfmm_bt clear_wl">
                <img src="{{URL::asset('assets/image/xx_03.jpg')}}" class="tx close fl">
                <img src="{{URL::asset('assets/image/yue@2x.png')}}" class="tx fl">
                <span class="fl">请输入支付密码</span></div>
            <div class="zfmmxx_shop">
                <div class="mz">泊通停车</div>
                <div class="zhifu_price">￥0.0</div></div>
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
    <div class="layer-content">
        <div class="form_edit clearfix1">
            <div class="num" onclick="gets(this)">1</div>
            <div class="num" onclick="gets(this)">2</div>
            <div class="num" onclick="gets(this)">3</div>
            <div class="num" onclick="gets(this)">4</div>
            <div class="num" onclick="gets(this)">5</div>
            <div class="num" onclick="gets(this)">6</div>
            <div class="num" onclick="gets(this)">7</div>
            <div class="num" onclick="gets(this)">8</div>
            <div class="num" onclick="gets(this)">9</div>
            <div class="num" id="wrap">完成</div>
            <div class="num" onclick="gets(this)">0</div>
            <div id="remove">删除</div>
        </div>
    </div>

    <div  style="display: none;background-color: #f5f5f5;width:100%;height:100%;position: fixed;z-index:9999999;top: 0; bottom:0; overflow-y:scroll; overflow-x:hidden;" id="coupons">
        <input type="hidden" name="selected_coupon_id" id="selected_coupon_id" value="0">
        <input type="hidden" name="last_coupon_price" id="last_coupon_price" value="0">
        <input type="hidden" name="selected_coupon_type" id="selected_coupon_type" value="0">
        <input type="hidden" name="hasmj" id="hasmj" value="0">


        <div class="coupon_true" style="margin-bottom: 60px" id="couponbox">

        </div>
        <button class="coupon_button" style="position: fixed;bottom: 1px; z-index:9999" onclick="select_coupon()">确 定</button>
    </div>


</div>

<div class="notify" style="display:none">
    <div class="notify-bg">
        <div class="notify-container">
            <div class="notify-content">
                <article>

                    <h2>收费标准和时段划分</h2>
                    <p>（一）白天 3 元/小时/辆；晚上 3 元/小时/辆.</p>
                    <p>（二）最高限价 8 元；24 小时最高限价 30 元/辆；月保：200 元/辆.</p>
                    <p>（三）一类路段（商业繁华路段）时段为：白天（8:00 时—22:00 时），晚上（22:00 时—次日 8:00 时）.</p>
                    <p>（四）二类路段（非商业繁华 路段）时段为：白天（8:00 时—19:00 时），晚上（19:00 时— 次日 8:00 时）。地段划分由容桂街道办确定.</p>
                    <p>停放不超过 30 分钟的车辆及军警车辆、执法车辆、 市政工程抢修车辆、实施救助的医院救护车辆免费.</p>
                    <p>停放时间 超过免费时段的，按实际停放时间计收，不足 1 小时的按 1 小 时计收.</p>


                </article>

            </div>
            <button class="notify-ok" onclick="closeNotify()">确定停车</button>
        </div>

    </div>
</div>

</body>
</html>
<script>
    $(document).ready(function() {
        //填写信息
        $('.infor-sub').click(function(e){
            $('.layer').hide();
            $('.form').hide();
            e.preventDefault();     //阻止表单提交
        })
        // 监听#div内容变化，改变支付按钮的颜色
        $('#div').bind('DOMNodeInserted', function(){
            if($("#div").text()!="" || $("#div").text()>'0'){
                $('.submit').removeClass('active');
                $('.submit').attr('disabled', false);
            }else{
                $('.submit').addClass('active');
                $('.submit').attr('disabled', true);
            }
        })
        $('#div').trigger('DOMNodeInserted');

        $('.ulpw li').on('click',function(e){
            $('.layer-content').css({'display':'block'});


            e.stopPropagation();
        })

        $('#wrap').click(function(){
            $('.layer-content').css({'display':'none'});

        })


        $('#remove').click(function(){
            $(".lipw7").html('');
            if($(".lipw7").prev().length>0){
                $(".lipw7").prev().html('');

                $('.lipw7').removeClass('lipw7').prev().addClass('lipw7');
                //alert(1);

            }
            //alert(1);
        })

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
                        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
                        var paypwd=data;
                        var PayPrice=$('.pay_monney0').val();
                        var times=$('.times').val();
                        var zuichepai=$('.zuichepai').html();
                        // alert(zuichepai);
                        if(typeof zuichepai!='undefined'){
                            var CarNo=zuichepai;
                        }else{
                            var CarNo='';

                        }

                        $.ajax({
                            url: 'pay_lubpark01',
                            data: {'berthcode':berthcode,'paypwd':paypwd,'PayPrice':PayPrice,'times':times,'CarNo':CarNo},
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
                                        setTimeout("window.location.href='pay_jishi?id=1'",2000);

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
        choosechepai1();
    });

    function check_berth(){
        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();

        $.ajax({
            url: 'pay_chargetime1',
            data: {'berthcode':berthcode},
            method:'post',
            dataType:'text',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                // $('.light_font').html(ops);
                $('.jiaofei').html("￥"+'0.00');
                initial_coupon_setting();
                $('.hour_time,.minute_time').html('00');
            }
        })



        $.ajax({
            url: 'pay_berthstatus',
            data: {'berthcode':berthcode},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (ops) {

                if(ops.Data.status!=1){
                    layer.open({
                        content: ops.Data.msg||ops.Message
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });


                }else if(ops.Data.status==1){
                    $('.yishu').css({"display":'block'});
                    var src="{{URL::asset('assets/image/charge_rule')}}"+ops.Data.data.pricingStrategyId+".png";
                    $(".yishu").find("img").attr("src",src);
                    $('.weishu').css({'display':'none'});
                    $('.star_time').html(ops.Data.data.dayStartTime);
                    $('.end_time').html(ops.Data.data.dayEndTime);
                    $('.mian_time').html("0元");
                    $('.first_price').html(ops.Data.data.firstRatePrice+"元");
                    $('.second_price').html(ops.Data.data.secondRatePrice+"元/"+ops.Data.data.secondRateUnit+'分');

                    $('.time1').html(ops.Data.data.freeDuration+"分钟");
                    $('.time2').html(ops.Data.data.fisrtRateUnit+"分钟");
                    $('.pay_monney3').css({'background':'#0d57a0'});
                    $('.pay_monney3').attr('disabled',false);

                    var name=ops.Data.data.sectionName+"("+ops.Data.data.pricingStrategyName+")";
                    $('.light_font').html(name);




                }

            },
            error: function(){
                layer.closeAll();
                layer.open({
                    content: "请求失败，请稍后执行！"
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                //alert("请求失败，请稍后执行！");
            }


        })



    }

    $('.jia1').click(function(){
        $('.jian1').attr('src','image/jian.jpg');
        $('.jian2').attr('src','image/jian.jpg');

        var hour_time = $('.hour_time').html();
        if(parseInt(hour_time)>=9){
            $('.hour_time').html(parseInt(hour_time)+1);
        }else{
            $('.hour_time').html('0'+(parseInt(hour_time)+1));
        }
        getparkprice();
        // getcoupons();

    })
    $('.jian1').click(function(){
        var hour_time = $('.hour_time').html();
        var minute_time = $('.minute_time').html();
        var firstMinTime=60;
        var total1=parseInt(hour_time)*60+parseInt(minute_time);
        if(total1-60<firstMinTime){
            $('.hour_time').html('00');
            $('.minute_time').html('00');
            $('.jian1').attr('src','image/jian1.jpg');
            $('.jian2').attr('src','image/jian1.jpg');
            getparkprice();

            return;

        }
        if(parseInt(hour_time)>10){
            $('.hour_time').html(parseInt(hour_time)-1);
        }else if(parseInt(hour_time)>0){
            if(parseInt(hour_time)==1){
                $('.hour_time').html('0'+(parseInt(hour_time)-1));
                $('.jian1').attr('src','image/jian1.jpg');
                if(parseInt(minute_time)==0){
                    $('.jian2').attr('src','image/jian1.jpg');

                }
            }else{
                $('.hour_time').html('0'+(parseInt(hour_time)-1));

            }

        }else{
            alert("hour_time:" + hour_time + "||minute_time:" + minute_time);
            if(parseInt(hour_time)<=0 && parseInt(minute_time))
                $('.jiaofei').html("￥"+'0.00');
            return false;
        }
        getparkprice();

    })
    $('.jia2').click(function(){
        var minUnit=30;
        var firstMinTime=60;

        $('.jian2').attr('src','image/jian.jpg');
        var hour_time = $('.hour_time').html();
        var minute_time = $('.minute_time').html();
        var total1=parseInt(hour_time)*60+parseInt(minute_time);
        if(total1==0){
            var hour=parseInt(firstMinTime/60);
            var minut=firstMinTime%60;
            if(hour<=9){
                $(".hour_time").html("0"+hour);
            }else{
                $(".hour_time").html(hour);

            }
            if(minut<=9){
                $(".minute_time").html("0"+minut);

            }else{
                $(".minute_time").html(minut);

            }
            $('.jian1').attr('src','image/jian.jpg');
            $('.jian2').attr('src','image/jian.jpg');

            getparkprice();

            return;

        }
        var minute_time1=parseInt(minute_time)+minUnit;
        if(minute_time1>=60){
            if(parseInt(hour_time)>=9){
                $('.hour_time').html(parseInt(hour_time)+1);
            }else{
                $('.hour_time').html('0'+(parseInt(hour_time)+1));
            }

            $('.minute_time').html((minute_time1-60)<10?'0'+(minute_time1-60):(minute_time1-60));

        }else{
            $('.minute_time').html((parseInt(minute_time)+minUnit)<10?'0'+(parseInt(minute_time)+minUnit):(parseInt(minute_time)+minUnit));


        }
        getparkprice();

    })
    $('.jian2').click(function(){
        var minUnit=30;
        var firstMinTime=60;

        var minute_time = $('.minute_time').html();
        var hour_time = $('.hour_time').html();
        var minute_time1=parseInt(minute_time)-minUnit;
        var total1=parseInt(hour_time)*60+parseInt(minute_time);
        if(total1==firstMinTime){
            $('.minute_time').html('00');
            $('.hour_time').html('00');
            $('.jian1').attr('src','image/jian1.jpg');

            $('.jian2').attr('src','image/jian1.jpg');
            getparkprice();

            return;


        }
        if(minute_time1<0){


            if(parseInt(hour_time)>10){
                $('.hour_time').html(parseInt(hour_time)-1);
                $('.minute_time').html((60+minute_time1)<10?'0'+(60+minute_time1):(60+minute_time1));
            }else if(parseInt(hour_time)>0){
                $('.hour_time').html('0'+(parseInt(hour_time)-1));
                // $('.minute_time').html(60+minute_time1);
                $('.minute_time').html((60+minute_time1)<10?'0'+(60+minute_time1):(60+minute_time1));

                if(parseInt(hour_time)==1){
                    $('.jian1').attr('src','image/jian1.jpg');
                    if(60+minute_time1==0){
                        $('.jian2').attr('src','image/jian1.jpg');

                    }
                }

            }else{
                return false;
            }

        }else if(minute_time1==0){
            $('.minute_time').html('00');
            if(parseInt(hour_time)>=10){
                $('.hour_time').html(parseInt(hour_time));
                // $('.minute_time').html(60+minute_time1);
            }else if(parseInt(hour_time)>0){
                $('.hour_time').html('0'+(parseInt(hour_time)));
                // $('.minute_time').html(60+minute_time1);


            }else if(parseInt(hour_time)==0){
                $('.jian1').attr('src','image/jian1.jpg');

                $('.jian2').attr('src','image/jian1.jpg');


            }else{
                return false;

            }

        }else{
            $('.minute_time').html((minute_time1)<10?'0'+(minute_time1):(minute_time1));

        }
        getparkprice();
    })
    function getcoupons(pr){
        $.ajax({
            url: 'pay_couponget',
            data: {'action':'ajaxget','carno':pr,"pay_type":1,"price":$('.pay_monney0').val()},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (ops) {
                if (ops) {
                    var str="<p class=\"use-attention\">每次只能使用一张优惠券</p>";
                    console.log(ops.length);
                    $("#coupon_tips").html(ops.length+"张可用");
                    $(ops).each(function(is,lim){
                        // console.log(is);
                        $(lim).each(function(js,item){
                            if (typeof item['VoucherId'] !='undefined') {
                                str+="<div class =\"opt\">";
                                str+="<div class=\"squaredThree\">";
                                if (item['Amount']=="")
                                    str+="<input type=\"radio\" name=\"coupon_id\" id=\"radio"+item['VPNMId']+"\" value=\""+item['VPNMId']+"-" + item['VPMoney'] + "-" + item['VoucherType']+"\" class=\"check\">";
                                else
                                    str+="<input type=\"radio\" name=\"coupon_id\" id=\"radio"+item['VoucherId']+"\" value=\""+item['VoucherId']+"-" + item['Amount'] + "-" + item['VoucherType']+"\" class=\"check\">";
                                str+="<label for=\"myCheck\"></label>";
                                str+="</div>";
                                if (item['Amount']=="0")
                                    str+="<div class=\"coupon_img"+item['AppeType']+"\" onclick=\"change_coupon_select_status("+item['VPNMId']+")\">";
                                else
                                    str+="<div class=\"coupon_img"+item['AppeType']+"\" onclick=\"change_coupon_select_status("+item['VoucherId']+")\">";
                                str+="<p class=\"coupon_top\"><span class=\"coupon_size\" >· </span>";
                                console.log(item['VPMoney']);
                                if(item['AppeType']==1)str+="广发银行CGB";else if(item['AppeType']==0&&item['Amount']=="0")str+= "满减券"; else str+= "优惠券";
                                str+="</p>";
                                str+="<p class=\"coupon_left\" style=\"font-size:0.22rem\">使用期限："+item['EffTime']+"-"+item['FailureTime']+"</p>";
                                str+="<p class=\"coupon_right\"><span>";
                                if(item['VoucherType']==1)  str+= "小时"; else str+= "￥";
                                if(item['Amount']=="")
                                    str+="</span>"+ item['VPMoney']+"</p>";
                                else
                                    str+="</span>"+ item['Amount']+"</p>";
                                if(item['Amount']=="0")str+= "<p class=\"coupon_money\">满"+ item['FSMoney']+"元可用</p>";
                                str+="</div></div>";

                            }
                        })
                    })
                    $("#couponbox").html(str)
                }
            }
        })
    }
    function getparkprice(){


        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
        var hour_time = $('.hour_time').html();
        var minute_time=$('.minute_time').html();
        sessionStorage.setItem('hour_time',hour_time);
        sessionStorage.setItem('minute_time',minute_time);
        var total_time=parseInt(hour_time)*60+parseInt(minute_time);
        // 总时间缓存
        localStorage.total_time=total_time;
        $('.times').val(total_time);
        $.ajax({
            url: 'pay_getparkprice',
            data: {'berthcode':berthcode,'parktimes':total_time},
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
                layer.closeAll();

                // console.log(ops);
                //if(ops.Data.data.price){
                if(ops.Data.status==1){
                    $('.pay_monney2').css({'background':'#0d57a0'});
                    $('.pay_monney2').attr('disabled',false);
                    $('.jiaofei').html("￥"+ops.Data.data.price);
                    $('.pay_monney0').val(ops.Data.data.price);
                    var leave_time_tips = cal_leave_time(parseInt(hour_time), parseInt(minute_time));
                    $('#leave_time').html(leave_time_tips);
                    getcoupons($('.zuichepai').html());
                    initial_coupon_setting();
                }else{
                    $('.pay_monney2').css({'background':'#93cbf1'});
                    $('.pay_monney2').attr('disabled',true);
                    $('.jiaofei').html("￥"+'0.00');
                    $('.pay_monney0').val(0);
                    var leave_time_tips = cal_leave_time(parseInt(hour_time), parseInt(minute_time));
                    $('#leave_time').html(leave_time_tips);
                    initial_coupon_setting();
                }
            }
        })

    }
    function timestampToTime(timestamp) {
        var date = new Date(timestamp);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        var Y = date.getFullYear() + '-';
        var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        var D = date.getDate() + ' ';
        var h;
        if (date.getHours()<10) {h="0"+date.getHours() + ':';}
        else {h = date.getHours() + ':';}
        var m;
        if (date.getMinutes()<10) {m="0"+date.getMinutes();}
        else {m = date.getMinutes() ;}
        var s = date.getSeconds();
        return Y+M+D+h+m;
    }
    function cal_leave_time(hour_add, min_add){
        var timestamp = Date.parse(new Date());
        var now = new Date();
        var timeadd=hour_add*3600+min_add*60;

        var leave_tips = "预计离开时间：" + timestampToTime(timestamp+timeadd*1000);

        return leave_tips;
    }
    function park_park(){
        window.location.href="pay_roompark";
    }
    function road_park(){
        window.location.href="pay_lubpark?love";
    }

    function border_change0(obj){
        $(obj).css({'border': '1px solid #e3e3e3',
            'borderRadius': '0.03rem',
            'borderLeft': 'none',
            'borderRight': '1px dashed #e3e3e3'});
    }
    function border_change1(obj){

        $(obj).css({'border': '1px solid #e3e3e3',

            'borderRadius': '0.03rem',
            'borderRight': '1px dashed #e3e3e3'});
    }
    function border_change2(obj){

        $(obj).css({'border': '1px solid #e3e3e3',

            'borderRadius': '0.03rem',
            'borderLeft': 'none'});
    }
    function siqu(obj){
        $(obj).blur();
    }
    $('.pay_monney2').click(function(){

        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
        var submit_flag = 'yes';
        $.ajax({
            url: 'pay_berthstatus',
            data: {'berthcode':berthcode},
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            method:'post',
            dataType:'json',
            async: false,
            success: function (ops) {
                if(ops.Data.status!=1){
                    layer.open({
                        content: ops.Data.msg||ops.Message
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                    submit_flag = 'no';
                    return false;
                }

            },
            error: function(){
                layer.closeAll();
                layer.open({
                    content: "请求失败，请稍后执行！"
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                submit_flag = 'no';
                return false;
            }
        });
        if(submit_flag=='no')
            return false;

        var times=$('.times').val();
        if(times<=0){
            alert('请选择停车时长!');
            return false;
        }
        /*if($('.pay_monney0').val()=='0.00'){
            alert('请选择停车时长!');
            return false;
        }*/
        var zuichepai=$('.zuichepai').html();
        if(typeof zuichepai!='undefined'){
            var CarNo=zuichepai;
        }else{
            var CarNo='';
        }

        if(CarNo==''){
            //alert('请选择车牌');
            layer.closeAll();
            layer.open({
                content: "请选择车牌！"
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            return false;
        }

        var PayPrice=$('.pay_monney0').val();


        if(typeof zuichepai!='undefined'){
            var CarNo=zuichepai;
        }else{
            var CarNo='';
        }

        var VoucherID;var VPNMId;
        if ($('#hasmj').val()==0)
        { VoucherID=$('#selected_coupon_id').val();
            VPNMId=0;
        }
        else{
            VoucherID=0;
            VPNMId=$('#hasmj').val();
        }


        console.log(VPNMId);
        var CouponAmount = $('#last_coupon_price').val();
        var CouponType = $('#selected_coupon_type').val();
        var hf="pay_parkapply?berthcode=" + berthcode  + "&PayPrice=" + PayPrice + "&time=" + times + "&trade_type=1&PlateNumber=" + CarNo + "&VPNMId=" + VPNMId+ "&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType;
        window.location.href=hf;
        console.log(hf);

        $('.zhifu_price').html($('.jiaofei').html());

        //$(".ftc_wzsf").show();



    })
    function closes(){
        $('.body').css({'opacity':1,'background':'#ffffff'});
        $('.zhifumima').css({'display':'none'});
        // alert('1');
    }
    $('.pay_monney22').click(function(){

        var mn1=$('#mn1').val();
        var mn2=$('#mn2').val();
        var mn3=$('#mn3').val();
        var mn4=$('#mn4').val();
        var mn5=$('#mn5').val();
        var mn6=$('#mn6').val();
        var paypwd = mn1+mn2+mn3+mn4+mn5+mn6;
        if(paypwd.length<6){
            alert('密码错误!');
            return false;
        }else{
            $('form').submit();
        }

    })
    function puts(obj){
        $(obj).addClass('lipw7');
        $(obj).siblings().removeClass('lipw7');
        //$(obj).siblings().attr('id','');
        //$(obj).attr('id','puting');
    }
    function gets(obj){
        $('.lipw7').html($(obj).html());

        if($('.lipw7').next().length>0){
            $('.lipw7').removeClass('lipw7').next().addClass('lipw7');
            //$('.lipw7')[0].removeClass('lipw7');

            //alert(1);
            // alert($('#puting').html());
            //$('#puting').removeClass('lipw7').end().next().addClass('lipw7');

            //$('#puting').next().attr('id','puting').end().attr('id','');

        }
        var berthcode=$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
        if(berthcode.length==6){
            $('.layer-content').css({'display':'none'});
            sessionStorage.setItem('berthcode',berthcode);
            // alert(berthcode);
            check_berth();


        }
    }
    function choosechepai(){
        $.ajax({
            url: 'choosechepai',
            data: {},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                var str="<img src='{{URL::asset('assets/image/xx_03.png')}}' alt='' style='width:0.8rem;height:0.8rem;margin-left:6.7rem;' onclick='showclose()'/>";
                str+="<div style='width:100%;text-align:center;margin-top:-0.6rem;font-size:0.36rem;color:#666666;'>选择车牌</div>";
                if(ops.Message=='success'){
                    for(var i=0;i<ops.Data.Items.length;i++){
                        if(i==0){
                            str+="<div style='height:1.75rem;width:100%;margin-top:0.3rem;overflow-x:hidden;overflow-y:scroll;'><div style='width:100%;text-align:center;font-size:0.3rem;color:#666666;' onclick='chooseit(this)'>"+ops.Data.Items[i]["CarNo"]+"</div>";

                        }else{
                            str+="<div style='width:100%;text-align:center;margin-top:0.15rem;font-size:0.3rem;color:#666666;' onclick='chooseit(this)'>"+ops.Data.Items[i]["CarNo"]+"</div>";
                        }

                    }
                }
                str+='</div><div style="width:100%;text-align:center;" onclick="addchepai()"><input type="button" value="添加新车牌" style="width:5rem;height: 0.8rem;background: #0d57a0;border-radius: 0.14rem;border: none;margin-top: 0.5rem;color: #ffffff;"></div>';
                layer.open({
                    type: 1
                    ,content: str
                    ,anim: 'up'
                    ,style: 'position:fixed; bottom:0; left:0; width: 100%; height: 200px; padding:10px 0; border:none;'
                });



                getcoupons()

            },error : function(){
                // alert('请求失败，请稍后执行！');
                layer.closeAll();
                layer.open({
                    content: '请求失败，请稍后执行！'
                    ,skin: 'msg'
                    ,time: 2 //2秒后自动关闭
                });
                //alert('请求失败，请稍后执行！');
            }


        })
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

    function show_coupon(){
        document.getElementById('coupons').style.display='block';
        return true;
    }

    //选择使用优惠券
    function select_coupon(){
        document.getElementById('coupons').style.display='none';
        var coupon_value = $("input[name='coupon_id']:checked").val();
        console.log(coupon_value);
        //未选择任何优惠券
        if(coupon_value==undefined){
            var last_coupon_price = $("#last_coupon_price").val();
            //之前有选择优惠券
            if(last_coupon_price>0){



                var need_pay_price = $('.pay_monney0').val();

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


                var need_pay_price = $('.pay_monney0').val();
                var last_coupon_price = $("#last_coupon_price").val();

                var new_price = parseFloat(Number(need_pay_price) - Number(coupon_arr[1])).toFixed(2);

                if(new_price<0)
                    new_price = 0;

                $("#last_coupon_price").val(coupon_arr[1]);
                $('.jiaofei').html("￥" + new_price);
            }
        }
        return false;
    }

    //初始化优惠价格设置
    function initial_coupon_setting(){
        var need_pay_price = $('.pay_monney0').val();
        var last_coupon_price = $("#last_coupon_price").val();

        var new_price = parseFloat(Number(need_pay_price) - Number(last_coupon_price)).toFixed(2);

        if(new_price<0)
            new_price = 0;
        $('.jiaofei').html("￥" + new_price);
    }

    function addchepai(){
        var berthcode=$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
        if(berthcode.length==6){
            var berthcode_ok = berthcode;
        }else{
            var berthcode_ok = '';
        }
        window.location.href='chepai?source=pay_lubpark&berthcode=' + berthcode_ok;
    }
    function chooseit(obj){
        var chepai=$(obj).html();
        var str="<div style='display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;margin-left: 0.6rem;'><div style='width:2.1rem;height:0.72rem;font-size:0.3rem;color:#fff;line-height:0.72rem;text-align:center;z-index:2;' class='zuichepai'>"+chepai+"</div><img src='{{URL::asset('assets/image/chepaikuang.png')}}' alt='' style='width:2.1rem;height:0.72rem;margin-left:-2.1rem;z-index:1;' onclick='return false;'/></div>";
        layer.closeAll();

        $('.choosechepai').html(str);
        getcoupons(chepai);
    }
    function showclose(){
        layer.closeAll();

    }

    $('.pay_monney3').click(function(){
        var zuichepai=$('.zuichepai').html();
        if(typeof zuichepai!='undefined'){
            var CarNo=zuichepai;
        }else{
            var CarNo='';
        }

        if(CarNo==''){
            layer.closeAll();
            layer.open({
                content: "请选择车牌！"
                ,skin: 'msg'
                ,time: 2 //2秒后自动关闭
            });
            //alert("请选择车牌！");
            return false;
        }

        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();

        // alert(zuichepai);

        // alert(CarNo);
        $.ajax({
            url: 'pay_apply_hou',
            data: {'berthcode':berthcode,'CarNo':CarNo},
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            method:'post',
            dataType:'json',
            // header: { 'Content-Type': 'application/x-www-form-urlencoded' },
            beforeSend: function () {
                layer.open({
                    type: 2
                });
            },
            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                layer.closeAll();
                if(ops.Message=='success'){

                    window.location.href='pay_success_tips?type=after';


                }else{
                    layer.open({
                        content: ops.Message
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
                //alert("请求失败，请稍后执行！");
            }


        })

    })
    function yuxuan(){
        // $('.ulpw').attr('id','yu');
        // $('#yujianpan,#houjianpan').css({'display':'none'});
        sessionStorage.setItem('paytype',1);
        $('.yufu3').css({'display':'block'});
        $('.houfu3').css({'display':'none'});

    }
    function houxuan(){
        // $('.ulpw').attr('id','hou');
        // $('#yujianpan,#houjianpan').css({'display':'none'});
        sessionStorage.setItem('paytype',2);
        $('.yufu3').css({'display':'none'});
        $('.houfu3').css({'display':'block'});
    }
    function fangshi(){
        window.location.href="pay_fangshi";
    }

    function choosechepai1(){
        $.ajax({
            url: 'choosechepai',
            data: {},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                if(ops.Message=='success'){
                    for(var i=0;i<ops.Data.Items.length;i++){
                        if(ops.Data.Items[i]['Bind']==1){
                            var str="<div style='display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;margin-left: 0.6rem;'><div style='width:2.1rem;height:0.72rem;font-size:0.3rem;color:#fff;line-height:0.72rem;text-align:center;z-index:2;' class='zuichepai'>"+ops.Data.Items[i]["CarNo"]+"</div><img src='{{URL::asset('assets/image/chepaikuang.png')}}' alt='' style='width:2.1rem;height:0.72rem;margin-left:-2.1rem;z-index:1;' onclick='return false;'/></div>";

                            getcoupons(ops.Data.Items[i]["CarNo"]);
                            $('.choosechepai').html(str);
                        }
                    }
                }
            }
        })
    }

    @if(!empty($jump_berthcode))
    $(".lipw1").html(@php echo substr($jump_berthcode,0,1);@endphp);
    $(".lipw2").html(@php echo substr($jump_berthcode,1,1);@endphp);
    $(".lipw3").html(@php echo substr($jump_berthcode,2,1);@endphp);
    $(".lipw4").html(@php echo substr($jump_berthcode,3,1);@endphp);
    $(".lipw5").html(@php echo substr($jump_berthcode,4,1);@endphp);
    $(".lipw6").html(@php echo substr($jump_berthcode,5,1);@endphp);
    check_berth();
   @endif

</script>

<script>
    $.smartScroll=function(l,o){if(o&&!l.data("isBindScroll")){var t={posY:0,maxscroll:0};l.on({touchstart:function(l){var c,e=l.touches[0]||l,r=$(l.target);r.length&&(r.is(o)?c=r:0==(c=r.parents(o)).length&&(c=null),c&&(t.elScroll=c,t.posY=e.pageY,t.scrollY=c.scrollTop(),t.maxscroll=c[0].scrollHeight-c[0].clientHeight))},touchmove:function(l){t.maxscroll<=0&&l.preventDefault();
            var o=t.elScroll,c=o.scrollTop(),e=(l.touches[0]||l).pageY-t.posY;e>0&&0==c?l.preventDefault():e<0&&c+1>=t.maxscroll&&l.preventDefault()},touchend:function(){t.maxscroll=0}}),l.data("isBindScroll",!0)}};
</script>
<script>
    var notify = sessionStorage.getItem('notify')?false:true;
    console.log(notify);
    var paytype=sessionStorage.getItem('paytype');
    var hour_time=sessionStorage.getItem('hour_time');
    var minute_time=sessionStorage.getItem('minute_time');
    function hidein(){
        $('.notify').delay(5000).hide(0);
    }
    $(function(){
        if (paytype==2) {
            houxuan();
        }
        if(notify){
            $('.notify').css({'display':'block'});
            sessionStorage.setItem('notify',false);
        }
        hidein();

        if (hour_time||hour_time) {
            $(".hour_time").text(hour_time);
            $(".minute_time").text(minute_time);
        }
    })
    function closeNotify(){
        $('.notify').css({'display':'none'});
    }

    $.smartScroll($('.notify'), $('.notify article'))
</script>