<?php
include('common.php');
$time=time();
$array=array('AppId'=>AppId,'Nonce'=>$time,'AccessToken'=>$_SESSION['AccessToken'],'LastId'=>0,'pageSize'=>10);
 $signArr = array();
foreach ($array as $k=>$v) {
    if (strlen($v) > 0) $signArr[$k] = $k . '=' . $v;
}
ksort($signArr);
$array['Sign'] = base64_encode(hash_hmac('sha256', implode('&', $signArr), SecretKey, true));
$data= json_encode($array);
$url=URL.'/api/Invoice/GetEInvoiceOrderList';
   // var_dump($data);
    // var_dump($url);
 $arrdata1 = json_decode(curl_request($url,$data),true);
 $last=$arrdata1['Data']['LastId'];
// var_dump($arrdata1);
  // echo"<script>alert('添加成功');history.go(-2);</script>"; 
 
?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title>可开票记录</title>
    <link rel="stylesheet" type="text/css" href="css/aui/aui.css" />
    <link rel="stylesheet" type="text/css" href="css/aui/aui-pull-refresh.css" />
    <style type="text/css">
    body{background: #efefef} 
    .aui-list-header{background-color: #efefef!important}
    .aui-list-item{background-image: none!important;border-bottom:1px solid #E5E5E5!important;}
    .geline{width: 100%;height: 10px;background-color: #efefef!important}
    .noborder{border-bottom:0px solid #E5E5E5!important;}
    .c9{color: #999!important}
    .c4{color: #4d4d4d!important}  
    .be{color: #005AAD!important}
    .b{font-weight: 600}
    .bebg{background-color: #005AAD!important;color: #fff!important}
    .w90{width: 90%!important;margin:0 auto;}
    .mt90{margin-bottom:90px}
    .circle{width: 10px;height: 10px;border-radius: 5px;}
    .no-flex{display: block!important;}
    .no-flex img{float: left;margin-right: 5px; margin-top: 4px;}
    .time{width: 14px;height: 14px}
    .h2{padding:0.2rem 0;}
    .aui-radio{cursor: pointer;}
    .price{position: absolute;right: 10px;top: 0.5rem;color: #F8454D;font-size: 0.8rem}
    .price .b{font-size: 1.2rem}
    .discount_mount{color: #da1212}
    .sel_all {width: 100%;position: fixed;bottom: 0;left: 0;height: 90px;padding: 0.2rem 0.5rem;    background: #ffffff;}
    .sel_all p{line-height: 24px;height: 24px}
    .sel_all label{color: #666!important; font-size: 0.7rem}
    .sel_all .che_sel{padding-top: 5px;padding-right: 0.75rem}
    .next{float: right;text-align: center;color: #fff;border-radius: 4px;background: none;border: none}
    #no-data{display: none;position: fixed;top: 0;left: 0}
    .aui-toast-content{
        font-size: 0.6rem
    }
    .aui-dialog-body{font-size: 0.6rem;}
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
    <div class="aui-tips aui-margin-b-15" id="no-data">
        <i class="aui-iconfont aui-icon-info"></i>
        <div class="aui-tips-title">暂无更多信息</div>
        <i class="aui-iconfont aui-icon-close"></i>
    </div>
    <div class="contain aui-refresh-content" id="maininfo">
     <div class="aui-content aui-margin-b-15">
    <ul class="aui-list aui-select-list mt90" id="orbox">
        <?php foreach ($arrdata1['Data']['Items'] as $key => $value) { if ($value['IsOpenInvoice']==0) {
           echo $value['KKPJE'];
         $er=$value['ActualPrice']-$value['DiscountCharge'];?> 
        <li class="aui-list-item">
            <div class="aui-list-item-label">
                <input class="aui-radio" type="checkbox" name="sel" onclick="ert(this)" value="<?php echo $value['BargainOrderCode'].'-'.$value['KKPJE'].'-'.$value['DiscountCharge']; ?>">
                <input  type="hidden" name="kpje" value="<?php echo $value['KKPJE'] ?>">
            </div>
            <div class="aui-list-item-inner no-flex">
                <div class="aui-list-item-text no-flex h2">
                    <img src="image/time.png" class="time">
                   <?php echo $value['EndParkingTime'] ?>  
                </div>
                <div class="aui-list-item-text no-flex h2">
                    <img src="image/dot1.png">
                    <?php echo $value['ParkingName'] ?>
                </div>
                <div class="aui-list-item-text no-flex h2">
                    <img src="image/dot2.png">
                    车牌号：<?php echo $value['PlateNumber'] ?>
                   
                </div>
                 <p class="price"><span class="b"><?php echo $value['KKPJE'] ?></span>元</p>
            </div>
        </li>
         <div class="geline"></div>
<?php
    } 
}
?>
       
       
      
      
       
     
    </ul>

  
</div> 
    </div>
    <div class="sel_all">
        <p><span class="be num">0</span>个订单，共<span class="be all">0.00</span>元(<span class="discount_mount">不可开票额度0.00元</span>)</p>
        <p class="aui-font-size-12 c9">不可开票额度指的是用户充值赠送金额抵扣的金额总额</p>
        <div class="che_sel">
        <label class="aui-margin-r-15"><input class="aui-radio" type="radio" name="allsel" > 本页全选</label>
        <label><input class="aui-radio" type="radio" name="entiresel"> 全部全选</label>

        <button class="next bebg">下一步</button>
        </div>
    </div>
    </body>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/aui/api.js" ></script>
    <script type="text/javascript" src="js/aui/aui-scroll.js" ></script>
    <script type="text/javascript" src="js/aui/aui-dialog.js" ></script>
     <script type="text/javascript" src="js/aui/aui-toast.js" ></script>
    
    <script type="text/javascript">
        window.onpageshow = function(event){
        if (event.persisted) {
        window.location.reload();
        }
        }
        var arr=[];
        var t=0;
        var allsel=false;
        var entiresel=false;
        var lastid="<?php echo $last;?>";
        var toast = new auiToast({
         });
         var dialog = new auiDialog({});
          function ert(ts){
                        var sr=ts.value.split('-')
                        var json = {"id":sr[0],"amount":sr[1],"discount":sr[2],"kpje":$(ts).next().val()};
                        if(ts.checked==true){
                            arr.push(json);
                           t++;  
                        }
                       else{
                        $(arr).each(function(index,item){
                        if (item.id==sr[0]) 
                         arr.splice(index, 1);
                            });
                        t--;
                       }
                       checksel();
                     }
                   
        function checksel(){
            var p=0;
            var d=0;
            var k=0;
            var oid="";
            var len=arr,length;
              $(arr).each(function(index,item){ 
             //index指下标 
             //item指代对应元素内容 
             //this指代每一个元素对象 
              // console.log(item);
             p=p+parseFloat(item.amount);
             d=d+parseFloat(item.discount);
             k=k+parseFloat(item.kpje);
             // console.log(p);
             if(index!=(len-1))
                oid +=item.id+",";
             //console.log($(this)); 
         });
              console.log(p);
          $(".be").text(p.toFixed(2));
          $(".num").text(t);
          $(".discount_mount").text("不可开票额度"+d+"元");
          sessionStorage.oarr=oid;
          sessionStorage.kpje=k;
        }
        function check(){
            var s = $("input[name='sel']");
            arr.splice(0,arr.length);
            t=0;
            s.each(function(i) {
                        var sr=this.value.split('-')
                        var json = {"id":sr[0],"amount":sr[1],"discount":sr[2],"kpje":$(this).next().val()};
                        console.log(this.checked)
                        if(this.checked){
                            arr.push(json);
                           t++;  
                        }

                       checksel();

                    })
           
        }
        $(function(){
           
           
            $("input[name=allsel]").click(
                function () {
                console.log(arr);
                $("input[name=entiresel]").prop("checked", false);
                if (!allsel) {
                    $("input[name=sel]").prop("checked", true);
                    check();
                    allsel=true;
                } else {
                     window.location.reload();
                    allsel=false;
                }
                
            });
            $("input[name=entiresel]").click(function () {
            $("input[name=allsel]").prop("checked", false);
            console.log(entiresel);
            if (entiresel) {
                 window.location.reload();
            }
            $.ajax({
            url: "invoice_post.php", 
            data: {'getmore':1,'lastid':lastid,'page':999},
            method:'post',
            dataType:'json',
            async: true,
            success: function (ops) {
        if (ops.RetCode==0) 
             {con = "";
             $.each(ops.Data.Items, function(index, item){
                var er=item.KKPJE;
         
               con += ' <li class="aui-list-item"><div class="aui-list-item-label">';
               con += '<input class="aui-radio" type="checkbox" name="sel" value="'+item.BargainOrderCode+'-'+er+'-'+item.DiscountCharge+'">';
               con += ' <input  type="hidden" name="kpje" value="'+item.KKPJE+'">';
               con += ' </div>';
               con += '<div class="aui-list-item-inner no-flex">';
               con += '<div class="aui-list-item-text no-flex h2">';
               con += '<img src="image/time.png" class="time">'+item.AddTime+'</div>';
               con += '<div class="aui-list-item-text no-flex h2">';
               con += '<img src="image/dot1.png">'+item.ParkingName+'</div>';
               con += '<div class="aui-list-item-text no-flex h2">';
               con += '<img src="image/dot2.png">';
               con += '车牌号：'+item.PlateNumber+'</div>';
               con += '<p class="price"><span class="b">'+item.KKPJE+'</span>元</p>';
               con +='</div>';
               con +='</li>';
               con +='<div class="geline"></div>';
                    
             });
             lastid=ops.Data.LastId;
            
         }
             // console.log(con);    //可以在控制台打印一下看看，这是拼起来的标签和数据
             $("#orbox").append(con);
             // toast.hide();
            },

             complete: function () {
                console.log(entiresel);
                setTimeout(function(){    
                if (!entiresel) {
                    $("input[name=sel]").prop("checked", true);
                    check();
                    // entiresel=true;
                } entiresel=true;
                    }, 1000)
                           
            }
        })

            });
            $(".next").click(function(){
                var am=$(".all").text();
                if (arr.length==0) {
                    alert("请选择要开票订单");
                    return;
                }
                var pi=$(".all").text();
                var ps=$(".num").text();
                dialog.alert({
                    title:"温馨提示",
                    msg:'您本次选择的待开票订单'+ps+'个，金额'+pi+'元， 请核对!',
                    buttons:['取消','确定']
                },function(ret){
                     if(ret.buttonIndex==2)
                        window.location.href="invoice_do.php?amount="+am;
                })
                
            })
            
        })
    </script>
    <script type="text/javascript" src="js/getmore.js" ></script>
    </html>