<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>开具发票</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <style type="text/css">
        body{background: #efefef}
        input::-webkit-input-placeholder {
            /* placeholder颜色  */
            color: #999;
            /* placeholder字体大小  */
            font-size: 12px;
            /* placeholder位置  */
            text-align: left;
        }
        .aui-list-header{background-color: #efefef!important;font-size: 12px!important;}
        .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
        .noborder{border-bottom:0px solid #E5E5E5!important;}
        .c9{color: #999!important}
        .c8{color: #c8c8c8!important}
        .c4{color: #4d4d4d!important}
        .be{color: #005AAD!important}
        .bebg{background-color: #005AAD!important;color: #fff!important}
        .w90{width: 90%!important;margin:0 auto;}
        .circle{width: 10px;height: 10px;border-radius: 5px;}
        .no-flex{display: block!important;}
        .no-flex img{float: left;margin-right: 5px; margin-top: 4px;}
        .time{width: 14px;height: 14px}
        .h2{padding:0.2rem 0;}

    </style>

</head>
<body>
<div class="contain" id="maininfo">
    <div class="aui-content aui-margin-b-15">
        <form method="post" action="" id="form1">
            <ul class="aui-list aui-form-list">

                <li class="aui-list-item">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-label c8">
                            电子邮件
                        </div>
                        <div class="aui-list-item-input">
                            <input type="text" value="{{$email}}"  class="aui-font-size-14" name="email">
                        </div>
                    </div>
                </li>
                <li class="aui-list-header c9">说明：请输入新邮箱后，再点击提交，系统会给您重新发送电子发票</li>

            </ul>
            <input type="hidden" name="EInvoiceCode" value="{{$EInvoiceCode}}">
        </form>
    </div>
    <p class="aui-margin-t-15"><div class="aui-btn aui-btn-block w90 bebg" onclick="repost()">提交</div></p>
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
    var toast = new auiToast({
    });
    function repost(){
        var email= $("input[name=email]").val();
        if (email=="") {
            toast.fail({
                title:"信息不完整",
                duration:2000
            });
            return;
        }
        $("#form1").submit();


    }




</script>
</html>