<!DOCTYPE html>
<html lang="en" style="width: 100%;height:100%;">
<head>
    <meta charset="UTF-8">
    <title>路边停车</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/zhifu.css')}}">
    <script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>


    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
</head>

<body style="width: 100%;height:100%;">
<div style="width: 100%;overflow: hidden;background: #f5f5f5;height: 100%;">
    <div class="body">



        <div class="zhangdan_top" style="border-bottom: 1px solid #dcdcdc;background: white">
            <div class="zhangdan_top1" onclick="road_park()">路边停车</div>
            <div class="zhangdan_top2" onclick="park_park()">停车场停车</div>

        </div>

        <p class="powei">请输入泊位号</p>

        <form action="pay_lubpark" method="post" id="form1">
            <ul class="ulpw">
                <li class="lipw1" onclick="puts(this)"></li>
                <li class="lipw2" onclick="puts(this)"></li>
                <li class="lipw3" onclick="puts(this)"></li>
                <li class="lipw4" onclick="puts(this)"></li>
                <li class="lipw5" onclick="puts(this)"></li>
                <li class="lipw6" onclick="puts(this)"></li>
            </ul>
            <!-- <div style="font-size: 0.3rem;color:red;width: 100%;text-indent: 1.2rem;" class="berth"></div> -->
            <div style="width:6.5rem;margin-left:0.5rem;margin-top:0.5rem;height: 3.6rem;display:-webkit-flex;-webkit-flex-direction:column;-webkit-align-items:center;-webkit-justify-content:center;border: 1px solid #e4e4e4;background: white;" class="weishu"><img src="{{URL::asset('assets/image/boweixinxi@2x.png')}}" alt="" style="width: 1.8rem;height: 1.8rem"><span style="font-size:0.32rem;color:#afaeae;margin-top:0.3rem; ">输入泊位号即可显示泊位信息</span></div>

            <div style="width:6.5rem;margin-left:0.5rem;margin-top:0.5rem;height: 3.6rem;border: 1px solid #e4e4e4;background: white;display: none;" class="yishu">
                <div style="width: 100%;height: 0.8rem;display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;"><img src="{{URL::asset('assets/image/quantianbowei@2x.png')}}" alt="" style="width: 1.6rem;height: 0.42rem;margin-left:2.45rem; "><span style="color: white;font-size:0.24rem;margin-left: -1.3rem;z-index: 2">全天泊位</span></div>
                <div style="width: 6.3rem;height:0.1px;border-bottom: 1px solid #e4e4e4;margin-left: 0.1rem;"></div>
                <div style="width: width:100%;height: 1rem;display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;"><div style="width: 1.25rem;height: 0.36rem;font-size: 0.18rem;text-align: center;line-height: 0.34rem;background: #f5f5f5;color: #9e9e9e;border: 1px solid #e4e4e4;margin-left: 0.3rem; ">收费时段</div><div style="width: 1.25rem;height: 0.36rem;font-size: 0.18rem;text-align: center;line-height: 0.34rem;background: #f5f5f5;color: #9e9e9e;border: 1px solid #e4e4e4;margin-left:2.3rem;">收费规则</div></div>
                <div style="width: 3.25rem;height: 1.8rem;float: left;"><div style="width: 3.25rem;height: 0.34rem;color: #3399ff;font-size:0.24rem;text-align:center">收费</div><div style="width: 3.25rem;height: 0.8rem;display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;"><img src="{{URL::asset('assets/image/baitian@2x.png')}}" alt="" style="width:0.36rem;height: 0.36rem;margin-left:0.3rem;"><span style="color: #3399ff;font-size:0.24rem; z-index: 2;margin-left: 0.2rem;" class="star_time">07:30</span><img src="{{URL::asset('assets/image/shijian@2x.png')}}" alt="" style="width: 0.24rem;height: 0.24rem;z-index: 2;margin-left: 0.05rem;"><img src="{{URL::asset('assets/image/shijiankuang@2x.png')}}" alt="" style="width: 1.8rem;height: 0.74rem;margin-left: -0.99rem;z-index: 1;"><span style='color: #3399ff;font-size:0.24rem;z-index: 2;margin-left: -0.74rem;' class="end_time">20:30</span><img src="{{URL::asset('assets/image/wanshang@2x.png')}}" alt="" style="width: 0.34rem;height: 0.34rem;margin-left: 0.25rem;"></div></div>
                <div style='width: 3.2rem;height: 1.8rem;float: left;display:-webkit-flex;-webkit-flex-direction:column;-webkit-align-items:center;-webkit-justify-content:center;'>
                    <div style="width: 3.2rem;height:0.25rem;display: -webkit-flex;-webkit-align-items:center;-webkit-justify-content:center;">
                        <div style="width: 0.61rem;height: 0.24rem;background: #f6ba5a;text-align: center;line-height: 0.24rem;"><span style="color:white;font-size: 12px;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;display: inline-block;white-space:nowrap;height:0.25rem;padding-top:0.06rem;text-align: center;padding-left: 0.1rem;" class="mian_time">0元</span></div>
                        <div style="width: 0.86rem;height: 0.24rem;background: #3398fe;text-align: center;line-height: 0.24rem;margin-left:0.02rem;"><span style="color:white;font-size: 12px;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;display: inline-block;white-space:nowrap;height:100%;text-align: center;padding-left:0.08rem;padding-top:0.06rem;" class="first_price">3元</span></div>
                        <div style="width: 0.86rem;height: 0.24rem;background: #f28c75;text-align: center;line-height: 0.24rem;margin-left: 0.02rem;"><div style="color:white;font-size: 12px;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;display: inline-block;white-space:nowrap;width:100%;height:100%;text-align: center;padding-left:0.08rem;padding-top:0.06rem; " class="second_price">6元/30分</div></div>
                    </div>
                    <img src="{{URL::asset('assets/image/022.png')}}" alt="" style="width: 2.38rem;">
                    <div style="width: 3.2rem;height:0.25rem;display: -webkit-flex;-webkit-align-items:center;-webkit-justify-content:center;margin-top: -0.18rem;"><div style="width: 0.61rem;height: 0.15rem;border: none;border-left:1px solid  #9e9e9e;"></div><div style="width: 0.86rem;height: 0.15rem;border: none;border-left:1px solid  #9e9e9e;margin-left: 0.01rem;"></div><div style="width: 0.86rem;height: 0.15rem;border: none;border-left:1px solid  #9e9e9e;margin-left: 0.01rem;"></div></div>
                    <div style="width: 3.2rem;z-index: 2;margin-top: -0.08rem;display: -webkit-flex;-webkit-align-items:center;"><span style="font-size: 12px;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;display: inline-block;margin-left: 0.25rem;color: #9e9e9e;width: 0.61rem;white-space: nowrap;">0分钟</span><span style="font-size: 12px;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;display: inline-block;margin-left:0rem;color: #9e9e9e;width: 0.86rem;white-space: nowrap;margin-left: -0.09rem;" class="time1">30分钟</span><span style="font-size: 12px;-webkit-transform:scale(0.75);-webkit-transform-origin:0 0;display: inline-block;color: #9e9e9e;margin-left: 0rem;width: 0.86rem;white-space: nowrap;margin-left: 0rem;" class="time2">180分钟</span></div>
                </div>
            </div>


            <div style="text-align:center;width: 100%;"><input type="button" value="确定" class="pay_monney2" style="background: #93cbf1;" disabled="disabled" ></div>
        </form>
        <!--<div class="detail_phone1">
                <p style="font-size: 0.24rem;font-style: '宋体';">服务提供：深圳市凯达富智慧交通科技有限公司</p>
                <p style="font-size: 0.24rem">客服电话:0755-86700413</p>

            </div>-->
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
<script>
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
    $('#remove').click(function(){
        $(".lipw7").html('');
        if($(".lipw7").prev().length>0){
            $(".lipw7").prev().html('');

            $('.lipw7').removeClass('lipw7').prev().addClass('lipw7');
            //alert(1);

        }
        //alert(1);
    })
    $('#wrap').click(function(){
        $('.layer-content').css({'display':'none'});

    })
    $('.ulpw li').click(function(e){
        $('.layer-content').css({'display':'block'});
        e.stopPropagation();
    })
    function check_berth(){
        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();

        $.ajax({
            url: 'pay_berthstatus',
            data: {'berthcode':berthcode},
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
                if(ops.Data.msg=='空闲'){
                    $('.yishu').css({"display":'block'});
                    $('.weishu').css({'display':'none'});
                    $('.star_time').html(ops.Data.data.dayStartTime);
                    $('.end_time').html(ops.Data.data.dayEndTime);
                    $('.mian_time').html("0元");
                    $('.first_price').html(ops.Data.data.firstRatePrice+"元");
                    $('.second_price').html(ops.Data.data.secondRatePrice+"元/"+ops.Data.data.secondRateUnit+'分');

                    $('.time1').html(ops.Data.data.freeDuration+"分钟");
                    $('.time2').html(ops.Data.data.fisrtRateUnit+"分钟");
                    $('.pay_monney2').css({'background':'#0d57a0'});
                    $('.pay_monney2').attr('disabled',false);





                }else{
                    // alert(ops.Data.msg);
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
    $('.pay_monney2').click(function(){

        var berthcode =$(".lipw1").html()+$(".lipw2").html()+$(".lipw3").html()+$(".lipw4").html()+$(".lipw5").html()+$(".lipw6").html();

        $.ajax({
            url: 'apply_hou.php',
            data: {'berthcode':berthcode},
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
                if(ops.Message=='success'){
                    layer.open({
                        content: '申请成功'
                        ,btn: '我知道了'
                    });

                    setTimeout("window.location.href='pay_jishi?id=1'",5000);

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
            }


        })

    })
    function park_park(){
        window.location.href="chepai1";
    }
    function road_park(){
        window.location.href="pay_later_pay";
    }
</script>