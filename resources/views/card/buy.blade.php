<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>月卡办理</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <style type="text/css">
        ul{list-style: none;margin: 0;padding: 0;}
        .nopadding{padding: 0 .75rem}
        .nomargin{margin:.25rem 0 }
        .f6{font-size: 0.6rem}
        .card{font-size: .8rem}
        .buybtn{position: fixed;bottom: .2rem;width: 90%;left: 5%;padding: .2rem}
        .button.button-fill{height: 1.75rem;line-height: 1.75rem}
        .list-block {
            margin: .5rem 0;
            font-size: .75rem;
        }
        .picker-modal{background: #f4f4f4;}
        .picker-item{font-size:16px}
        .list-block .item-media+.item-inner input[type="text"]{text-align: right;width: 65%!important;font-size: 0.75rem}
        #price{color: #e21010}
        .carnobox,.pricebox{position: fixed;bottom: 0px; width: 90%;left: 5%;z-index: 9999;background: #fff;border-radius: 5px; padding: 5px;display:none}
        .headarea{color: #666;font-size: 16px;text-align: center;padding:5px;order-bottom: 1px solid #ececec;}
        .carnobox ul,.pricebox ul{max-height: 180px;overflow-y: scroll;margin-bottom:10px}
        .carnobox ul li{text-align: center;margin:2px 0;color:#1481e0;padding: 10px 0;}
        .pricebox ul li{text-align: center;margin:2px 0;color:#1481e0;padding: 10px 0;}
        .addact{width: 80%;
            /* height: 1rem; */text-align: center; display: block;padding: 0.25rem;margin: 0 auto;background: #1481e0;color: #fff;border-radius: 5px;}
        .parkareabox{position: fixed;width: 100%;height: 100%;z-index: 9999;background: #efefef;display: none;overflow: auto;}
        .parkareabox ul li{width: 100%;padding: 10px;color: #666;background: #fff;margin-bottom: 10px;align-items: center;font-size: 14px}
        .parkareabox ul li img{width: 24px;height: 24px;float: right;margin-left: 20px;display: none}
        .parkareabox ul li.active img{display: block}
        .close{position: absolute;right: 8px;top: 2px;color: #333;}
        .parkareaitem li p{display: contents;}
        .close_img{
            width:40px;
            height: 40px
        }
        .item-flex{
            display: flex;
            display:-webkit-flex;
            align-items:center ;
            -webkit-align-items:center ;
        }

        .displayCls{
            background: #a2a2a2 !important;
        }
    </style>


</head>
<body>
<div class="page-group">
    <div class="page page-current">
        <div class="content">
            <div class="content-padded">

                <h4 class="nomargin f6">温馨提示</h4>

                <p class="nomargin f6">当日购买月卡,次日0点生效;不在月卡有效期的停车时长按照正常收费标准收费</p>
            </div>
            <div class="list-block">
                <ul>


                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">开通车牌</div>
                            <input type="text" id='picker3' name="carno" placeholder="请选择车牌" style="font-size: 0.75rem" readonly/>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">开通片区</div>
                            <input type="text" id='picker1' name="road" placeholder="请选择要开通的片区" style="font-size: 0.75rem" readonly/>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">购买月数及金额</div>
                            <input type="text" id='picker4' placeholder="请选择" style="font-size: 0.75rem" readonly/>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">有效期至</div>
                            <div class="item-after" id="dateline" style="font-size: 0.75rem">2020-01-01</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">支付金额</div>
                            <div class="item-after" id="price" style="font-size: 0.75rem">0.00元</div>
                        </div>
                    </li>
                    <li class="item-content">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title item-flex"><input type="checkbox" id="checkread"  name="check" />我已同意&nbsp;<a href="card_explain" data-no-cache="true">《容桂智泊月卡使用规则》</a></div>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="content-block">
                <p class="buybtn"><a href="javascript:void(0)" class="button button-fill displayCls" onclick="payact(this)" data-payact="0">立即支付</a></p>

            </div>
        </div>
    </div>

    <div class="carnobox">
        <div class="headarea">选择开通车牌</div>
        <a href="javascript:void(0)" onclick="closebox(this)" class="close">
            <img class='close_img' src='{{URL::asset('assets/image/xx_03.png')}}' alt='' title = '' />
        </a>
        <ul class="carnoitem">

        </ul>
        <a class="addact" href="chepai?source=monthcard">新增车牌</a>
    </div>
    <div class="parkareabox">
        <div class="headarea">选择开通片区<a href="card_newrule" style="float:right">月卡规则</a></div>
        <ul class="parkareaitem">

        </ul>
    </div>
    <div class="pricebox">
        <div class="headarea">选择开通月数</div>
        <a href="javascript:void(0)" onclick="closebox(this)" class="close">
            <img class='close_img' src='{{URL::asset('assets/image/xx_03.png')}}' alt='' title = '' />
        </a>
        <ul class="priceitem">

        </ul>

    </div>


</div>

<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script>
    var jsonarray=[];
    var pricearray=[];
    var mcarray=[];
    var ParkCodearr=[];
    var cartype= ['蓝牌车', '黄牌车', '小型新能源车','大型新能源车','其他'];
    var cararray=[];
    var price_per=0;
    var selarr=[];
    var PlateNumberType=1;
    var MCId=0;
    var MonthArr=['','1个月', '2个月', '3个月', '4个月','5个月'];
    var CardPrice=0;
    var PlateNumber='';
    var ParkCode='';

    $(function(){

        $.ajax({

            type:'POST',

            url:'getcardlist',

            data: {action:'parklist'},

            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            dataType:'text',
            beforeSend:function(){

                // $.showPreloader();
            },
            success:function(data){
                data = data.replace(/\s+/g,'')
                data = JSON.parse(data)
                if (data.RetCode==5) {
                    $.toast('登录失效');
                    window.location.href="login_sms?source=cardlist";

                }
                console.log(data);
                var parklist=data.Data.Items;
                var str="";
                var hs=""
                for(var i in parklist){
                    if (parklist[i].MCardNum>0) {
                        var numstr="<span>(剩余"+parklist[i].MCardNum+"张)</span>";
                    }
                    else{
                        var numstr="<span>(已售完)</span>";
                    }
                    // numstr="";
                    str+="<li onclick=policy_sel(this)  data-MCId='"+parklist[i].MCId+"'  data-MCardPrice='"+parklist[i].MCardPrice+"' title='"+parklist[i].CommunityID+"'><p>"+parklist[i].CommunityName+"</p>"+numstr+"<img src='../../image/community.png'/></li>"

                }
                $(".parkareaitem").html(str);
                $.hidePreloader();




            },

            error:function(xhr, type){

                console.log('Ajax error!')

            }

        })
        $.ajax({

            type:'POST',

            url:'getcardlist',

            data: {action:'carlist'},

            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            dataType:'text',
            beforeSend:function(){

                // $.showPreloader();
            },
            success:function(data){

                data = data.replace(/\s+/g,'')
                data = JSON.parse(data)
                console.log(data)
                if (data.RetCode==4) {

                    $.toast("请添加车牌");
                    window.location.href='chepai?source=monthcard';
                    return false;
                }
                var parklist=data.Data.Items;
                var str="";
                for(var i in parklist){
                    str+="<li onclick=carno_del(this,'#picker3')>"+parklist[i].CarNo+"</li>"
                    cararray.push(parklist[i].CarNo);
                    // alert(parklist[i].ParkingName);
                }
                $(".carnoitem").html(str);
                $.hidePreloader();

            },

            error:function(xhr, type){
                console.log(xhr)
                console.log('Ajax error!')

            }

        })
    })
    function carno_del(obj){
        var text=$(obj).html();
        $.ajax({

            type:'POST',

            url:'card_renew',

            data: {PageIndex:1,PageSize:20,carCode:text},

            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            dataType:'json',
            beforeSend:function(){

                // $.showPreloader();
            },
            success:function(data){
                if (data.RetCode == 0) {
                    if (data.Data.data.count >= 1) {
                        alert("该车牌有欠费订单,请先处理");
                        window.location.href = 'pay_noapply?CarNo='+text;
                        return false;
                    }

                }

            },

            error:function(xhr, type){
                console.log(xhr)
                console.log('Ajax error!')

            }

        })
        $("#picker3").val(text);
        $(".carnobox").hide();

    }
    function pritem_sel(obj){
        console.log($(obj).index())
        var text=$(obj).find("span").text();
        var i=$(obj).data("i");
        $("#picker4").val(MonthArr[i]+text);
        $("#price").text(text);
        console.log(new Date());
        $("#dateline").text(datechange(new Date().getTime(),31*$(obj).index()+31));
        localStorage.setItem('MonthNum',$(obj).index()+1);
        localStorage.setItem('CardPrice',text);
        $(".pricebox").hide();
        if($("#picker1").val().length>0 && $("#checkread").is(':checked') && text.length>0){
            $(".buybtn").find("a").data("payact","1");
            $(".buybtn").find("a").removeClass("displayCls").addClass("payact");
        }
    }
    function policy_sel(obj){
        $(obj).addClass("active").siblings().removeClass("active");
        var text=$(obj).find("p").text();
        $("#picker1").val(text);
        localStorage.setItem('cardper_price',parseFloat($(obj).attr("data-MCardPrice")));
        localStorage.setItem('CommunityID',$(".active").attr("title"));
        localStorage.setItem('MCId',$(".active").attr("data-mcid"));
        $(".parkareabox").hide();
        if($("#picker4").val().length>0 && $("#checkread").is(':checked') && text.length>0){
            $(".buybtn").find("a").data("payact","1");
            $(".buybtn").find("a").removeClass("displayCls").addClass("payact");
        }
    }

    function closebox(obj){
        $(obj).parent("div").hide();;


    }
    function datechange(date,days){
        var nd = date;
        nd = nd.valueOf();
        nd = nd + days * 24 * 60 * 60 * 1000;
        nd = new Date(nd);
        //alert(nd.getFullYear() + "年" + (nd.getMonth() + 1) + "月" + nd.getDate() + "日");
        var y = nd.getFullYear();
        var m = nd.getMonth()+1;
        var d = nd.getDate();
        if(m <= 9) m = "0"+m;
        if(d <= 9) d = "0"+d;
        var cdate = y+"-"+m+"-"+d+" 23:59";
        return cdate;
    }
    $("#picker3").click(function(){
        $(".carnobox").show();
    })
    $("#picker1").click(function () {
        var check_cp = $("#picker3").val();
        if (check_cp.length > 0) {
            $(".parkareabox").show();
        } else {
            $.toast("请先选择车牌");
        }

    })
    $("#picker4").click(function () {
            var check_cp = $("#picker3").val();
            if (check_cp.length > 0) {
                var str = "";
                for (var i in MonthArr) {
                    //i++;
                    var prc = localStorage.getItem('cardper_price') * i;
                    if (MonthArr[i])
                        str += "<li onclick=pritem_sel(this,'#picker3') data-i="+i+">" + MonthArr[i] + "<span>" + prc.toFixed(2) + "<span>元</li>";
                }
                $(".priceitem").html(str);
                $(".pricebox").show();
            } else {
                $.toast("请先选择车牌");
            }


        }
    );

    function payact(obj){
        var check_payact=$(obj).data("payact");
        if(check_payact == 0){
            return false;
        }
        var PlateNumber=$("#picker3").val();
        var CommunityID=localStorage.getItem('CommunityID');
        var MCId=localStorage.getItem('MCId');
        var MonthNum=localStorage.getItem('MonthNum');
        var CardPrice=localStorage.getItem('CardPrice');
        console.log(PlateNumber);
        console.log(CommunityID);
        console.log(MCId);
        console.log(MonthNum);
        if (CommunityID==''||MCId==''||MonthNum==''||CardPrice==''||PlateNumber=='') {
            $.toast("信息不完整");
            return false;

        }
        if(!$('#checkread').attr('checked')){
            $.toast("请阅读服务协议后勾选同意");
            return false;
        }
        $.ajax({

            type:'POST',

            url:'getcardlist',

            data: {action:'cardpay',CommunityID:CommunityID,PlateNumberType:1,MCId:MCId,MonthNum:MonthNum,CardPrice:parseFloat(CardPrice),PlateNumber:PlateNumber},

            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            dataType:'text',
            beforeSend:function(){

                $.showPreloader();
            },
            success:function(data){
                data = data.replace(/\s+/g,'')
                data = JSON.parse(data)
                $.hidePreloader();
                if (data.countstate==1) {
                    $.toast('该车牌存在欠费订单!');
                    setTimeout(function(){
                        window.location.href='pay_noapply?CarNo='+PlateNumber;
                    }, 2000);

                    return false;
                }
                if (data.RetCode!=0) {
                    $.toast(data.Message);
                    return false;
                }
                else{
                    window.location.href=data['Data']['result']['WFTResponse']['Content']
                }


            },

            error:function(xhr, type){

                console.log('Ajax error!')

            }

        })
    }

    $('.body').on('click','.cancle',function(){
        $(".picker-modal").hide()
    })

    $("#checkread").click(function(){
        if($("#picker4").val().length>0 && $("#checkread").is(':checked') && $("#picker1").val().length>0){
            $(".buybtn").find("a").data("payact","1");
            $(".buybtn").find("a").removeClass("displayCls").addClass("payact");
        }
    })

</script>
</body>
</html>