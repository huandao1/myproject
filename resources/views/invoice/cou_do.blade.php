<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>开具发票</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}"/>
    <style type="text/css">
        body {
            background: #efefef
        }

        input::-webkit-input-placeholder {
            /* placeholder颜色  */
            color: #C8C8C8;
            /* placeholder字体大小  */
            font-size: 12px;
            /* placeholder位置  */
            text-align: left;
        }

        .aui-list-header {
            background-color: #efefef !important
        }

        .aui-list-item {
            background-image: none !important;
            border-bottom: 1px solid #E5E5E5 !important;
        }

        .noborder {
            border-bottom: 0px solid #E5E5E5 !important;
        }

        .c9 {
            color: #666 !important
        }

        .c8 {
            color: #c8c8c8 !important
        }

        .c4 {
            color: #4d4d4d !important
        }

        .be {
            color: #1B99FD !important
        }

        .b {
            font-weight: 600
        }

        .bebg {
            background-color: #1B99FD !important;
            color: #fff !important
        }

        .w90 {
            width: 90% !important;
            margin: 0 auto;
        }

        .circle {
            width: 10px;
            height: 10px;
            border-radius: 5px;
        }

        .no-flex {
            display: block !important;
        }

        .no-flex img {
            float: left;
            margin-right: 5px;
            margin-top: 4px;
        }

        .time {
            width: 14px;
            height: 14px
        }

        .h2 {
            padding: 0.2rem 0;
        }

        /*.personin{display: none!important;}*/
        .aui-radio:checked {
        }

        .submitbox {
            position: fixed;
            bottom: 0;
            background: #fff;
            display: none;
            z-index: 999
        }

        .submitbox h4 {
            text-align: center;
            color: #4D4D4D;
            height: 2rem;
            line-height: 2rem;
            font-size: 0.8rem;
        }

        .submitbox .aui-list-header {
            background: #fff !important;
        }

        .mask {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 990;
            display: none
        }

        .aui-toast-content {
            font-size: 0.6rem
        }

        .isRequest {
            color: red;
            line-height: 46px;
            font-size: 14px;
            padding-right: 6px;
        }

        .upbox {
            height: 0px;
            overflow: hidden;
            transition: height 500ms cubic-bezier(0.470, 0.000, 0.745, 0.715);
            -webkit-transition: height 500ms cubic-bezier(0.470, 0.000, 0.745, 0.715);;
        }

        .upbox.hide {
            height: 0 !important
        }
    </style>
    <script>
        window.alert = function (name) {
            var iframe = document.createElement("IFRAME");
            iframe.style.display = "none";
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
            <li class="aui-list-header c9">发票类型</li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner no-flex">
                    <p class="aui-font-size-14 h2 c4">
                        电子发票
                    </p>
                    <p class="aui-font-size-14 h2 c4">
                        最快5分钟开具
                    </p>
                    <p class="aui-font-size-12 h2 c8">
                        电子发票与纸质发票具有同等法律效力，可支持报销入账
                    </p>
                </div>
            </li>
            <li class="aui-list-header c9">发票详情</li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        抬头类型
                    </div>
                    <div class="aui-list-item-input">
                        <label class="aui-font-size-12 c9 aui-margin-r-15"><input class="aui-radio" type="radio"
                                                                                  name="typeli" value="1" checked> 企业单位</label>
                        <label class="aui-font-size-12 c9"><input class="aui-radio be " type="radio" name="typeli"
                                                                  value="2"> 个人/非企业单位</label>
                    </div>

                </div>
            </li>
            <li class="aui-list-item  upadd">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        <span class='isRequest'>*</span>发票抬头
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="填写发票抬头" name="TitleName" class="c9 aui-font-size-12 companyin"
                               onfocus="getup_data(1)">
                        <input type="text" placeholder="请填写个人姓名" name="TitleName" class="c9 aui-font-size-12 personin"
                               onfocus="getup_data(2)" style="display: none">
                    </div>
                </div>
            </li>
            <div class="upbox"></div>
            <li class="aui-list-item company">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        <span class='isRequest'>*</span>税号
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="填写纳税人识别号 " class="c9 aui-font-size-12" name="TaxpayerNumber">
                    </div>
                </div>
            </li>
            <li class="aui-list-item company">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        企业地址
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="非必填" class="c9 aui-font-size-12" name="BusinessAddress">
                    </div>
                </div>
            </li>
            <li class="aui-list-item company">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        银行账号
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="非必填" class="c9 aui-font-size-12" name="BankAccount">
                    </div>
                </div>
            </li>
            <li class="aui-list-item company">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        电话号码
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="非必填" class="c9 aui-font-size-12" name="PhoneNumber">
                    </div>
                </div>
            </li>
            <li class="aui-list-item company">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        备注信息
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="非必填" class="c9 aui-font-size-12" name="remark">
                    </div>
                </div>
            </li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        发票金额
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="非必填" class="be aui-font-size-14" value="{{$amount}}元"
                               name="InvoicePrice">
                    </div>
                </div>
            </li>
            <li class="aui-list-header c9">接收方式</li>
            <li class="aui-list-item">
                <div class="aui-list-item-inner">
                    <div class="aui-list-item-label c4">
                        <span class='isRequest'>*</span>电子邮件
                    </div>
                    <div class="aui-list-item-input">
                        <input type="text" placeholder="用于向您发送电子发票和行程单" class="be aui-font-size-14" name="email">
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <p class="aui-margin-t-15">
    <div class="aui-btn aui-btn-block w90 bebg" onclick="subpost()">保存</div>
    </p>
</div>
<div class="submitbox">
    <h4>开具电子发票</h4>
    <ul class="aui-list aui-form-list">
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label c9">
                    发票类型
                </div>
                <div class="aui-list-item-input">
                    <input type="text" value="电子发票" class="type aui-font-size-14">
                    <input type="hidden" name="ty">
                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label c9">
                    发票抬头
                </div>
                <div class="aui-list-item-input">
                    <input type="text" value="深圳市凯达尔科技实业有限公司" class="tai aui-font-size-14" id="up">
                </div>
            </div>
        </li>

        <li class="aui-list-item" id="number">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label c9">
                    税号
                </div>
                <div class="aui-list-item-input">
                    <input type="text" value="9144 0300 7084 8067 9W" class="numberd aui-font-size-14">
                </div>
            </div>
        </li>
        <li class="aui-list-item">
            <div class="aui-list-item-inner">
                <div class="aui-list-item-label c9">
                    电子邮件
                </div>
                <div class="aui-list-item-input">
                    <input type="text" value="1323#####@cadre.cn" class="email aui-font-size-14" id="email">
                </div>
            </div>
        </li>
        <li class="aui-list-header c9">请确认邮箱无误，电子发票将在系统开具后发送至您的邮箱，请注意查收</li>

        <p class="aui-margin-t-15">
        <div class="aui-btn aui-btn-block w90 bebg" id="ensure" onclick="ensure()">确认提交</div>
        </p>
    </ul>
</div>
<div class="mask" onclick="guan()"></div>
</body>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/api.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/aui-toast.js')}}"></script>
<script type="text/javascript">
    function unique(arr) {
        var newArr = []
        for (var i = 0; i < arr.length; i++) {
            if (newArr.indexOf(arr[i]) === -1 && arr[i]) {
                newArr.push(arr[i])
            }
        }
        return newArr
    }

    var localEmail = localStorage.getItem('email')
    if (localEmail) {
        $("input[name=email]").val(localEmail);
    }
    apiready = function () {
        api.parseTapmode();
    }
    var toast = new auiToast({});
    var type = 1;
    var amount ={{$amount}};

    function strchange(va) {
        va = va.replace(/\s/g, '').replace(/(\d{4})(?=\d)/g, "$1 ");
        return va;

    }

    function checkTax(obj) {
        obj = obj.replace(/\s/g, "");
        if (/^(\w){15,20}$/.test(obj)) {
            return true;
        }
        else {
            return false;
        }
    }

    function moreinput(de, i) {
        if (de[i].BankAccount != "")
            $("input[name=BankAccount]").val(de[i].BankAccount);
        if (de[i].BankAccount != "")
            $("input[name=PhoneNumber]").val(de[i].PhoneNumber);
        if (de[i].BankAccount != "")
            $("input[name=BusinessAddress]").val(de[i].BusinessAddress);
    }

    var checkedStr = "";

    function getup_data(t) {
        if (!!checkedStr) {
            // console.log('show')
            $(".upbox").removeClass('hide');

            return
        }
        $.ajax({
            url: "invoice_post",
            data: {type: type},
            headers: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            dataType: 'json',
            async: true,
            success: function (ops) {
                if (ops.RetCode == 0) {
                    console.log(ops);
                    var dt = ops.Data.Items;
                    checkedStr = ''
                    console.log(dt);
                    console.log(dt.length);
                    if (dt.length > 0) {
                        $(".upbox").html("");
                        var tIndex = 0
                        for (var index in dt) {
                            if (dt[index].TitleType == t) {
                                tIndex = tIndex + 1
                                checkedStr += '<li class="aui-list-header upli" style="height:47px" onclick="selup(this)">' +
                                    '<p class="clearfix" style="color:#2196F3" address="' + dt[index].BusinessAddress + '" phoneNumber="' + dt[index].PhoneNumber + '" bankAccount="' + dt[index].BankAccount + '" title="' + dt[index].TaxpayerNumber + '">' + dt[index].TitleName + '</p>' +
                                    '<img class="checkedImg" src="{{URL::asset('assets/image/chexuan.png')}}" style="width:30px;height: 30px;display:none" />' +
                                    '</li>';
                            }
                        }

                        //  if (dt[0].TitleType==t) {
                        //  $("input[name=TitleName]").val(dt[0].TitleName);
                        //  $("input[name=TaxpayerNumber]").val(strchange(dt[0].TaxpayerNumber));
                        //  }
                        moreinput(dt, 0);
                        $(".upbox").css({height: tIndex * 47 + 'px'})
                        $(".upbox").html(checkedStr);
                        //console.log(tInde)
                        $(".upbox").removeClass('hide');
                    }
                }
                else {
                    return;
                    //  toast.fail({
                    //     title:"操作失败",
                    //     duration:2000
                    // });
                    // window.location.reload();
                }
            }

        })
    }

    function selup(ts) {
        $('.checkedImg').hide()

        $('.clearfix').css({color: '#2196F3', fontWeight: 500})

        var tn = $(ts).find("p").attr("title");
        var tx = $(ts).find("p").text();
        $("input[name=TitleName]").val(tx);
        $("input[name=TaxpayerNumber]").val(strchange(tn));

        $("input[name=BusinessAddress]").val($(ts).find("p").attr("address"));
        $("input[name=BankAccount]").val($(ts).find("p").attr("bankAccount"));
        $("input[name=PhoneNumber]").val($(ts).find("p").attr("phoneNumber"));

        $(ts).find("img").show()

        $(ts).find("p").css({color: 'rgb(0,90,173)', fontWeight: 600})

        $(".upbox").addClass('hide');

    }

    function clear() {
        $("input[name=TitleName]").val('');
        $("input[name=TaxpayerNumber]").val('');
        $(".upbox").addClass('hide');

    }

    function guan() {
        $(".mask").fadeOut();
        $(".submitbox").hide();

    }

    $(document).ready(function () {
        $('input[type=radio][name=typeli]').change(function () {
            if (this.value == '2') {
                window.location.href = "invoice_cou_do2/" + amount;
            }
            else if (this.value == '1') {
                type = 1;
                $(".company").show();
                $(".companyin").show();
                $(".personin").hide();
                $("#number").show();
            }
        });
        $("input[name=TaxpayerNumber]").keyup(function () {
            console.log(this.value);
            this.value = this.value.replace(/\s/g, '').replace(/(\d{4})(?=\d)/g, "$1 ");
        });

    });

    function subpost() {

        var email = $("input[name=email]").val();

        var typeli = type;
        var TitleName = $("input[name=TitleName]").eq(type - 1).val();
        console.log(typeli);
        console.log(TitleName);
        var TaxpayerNumber = $("input[name=TaxpayerNumber]").val();
        $(".numberd").val(TaxpayerNumber);
        $("#up").val(TitleName);
        $("#email").val(email);

        if (TaxpayerNumber == "" || !checkTax(TaxpayerNumber)) {
            toast.fail({
                title: "请填写正确税号",
                duration: 2000
            });
            return;

        }
        if (TitleName == "") {
            toast.fail({
                title: "请填写发票抬头信息",
                duration: 2000
            });
            // $("input[name=TitleName]").focus();
            return;
        }
        if (email == "" || !/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/.test(email)) {
            toast.fail({
                title: "请填写正确接收邮箱",
                duration: 2000
            });
            $("input[name=emial]").focus();
            return;
        }

        $(".mask").fadeIn();
        $(".submitbox").show();

    }

    function ensure() {
        var ck = false;
        $(".mask").fadeOut();
        $(".submitbox").hide();
        toast.loading({
            title: "申请中",
            duration: 2000
        }, function (ret) {
            console.log(ret);
            setTimeout(function () {
                toast.hide();
            }, 2000)
        });
        // return false;
        var email = $("input[name=email]").val();
        var typeli = type;
        var TitleName = $("input[name=TitleName]").eq(type - 1).val();
        var TaxpayerNumber = $("input[name=TaxpayerNumber]").val();
        var BusinessAddress = $("input[name=BusinessAddress]").val();
        var BankAccount = $("input[name=BankAccount]").val();
        var PhoneNumber = $("input[name=PhoneNumber]").val();
        var InvoicePrice = parseFloat($("input[name=InvoicePrice]").val());
        var Remark = $("input[name=remark]").val();

        var OrderCodeList = sessionStorage.oarr;
        var list = unique(OrderCodeList.split(','));
        OrderCodeList = list.join(',') + ',';

        if (!ck) {
            ck = true;
            $.ajax({
                url: "invoice_cou_post",
                data: {
                    TitleName: TitleName,
                    TitleType: typeli,
                    TaxpayerNumber: TaxpayerNumber,
                    email: email,
                    EInvoiceType: 1,
                    Remark: Remark,
                    BusinessAddress: BusinessAddress,
                    BankAccount: BankAccount,
                    PhoneNumber: PhoneNumber,
                    InvoicePrice: InvoicePrice,
                    OrderCodeList: OrderCodeList,
                    kpje: sessionStorage.kpje
                },
                headers: {
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                },
                method: 'post',
                dataType: 'json',
                async: true,
                success: function (ops) {
                    console.log(ops);
                    toast.hide();
                    if (ops.RetCode == 0 && ops.Message == 'success') {
                        setTimeout(function () {
                            ck = false;
                            window.location.href = "invoice_info";
                        }, 1000)
                    }
                    else {
                        toast.fail({
                            title: ops.Message,
                            duration: 2000
                        });
                        return false;
                    }
                }
            })
        }
    }
</script>
</html>