<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
</head>
<body>
<script src="{{URL::asset('assets/js/jquery-3.1.1.js') }}"></script>
<script src="{{URL::asset('assets/layer/layer.js') }}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/aui-toast.js')}}"></script>
{{URL::asset('assets/image/logo.png') }}<br>
<input type="button" value="提" onclick="ti()">
<br>

{{--<form action="login_sms" method="post">
    @csrf
    <input type="text" name="phone" value="">
    <input type="submit" value="提交">
</form>--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    function ti(){
        $.ajax({
            url: 'test?phone=2222',
            data: {'phone':'1322'},
            method:'post',
            dataType:'json',
            //header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (ops) {
                if (ops.RetCode==0){
                    alert(ops.phone);
                }
            }
        })
    }

/*   layer.open({
       type: 2
       ,content: '支付请求中，请稍等...'
   });*/

  /* var toast = new auiToast({});
   toast.loading({
       title: '加载中'
   });
/*   layer.open({
       content: '请输入正确的电话号码！'
       , skin: 'msg'
   });*/

</script>

</body>
</html>