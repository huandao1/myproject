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
        #picker4{text-align: right;}
        #price{color: #e21010}
        input{text-align: right;
            width: 65%!important;font-size: 0.75rem}
        .carnobox,.pricebox{position: fixed;bottom: 0px; width: 90%;left: 5%;z-index: 9999;background: #fff;border-radius: 5px; padding: 5px;display:none}
        .headarea{color: #666;font-size: 16px;text-align: center;padding:5px;order-bottom: 1px solid #ececec;}
        .carnobox ul,.pricebox ul{max-height: 100px;overflow-y: scroll;margin-bottom:10px;}
        .carnobox ul li{text-align: center;margin:2px 0;color:#1481e0}
        .pricebox ul li{text-align: center;margin:2px 0;color:#1481e0}
        .close{position: absolute;right: 8px;top: 10px;color: #333;}
        #picker1{max-width: 280px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;font-size: 14px;}
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
                    <div id="testid"></div>
                    <script type="text/x-dot-template" id="useType0">
                        <li class="item-content item-link">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">开通车牌</div>
                                <div class="item-after" >{{=it.PlateNumber}}</div>
                            </div>
                        </li>
                        <li class="item-content item-link">
                            <div class="item-media"><i class="icon icon-f7"></i></div>
                            <div class="item-inner">
                                <div class="item-title">开通路段</div>
                                <input type="text" id='picker1' name="road" value="{{=it.CommunityName}}" readonly/>
                            <!-- <div class="item-after rtee" ><p class="loadtext">{{=it.CommunityName}}</p></div> -->
                            </div>
                        </li>
                    </script>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">购买月数及金额</div>
                            <input type="text" id='picker4' placeholder="请选择" readonly/>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">有效期至</div>
                            <div class="item-after" id="dateline">2019-10-09</div>
                        </div>
                    </li>
                    <li class="item-content item-link">
                        <div class="item-media"><i class="icon icon-f7"></i></div>
                        <div class="item-inner">
                            <div class="item-title">支付金额</div>
                            <div class="item-after" id="price">0.00元</div>
                        </div>
                    </li>
                </ul>

            </div>

            <div class="content-block">
                <p class="buybtn"><a href="javascript:void(0)" class="button button-fill payact">立即支付</a></p>

            </div>
        </div>
    </div>

    <div class="pricebox">
        <div class="headarea">选择开通月数</div>
        <a href="javascript:void(0)" onclick="closebox(this)" class="close">X</a>
        <ul class="priceitem">

        </ul>

    </div>

</div>

<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script src="{{URL::asset('assets/js/doT.min.js')}}" type="text/javascript"></script>
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
    var MonthArr=['','1个月', '2个月', '3个月','4个月', '5个月', '6个月'];
    var CardPrice=0;
    var PlateNumber='';
    var ParkCode='';
    var EndTime='';
    var formArray;
    $(function(){

        formArray = JSON.parse(localStorage.getItem('resata'));
        EndTime=formArray.EndTime;
        localStorage.setItem('EndTime',EndTime);
        $("#dateline").text(EndTime);
        tmpltxt=doT.template(document.getElementById("useType0").innerHTML);//生成模板方法
        document.getElementById("testid").innerHTML=tmpltxt(formArray);

        var str="";
        for(var i in MonthArr){

            var prc=parseFloat(formArray.MCardPrice)*i;
            if (MonthArr[i]&&i<=localStorage.getItem('remonth'))
                str+="<li onclick=pritem_sel(this,'#picker3')>"+MonthArr[i]+"<span>"+prc.toFixed(2)+"<span>元</li>";
        }
        $(".priceitem").html(str);
    })

    $("#picker4").click(function(){

            $(".pricebox").show();

        }
    );
    function pritem_sel(obj){
        var text=$(obj).find("span").text();
        $("#picker4").val(text);
        $("#price").text(text);
        $("#dateline").text(datechange(EndTime,30*$(obj).index()+30));
        localStorage.setItem('MonthNum',$(obj).index()+1);
        $(".pricebox").hide();

    }
    function datechange(date,days){
        var nd = new Date(date);
        nd = nd.valueOf();
        nd = nd + days * 24 * 60 * 60 * 1000;
        nd = new Date(nd);
        //alert(nd.getFullYear() + "年" + (nd.getMonth() + 1) + "月" + nd.getDate() + "日");
        var y = nd.getFullYear();
        var m = nd.getMonth()+1;
        var d = nd.getDate();
        if(m <= 9) m = "0"+m;
        if(d <= 9) d = "0"+d;
        var cdate = y+"-"+m+"-"+d;
        return cdate;
    }
    //   function datechange(dateTemp, days) {
    //    var dateTemp = dateTemp.split("-");
    //    var nDate = new Date(dateTemp[1] + '-' + dateTemp[2] + '-' + dateTemp[0]); //转换为MM-DD-YYYY格式
    //    var millSeconds = Math.abs(nDate) + (days * 24 * 60 * 60 * 1000);
    //    var rDate = new Date(millSeconds);
    //    var year = rDate.getFullYear();
    //    var month = rDate.getMonth() + 1;
    //    if (month < 10) month = "0" + month;
    //    var date = rDate.getDate();
    //    if (date < 10) date = "0" + date;
    //    return (year + "-" + month + "-" + date);
    // }

    function GetRequest() {
        var url = location.search; //获取url中"?"符后的字串
        var theRequest = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for(var i = 0; i < strs.length; i ++) {
                theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
            }
        }
        return theRequest;
    }


    $(".payact").click(function(){
        var CardPrice=$("#price").text();
        var MonthNum=localStorage.getItem('MonthNum');
        if (CardPrice=='') {
            $.toast("信息不完整");
            return false;

        }
        $.ajax({

            type:'POST',

            url:'getcardlist',

            data: {action:'recardpay',CommunityID:formArray.CommunityID,PlateNumberType:formArray.PlateNumberType,MCId:formArray.MCId,MonthNum:MonthNum,CardPrice:parseFloat(CardPrice),PlateNumber:formArray.PlateNumber,MCCode:formArray.MCCode},

            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },

            dataType:'json',
            beforeSend:function(){

                $.showPreloader();
            },
            success:function(data){
                $.hidePreloader();
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
    })
</script>
</body>
</html>