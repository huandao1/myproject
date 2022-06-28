<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>发票明细</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <style type="text/css">
        body{background: #efefef}
        input::-webkit-input-placeholder {
            /* placeholder颜色  */
            color: #C8C8C8;
            /* placeholder字体大小  */
            font-size: 12px;
            /* placeholder位置  */
            text-align: left;
        }
        .aui-list-header{background-color: #efefef!important}
        .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
        .noborder{border-bottom:0px solid #E5E5E5!important;}
        .c9{color: #666!important}
        .c8{color: #c8c8c8!important}
        .c4{color: #4d4d4d!important}
        .be{color: #005AAD!important}
        .b{font-weight: 600}
        .bebg{background-color: #005AAD!important;color: #fff!important}
        .w90{width: 90%!important;margin:0 auto;}
        .circle{width: 10px;height: 10px;border-radius: 5px;}
        .no-flex{display: block!important;}
        .no-flex img{float: left;margin-right: 5px; margin-top: 4px;}
        .time{width: 14px;height: 14px}
        .h2{padding:0.2rem 0;}
        .geline{width: 100%;height: 10px;background-color: #efefef!important}
        .more{position: absolute;right: 1.25rem;top: 30%;font-size: 12px}
    </style>
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
<div class="contain" id="maininfo">
    <div class="aui-content aui-margin-b-15">
        <ul class="aui-list aui-form-list">

            <li class="aui-list-item">
                <div class="aui-list-item-inner no-flex">
                    <p class="aui-font-size-14 h2 c4">
                        电子发票<span class="status"></span>
                    </p>

                    <p class="aui-font-size-12 h2 c8" id="publictime">
                        2018.09.17  10:30
                    </p>
                    <!--   <a class="more c9" href="" id="picview">查看</a> -->
                </div>
            </li>
            <li class="aui-list-header c9">接收信息</li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        电子邮件
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" id="email" name="email" class="c9 aui-font-size-12">
                    </div>

                </div>
            </li>
            <!-- <div class="geline"></div> -->
            <li class="aui-list-header c9">接受信息</li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        抬头类型
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" id="itype" value="企业单位" name="TitleName" class="c9 aui-font-size-12">
                    </div>

                </div>
            </li>
            <li class="aui-list-item  upadd">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        发票抬头
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" id="tname" name="TitleName" class="c9 aui-font-size-12">
                    </div>
                </div>
            </li>
            <div class="upbox"></div>
            <li class="aui-list-item company">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        税号
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" id="snum" class="c9 aui-font-size-12" name="TaxpayerNumber">
                    </div>
                </div>
            </li>

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        发票金额
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" id="charge" class="be aui-font-size-14"  name="InvoicePrice">
                    </div>
                </div>
            </li>

            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        申请时间
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" id="atime" class=" aui-font-size-14" name="apply_time">
                    </div>
                </div>
            </li>
            <div class="geline"></div>
            <li class="aui-list-item">
                <div class="aui-list-item-inner aui-list-item-arrow no-flex">
                    <p class="aui-font-size-14 h2 c4">
                        1张发票，含{{$arrdata1['Data']['Count']}}个订单
                    </p>

                    <p class="aui-font-size-12 h2 c8">{{$arrdata1['Data']['Items'][0]['StartParkingTime']}}-{{$arrdata1['Data']['Items'][0]['EndParkingTime']}}
                    <!-- 2018.05.01 10:30-2018.09.16 19:00AddTime -->
                    </p>
                    @if($EInvoiceType==1)
                    <a class="more c9" href="invoice_cou_order_show?eid={{$EInvoiceCode}}&type={{$EInvoiceType}}">查看</a>
                    @else
                    <a class="more c9" href="invoice_order_show?eid={{$EInvoiceCode}}&EInvoiceType={{$EInvoiceType}}">查看</a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
    <p class="aui-margin-t-15"><div class="aui-btn aui-btn-block w90 bebg" onclick="resend()">重新发送电子发票</div></p>
</div>

</body>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/api.js')}}" ></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/aui-toast.js')}}" ></script>
<script type="text/javascript">
    apiready = function(){
        api.parseTapmode();
    }
    var toast = new auiToast({
    });

    var idata=localStorage.getItem("invoice_data");
    var arr = idata.split(',');
    console.log(arr);
    $(document).ready(function(){
        $("#tname").val(arr[1]);
        $("#email").val(arr[8]);
        $("#snum").val(arr[6]);
        $("#atime").val(arr[11]);
        $("#publictime").text(arr[11]);
        $("#charge").val(arr[16]+"元");
        if (arr[9]=="1")
            $(".status").text("已开");
        else
            $(".status").text("待开");
        if (arr[2]=="1")
        {$("#itype").val("企业单位");}
        else
        {$("#itype").val("个人");
            $(".company").hide();}
    })
    var ecode="{{$EInvoiceCode}}";
    function resend(){
        window.location.href="invoice_resend?email="+arr[8]+"&encode="+ecode;
    }
</script>
</html>