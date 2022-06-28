<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>开具发票</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <style type="text/css">
        body{background: #efefef}
        .aui-list-header{background-color: #efefef!important}
        .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
        .noborder{border-bottom:0px solid #E5E5E5!important;}
        .c9{color: #999!important}
        .c4{color: #4d4d4d!important}
        .be{color: #005AAD!important}
        .del{position: absolute;right: 0.5rem;top: 0.75rem;width: 0.8rem}
    </style>
</head>
<body>
<div class="contain" id="maininfo">
    <div class="aui-content aui-margin-b-15">
        <ul class="aui-list  aui-media-list aui-list-in">

            <li class="aui-list-item aui-list-item-arrow">
                <a href="invoice_order">
                    <div class="aui-list-item-inner ">
                        <div class="aui-list-item-title c4">停车订单</div>
                    </div>
                </a>
            </li>
            <li class="aui-list-item aui-list-item-arrow">
                <a href="invoice_cou_order">
                    <div class="aui-list-item-inner ">
                        <div class="aui-list-item-title c4">月卡订单</div>
                    </div>
                </a>
            </li>
            <li class="aui-list-item aui-list-item-arrow">
                <a href="invoice_history">
                    <div class="aui-list-item-inner">
                        <div class="aui-list-item-title c4">开票历史</div>
                    </div>
                </a>
            </li>
            <li class="aui-list-header c4">
                发票抬头
            </li>

            @if($arrdata1['Data']['Count']>0)
            <ul class="aui-list aui-list-in">
                @foreach($arrdata1['Data']['Items'] as $key => $value)
                <li class="aui-list-item ">
                    <div class="aui-media-list-item-inner">
                        <div class="aui-list-item-inner">
                            <div class="aui-list-item-text">
                                <div class="aui-list-item-title"> {{$value['TitleName']}}</div>

                            </div>
                            <img src="{{URL::asset('assets/image/del2.png')}}" class="del" onclick="del({{$value['TitleId']}},'{{$value['TitleName']}}',{{$value['TitleType']}})">
                            <div class="aui-list-item-text aui-ellipsis-2 c9">
                                @if($value['TitleType']==1)
                                    税号：{{$value['TaxpayerNumber']}}
                                @else
                                    个人电子发票
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
                  @endforeach
                @endif
                    <li class="aui-list-item noborder">
                    <a href="invoice_up_add">
                        <div class="aui-info">
                            <div class="aui-info-item">
                                <img src="{{URL::asset('assets/image/add_in.png')}}" style="width:1rem" class="aui-img-round" /><span class="aui-margin-l-5 be">添加发票抬头</span>
                            </div>

                        </div>
                    </a>
                </li>
            </ul>
    </div>

</div>

</body>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/api.js')}}" ></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/aui-toast.js')}}" ></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/aui-dialog.js')}}" ></script>
<script type="text/javascript">
    var toast = new auiToast({
    });
    var dialog = new auiDialog({});
    function del(obj,na,tp){
        console.log(obj);
        dialog.alert({
                title:"操作提示",
                msg:'确定删除内容吗',
                buttons:['取消','确定']
            },function(ret){
                if(ret.buttonIndex==2)
                    $.ajax({
                        url: "invoice_up_add",
                        data: {'TitleId':obj,'typeli':tp,'TitleName':na},
                        headers: {
                            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                        },
                        method:'post',
                        dataType:'json',
                        async: true,
                        success: function (ops) {
                            if (ops.RetCode==0)
                                toast.success({
                                    title:"删除成功",
                                    duration:2000
                                });
                            else
                                toast.fail({
                                    title:"删除失败",
                                    duration:2000
                                });

                        },
                        complete: function () {
                            setTimeout(function(){
                                window.location.reload();
                            }, 2000)

                        }

                    })


            }
        );

    }
</script>
</html>