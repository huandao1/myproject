<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>欠费账单记录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/public.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/loading.css')}}">
    <script src="{{URL::asset('assets/js/hengping.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script src="{{URL::asset('assets/js/axios.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery-3.1.1.js')}}"></script>
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
    <script>
        var deviceWidth = document.documentElement.clientWidth;
        if(deviceWidth > 750) deviceWidth = 750;
        document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';
    </script>
    <style type="text/css">
        [v-cloak]{
            display:none
        }
        .type_switch{height: auto}
        .type_item a{color: #0d57a0}
        .search_act{
            padding: 10px;
            display: flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            -webkit-box-pack: space-around;
            -ms-flex-pack: space-around;
            -webkit-justify-content: space-around;
            justify-content: space-around;
            background-color: #fff;line-height: 24px;}
        .search_act span{line-height: 24px}
        .search_act p{

        }
        .search_act p img{
            width:14px;
            height: 14px;
            margin-left: 6px;
            vertical-align: middle;
        }
        .search_btn{color: #fff;padding: 4px 10px;font-size: 14px; background-color: #0d57a0;border-radius: 2px}

        .bu_btn{width: 1rem;background: #0d57a0;text-align: center;color: white;border-radius: 0.1rem;border: none;padding: 0px 0;float: right;position: absolute;display: block;top: 2px;right: 0rem;}
        .nobu_btn{width: 1rem;background: #666;text-align: center;color: white;border-radius: 0.1rem;border: none;padding: 2px 0;float: right;position: absolute;display: block;bottom: 0px;right: 0rem;}
        .detail{color: #0672d2;float: right;}
        .search_content{padding-bottom: 1.2rem}
        .payorder_li {width:90%;margin:0.2rem auto;padding:0.3rem 0.4rem;background:#fff;position:relative;}
        .payorder_li .pay_detail{border-bottom:1px #f3f3f3 solid; padding-top: 0.1rem; padding-bottom: 0.2rem;}
        .payorder_li .pay_detail label{float: right;}
        input[type="checkbox"],
        input[type="radio"] {
            width: 16px;
            height: 16px;
            background-color:#fff;
            -webkit-appearance:none;
            border:1px solid #c9c9c9;
            border-radius: 2px;
            outline: none;
        }
        input[type="radio"] {border-radius: 50%;}
        input[type="checkbox"]:checked,
        input[type="radio"]:checked {
            background-color: #0d57a0;
            border-color: #0d57a0;
            background-clip: content-box;
            padding:2px;
        }
        .empty{text-align: center;padding: 20px;}
        .empty p{line-height: 0.75rem;color: #666;}
        .payorder_li .pay_detail span{color:#555;}
        .payorder_li .pay_detail1{background:none;position:relative;width:100%;height: 0.5rem;line-height: 0.5rem;margin: 4px auto }
        .payorder_li .pay_detail1 span:first-child{color:#666}
        .payorder_li .pay_detail1 span{color:#333}
        .payorder_li .pay_detail1 span.price{color:#ea2d2d}
        .head_line{width: 90%;height: 0.8rem;align-items: center;display: flex;justify-content: space-between;margin:0 auto;}
        .head_line .li{width: 38%;height: 1px;background-color: #c7c7c7;display: block;}
        .head_line span{color: #c7c7c7;font-size: 0.3rem}
        .lin{width: 89%;height: 1px;background: #f3f3f3;position: absolute;bottom: 10px;}
        .search_sel_res{position: fixed;bottom: 0;width: 100%;height: 1rem;padding: 5px;display: flex;justify-content: space-around;    align-items: center;background-color: #f2f2f2}
        .search_sel_res p{color: #333;    line-height: 1rem;}
        .search_sel_res p span{color: #e00505;}
        .search_sel_res input[type="button"]{color: #fff;background-color:#0d57a0;padding: 4px 10px;border-radius: 4px}
        .loadmsg{text-align: center;color: #666;font-weight: normal;}
        .noPlate{
            margin-top:103px;
            text-align: center;
            padding: 30px
        }
        .noPlate p{
            font-size: 17px;
            color: #1A1A1A
        }
        .noPlate a{
            display: block;
            margin-top:70px;
            padding: 12px;
            border-radius: 5px;
            background: #2559A6;
            color: #fff
        }
        .carnobox,.pricebox{position: fixed;bottom: 0px; width: 90%;left: 5%;z-index: 9999;background: #fff;border-radius: 5px; padding: 5px;display:none}
        .headarea{color: #666;font-size: 16px;text-align: center;padding:5px;order-bottom: 1px solid #ececec;}
        .carnobox ul,.pricebox ul{max-height: 130px;overflow-y: scroll;margin-bottom:10px}
        .carnobox ul li{text-align: center;padding:10px 0;margin:2px 0;color:#1481e0}
        .carnobox img{ width: 22px; height: 22px }
        .pricebox ul li{text-align: center;margin:2px 0;color:#1481e0}
        .addact{width: 90%;
            /* height: 1rem; */text-align: center; display: block;padding: 8px;margin: 0 auto;background: #1481e0;color: #fff;border-radius: 5px;}
        .parkareabox{position: fixed;width: 100%;height: 100%;z-index: 9999;background: #efefef;display: none;overflow: auto;}
        .parkareabox ul li{width: 100%;padding: 10px;color: #666;background: #fff;margin-bottom: 10px;align-items: center;font-size: 14px}
        .parkareabox ul li img{width: 24px;height: 24px;float: right;margin-left: 20px;display: none}
        .parkareabox ul li.active img{display: block}
        .close{position: absolute;right: 8px;top: 10px;color: #333;}
        .parkareaitem li p{display: contents;}
    </style>





</head>
<body>
<div  class="main" id="app" v-cloak>
    <div class="top">
        <div class="type_switch">
            <div class="type_item"><a href="pay_bupay?type=2">已登记停车欠费记录</a></div>
            <div class="type_item active"><div>收费告知单欠费记录</div></div>
        </div>
    </div>
    <div class="search_content">
        <div class="search_act"  v-if="this.carno_data.length>0">
            <span>请选择车牌号</span>
            <p @click='handleSelect'>@{{this.carno_data[this.carnoSelected]['CarNo']}}<img src='{{ URL::asset('assets/image/down.png') }}' /></p>
            <input type="button" value="查询" class="search_btn" @click="search">
        </div>
        <div class="search_res">
            <div v-if="parking_order.length>0">
                <div class="head_line" ><span class="li"></span><span>正在进行</span><span class="li"></span></div>
                <ul class="payorder_li" v-for="(it,i) in parking_order">
                    <li class="pay_detail" ><span>@{{ it.SectionName }}/@{{ it.AreaName }}/@{{ it.BerthCode }}</span>
                    </li>
                    <li class="pay_detail1"><span>入场时间：</span><span >@{{ it.StartParkingTime }}</span></li>

                    <li class="pay_detail1"><span>停车时长：</span><span>@{{Math.floor(it.ParkDuration/60)}}小时@{{ it.ParkDuration%60 }}分钟</span><a href="javascript:void(0)"  @click="for_setail(it)" class="detail">订单详情</a></li>

                    <li class="pay_detail1"><span>待缴金额：</span><span class="price">￥@{{ it.ArrearsPrice }}</span>
                        <a href="javascript:void(0)"
                           @click='goToOrder(it)'
                           class="bu_btn" :style='!(it.ArrearsPrice-0)?"background:#ccc":""' >补缴</a>
                    </li>
                    <div class="lin"></div>
                </ul>

            </div>
            <div v-if="history_order == ''  ? false : true">
                <div class="head_line"><span class="li"></span><span>历史订单</span><span class="li"></span></div>
                <ul class="payorder_li" v-for="(it,i) in history_order">
                    <li class="pay_detail"><span>@{{ it.SectionName }}/@{{ it.AreaName }}/@{{ it.BerthCode }}</span>
                        <label><input  type="checkbox" :checked="PeccPiceCodes.indexOf(it.PeccPiceCode)>=0" name="checkboxinput" @change="checkedOne($event,it.PeccPiceCode,it.ArrearsPrice)"  /></label>
                    </li>
                    <li class="pay_detail1"><span>入场时间：</span><span >@{{ it.StartParkingTime }}</span></li>

                    <li class="pay_detail1"><span>停车时长：</span><span>@{{Math.floor(it.ParkDuration/60)}}小时@{{ it.ParkDuration%60 }}分钟</span><a href="javascript:void(0)" class="detail" @click="for_setail(it)">订单详情</a></li>

                    <li class="pay_detail1"><span>待缴金额：</span><span class="price">￥@{{ it.ArrearsPrice }}</span></li>
                    <div class="lin"></div>
                </ul>

            </div>
        </div>

        <div v-show="result&&this.carno_data.length<=0" class='noPlate'>
            <p>您暂无车牌信息，请添加车牌后查询</p>
            <span><a href="chepai?source_url=arrears">去添加</a></span>
        </div>
    <!-- @{{result}}@{{paging.PageIndex}} -->
        <div class="empty" v-show="result&&paging.PageIndex==1&&this.carno_data.length>0">
            <img src="{{ URL::asset('assets/image/noth.png') }}">
            <p>您当前没有欠费订单！</p>
        </div>
        <h2 class="loadmsg" v-if="paging.isTrue||history_order.length>5">@{{paging.loadingMessage}}</h2>
    </div>

    <div class="search_sel_res" v-if="this.carno_data.length>0">
        <!--        <input type="checkbox"  :checked="PeccPiceCodes.length==20 && PeccPiceCodes.length"  @click="checkedAll" class="allsel"> -->
        <input type="checkbox" :checked="PeccPiceCodes.length==history_order.length && PeccPiceCodes.length" @click="checkedAll" class="allsel">
        <p>首页全选&nbsp;&nbsp;已选<span>@{{PeccPiceCodes.length}}</span>单</p>
        <p>合计:<span>￥@{{total_money}}</span></p>
        <input type="button" @click="dopay" class="paydo" value="立即支付">
    </div>
    <div class="loader" v-show="loadingstatus">
        <div class="loader-inner ball-clip-rotate-multiple">
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="alsrtInfo" :style="{display: displayStsates}" ref="alertMsg">
        <div class="profPrompt_test">@{{aletMsg}}</div>
    </div>
    <div class="carnobox" :style='{display: this.showSelect?"block": "none" }'>
        <div class="headarea">请选择车牌</div>
        <a href="javascript:void(0)" @click="handleSelect()" class="close"><img src='{{ URL::asset('assets/image/Close.png') }}' alt='' title='' /></a>
        <ul class="carnoitem">
            <li v-for='(item,index) in this.carno_data' @click='selectPalte(item)'>@{{item['CarNo']}}</li>
        </ul>
        <a class="addact" href="chepai?source=monthcard">新增车牌</a>
    </div>
</div>
</body>
</html>
<script src="{{URL::asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<script src="https://cdn.bootcss.com/fastclick/1.0.6/fastclick.js"></script>
<script>
    $(function(){
        var refer =document.referrer;
        var http = window.location.protocol;
        var domain=document.domain;
        if(refer == http+"//"+domain+'/login_password' || refer == http+"//"+domain+'/zhuce' || refer == http+"//"+domain+'/login_sms'){
            pushHistory()
            window.addEventListener("popstate", function(e) {
                window.location.href='user_index';//根据自己的需求实现自己的功能
            }, false)};
    });

    window.onload=function(){
        FastClick.attach(document.body);
    }


</script>
<script>
    // 创建vue实例对象
    var app = new Vue({
        el: "#app",    // 元素
        // 所有的数据都放在数据属性里
        data: {
            showSelect:false,
            carno_data: [],
            carnoSelected:'',
            search_result:[],
            parking_order:[],
            history_order:'',
            parking_status:false,
            PeccPiceCodes:[],
            total_money:0.00,
            selarr:[],
            result:false,
            isCheckedAll: false,
            loadingstatus:true,
            aletMsg: '合并支付订单数已达到限制', // 弹出框中的提示语
            displayStsates: 'none',
            paging: {
                PageIndex: 1,
                PageSize: 20,
                isTrue: false,
                showLoading: false,
                loadingMessage: "上拉加载更多~"
            }, //分页
        },
        created() {
            // this.result=true;
            this.carno_data=<?php echo $carno_data ?>;
            console.log(this.carno_data)
            this.carno_data=JSON.stringify(this.carno_data);
            var obj3 = JSON.parse(this.carno_data);
            this.carno_data=obj3['Data']['Items'] || [];
            for (var i = this.carno_data.length - 1; i >= 0; i--) {
                this.carno_data[i]['id']=i
            }
            console.log(this.carno_data[0].id)
            this.carnoSelected = this.carno_data.length>0 ? this.carno_data[0].id : '';

            var urlCarNo = decodeURIComponent(this.getQueryString('CarNo'))
            console.log(urlCarNo,'1221')
            if(urlCarNo){
                if(this.carno_data.length===0){
                    this.carno_data.push({ CarNo: urlCarNo, id: 0, Bind:0 })
                    this.carnoSelected = 0
                }
                else if(this.carno_data.length > 0){
                    console.log('haveCar')
                    var carIndexs = []
                    for(var i = 0 ; i < this.carno_data.length; i++){
                        if(urlCarNo == this.carno_data[i]['CarNo']){
                            carIndexs.push(this.carno_data[i]['id'])
                        }
                    }
                    // var carIndex = carIndexs[0]
                    if(carIndexs.length){
                        this.carnoSelected = carIndexs[0]
                    }
                    else{
                        console.log('adasdas')
                        this.carno_data.push({ CarNo: urlCarNo, id: this.carno_data.length, Bind:0 })
                        this.carnoSelected =  this.carno_data.length - 1
                    }
                }
            }
        },
        mounted(){
            //监听滚动
            window.addEventListener('scroll', () => {
                this.handleScroll();
            });
            //初始加载数据
            setTimeout(() => {
                this.getList();
            }, 1000);
        },
        methods:{
            handleSelect(){
                this.showSelect = !this.showSelect
            },
            selectPalte(item){
                this.carnoSelected = item.id
                this.handleSelect()
            },
            getQueryString(name) {
                var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
                var r = window.location.search.substr(1).match(reg); //获取url中"?"符后的字符串并正则匹配
                var context = "";
                if (r != null){
                    context = r[2];
                }
                reg = null;
                r = null;
                return context == null || context == "" || context == "undefined" ? "" : context;
            },
            goToOrder(it){
                if(!(it.ArrearsPrice-0)){
                    return
                }
                window.location.href='pay_dingdan_noapply?ordercode='+it.PeccPiceCode+'&carCode='+ it.InPeccancyPlateNumber
            },
            search(){
                var _this=this;
                this.history_order= [];
                this.PeccPiceCodes= [];
                this.paging.PageIndex=1;
                this.total_money=0;
                this.loadingstatus=true;
                this.getList();

            },
            checkedOne (obj,pid,price) {
                console.log(obj.target)
                var _this=this;
                let idIndex = this.PeccPiceCodes.indexOf(pid)
                if (idIndex >= 0) {//如果已经包含就去除
                    this.PeccPiceCodes.splice(idIndex, 1);
                    this.total_money=this.total_money-(price-0)
                } else {//如果没有包含就添加
                    if(this.PeccPiceCodes.length>19){
                        obj.target.checked = false;
                        _this.alertDia(_this.aletMsg);
                        return false;
                    }

                    this.PeccPiceCodes.push(pid);
                    this.total_money=this.total_money+(price-0);

                    // this.total_money=this.total_money.toFixed(2)
                }
                console.log(this.PeccPiceCodes)
            },
            checkedAll (e) {
                this.isCheckedAll = e.target.checked;
                if (this.isCheckedAll) {//全选时
                    this.PeccPiceCodes = [];
                    this.total_money=0;
                    this.history_order.forEach(item => {
                        if(this.PeccPiceCodes.length>19){
                            return;
                        }
                        else{
                            this.PeccPiceCodes.push(item.PeccPiceCode);
                            this.total_money=this.total_money+(item.ArrearsPrice-0)
                        }
                    })
                } else {
                    this.PeccPiceCodes = [];
                    this.total_money=0.00;
                }
            },
            for_setail(item){
                localStorage.setItem('detail_item', JSON.stringify(item));
                window.location.href='arrears_detail.php';
            },
            dopay(){
                localStorage.setItem('PeccPiceCodes_sel', JSON.stringify(this.PeccPiceCodes));
                if(this.total_money==0){
                    this.alertDia('无可支付订单');
                    return;
                }
                if(this.PeccPiceCodes.length == 1){
                    var code = this.PeccPiceCodes[0]
                    var it = {}
                    for(var i = 0; i < this.history_order.length; i++ ){
                        var theOrder = this.history_order[i]
                        if(code == theOrder.PeccPiceCode){
                            it = theOrder
                        }
                    }

                    // 跳转订单支付
                    window.location.href='pay_dingdan_noapply?ordercode='+it.PeccPiceCode+'&carCode='+ it.InPeccancyPlateNumber

                }
                else{
                    window.location.href='arrears_pay.php?PayPrice='+this.total_money;
                }
            },
            handleScroll() {
                var that = this;
                //判断滚动到底部
                // console.log(document.body.scrollTop);
                // console.log(document.body.clientHeight);
                //  console.log(document.body.scrollHeight);
                if (document.body.scrollTop >= document.body.scrollHeight - document.body.clientHeight) { //滚动高度>=页面高度-屏幕高度
                    // console.log('测试高度');return;

                    if (that.paging.isTrue) {
                        that.loadingstatus=true;
                        setTimeout(function() {
                            that.paging.PageIndex++;
                            that.paging.showLoading = true;
                            that.paging.loadingMessage = "正在加载中~";
                            that.getList();
                        }, 1000); //防止连续下拉
                        that.paging.isTrue = false;
                    }
                }
            },
            getList() {
                var that = this;
                var datas = [];
                that.parking_order = []
                var j=0;
                axios.post('pay_getarrears', {
                    PageIndex:that.paging.PageIndex,
                    PageSize:that.paging.PageSize,
                    carCode: that.carno_data.length> 0 ? that.carno_data[that.carnoSelected]['CarNo'] : '' //  '粤C55440'  //

                }).then(function (res) {
                    datas = [];
                    that.parking_order = []
                    that.loadingstatus=false;
                    var response = res.data.Data.data ? res.data.Data: { data:{ items:[], ParkingItem:[] } }
                    that.search_result=response.data;
                    that.search_result.items = response.data.ParkingItem.concat(response.data.items)

                    // console.log(that.search_result.items.length);
                    if (that.search_result.items.length>0)
                    {

                        that.result=false;
                        for (let i = 0; i < that.search_result.items.length; i++) {
                            //console.log(that.search_result.items[i])
                            if(that.search_result.items[i]['FineStatus']==1){
                                //console.log(that.search_result.items[i])
                                that.parking_order.push(that.search_result.items[i]);
                            }
                            else{
                                datas.push(that.search_result.items[i]);
                            }
                            j++;
                        }
                        // console.log(that.parking_order)
                        that.parking_status = true;
                        that.paging.PageIndex == 1 ? that.history_order = datas : that.history_order = that.history_order.concat(datas);
                        // console.log(datas.length);
                        // console.log(that.paging.PageSize)
                        if (datas.length + that.parking_order.length < that.paging.PageSize) {
                            that.paging.isTrue = false;
                            that.paging.loadingMessage = "暂时没有更多内容了哦~";
                        } else {
                            that.paging.isTrue = true;
                            that.paging.loadingMessage = "上拉加载更多~";
                        }
                    }
                    else{
                        that.parking_order.length = 0;
                        that.parking_status = false;
                        that.history_order.length = 0;
                        that.result=true;
                        that.paging.isTrue = false;
                    }
                    console.log(that.parking_order.length);
                    console.log(that.history_order.length);
                }).catch(function (error) {
                    console.log(error);
                });


            },
            alertDia(msg) {
                this.displayStsates = 'block'
                this.aletMsg = msg
                // 延迟2秒后消失 自己可以更改时间
                window.setTimeout(() => {
                    this.displayStsates = 'none'
                }, 2000)
            }
        },
    })
</script>