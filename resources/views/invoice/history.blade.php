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
        .aui-list-header{background-color: #efefef!important}
        .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
        .noborder{border-bottom:0px solid #E5E5E5!important;}
        .geline{width: 100%;height: 10px;background-color: #efefef!important}
        .price{position: absolute;right: 0.75rem;bottom: 0.5rem;color: #F8454D;font-size: 0.6rem}
        .price .b{font-size: 1.2rem;font-weight: 600}
        .c9{color: #999!important}
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
        .aui-list-item-arrow:before{top: 25%;}
        .empty_data{ position: absolute;left: 0;right: 0;top: 30%;}
        .empty_data img{display: block;margin:0 auto;max-width: 100%;width: 4rem}
        .empty_data p{text-align: center;color: #4d4d4d;margin-top: 1.2rem;font-size: 0.8rem}
        .nextpage{display: none;margin:0 auto;text-align: center;}
        .nextpage a{color: #fff;padding: 5px 8px;    background-color: #b1b1b1;
            border-radius: 5px;}
    </style>
</head>
<body>
@if($arrdata1['Data']['Count']>0)
<div class="contain" id="maininfo">

    <div class="aui-content aui-margin-b-15">
        <ul class="aui-list  aui-media-list aui-list-in oli">

            @foreach($arrdata1['Data']['Items'] as $key => $value)
            <li class="aui-list-item aui-list-item-middle ">
                <a href="javascript:void(0)" title="invoice_detail?eid={{$value['EInvoiceCode']}}&EInvoiceType={{$value['EInvoiceType']}}" onclick="showdetail(this)">
                    <div class="aui-media-list-item-inner">
                        <div class="aui-list-item-inner aui-list-item-arrow">
                            <div class="aui-list-item-text">
                                <div class="aui-list-item-title no-flex h2 aui-font-size-14">
                                    <img src="{{URL::asset('assets/image/time.png')}}" class="time aui-margin-r-10">
                                   {{$value['ApplyTime']}}
                                </div>
                                <div class="aui-list-item-right">
                                    @if($value['OrderStatus']==0)
                                        待开票
                                    @else
                                        已开票
                                    @endif
                                    </div>
                            </div>
                            <div class="aui-list-item-text no-flex">
                                <p>电子发票</p>
                                <p>停车发票</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="loacldata" value="@php $jsda = implode(',', $value); echo $jsda;@endphp">
                    <p class="price"><span class="b">{{$value['InvoicePrice']}}</span>元</p>
                </a>
            </li>

            <div class="geline"></div>

          @endforeach

        </ul>
        <div class="nextpage"><a href="invoice_history?p={{$arrdata1['Data']['LastId']}}">下一页</a></div>
    </div>
</div>
@else
<div class="empty_data" >
    <img src="{{URL::asset('assets/image/no_invoice.png')}}">
    <p>您还没有开票历史</p>
</div>
@endif
</body>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>


<script type="text/javascript">
    function showdetail(ts) {
        var er = $(ts).find("input").val();
        localStorage.setItem("invoice_data",er);
        window.location.href=$(ts).attr("title");
    }
    $(function(){
        var le=$('.oli').children('li').length;
        console.log(le);
        if (le==10) {
            $(".nextpage").show();
        }
    })
</script>
</html>