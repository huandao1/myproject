<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欠费账单记录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
    <script src="{{URL::asset('assets/layer/layer.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/css/zhifu.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>

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

    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style type="text/css">
        .type_switch{height: auto;}
        .pay_detail{position: relative;padding-top:0.2rem}
        .pay_applies{position: relative;display: none}
        .picve{position: absolute;right: 0px;top: 6px;}
        .picve img{width: 18px}
        .select_carno{width: 3.5rem;text-align: left;height: 0.55rem;border-radius: 0.08rem;border: none;border:1px solid #b3b3b3;font-size: 0.3rem;z-index: 1;margin-top: 0}
        .bu_btn{width: 1rem;background: #2f8ae4;text-align: center;color: white;border-radius: 0.1rem;border: none;padding: 2px 0;float: right;position: absolute;display: block;bottom: 0px;right: 0rem;}
        .nobu_btn{width: 1rem;background: #666;text-align: center;color: white;border-radius: 0.1rem;border: none;padding: 2px 0;float: right;position: absolute;display: block;bottom: 0px;right: 0rem;}
        .payorder_li {width:90%;margin:0.2rem auto;padding:0.3rem 0.4rem;background:#fff;position:relative;}
        .payorder_li .pay_detail{border-bottom:1px #e2e2e2 solid; padding-top: 0.1rem; padding-bottom: 0.2rem;}
        .payorder_li .pay_detail span{color:#555;}
        .payorder_li .pay_detail1{background:none;position:relative;width:100%;height: 0.5rem;line-height: 0.5rem; }
        .payorder_li .pay_detail1 span:first-child{color:#999}
        .payorder_li .pay_detail1 span:last-child{color:#666}
        .payorder_li .pay_detail1 span.price{color:#ea2d2d}

        .pay_historybox{border-top:1px #e2e2e2 solid;margin-top:0.2rem}
        .pay_historybox h3{font-weight:500;text-align:center;color:#666;padding: 0.1rem;}
        .pay_historybox h3 img{width: 16px;}
        .pay_historybox ul{display:none}
        .pay_historybox ul li{color:#555;height:0.5rem;line-height:0.5rem;display:flex;justify-content: space-between;}
        .pay_historybox ul li span{font-size:0.25rem}
        .pay_historybox ul li span.price{color:#ea2d2d}

        .head_line{width: 90%;height: 0.8rem;align-items: center;display: flex;justify-content: space-between;margin:0 auto;}
        .head_line .li{width: 38%;height: 1px;background-color: #999;display: block;}
        .head_line span{color: #999;font-size: 0.3rem}
    </style>
</head>
<body>
<div  class="main">
    <div class="top">
        <div class="type_switch">
            <div class="type_item" onclick="show_applies(this)"><div>已登记停车欠费记录</div></div>
            <div class="type_item active" ><a href="pay_noapply">收费告知单欠费记录</a></div>
        </div>
    </div>
    <div class="pay_applies">
        @if(!empty($arrdata1['Data']['Items']))
        @foreach($arrdata1['Data']['Items'] as $key => $value)
        <div class="pay_detail">
            <div class="pay_detail1"><span style="color:white;font-size:0.3rem;margin-left: 0.3rem">泊位号：{{$value['BerthCode']}}</span></div>
            <div class="pay_detail2"><img src="{{URL::asset('assets/image/parkStart.png')}}" alt="" style="width: 0.7rem;height: 0.7rem"><span style="color: #a9a9a9;font-size:0.3rem;margin-left: 0.1rem;">开始时间：</span><span style="color:#3d3d3d;font-size:0.32rem;margin-left: 0.1rem;">{{$value['BerthStartParkingTime']}}</span></div>
            <div class="pay_detail3"><img src="{{URL::asset('assets/image/parkEnd.png')}}" alt=""  style="width: 0.7rem;height: 0.7rem"><span style="color: #a9a9a9;font-size:0.3rem;margin-left: 0.1rem;">离场时间：</span><span style="color:#3d3d3d;font-size:0.32rem;margin-left: 0.1rem;">{{$value['BerthEndParkingTime']}}</span></div>
            <div class="pay_detail4"><img src="{{URL::asset('assets/image/times.png')}}" alt=""  style="width: 0.7rem;height: 0.7rem"><span style="color: #a9a9a9;font-size:0.3rem;margin-left: 0.1rem;">停车时长：</span><span style="color:#3d3d3d;font-size:0.32rem;margin-left: 0.1rem;">{{$value['ActualDuration']}}分钟</span></div>
            <div class="pay_detail5"><img src="{{URL::asset('assets/image/pay.png')}}" alt=""  style="width: 0.7rem;height: 0.7rem"><span style="color: #a9a9a9;font-size:0.3rem;margin-left: 0.1rem;">欠费金额：</span><span style="font-size:0.32rem;color: #fe4241;margin-left: 0.1rem;">￥{{$value['ArrearsPrice']}}元</span>
                <input type="button" onclick="go_bujiao('{{$value['SectionName']}}','{{$value['BerthStartParkingTime']}}','{{$value['ArrearsPrice']}}','{{$value['BerthCode']}}','{{$value['ActualDuration']}}','{{$value['BargainOrderCode']}}','{{$value['PlateNumber']}}','{{$value['OrderType']}}')" style="width: 1rem;height: 0.65rem;background: #54a4f3;text-align: center;color: white;display: block; position: absolute; border-radius: 0.1rem;border: none;right: 1rem;" value="补缴">
            </div>
            <hr class="hr_line">
        </div>
       @endforeach
        @else
        <div style="width:100%;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-top:0.7rem;"><img src="{{URL::asset('assets/image/noth.png')}}" alt="" width="" style="width: 2rem;height:2rem"><div style="margin-top: 0.3rem;"><span style="color: #fb415b;font-size: 0.3rem;">温馨提示：</span><span style="color: #0d57a0;font-size: 0.3rem;">您当前没有欠费订单</span></div></div>
       @endif
    </div>

    <div class="pay_unapplies">
        <form action="" method="post" id="form1">
            <div style="width: 100%;height: 8%;left: 0;top:0;background: #fff;z-index: 2;display:-webkit-flex;-webkit-align-items:center;-webkit-justify-content:space-around;">

                <span>请选择车牌号</span>
                <select id="select_carno" name="carCode">
                    @if(!empty($carno_data['Data']['Items']))
                        @foreach($carno_data['Data']['Items'] as $key => $value)
                            <option value="{{$value['CarNo']}}"
                                    @if($carCode && $value['CarNo'] == $carCode) selected='selected' @endif>{{$value['CarNo']}}
                            </option>
                        @endforeach
                    @endif
                </select>
                <input type="submit" style="width: 1.1rem;height: 0.6rem;background: #115ca7;text-align: center;color: white;border-radius: 0.1rem;border: none;font-size:0.26rem" value="查询">
                <input type="hidden" name="have_no_apply_order" id="have_no_apply_order" value="no">

            </div>
        </form>
        <div id="no_apply_record_div">
            @php
                $eff=true;
            @endphp

            @if(empty($carno_data['Data']['Items'])||empty($result['Data']['items'] ))
                <div class="pay_unapplies_no_record" id="pay_unapplies_no_record" style="width:100%;display: -webkit-flex;-webkit-flex-direction: column;-webkit-align-items: center;margin-top:0.7rem;">
                    <img src="{{URL::asset('assets/image/noth.png')}}" alt="" width="" style="width: 2rem;height:2rem">
                    <div style="margin-top: 0.3rem;">
                        <span style="color: #fb415b;font-size: 0.3rem;">温馨提示：</span>
                        <span style="color: #2f8ae4;font-size: 0.3rem;">该车牌当前没有欠费订单
                </span>
                    </div>
                </div>
            @else
                @foreach($result['Data']['items'] as $key => $value)
                @php
                    $hour=intval($value['ParkDuration']/60);
                    $len=$hour>0?$hour."小时":"";
                    $len=$len.($value['ParkDuration']%60)."分钟";
                @endphp
                @if($value['FineStatus']==1)
                    <div class="head_line"><span class="li"></span><span>正在进行</span><span class="li"></span></div>
                @endif
                @if($value['FineStatus']!=1&&$eff)
                    <div class="head_line"><span class="li"></span><span>历史订单</span><span class="li"></span></div>
                    @php $eff=false; @endphp
                @endif
            <ul class="payorder_li">
                <li class="pay_detail"  src="{{$value['Images'][0]}}"><span>{{$value['SectionName']}}.'/'.{{$value['AreaName']}}.'/'.{{$value['BerthCode']}}</span>
                </li>
                <li class="pay_detail1"><span>入场时间：</span><span >{{$value['StartParkingTime']}}</span></li>
                <li class="pay_detail1"><span >离场时间：</span><span>{{$value['EndParkingTime']}}</span></li>
                <li class="pay_detail1"><span>停车时长：</span><span>{{$len}}</span></li>
                <li class="pay_detail1"><span>已缴金额：</span><span class="price">￥{{$value['PaiedPrice']}}</span></li>
                @if($value['MPOValue']>0)
                    @php
                        $motype=['','时长','金额'];
                         $motype1=['','分钟','元'];
                    @endphp
                    <li class="pay_detail1">
                    <span>优惠
                        {{$motype[intval($value['MPOType'])]}}：
                    </span>
                        <span>
                        {{$value['MPOValue']}}{{$motype1[intval($value['MPOType'])]}}
                        </span>
                    </li>
               @endif
                <li class="pay_detail1"><span>待缴金额：</span><span class="price">￥{{$value['ArrearsPrice']}}.00</span>
                    @if($value['ArrearsPrice']>0)
                        <a href="pay_dingdan_noapply?ordercode={{$value['PeccPiceCode']}}&carCode={{$carCode}}" class="bu_btn" >补缴</a>
                    @else
                        <a href="javascript:void(0)" class="nobu_btn" >补缴</a>
                    @endif
                </li>
                <div class="pay_historybox">
                    @if($value['PaiedPrice']>0)
                    <h3>缴费明细&nbsp;<img src="{{URL::asset('assets/image/slideup.png')}}"></h3>
                    <ul>
                        @foreach($value['paymentinfos'] as $key => $v)
                        <li><span>{{$v['paymenttime']}}</span><span>{{$otypearr[$v['OrderType']-1]}}</span><span class="price">￥{{$v['payprice']}}</span></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </ul>
          @endforeach
            @endif
        </div>
    </div>

</div>
<input type="hidden" class="ordercode">
<input type="hidden" class="time">
<input type="hidden" class="PayPrice">
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

<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2;width:100%;height:100%;display:none;">
    <div id="innerdiv" style="position:absolute;">
        <img id="bigimg" style="border:5px solid #fff;" src="" />
    </div>
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
<script>
    var type={{$type}};
    function show_applies(elem){
        $(".type_item").removeClass('active');
        $(".type_item").eq(0).addClass('active');
        $(".pay_applies").show();
        $(".pay_applies_no_record").show();
        $(".pay_unapplies").hide();
        $(".pay_unapplies_no_record").hide();
    }
    function show_unapplies(elem){
        $(".type_item").removeClass('active');
        $(".type_item").eq(1).addClass('active');
        $(".pay_unapplies").show();
        $(".pay_applies").hide();
        $(".pay_applies_no_record").show();
    }
    if(type=="2")
        show_applies();
    else
        show_unapplies();

    //图片预览

    $(function(){
        var refer =document.referrer;
        var http = window.location.protocol;
        var domain=document.domain;
        if(refer == http+"//"+domain+'/login_password' || refer == http+"//"+domain+'/zhuce' || refer == http+"//"+domain+'/login_sms' || refer == http+"//"+domain+'/pay_noapply'){
            pushHistory()
            window.addEventListener("popstate", function(e) {
                window.location.href='user_index';//根据自己的需求实现自己的功能
            }, false)};
        $(".pay_detail").click(function(){

            console.log("123");
            var _this = $(this);//将当前的pimg元素作为_this传入函数
            imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);
        });

        $(".pay_historybox h3").click(function(){
            $(this).next("ul").slideToggle("slow");
        });
    });

    function pushHistory() {
        var state = {
            title: "title",
            url: "#"
        };
        window.history.pushState(state, "title", "#");
    }

    function imgShow(outerdiv, innerdiv, bigimg, _this){
        var src = _this.attr("src");//获取当前点击的pimg元素中的src属性
        console.log(src);
        $(bigimg).attr("src", src);//设置#bigimg元素的src属性
        /*获取当前点击图片的真实大小，并显示弹出层及大图*/
        $("<img/>").attr("src", src).load(function(){
            var windowW = $(window).width();//获取当前窗口宽度
            var windowH = $(window).height();//获取当前窗口高度
            var realWidth = this.width;//获取图片真实宽度
            var realHeight = this.height;//获取图片真实高度
            var imgWidth, imgHeight;
            var scale = 0.8;//缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放
            if(realHeight>windowH*scale) {//判断图片高度
                imgHeight = windowH*scale;//如大于窗口高度，图片高度进行缩放
                imgWidth = imgHeight/realHeight*realWidth;//等比例缩放宽度
                if(imgWidth>windowW*scale) {//如宽度扔大于窗口宽度
                    imgWidth = windowW*scale;//再对宽度进行缩放
                }
            } else if(realWidth>windowW*scale) {//如图片高度合适，判断图片宽度
                imgWidth = windowW*scale;//如大于窗口宽度，图片宽度进行缩放
                imgHeight = imgWidth/realWidth*realHeight;//等比例缩放高度
            } else {//如果图片真实高度和宽度都符合要求，高宽不变
                imgWidth = realWidth;
                imgHeight = realHeight;
            }

            $(bigimg).css("width",imgWidth);//以最终的宽度对图片缩放
            var w = (windowW-imgWidth)/2;//计算图片与窗口左边距
            var h = (windowH-imgHeight)/2;//计算图片与窗口上边距
            $(innerdiv).css({"top":h, "left":w});//设置#innerdiv的top和left属性
            $(outerdiv).fadeIn("fast");//淡入显示#outerdiv及.pimg

        });

        $(outerdiv).click(function(){//再次点击淡出消失弹出层
            $(this).fadeOut("fast");
        });

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

                    var paypwd=data;
                    var ordercode= $('.ordercode').val();
                    var time= $('.time').val();
                    var PayPrice= $('.PayPrice').val();


                    $.ajax({
                        url: 'pay_bupay',
                        data: {'ordercode':ordercode,'paypwd':paypwd,'time':time,'PayPrice':PayPrice},
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

                                layer.open({
                                    content: '补缴成功1！'
                                    ,skin: 'msg'
                                    ,time: 2 //2秒后自动关闭
                                });
                                //alert('补缴成功');
                                setTimeout("window.location.href='pay_bupay'",1000);


                            }else{
                                layer.open({
                                    content: ops.Message
                                    ,skin: 'msg'
                                    ,time: 2 //2秒后自动关闭

                                });
                                setTimeout("window.location.href='pay_bupay'",2000);

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

    function border_change(obj){
        $(obj).css({"border":'1px solid #2f8ae4'});
        // $(obj).siblings().css({'border': '1px solid #676767','borderRight': '1px dashed #676767'});
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

    function closes(){
        $('.body').css({'opacity':1,'background':'#ffffff'});
        $('.zhifumima').css({'display':'none'});
        // alert('1');
    }

    function bujiao(obj1,obj2,obj3){
        window.location.href='pay_zhifu?ordercode='+ordercode+'&PayPrice='+PayPrice+'&berthcode='+berthcode+'&time='+time+'&BargainOrder='+BargainOrder;

        $('.zhifu_price').html('￥'+returnFloat(obj3));

        $(".ftc_wzsf").show();
        $('.ordercode').val(obj1);
        $('.time').val(obj2);
        $('.PayPrice').val(obj3);


    }

    function go_bujiao(sectionname,sttime,PayPrice,berthcode,time,BargainOrder,PlateNumber,OrderType){
        window.location.href='pay_bj_dingdan?SectionName='+sectionname+'&BerthStartParkingTime='+sttime+'&price='+PayPrice+'&berthcode='+berthcode+'&time='+time+'&BargainOrder='+BargainOrder+'&PlateNumber='+PlateNumber+'&PayType='+OrderType;
    }

    function returnFloat(value){
        var value=Math.round(parseFloat(value)*100)/100;
        var xsd=value.toString().split(".");
        if(xsd.length==1){
            value=value.toString()+".00";
            return value;
        }
        if(xsd.length>1){
            if(xsd[1].length<2){
                value=value.toString()+"0";
            }
            return value;
        }
    }
    //  check_no_apply_orders();
</script>