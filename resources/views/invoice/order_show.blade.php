<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>订单详情</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/aui/aui.css')}}" />
    <style type="text/css">
        body{background: #efefef}
        .aui-list-header{background-color: #efefef!important}
        .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
        .geline{width: 100%;height: 10px;background-color: #efefef!important}
        .noborder{border-bottom:0px solid #E5E5E5!important;}
        .c9{color: #999!important}
        .c4{color: #4d4d4d!important}
        .be{color: #1B99FD!important}
        .b{font-weight: 600}
        .bebg{background-color: #1B99FD!important;color: #fff!important}
        .w90{width: 90%!important;margin:0 auto;}
        .mt90{margin-bottom:90px}
        .circle{width: 10px;height: 10px;border-radius: 5px;}
        .no-flex{display: block!important;}
        .no-flex img{float: left;margin-right: 5px; margin-top: 4px;}
        .time{width: 14px;height: 14px}
        .h2{padding:0.2rem 0;}
        .aui-radio:checked{background-color:#005AAD!important;border-color:#005AAD!important; }
        .price{position: absolute;right: 10px;top: 0.5rem;color: #F8454D;font-size: 0.8rem}
        .price .b{font-size: 1.2rem}
        .discount_mount{color: #da1212}
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
        <ul class="aui-list aui-select-list mt90">
            @foreach ($arrdata1['Data']['Items'] as $key => $value)
            @php $er=$value['ActualPrice']-$value['DiscountCharge'];@endphp
            <li class="aui-list-item">
                <div class="aui-list-item-inner no-flex">
                    <div class="aui-list-item-text no-flex h2">
                        <img src="{{URL::asset('assets/image/time.png')}}" class="time">
                        {{$value['AddTime']}}
                    </div>
                    <div class="aui-list-item-text no-flex h2">
                        <img src="{{URL::asset('assets/image/dot1.png')}}">
                        {{$value['ParkingName']}}
                    </div>
                    <div class="aui-list-item-text no-flex h2">
                        <img src="{{URL::asset('assets/image/dot2.png')}}">
                        车牌号：{{$value['PlateNumber']}}

                    </div>
                    <p class="price"><span class="b">{{$value['ActualPrice']}}</span>元</p>
                </div>
            </li>
            <div class="geline"></div>
           @endforeach






        </ul>


    </div>
</div>

</body>
<script type="text/javascript" src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('assets/js/aui/api.js')}}" ></script>

<script type="text/javascript">
    window.onpageshow = function(event){
        if (event.persisted) {
            window.location.reload();
        }
    }
    var arr=[];
    var t=0;
    var allsel=false;

</script>
</html>