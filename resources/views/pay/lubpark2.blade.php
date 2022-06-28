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

        <p class="powei">请输入泊位号</p>
        <form action="pay_lubpark2" method="post" id="form1">
            @csrf
            <div class="powei6">
                <input type="tel" name="sn1" maxlength="1" id="sn1"  onblur="border_change1(this)" value="@php echo substr($berthcode,0,1);@endphp" disabled="disabled">
                <input type="tel" name="sn2" maxlength="1" id="sn2"  onblur="border_change0(this)" value="@php echo substr($berthcode,1,1);@endphp" disabled="disabled">
                <input type="tel" name="sn3" maxlength="1" id="sn3"  onblur="border_change0(this)" value="@php echo substr($berthcode,2,1);@endphp" disabled="disabled">
                <input type="tel" name="sn4" maxlength="1" id="sn4"  onblur="border_change0(this)" value="@php echo substr($berthcode,3,1);@endphp" disabled="disabled">
                <input type="tel" name="sn5" maxlength="1" id="sn5"  onblur="border_change0(this)" value="@php echo substr($berthcode,4,1);@endphp" disabled="disabled">
                <input type="tel" name="sn6" maxlength="1" id="sn6"  onblur="border_change2(this)"  value="@php echo substr($berthcode,5,1);@endphp" disabled="disabled">
            </div>
            <!-- <div style="font-size: 0.3rem;color:red;width: 100%;text-indent: 1.2rem;" class="berth"></div> -->
            <div class="light"><img src="{{URL::asset('assets/image/light1.png')}}" alt="" style="width: 0.3rem;height: 0.3rem"><span class="light_font">{{$time_t}}</span></div>
            <p class="powei1">请选择停车时长</p>
            <div class="choose_time">
                <div class="choose_time1">
                    <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia1">
                    <img src="{{URL::asset('assets/image/jia.jpg')}}" alt="" class="jia2">

                </div>

                <div class="choose_time2">
                    <div><span class="hour_time">00</span>小时</div><div><span class="minute_time">00</span>分钟</div>
                    <input type="hidden" name="times" class="times">
                    <input type="hidden" name="berthcode" value="{{$berthcode}}" class="berthcode">
                    <input type="hidden" name="ordercode" value="{{$ordercode}}" class="ordercode">


                </div>

                <div class="choose_time3">
                    <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian1">
                    <img src="{{URL::asset('assets/image/jian1.jpg')}}" alt="" class="jian2">

                </div>

            </div>
            <p class="powei1" id="leave_time"></p>
            @if($coupon_list['Data']['Count']>0)
                @if($coupon_use_array['Data']['UseStatus']==1)
                    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:space-between;-webkit-align-items:center;margin-top:0.2rem;">
                        <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.36rem;color: #0d57a0;margin-left: 0.6rem;margin-top:0.3rem;">
                            停车优惠券
                        </div>
                        <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.24rem;color: #666666;margin-right: 0.4rem;color: #666666;margin-top:0.3rem;"><span
                                    id="coupon_tips">
        无可用</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt="" style="width: 0.36rem;height: 0.36rem;">
                        </div>
                    </div>
                @else
                    <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-justify-content:space-between;-webkit-align-items:center;margin-top:0.2rem;">
                        <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.36rem;color: #0d57a0;margin-left: 0.6rem;margin-top:0.3rem;">
                            停车优惠券
                        </div>
                        <div style="display:-webkit-flex;-webkit-flex-direction:row;-webkit-align-items:center;font-size:0.24rem;color: #666666;margin-right: 0.4rem;color: #666666;margin-top:0.3rem;"
                             onclick="show_coupon()"><span id="coupon_tips">
        {{$i}}张可用</span><img src="{{URL::asset('assets/image/my_right.png')}}" alt=""
                             style="width: 0.36rem;height: 0.36rem;"></div>
                    </div>

                @endif
            @endif

            <p class="pay_monney">缴费金额</p>
            <p class="pay_monney1"><span style="color: #ff3334;font-weight: bold;font-size: 0.4rem;" class="jiaofei">￥0.00</span><!--/账户余额<span style="font-size: 0.3rem;" class="yuer1">{{$personInfo['Data']['Items']['0']['Overageprice']}}</span>元--></p>
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
        <div class="coupon_true" style="margin-bottom: 60px" id="couponbox">

            @if($coupon_list['Data']['Count']>0)
                @foreach($coupon_list['Data']['Items'] as $k=>$v)
                    <div class="opt">
                        <div class="squaredThree">
                            <input type="radio" name="coupon_id" id="radio{{$v['VoucherId']}}"
                                   value="{{$v['VoucherId']}}-{{$v['VPMoney']}}-{{$v['VoucherType']}}"
                                   class="check">
                            <label for="myCheck"></label>
                        </div>
                        <div class="coupon_img" onclick="change_coupon_select_status({{$v['VoucherId']}})">
                            <p class="coupon_top"><span class="coupon_size">· </span>优惠券</p>
                            <p class="coupon_left">使用期限：{{$v['EffTime']}}
                                -{{$v['FailureTime']}}</p>
                            <p class="coupon_right">
                                <span>@if($v['VoucherType'] == 1)小时@else￥@endif</span>{{$v['VPMoney']}}
                            </p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button class="coupon_button" style="position: fixed;bottom: 1px; z-index:9999" onclick="select_coupon()">确 定</button>
    </div>



</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script>
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
                    var sn1=$('#sn1').val();
                    var sn2=$('#sn2').val();
                    var sn3=$('#sn3').val();
                    var sn4=$('#sn4').val();
                    var sn5=$('#sn5').val();
                    var sn6=$('#sn6').val();
                    var berthcode = sn1+sn2+sn3+sn4+sn5+sn6;
                    var paypwd=data;
                    var PayPrice=$('.pay_monney0').val();
                    var times=$('.times').val();
                    var ordercode=$('.ordercode').val();




                    $.ajax({
                        url: 'lubpark03.php',
                        data: {'berthcode':berthcode,'paypwd':paypwd,'PayPrice':PayPrice,'times':times,'ordercode':ordercode},
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
                                        content: '续费成功'
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

    })
    $('.jian1').click(function(){
        var hour_time = $('.hour_time').html();
        var minute_time = $('.minute_time').html();

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
            return false;
        }
        getparkprice();

    })
    $('.jia2').click(function(){
        var minUnit=30;
        $('.jian2').attr('src','image/jian.jpg');
        var hour_time = $('.hour_time').html();
        var minute_time = $('.minute_time').html();
        var minute_time1=parseInt(minute_time)+minUnit;
        if(minute_time1>=60){
            if(parseInt(hour_time)>=9){
                $('.hour_time').html(parseInt(hour_time)+1);
            }else{
                $('.hour_time').html('0'+(parseInt(hour_time)+1));
            }
            $('.jian1').attr('src','image/jian.jpg');

            $('.minute_time').html((minute_time1-60)<10?'0'+(minute_time1-60):(minute_time1-60));

        }else{
            $('.minute_time').html((parseInt(minute_time)+minUnit)<10?'0'+(parseInt(minute_time)+minUnit):(parseInt(minute_time)+minUnit));


        }
        getparkprice();

    })
    $('.jian2').click(function(){
        var minUnit=30;

        var minute_time = $('.minute_time').html();
        var hour_time = $('.hour_time').html();
        var minute_time1=parseInt(minute_time)-minUnit;
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
        console.log("{{$coupon_use_array['Data']['UseStatus']}}");
        if ("{{$coupon_use_array['Data']['UseStatus']}}" == 1) {
            return false;
        }
        $.ajax({
            url: 'pay_couponget',
            data: {'action':'ajaxget','total_money':pr,"pay_type":1},
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
                                if (item['Amount']=="0")
                                    str+="<input type=\"radio\" name=\"coupon_id\" id=\"radio"+item['VPNMId']+"\" value=\""+item['VPNMId']+"-" + item['VPMoney'] + "-" + item['VoucherType']+"\" class=\"check\">";
                                else
                                    str+="<input type=\"radio\" name=\"coupon_id\" id=\"radio"+item['VoucherId']+"\" value=\""+item['VoucherId']+"-" + item['VPMoney'] + "-" + item['VoucherType']+"\" class=\"check\">";
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
                                if(item['Amount']=="0")
                                    str+="</span>"+ item['VPMoney']+"</p>";
                                else
                                    str+="</span>"+ item['VPMoney']+"</p>";
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

        var sn1=$('#sn1').val();
        var sn2=$('#sn2').val();
        var sn3=$('#sn3').val();
        var sn4=$('#sn4').val();
        var sn5=$('#sn5').val();
        var sn6=$('#sn6').val();
        var berthcode = sn1+sn2+sn3+sn4+sn5+sn6;
        var hour_time = $('.hour_time').html();
        var minute_time=$('.minute_time').html();
        //alert("hour_time:" + hour_time + "||minute_time:" + minute_time);
        var total_time=parseInt(hour_time)*60+parseInt(minute_time);
        var ordercode="{{$ordercode}}";

        $('.times').val(total_time);
        $.ajax({
            url: 'pay_getparkprice',
            data: {'berthcode':berthcode,'parktimes':total_time,'ordercode':ordercode},
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
                    getcoupons(ops.Data.data.price);
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
        var remaintime={{$RemainTime}};
        console.log(hour_add);
        console.log(min_add);
        var timestamp = Date.parse(new Date());
        var now = new Date();
        var timeadd=hour_add*3600+min_add*60+parseInt(remaintime);

        var leave_tips = "预计离开时间：" + timestampToTime(timestamp+timeadd*1000);

        return leave_tips;
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
        /*
        var coupon_arr = coupon_value.split('-');

        if(coupon_arr[1]>0){

        $("#coupon_tips").html("-" + coupon_arr[1]);
        $("#selected_coupon_id").val(coupon_arr[0]);
        $("#selected_coupon_type").val(coupon_arr[2]);

        var orig_price_txt = $('.jiaofei').html();

        var price = orig_price_txt.substring(1);
        var last_coupon_price = $("#last_coupon_price").val();

        var new_price = parseFloat(Number(price) + Number(last_coupon_price) - Number(coupon_arr[1])).toFixed(2);

        $("#last_coupon_price").val(coupon_arr[1]);
        $('.jiaofei').html("￥" + new_price);
        //alert("选中的radio的值是：" + coupon_arr[0]);
        }
        return false;
        */

        //未选择任何优惠券
        if(coupon_value==undefined){
            var last_coupon_price = $("#last_coupon_price").val();
            //之前有选择优惠券
            if(last_coupon_price>0){
                var coupon_tips = "{{$coupon_list['Data']['Count']}}张可用";
                $("#coupon_tips").html(coupon_tips);


                var need_pay_price = $('.pay_monney0').val();
                //var new_price = parseFloat(Number(need_pay_price) - Number(last_coupon_price)).toFixed(2);

                //if(new_price<0)
                //new_price = 0;
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

                var need_pay_price = $('.pay_monney0').val();
                var last_coupon_price = $("#last_coupon_price").val();

                var new_price = parseFloat(Number(need_pay_price) - Number(coupon_arr[1])).toFixed(2);

                if(new_price<0)
                    new_price = 0;

                $("#last_coupon_price").val(coupon_arr[1]);
                //$('.pay_monney0').val(new_price);
                $('.jiaofei').html("￥" + new_price);
                //alert("选中的radio的值是：" + coupon_arr[0]);
            }
        }
        return false;
    }

    //初始化优惠价格设置
    function initial_coupon_setting(){
        /*
        var have_coupon = $("#have_coupon").val();
        if(have_coupon==1){
            var coupon_tips = "优惠券<?php echo $coupon_list['Data']['Count']; ?>张，选择使用";
			$("#coupon_tips").html(coupon_tips);
			//$('input:radio[name="coupon_id"]').removeAttribute('checked');
			var checkedbrowser=document.getElementsByName("coupon_id");
			var len = checkedbrowser.length;
			var i = 0;
			for(; i < len; i++){
				checkedbrowser[i].checked = false;
			}
		}
		$("#last_coupon_price").val(0);
		$("#selected_coupon_id").val(0);
		$("#selected_coupon_type").val(0);
		*/
        var need_pay_price = $('.pay_monney0').val();
        var last_coupon_price = $("#last_coupon_price").val();

        var new_price = parseFloat(Number(need_pay_price) - Number(last_coupon_price)).toFixed(2);

        if(new_price<0)
            new_price = 0;
        $('.jiaofei').html("￥" + new_price);
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
        var times=$('.times').val();
        if(times<=0){
            alert('请选择停车时长!');
            return false;
        }
        /*if($('.pay_monney0').val()=='0.00'){
            alert('请选择停车时长!');
            return false;
        }*/
        $('.zhifu_price').html($('.jiaofei').html());
        //$(".ftc_wzsf").show();

        var berthcode ="{{$berthcode}}";
        var PayPrice=$('.pay_monney0').val();

        var VoucherID;var VPNMId;
        if ($('#hasmj').val()==0)
        { VoucherID=$('#selected_coupon_id').val();
            VPNMId=-1;
        }
        else{
            VoucherID=-1;
            VPNMId=$('#hasmj').val();
        }

        // var VoucherID = $('#selected_coupon_id').val();
        var CouponAmount = $('#last_coupon_price').val();
        var CouponType = $('#selected_coupon_type').val();
        var ordercode = "{{$ordercode}}";
        var payp=parseFloat($('.pay_monney0').val());
        window.location.href="renewapply.php?berthcode=" + berthcode  + "&PayPrice=" + payp + "&time=" + times + "&trade_type=1" + "&VPNMId=" + VPNMId+ "&VoucherID=" + VoucherID + "&CouponAmount=" + CouponAmount + "&CouponType=" + CouponType + "&ordercode=" + ordercode;




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
</script>