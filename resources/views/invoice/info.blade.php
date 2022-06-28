<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>开票历史</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <style type="text/css">
        body{background: #efefef}
        .be{color: #1B99FD!important}
        .b{font-weight: 600}
        .bebg{background-color: #1B99FD!important;color: #fff!important}
        .w90{width: 90%!important;margin:0 auto;}
        .empty_data{ position: absolute;left: 0;right: 0;top: 15%;}
        .empty_data img{display: block;margin:0 auto;max-width: 100%;width: 4rem}
        .empty_data p {margin-top: 1.2rem;text-align: center;color: #4d4d4d;font-size: 0.8rem}
        .empty_data  a{text-align: center;color: #fff;font-size: 0.8rem}
    </style>
</head>
<body>


<div class="empty_data" >
    <img src="{{URL::asset('assets/image/invoice_success.png')}}">
    <p class="aui-margin-t-15">申请开票成功，请前往邮箱查看<br>及下载电子发票</p>
    <p class="aui-margin-t-15"><a href="invoice_history"><div class="aui-btn aui-btn-block w90 bebg" id="savein">开票历史</div></a></p>
</div>

</body>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/api.js')}}" ></script>

<script type="text/javascript">
</script>
</html>