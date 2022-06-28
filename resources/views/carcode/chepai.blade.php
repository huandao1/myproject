<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加车牌</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css?v20200720')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

    <script>
        window.alert = function(name){
            var iframe = document.createElement("IFRAME");
            iframe.style.display="none";
            iframe.setAttribute("src", 'data:text/plain,');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
        }
    </script>

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>



</head>
<body style="background:#ffffff">
<div class="main">
    <form action="chepai" method="post">
        @csrf
        <p style="color:#8c8c8c;font-size:0.26rem;width: 100%;text-align: center;margin-top: 0.4rem;">请添加真实有效的车牌号码</p>
        <p style="color:red;font-size:0.26rem;width: 100%;text-align: center;" class="notice"></p>
        <div style="display: -webkit-flex;-webkit-flex-wrap:wrap;width: 100%;-webkit-justify-content: center;margin-top: 0.3rem;">
            <div style="width: 1.8rem;height: 0.75rem;border: 1px solid #0d57a0;border-radius: 0.05rem;display: -webkit-flex;-webkit-align-items: center;position:relative;border-right:none;"
                 class="input_pro">
                <span class="che_detail">粤</span>
                <img src="{{URL::asset('assets/image/select.jpg')}}" alt=""
                     style="height: 0.35rem;width: 0.35rem;position: absolute;top:0.2rem;left: 1.1rem;">
                <img src="{{URL::asset('assets/image/fenge.png')}}" alt=""
                     style="height: 0.7rem;width: 0.15rem;position: absolute;top:0.0rem;left: 1.7rem;">

            </div>
            <input type="hidden" name="pchepai" class="pchepai" value="粤">
            <input type="hidden" name="chepai" class="chepai">
            <input type="hidden" name="jump_url" value="{{$jump_url}}">
            <input type="hidden" name="berthcode" value="{{$berthcode}}">
            <div style="width:4.7rem;height: 0.75rem;line-height:0.75rem;border: 1px solid #0d57a0;border-radius: 0.05rem;text-align: center;font-size:.0.3rem;border-left:none;"
                 class="input_pp" onclick="jj(this)"></div>


            <div style="width: 100%;text-align: center;"><input type="submit" value="确认添加" class="chepai_submit"
                                                                disabled='true'></div>
        </div>
    </form>


</div>-->
</div>
</body>
</html>
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
<script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
<script src="{{URL::asset('assets/layer/layer.js')}}"></script>
<script src="{{URL::asset('assets/js/index2.js?v20200720')}}" type="text/javascript"></script>
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
        if(num.length!=6 && num.length!=7){
            $('.notice').html('只能输入车牌后6位或7位!');
            return false;
        }
    })
    function road_park(){
        window.location.href="lubpark.php?love";
    }
    function park_park(){
        window.location.href="chepai?love";
    }
    $('input').on('focus',function(){
        $('.tabbar').hide();
    })
    $('input').on('blur',function(){
        $('.tabbar').show();
    })
    function jj(obj){
        $(obj).css({'borderColor':'#0d57a0'});
        $(".input_pro").css({'borderColor':"#0d57a0"});

    }
    $('.input_pro').click(function(){
        $(".input_pp").css({'borderColor':"#0d57a0"});
        $('.input_pro').css({'borderColor':'#0d57a0'});

    })
</script>