<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>停车场停车</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
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
<body>
<div class="main">
    <div class="zhangdan_top" style="border-bottom: 1px solid #dcdcdc;">
        <div class="zhangdan_top2" onclick="road_park()">路边停车</div>
        <div class="zhangdan_top1" onclick="park_park()">停车场停车</div>

    </div>
    <form action="chepai" method="post">
        @csrf
        <p class="chepai_top">您好，欢迎使用泊通</p>
        <p style="color:#8c8c8c;font-size:0.26rem;width: 100%;text-align: center;margin-top: 0.1rem;">请添加您的车牌信息</p>
        <p style="color:red;font-size:0.26rem;width: 100%;text-align: center;margin-top: 0.1rem;" class="notice"></p>
        <div style="display: -webkit-flex;-webkit-flex-wrap:wrap;width: 100%;-webkit-justify-content: center;margin-top: 0.5rem;">
            <div style="width: 1.8rem;height: 0.82rem;border: 1px solid #93cbf1;border-radius: 0.05rem;display: -webkit-flex;-webkit-align-items: center;position:relative;border-right:none;" class="input_pro">
                <span class="che_detail">粤</span>
                <img src="{{URL::asset('assets/image/select.jpg')}}" alt="" style="height: 0.35rem;width: 0.35rem;position: absolute;top:0.2rem;left: 1.1rem;">
                <img src="{{URL::asset('assets/image/fenge.png')}}" alt="" style="height: 0.7rem;width: 0.15rem;position: absolute;top:0.06rem;left: 1.7rem;">

            </div>
            <input type="hidden" name="pchepai" class="pchepai" value="粤">
            <input type="hidden" name="chepai" class="chepai">

            <div style="width:3.4rem;height: 0.82rem;line-height:0.82rem;border: 1px solid #93cbf1;border-radius: 0.05rem;text-align: center;font-size:0.3rem;border-left:none;" class="input_pp" onclick="jj(this)"></div>


            <div style="width: 100%;text-align: center;"><input type="submit" value="确认添加" class="chepai_submit" disabled='true'></div>
            <p style="margin-left:4rem;margin-top:0.15rem;"><span style="color:#8c8c8c;font-size:0.3rem;">已有车牌？</span><a href='chepaicheck' style="color:#0d57a0;font-size:0.3rem;">直接缴费</a></p>
        </div>
    </form>


    <div class="tabbar">
        <a href="chepai1?love"><div class="tabbar1"><img src="{{URL::asset('assets/image/park_pay.png')}}" alt="" class="tabbar_img1"><div class="tabbar4" style="color: #0d57a0">停车缴费</div></div></a>
        <a href="pay_paymoney?love"><div class="tabbar2"><img src="{{URL::asset('assets/image/pay_money1.png')}}" alt="" class="tabbar_img2"><p class="tabbar5" style="color: #585858">快速充值</p></div></a>
        <a href="user_index?love"><div class="tabbar3"><img src="{{URL::asset('assets/image/persons1.png')}}" alt="" class="tabbar_img3"><p class="tabbar6" style="color: #585858">个人中心</p></div></a>


    </div>
</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('assets/layer/layer.js')}}"></script>
<script src="{{URL::asset('assets/js/index.js')}}" type="text/javascript"></script>
<script>
    function show_chepai(obj){
        var province = $(obj).html();
        $('.province').css({'display':'none'});
        $('.'+province).css({'display':'block'});
    }
    function back_province(obj){
        $(obj).parent().css({'display':'none'});
        $('.province').css({'display':'block'});
    }
    function get_chepai(obj){
        $('.che_detail').html($(obj).html());
        $('.pchepai').val($(obj).html());
        $(obj).parent().hide();
    }
    function shows(obj){
        var get_num = $('.che_detail').html().substring(0,1);
        $('.'+get_num).siblings().css({'display':'none'});
        $(obj).css({'display':'-webkit-flex'});
        $("#chepai").css({'display':'block'});
        // alert(get_num);
        $('.'+get_num).css({'display':'block'});

    }
    $("form").submit(function(){
        var num=$('.chepai').val();
        if(num.length!=6){
            $('.notice').html('只能输入车牌后6位!');
            return false;
        }
    })
    function road_park(){
        window.location.href="pay_later_pay";
    }
    function park_park(){
        window.location.href="chepai1";
    }
    $('input').on('focus',function(){
        $('.tabbar').hide();
    })
    $('input').on('blur',function(){
        $('.tabbar').show();
    })
    function jj(obj){
        $(obj).css({'borderColor':'#0d57a0'});
        $(".input_pro").css({'borderColor':"#93cbf1"});

    }
    $('.input_pro').click(function(){
        $(".input_pp").css({'borderColor':"#93cbf1"});
        $('.input_pro').css({'borderColor':'#0d57a0'});

    })
</script>