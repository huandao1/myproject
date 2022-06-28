<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>添加发票抬头</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <style type="text/css">
        body{background: #efefef}
        .aui-list-header{background-color: #efefef!important}
        .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
        .noborder{border-bottom:0px solid #E5E5E5!important;}
        .c9{color: #999!important}
        .c4{color: #4d4d4d!important}
        .be{color: #005AAD!important}
        .b{font-weight: 600}
        .bebg{background-color: #005AAD!important;color: #fff!important}
        .w90{width: 90%!important;margin:0 auto;}
        .isRequest{
            color: red;
            line-height: 46px;
            font-size: 14px;
            padding-right: 6px;
        }
    </style>

</head>
<body>
<div class="contain" id="maininfo">
    <div class="aui-content aui-margin-b-15">
        <form action="invoice_up_add" method="post" id="form1">
            @csrf
            <ul class="aui-list aui-form-list">
                <li class="aui-list-item">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            <span class='isRequest'>*</span>抬头类型
                        </div>
                        <div class="aui-list-item-input">
                            <label class="aui-font-size-12 c9 aui-margin-r-15"><input class="aui-radio be" type="radio" value="1" name="typeli" checked> 企业单位</label>
                            <label class="aui-font-size-12 c9"><input class="aui-radio  " value="2" type="radio" name="typeli" > 个人/非企业单位</label>
                        </div>

                    </div>
                </li>

                <li class="aui-list-item">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            <span class='isRequest'>*</span>发票抬头
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text" id="title" name="TitleName" placeholder="填写发票抬头" class="c9 aui-font-size-12">
                        </div>
                    </div>
                </li>
                <li class="aui-list-item company">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            <span class='isRequest'>*</span> 税号
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text" name="TaxpayerNumber" placeholder="填写纳税人识别号 " class="c9 aui-font-size-12">
                        </div>
                    </div>
                </li>
                <li class="aui-list-item company">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            企业地址
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text"  name="BusinessAddress" placeholder="非必填" class="c9 aui-font-size-12">
                        </div>
                    </div>
                </li>
                <li class="aui-list-item company">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            银行账号
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text" name="BankAccount" placeholder="非必填" class="c9 aui-font-size-12">
                        </div>
                    </div>
                </li>
                <li class="aui-list-item company">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            电话号码
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text" name="PhoneNumber" placeholder="非必填" class="c9 aui-font-size-12">
                        </div>
                    </div>
                </li>
                <!-- <li class="aui-list-item company">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c4">
                            邮箱
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text" id="email" name="email" placeholder="非必填" class="c9 aui-font-size-12">
                        </div>
                    </div>
                </li> -->
            </ul>
        </form>
    </div>
    <p class="aui-margin-t-15"><div class="aui-btn aui-btn-block w90 bebg" id="savein">保存</div></p>
</div>

</body>
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
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/api.js')}}" ></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/aui-toast.js')}}" ></script>


<script type="text/javascript">
    apiready = function(){
        api.parseTapmode();
    }
    function checkTaxpayerId(taxpayerId){
        taxpayerId=taxpayerId.replace(/\s/g,"");
        if(/^(\w){15,20}$/.test(taxpayerId)){
            return true;
        }
        else{
            return false;
        }
    }
    var toast = new auiToast({
    });
    var type=1;
    $("#savein").click(function(){
        var tnum=$('input[name=TaxpayerNumber]').val();
        var tnme=$("input[name=TitleName]").val();
        console.log(tnum);
        console.log(type);
        if (type==1) {
            if (tnum==''||tnme=='') {
                toast.fail({
                    title:"信息不完整",
                    duration:2000
                });
                return;
            }
            if (!checkTaxpayerId(tnum)) {
                toast.fail({
                    title:"税号格式有误",
                    duration:2000
                });
                return;
            }
        }
        else{
            if (tnme=='') {
                console.log(tnme);
                toast.fail({
                    title:"信息不完整",
                    duration:2000
                });
                return;
            }
        }
        var titleValue = $('#title').val()
        var emailValue = ''
        if(emailValue){
            var invoiceList = localStorage.getItem('invoice_list')
            if(invoiceList){
                invoiceList = JSON.parse(invoiceList)
            }
            else{
                invoiceList = []
            }
            var list = invoiceList.concat([{ title: titleValue, email: emailValue  }])

            localStorage.setItem('invoice_list', JSON.stringify(list))
        }
        // console.log(titleValue,emailValue )
        // return
        $("#form1").submit();
    })
    $("input[name=TaxpayerNumber]").keyup(function() {
        console.log(this.value);
        this.value =this.value.replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
    });
    $(document).ready(function() {
        $('input[type=radio][name=typeli]').change(function() {
            if (this.value == '2') {
                type=2;
                $(".company").hide();
                $("input[name=TitleName]").attr("placeholder","请填写个人姓名")
            }
            else if (this.value == '1') {
                $(".company").show();
            }
        });

    });
</script>
</html>