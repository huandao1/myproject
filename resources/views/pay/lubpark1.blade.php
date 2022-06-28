<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>路面停车</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/css/zhifu.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>


    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>

<body>
<div style="width: 100%;overflow: hidden;background: #f5f5f5;">
    <div class="body">
        <div style="position: absolute;top:30%;left:34%;display: none" class="download">
            <img src="{{URL::asset('assets/image/21.gif')}}" alt="" style="width:2.3rem;height:2.3rem">
        </div>


        <div class="zhangdan_top" style="border-bottom: 1px solid #dcdcdc;background: white;">
            <div class="zhangdan_top1" onclick="road_park()">路边停车</div>
            <div class="zhangdan_top2" onclick="park_park()">停车场停车</div>

        </div>
        <div style="width: 100%;height: 0.8rem;display: -webkit-flex;-webkit-align-items: center;padding-left: 0.5rem;-webkit-justify-content: flex-start;background: white;"><img src="{{URL::asset('assets/image/left.png')}}" alt="" style="width: 0.6rem;height: 0.6rem;"><span><a href="pay_lubpark"  style="color:#0a9dff">我要停车</a></span><a href="pay_guize" style="margin-left: 2.4rem;color:#0a9dff">次日续时规则</a></div>
        <p class="powei">请输入泊位号</p>
        <form action="pay_lubpark1" method="post" id="form1">
            @csrf
            <ul class="ulpw">
                <li class="lipw1" onclick="puts(this)"></li>
                <li class="lipw2" onclick="puts(this)"></li>
                <li class="lipw3" onclick="puts(this)"></li>
                <li class="lipw4" onclick="puts(this)"></li>
                <li class="lipw5" onclick="puts(this)"></li>
                <li class="lipw6" onclick="puts(this)"></li>
            </ul>
            <!-- <div style="font-size: 0.3rem;color:red;width: 100%;text-indent: 1.2rem;" class="berth"></div> -->
            <div class="light"><img src="{{URL::asset('assets/image/light1.png')}}" alt="" style="width: 0.3rem;height: 0.3rem"><span class="light_font">请输入地面上标记的6位泊位号</span></div>
            <p class="powei1">请选择停车时长</p>
            <div class="choose_time">
                <div class="choose_time1">
                    <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia1">
                    <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia2">

                </div>

                <div class="choose_time2">
                    <div><span class="hour_time">00</span>小时</div><div><span class="minute_time">00</span>分钟</div>

                </div>

                <div class="choose_time3">
                    <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian1">
                    <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian2">

                </div>

            </div>
            <p class="pay_monney">缴费金额</p>
            <p class="pay_monney1"><span style="color: #ff3334;font-weight: bold;font-size: 0.4rem;" class="jiaofei">￥0.00</span>/账户余额<span style="font-size: 0.3rem;" class="yuer1">{{$personInfo['Data']['Items']['0']['Overageprice']}}</span>元</p>
            <input type="hidden" name="pay_monney" value="0.00" class="pay_monney0">

            <div style="text-align:center;width: 100%;"><input type="button" value="确定" class="pay_monney2" style="background: #93cbf1;" disabled="true"></div>
        </form>
    </div>
    <div class="ftc_wzsf">
        <div class="srzfmm_box">
            <div class="qsrzfmm_bt clear_wl">
                <img src="{{URL::asset('assets/image/xx_03.jpg')}}" class="tx close fl">
                <img src="{{URL::asset('assets/image/yue@2x.png')}}" class="tx fl">
                <span class="fl">请输入支付密码</span></div>
            <div class="zfmmxx_shop">
                <div class="mz">泊通停车</div>
                <div class="zhifu_price">￥0.0</div>
            </div>
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
</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
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

        $('.ulpw li').click(function(e){
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
            }
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

                        var hour_time = $('.hour_time').html();
                        var minute_time=$('.minute_time').html();
                        var total_time=parseInt(hour_time)*60+parseInt(minute_time);


                        $.ajax({
                            url: 'pay_lubpark02',
                            data: {'berthcode':berthcode,'paypwd':paypwd,'times':total_time},
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
                                            content: '次日续时成功'
                                            ,skin: 'msg'
                                            ,time: 2 //2秒后自动关闭
                                        });
                                        setTimeout("window.location.href='pay_bespeak'",2000);

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
    });


    $('.jia1').click(function(){
        $('.jian1').attr('src','{{URL::asset('assets/image/jian.jpg')}}');
        $('.jian2').attr('src','{{URL::asset('assets/image/jian.jpg')}}');

        var hour_time = $('.hour_time').html();
        if(parseInt(hour_time)>=9){
            $('.hour_time').html(parseInt(hour_time)+1);
        }else{
            $('.hour_time').html('0'+(parseInt(hour_time)+1));
        }
        getparkprice();

    })
    $('.jian1').click(function(){
        var hour_time = $('.hour_time').html();
        var minute_time = $('.minute_time').html();
        var firstMinTime=parseInt("{{$firstMinTime}}");
        var total1=parseInt(hour_time)*60+parseInt(minute_time);
        if(total1-60<firstMinTime){
            $('.hour_time').html('00');
            $('.minute_time').html('00');
            $('.jian1').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');
            $('.jian2').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');
            getparkprice();

            return;

        }
        if(parseInt(hour_time)>10){
            $('.hour_time').html(parseInt(hour_time)-1);
        }else if(parseInt(hour_time)>0){
            if(parseInt(hour_time)==1){
                $('.hour_time').html('0'+(parseInt(hour_time)-1));
                $('.jian1').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');
                if(parseInt(minute_time)==0){
                    $('.jian2').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');

                }
            }else{
                $('.hour_time').html('0'+(parseInt(hour_time)-1));

            }

        }else{
            return false;
        }
        getparkprice();

    })
    $('.jia2').click(function(){
        var minUnit=parseInt("{{$minUnit}}");
        var firstMinTime=parseInt("{{$firstMinTime}}");

        $('.jian2').attr('src','{{URL::asset('assets/image/jian.jpg')}}');
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
            $('.jian1').attr('src','{{URL::asset('assets/image/jian.jpg')}}');
            $('.jian2').attr('src','{{URL::asset('assets/image/jian.jpg')}}');

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
        var minUnit=parseInt("{{$minUnit}}");
        var firstMinTime=parseInt("{{$firstMinTime}}");

        var minute_time = $('.minute_time').html();
        var hour_time = $('.hour_time').html();
        var minute_time1=parseInt(minute_time)-minUnit;
        var total1=parseInt(hour_time)*60+parseInt(minute_time);
        if(total1==firstMinTime){
            $('.minute_time').html('00');
            $('.hour_time').html('00');
            $('.jian1').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');

            $('.jian2').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');
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
                    $('.jian1').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');
                    if(60+minute_time1==0){
                        $('.jian2').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');

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
                $('.jian1').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');

                $('.jian2').attr('src','{{URL::asset('assets/image/jian1.jpg')}}');


            }else{
                return false;

            }

        }else{
            $('.minute_time').html((minute_time1)<10?'0'+(minute_time1):(minute_time1));

        }
        getparkprice();
    })
    function getparkprice(){

        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();
        var hour_time = $('.hour_time').html();
        var minute_time=$('.minute_time').html();
        var total_time=parseInt(hour_time)*60+parseInt(minute_time);
        $('.times').val(total_time);
        $.ajax({
            url: 'pay_getparkprice',
            data: {'berthcode':berthcode,'parktimes':total_time,'stype':'bespeak'},
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
                // console.log(ops);
                layer.closeAll();

                if(ops.Data.data.price){
                    $('.pay_monney2').css({'background':'#0d57a0'});
                    $('.pay_monney2').attr('disabled',false);
                    $('.jiaofei').html("￥"+ops.Data.data.price);
                    $('.pay_monney0').val(ops.Data.data.price);
                }else{
                    $('.pay_monney2').css({'background':'#93cbf1'});
                    $('.pay_monney2').attr('disabled',true);
                    $('.jiaofei').html("￥"+'0.00');
                }
            }
        })

    }

    function park_park(){
        window.location.href="chepai";
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
        if($('.pay_monney0').val()=='0.00'){
            alert('请选择停车时长!');
            return false;
        }else{
            $('.zhifu_price').html($('.jiaofei').html());

            $(".ftc_wzsf").show();

        }
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

            // alert(berthcode);
            check_berth();

        }
    }
    function check_berth(){
        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();

        $.ajax({
            url: 'pay_chargetime',
            data: {'berthcode':berthcode},
            method:'post',
            dataType:'text',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                layer.closeAll();

                $('.light_font').html(ops);
                $('.jiaofei').html("￥"+'0.00');
                $('.hour_time,.minute_time').html('00');


                //getparkprice();

            }


        })



    }
</script>