<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>月卡管理</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="//g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <style type="text/css">
        .nopadding{padding: 0.3rem .5rem}
        .nomargin{margin:.25rem 0;}
        .card{border-radius: .2rem;}
        .card,.card-header{font-size: .7rem}
        .buybtn{position: fixed;bottom: .2rem;width: 90%;left: 5%;padding: .2rem}
        .button.button-fill{height: 1.75rem;line-height: 1.75rem}
        .rebuy{height: 1.4rem !important;line-height: 1.4rem !important}
        .nodata {text-align: center;padding: 1rem;display: none}
        .nodata img{max-width: 100%;width: 30%}
        .intro{padding:0 0.5rem;font-size: .6rem;float: right;margin: .5em 0;}
        .intro img{width: .6rem}
        .clear{clear: both;}
        .card-header{border-bottom: 1px solid #f3f3f3;}
        .communityname{overflow: hidden;text-overflow: ellipsis;white-space: nowrap;font-size: 14px;}
        .card-footer, .card-header{min-height: 2rem;padding: .25rem .5rem;}
        .card-header:before,.card-header:after,.card-footer:before,.card-footer:after{ height:0px}
        .timelimit{font-size: 0.6rem}
        .yu{float: right;font-size: 0.6rem;}
        #evaluation{padding-bottom: 30px;}
        .displayCls{
            background: #a2a2a2 !important;
        }
    </style>

</head>
<body>
<div class="page-group">
    <div class="page page-current">
        <div class="content">

            <div id="evaluation">
            </div>

            <div class="content-block">
                <p class="buybtn"><a href="card_buy"  class="external button button-fill">购买月卡</a></p>

            </div>
        </div>

        <script id="evaluationtmpl" type="text/x-dot-template">

            <p class="intro"><a href="card_explain"><img src="{{URL::asset('assets/image/que.png')}}">月卡说明</a></p>
            <div class="clear"></div>
            @{{~it:value:index}}
            <div class="card">
                <div class="card-header">
                    <span class="communityname">@{{=value.CommunityName}}</span>

                </div>n
                <div class="card-content">
                    <div class="card-content-inner nopadding">@{{=value.PlateNumber}}<P class="nomargin yu">剩余天数：<span>@{{=value.SurplusDay}}天</span></P></div>
                </div>
                <div class="card-footer">
                    <p>有效期&nbsp;<span class="timelimit">@{{=value.StartTime}}至@{{=value.EndTime}}</span></p>
                    @{{? (value.MaxRenewMonth >0 && value.SurplusDay <=14) }} <a href="javascript:void(0)" class="external button button-fill rebuy" onclick="react('@{{=value.MCCode}}', @{{=value.MaxRenewMonth}})">去续费</a>@{{? }}
                    @{{? (value.MaxRenewMonth <0 || value.SurplusDay >14) }} <a href="javascript:void(0)" class="external button button-fill rebuy displayCls" onclick="showTost()">去续费</a>@{{? }}
                </div>
            </div>
            @{{~}}
        </script>
        <div class="nodata">
            <img src="{{URL::asset('assets/image/nodata.png')}}">
            <p>暂无月卡信息</p>
        </div>
    </div>



</div>
<script type='text/javascript' src='//g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
<script type='text/javascript' src='//g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
<script src="{{URL::asset('assets/js/doT.min.js')}}" type="text/javascript"></script>
<script type='text/javascript' src="{{URL::asset('assets/layer/layer.js')}}"></script>
<script type="text/javascript">
    var resdata=[];
    $.ajax({

        type:'POST',

        url:'getcardlist',

        data: {action:'list'},

        headers: {
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },

        dataType:'text',
        beforeSend:function(){
            $.showPreloader();
        },
        success:function(data){
            $.hidePreloader();
            data = data.replace(/\s+/g,'')
            data = JSON.parse(data)
            console.log(data);
            resdata=data.Data.Items;
            for(var i in resdata){
                resdata[i]['EndTime']=addDate(resdata[i]['EndTime'],-1);
            }
            if (data.RetCode==4) {
                $(".nodata").show();
                return;
            }
            if (data.RetCode==5) {
                $.toast('登录失效');
                window.location.href="login_sms?source=cardlist";

            }
            var evalText = doT.template($("#evaluationtmpl").text());

            $("#evaluation").html(evalText(resdata));


        },

        error:function(xhr, type){
            $.hidePreloader();

            // console.log('Ajax error!')

        }

    })
    function addDate(date,days){
        var d=new Date(date);
        d.setDate(d.getDate()+days);
        var month=d.getMonth()+1;
        var day = d.getDate();
        if(month<10){
            month = "0"+month;
        }
        if(day<10){
            day = "0"+day;
        }
        var val = d.getFullYear()+"-"+month+"-"+day;
        return val;
    }
    function react(id,remonth){
        for(var i in resdata){

            if (resdata[i]['MCCode']==id) {
                console.log(resdata[i].PlateNumber);
                var j=i;
                $.ajax({

                    type:'POST',

                    url:'card_renew',

                    data: {PageIndex:1,PageSize:20,carCode:resdata[i].PlateNumber},

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
                                window.location.href = 'pay_noapply?CarNo='+resdata[j].PlateNumber;
                                return false;
                            }else{
                                var MaxRenewMonth = resdata[j].MaxRenewMonth
                                localStorage.setItem('resata',JSON.stringify(resdata[j]));
                                localStorage.setItem('remonth',MaxRenewMonth);
                                window.location.href="card_rebuy";
                            }

                        }else{
                            var MaxRenewMonth = resdata[j].MaxRenewMonth
                            localStorage.setItem('resata',JSON.stringify(resdata[j]));
                            localStorage.setItem('remonth',MaxRenewMonth);
                            window.location.href="card_rebuy";
                        }

                    },

                    error:function(xhr, type){
                        console.log(xhr)
                        console.log('Ajax error!')

                    }

                })

            }

        }
    }
    function showTost(){
        layer.open({
            content: '请在到期前14天再续费',
            skin: 'msg',
            time: 2 //2秒后自动关闭
        });
    }
</script>
</body>
</html>