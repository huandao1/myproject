<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>停车计时</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>


    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>

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
</head>
<body style="background: #fff">

<div class="main powei_park" >

    @if(!empty($arrdata['Data'])&&$arrdata['Data']['BargainOrderType']==2)

    <div class="deadtime_top">


        <div style="width: 100%;height: 0.56rem;text-align: center;color: white;font-size: 0.42rem;padding-top: 1.6rem;letter-spacing: 0.1rem;">{{$arrdata['Data']['SectionName']}}</div>
        <div style="width: 100%;text-align: center;position: absolute;top:2.2rem;z-index:1;"><img src="{{URL::asset('assets/image/number.png')}}" alt="" style="width: 4.3rem;height:1.4rem;"></div>

        <div style="position: absolute;top:2.2rem;z-index:2;width: 100%;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: center;"><span class="de_hour" style="width:1.4rem;height: 1.4rem;text-align: center;line-height: 1.4rem;">00</span><span class="de_minute" style="width:1.4rem;height: 1.4rem;text-align: center;line-height: 1.4rem;margin-left: 0.03rem;">00</span><span class="de_second" style="width:1.4rem;height: 1.4rem;text-align: center;line-height: 1.4rem;margin-left: 0.03rem;">00</span></div>
        <div style="width: 100%;height: 0.56rem;text-align: center;line-height: 0.56rem;color: white;font-size: 0.33rem;margin-top:1.9rem;letter-spacing: 0.05rem;" class="ye_dao">停车计时</div>


        <div style="width: 100%;margin-top:1rem;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-around;">
            <div style="display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-left:0.5rem;"><span style="color:#f3faff;font-size: 0.34rem;display: inline-block;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/bianhao.png')}}" alt="" style="width: 0.4rem;height: 0.4rem;">泊位编号</span><span class="de_powei" style="font-size: 0.34rem;margin-top: 0.1rem;font-weight: bold;">{{$arrdata['Data']['BerthCode']}}</span></div>
            <div style="display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;"><span style="color:#f3faff;font-size: 0.34rem;display: inline-block;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/kaishishijian.png')}}" alt="" style="width: 0.4rem;height: 0.4rem;">开始时间</span><span class="de_powei" style="font-size: 0.34rem;margin-top: 0.1rem;font-weight: bold;">@php echo substr($arrdata['Data']['BerthStartParkingTime'],-8);@endphp</span></div>
            <div style="display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-right: 0.5rem;"><span style="color:#f3faff;font-size: 0.34rem;display: inline-block;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/jine.png')}}" alt="" style="width: 0.4rem;height: 0.4rem;">订单金额</span><span class="de_powei" id='de_powei' style="color:#ff3535;font-size: 0.34rem;margin-top: 0.1rem;font-weight: bold;">@php echo number_format($arrdata['Data']['ActualPrice'],2);@endphp元</span></div>

        </div>

    </div>


    <div style="width: 100%;margin:0;"><img src="{{URL::asset('assets/image/huxian.jpg')}}" alt="" style="width: 100%;"></div>

        @if($arrdata['Data']['OrderStatus']=="1")
        @elseif($arrdata['Data']['OrderStatus']=="3")
            <div style="width: 100%;margin-top: 0.8rem;display: -webkit-flex;-webkit-justify-content: center;">
                <a href="pay_dingdan?berthcode={{$arrdata['Data']['BerthCode']}}&BargainOrder={{$arrdata['Data']['BargainOrderCode']}}&BerthStartParkingTime={{$arrdata['Data']['BerthStartParkingTime']}}&ActualPrice={{$arrdata['Data']['ActualPrice']}}&RemainTime={{$arrdata['Data']['RemainTime']}}&PayType=2">
                    <div style="width: 3rem;height: 0.9rem;border-radius: 0.1rem;font-size:0.34rem;text-align: center;line-height: 0.9rem;color:#f3faff; background: #0d57a0;letter-spacing: 0.03rem;">
                        去支付
                    </div>
                </a></div>
        @endif


    <div style="width: 6.8rem;color:red;font-size: 0.2rem;display: -webkit-flex;-webkit-justify-content: center;-webkit-align-items:center;margin:0 auto;margin-top:1.05rem;">温馨提示：车辆驶离后，请尽快支付您的停车费用！</div>
    @if($arrdata['Data']['OrderStatus']=="1")
    <a href="pay_yichang/{{$arrdata['Data']['BargainOrderCode']}}"><div style="width: 2.5rem;height: 0.7rem;margin:0 auto;margin-top:0.8rem;color:red;font-size: 0.3rem;display: -webkit-flex;-webkit-justify-content: center;-webkit-align-items:center;"><img src="{{URL::asset('assets/image/yichang.png')}}" alt="" style="width: 0.3rem;height: 0.3rem;margin-right: 0.15rem;">异常上报</div></a>
    @endif
    @elseif(!empty($arrdata['Data'])&&$arrdata['Data']['BargainOrderType']==1)
    <div class="deadtime_top">
        <div style="width: 100%;height: 0.65rem;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: center;padding-top: 0.5rem;"><!--<div style="width: 1.3rem;height: 0.65rem;background: white;color: #0d57a0;font-size:0.36rem;text-align: center;line-height: 0.65rem;border-radius: 0.06rem;" class="lubian">路边</div><div style="width: 1.3rem;height: 0.65rem;background: #0d57a0;color: white;font-size:0.36rem;text-align: center;line-height: 0.65rem;border-radius: 0.06rem;border:1px solid white;white-space: nowrap;" class="chechang">停车场</div>--></div>

        <div style="width: 100%;height: 0.56rem;text-align: center;color: white;font-size: 0.42rem;margin-top: 0.7rem;letter-spacing: 0.1rem;">{{$arrdata['Data']['SectionName']}}</div>
        <div style="width: 100%;text-align: center;position: absolute;top:2.2rem;z-index:1;"><img src="{{URL::asset('assets/image/number.png')}}" alt="" style="width: 4.3rem;height:1.4rem;"></div>


        <div style="position: absolute;top:2.2rem;z-index:2;width: 100%;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: center;"><span class="de_hour" style="width:1.4rem;height: 1.4rem;text-align: center;line-height: 1.4rem;">00</span><span class="de_minute" style="width:1.4rem;height: 1.4rem;text-align: center;line-height: 1.4rem;margin-left: 0.03rem;">00</span><span class="de_second" style="width:1.4rem;height: 1.4rem;text-align: center;line-height: 1.4rem;margin-left: 0.03rem;">00</span></div>
        <div style="width: 100%;height: 0.56rem;text-align: center;line-height: 0.56rem;color: white;font-size: 0.33rem;margin-top:1.9rem;letter-spacing: 0.05rem;" class="ye_dao">停车倒计时</div>


        <div style="width: 100%;margin-top:1rem;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: space-around;">
            <div style="display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-left:0.5rem;"><span style="color:#f3faff;font-size: 0.34rem;display: inline-block;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/bianhao.png')}}" alt="" style="width: 0.4rem;height: 0.4rem;">泊位编号</span><span class="de_powei" style="font-size: 0.34rem;margin-top: 0.1rem;font-weight: bold;">{{$arrdata['Data']['BerthCode']}}</span></div>
            <div style="display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;"><span style="color:#f3faff;font-size: 0.34rem;display: inline-block;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/kaishishijian.png')}}" alt="" style="width: 0.4rem;height: 0.4rem;">开始时间</span><span class="de_powei" style="font-size: 0.34rem;margin-top: 0.1rem;font-weight: bold;">@php echo substr($arrdata['Data']['BerthStartParkingTime'],-8);@endphp</span></div>
            <div style="display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-right: 0.5rem;"><span style="color:#f3faff;font-size: 0.34rem;display: inline-block;display: -webkit-flex;-webkit-align-items: center;"><img src="{{URL::asset('assets/image/jine.png')}}" alt="" style="width: 0.4rem;height: 0.4rem;">预买金额</span><span class="de_powei" style="color:#ff3535;font-size: 0.34rem;margin-top: 0.1rem;font-weight: bold;">@php echo number_format($arrdata['Data']['ApplyPrice'],2);@endphp元</span></div>

        </div>

    </div>


    <div style="width: 100%;margin:0;"><img src="{{URL::asset('assets/image/huxian.jpg')}}" alt="" style="width: 100%;"></div>


    <div style="width: 100%;margin-top: 0.8rem;display: -webkit-flex;-webkit-justify-content: center;" class="xufei"><a href="lubpark2.php?berthcode={{$arrdata['Data']['BerthCode']}}&ordercode={{$arrdata['Data']['BargainOrderCode']}}&remaintime={{$arrdata['Data']['remaintime']}}"><div style="width: 1.8rem;height: 0.7rem;border-radius: 0.1rem;font-size:0.32rem;text-align: center;line-height: 0.7rem;background: white;border:1px solid #0d57a0;color: #0d57a0;">续费</div></a>@if($arr_data['Data']['IsBespeak']==2)<a href="pay_lubpark1" style="margin-left: 1.5rem;"><div style="width: 2.5rem;height: 0.7rem;border-radius: 0.1rem;font-size:0.32rem;text-align: center;line-height: 0.7rem;color:#f3faff; background: #0d57a0">次日续时</div></a>@endif</div>
    <div style="width: 6.8rem;color:red;font-size: 0.2rem;display: -webkit-flex;-webkit-justify-content: center;-webkit-align-items:center;margin:0 auto;margin-top:1.05rem;">温馨提示：如对计费有任何疑问，请致电客服热线：22908300！</div>
    @else
    <div class="deadtime_top">
        <!--<div style="width: 100%;height: 0.65rem;display: -webkit-flex;-webkit-align-items: center;-webkit-justify-content: center;padding-top: 0.5rem;"><div style="width: 1.3rem;height: 0.65rem;background: white;color: #0d57a0;font-size:0.36rem;text-align: center;line-height: 0.65rem;border-radius: 0.06rem;" class="lubian">路边</div><div style="width: 1.3rem;height: 0.65rem;background: #0d57a0;color: white;font-size:0.36rem;text-align: center;line-height: 0.65rem;border-radius: 0.06rem;border:1px solid white;white-space: nowrap;" class="chechang">停车场</div></div>-->
        <div style="width: 100%;text-align: center;padding-top: 1.5rem;"><img src="{{URL::asset('assets/image/tingche@2x.png')}}" alt="" style="width: 1.5rem;height: 1.5rem;"><div style="color:white;font-size: 0.36rem;">当前无订单信息</div></div>


    </div>


    <div style="width: 100%;margin:0;"><img src="{{URL::asset('assets/image/huxian.jpg')}}" alt="" style="width: 100%;"></div>
   @endif

</div>


</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script>
    function daojishi(){
        $.ajax({
            url: 'pay_jishi',
            data: {},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                console.log(ops.Data);
                layer.closeAll();
                var ta = parseInt(ops.Data.RemainTime);

                if(ops.Message=='success'&&ops.Data.OrderStatus=='1'&&ops.Data.BargainOrderType==2){
                    $('.ye_dao').html("正在停车中");
                    var t = parseInt(ops.Data.RemainTime);
                    $('#de_powei').html(parseFloat(ops.Data.ActualPrice).toFixed(2)+'元');
                    var d=0;

                    first_set1=setInterval(function(){
                        var h=0;
                        var m=0;
                        var s=0;
                        if(t>=0){
                            // d=Math.floor(t/1000/60/60/24);
                            h=Math.floor(t/60/60);
                            m=Math.floor(t/60%60);
                            s=Math.floor(t%60);
                        }
                        if(h<=9){
                            h='0'+h;
                        }
                        if(m<=9){
                            m='0'+m;
                        }
                        if(s<=9){
                            s='0'+s;
                        }
                        $('.de_hour').html(h);
                        $('.de_minute').html(m);
                        $('.de_second').html(s);
                        t++;
                        ++d;
                        if(d==30){
                            clearInterval(first_set1);
                            daojishi();
                        }
                    },1000);

                    // console.log(t);

                    // GetRTime(t);
                    // setInterval("GetRTime()",1000);

                }else if(ops.Message=='success'&&ops.Data.OrderStatus=='3'&&ops.Data.BargainOrderType==2){
                    // alert(1);
                    // $('.aa').html(1);
                    $('.ye_dao').html("停车已结束");
                    $('#de_powei').html(parseFloat(ops.Data.ActualPrice).toFixed(2)+'元');
                    var d=0;

                    var t = parseInt(ops.Data.RemainTime);

                    var h=0;
                    var m=0;
                    var s=0;
                    if(t>=0){
                        // d=Math.floor(t/1000/60/60/24);
                        h=Math.floor(t/60/60);
                        m=Math.floor(t/60%60);
                        s=Math.floor(t%60);
                    }
                    if(h<=9){
                        h='0'+h;
                    }
                    if(m<=9){
                        m='0'+m;
                    }
                    if(s<=9){
                        s='0'+s;
                    }
                    $('.de_hour').html(h);
                    $('.de_minute').html(m);
                    $('.de_second').html(s);
                    $(".bianhua").html('<a href="pay_dingdan?berthcode='+ops.Data.berthcode+'&BargainOrder='+ops.Data.BargainOrderCode+'&BerthStartParkingTime='+ops.Data.BerthStartParkingTime+'&ActualPrice='+ops.Data.ActualPrice+'&RemainTime='+ops.Data.RemainTime+'"><div style="width: 3rem;height: 0.9rem;border-radius: 0.1rem;font-size:0.34rem;text-align: center;line-height: 0.9rem;color:#f3faff; background: #0d57a0;letter-spacing: 0.03rem;">去支付</div></a>');

                }else if(ops.Message=='success'&&ops.Data.BargainOrderType==1&&ta>0){
                    $('.ye_dao').html("停车倒计时");
                    var t = parseInt(ops.Data.RemainTime);
                    var d=0;

                    first_set1=setInterval(function(){
                        var h=0;
                        var m=0;
                        var s=0;
                        if(t>=0){
                            // d=Math.floor(t/1000/60/60/24);
                            h=Math.floor(t/60/60);
                            m=Math.floor(t/60%60);
                            s=Math.floor(t%60);
                        }
                        if(h<=9){
                            h='0'+h;
                        }
                        if(m<=9){
                            m='0'+m;
                        }
                        if(s<=9){
                            s='0'+s;
                        }
                        $('.de_hour').html(h);
                        $('.de_minute').html(m);
                        $('.de_second').html(s);
                        $(".xufei").find("a").attr("href","lubpark2.php?berthcode="+ops.Data.BerthCode+"&ordercode="+ops.Data.BargainOrderCode+"&RemainTime="+ops.Data.RemainTime);
                        t--;
                        ++d;
                        if(d==30){
                            clearInterval(first_set1);
                            daojishi();
                        }
                    },1000);

                }else if(ops.Message=='success'&&ops.Data.BargainOrderType==1&&ta<0){
                    $('.ye_dao').html("订单已超时");
                    $('.de_hour,.de_minute,.de_second').css({'color':'#ff3535'});
                    $('.xufei').css({'display':'none'});
                    var tt = parseInt(ops.Data.RemainTime);
                    var t=Math.abs(tt);
                    var d=0;

                    first_set1=setInterval(function(){
                        var h=0;
                        var m=0;
                        var s=0;
                        if(t>=0){
                            // d=Math.floor(t/1000/60/60/24);
                            h=Math.floor(t/60/60);
                            m=Math.floor(t/60%60);
                            s=Math.floor(t%60);
                        }
                        if(h<=9){
                            h='0'+h;
                        }
                        if(m<=9){
                            m='0'+m;
                        }
                        if(s<=9){
                            s='0'+s;
                        }
                        $('.de_hour').html(h);
                        $('.de_minute').html(m);
                        $('.de_second').html(s);
                        t++;
                        ++d;
                        if(d==30){
                            clearInterval(first_set1);
                            daojishi();
                        }
                    },1000);
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
    daojishi();

    $(document).ready(function(){
        var id={{$id}};
        if(id==2){
            // alert(id);
            $('.chechang').trigger('click');
            // daojishi1a=setInterval(daojishi1,30000);


        }else{
            $('.powei_park').css({'display':'block'});
            $('.chechang_park').css({'display':'none'});
            // daojishia=setInterval(daojishi,30000);



        }
    })
    $('.lubian').click(function(){

        $(".lubian").css({'background':'white','color':'#0d57a0'});
        $(".chechang").css({'background':'#0d57a0','color':'white', 'border':'1px solid white'});
        $('.powei_park').css({'display':'block'});
        $('.chechang_park').css({'display':'none'});



    })
    $('.chechang').click(function(){
        $(".chechang").css({'background':'white','color':'#0d57a0'});
        $(".lubian").css({'background':'#0d57a0','color':'white','border':'1px solid white'});
        $('.powei_park').css({'display':'none'});
        $('.chechang_park').css({'display':'block'});




    })
    function GetRTime(){
        // var endtime = $("#hiddens").val();


        // alert(EndTime.getTime());
        // var NowTime = new Date();
        // var t =NowTime.getTime()/1000-star_time;

        var d=0;
        var h=0;
        var m=0;
        var s=0;
        if(t>=0){
            // d=Math.floor(t/1000/60/60/24);
            h=Math.floor(t/60/60);
            m=Math.floor(t/60%60);
            s=Math.floor(t%60);
        }
        if(h<=9){
            h='0'+h;
        }
        if(m<=9){
            m='0'+m;
        }
        if(s<=9){
            s='0'+s;
        }
        $('.de_hour').html(h);
        $('.de_minute').html(m);
        $('.de_second').html(s);
        t++;

    }


    function jiance(){
        $.ajax({
            url: 'pay_jiance',
            data: {},
            method:'post',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (ops) {
                // $('.berth').html(ops.Data.msg);
                // alert(ops.Data.data.price);

                if(ops.Message=='success'&&ops.Data.code!='is_parking'){
                    layer.open({
                        content: "没有当前订单！"
                        ,skin: 'msg'
                        ,time: 2 //2秒后自动关闭
                    });
                    window.location.reload();
                }

            }

        })
    }
    @if($arrdata['Data']['OrderStatus']=="1")
    setInterval("jiance()",5000);
    @endif
    document.addEventListener('webkitvisibilitychange', function () {
        if (document.webkitVisibilityState == 'hidden') {
        } else {
            if(typeof first_set1!="undefined"){
                //alert('1');
                clearInterval(first_set1);
            }else if(typeof first_set4!="undefined"){
                clearInterval(first_set4);
            }
            //alert('1');
            daojishi();

        }
    })
</script>