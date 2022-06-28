var geting=false;
var scroll = new auiScroll({
    listen:true, //是否监听滚动高度，开启后将实时返回滚动高度
    distance:100 //判断到达底部的距离，isToBottom为true
},function(ret){
   console.log(lastid);
   if (ret.scrollTop==0) 
    return;
    if ($("#orbox > li").length<10) 
        {
        toast.loading({
                        title:"暂无更多",
                        duration:1000
                    },function(ret){
                        setTimeout(function(){
                            toast.hide();
                        }, 1000)
                    });
    return;
    }
   
   if (ret.isToBottom&&!geting) {
        geting=true;
         toast.loading({
                    title:"加载更多",
                    duration:2000
                },function(ret){
                     console.log(ret);
                    setTimeout(function(){
                        toast.hide();
                    }, 2000)
                });
       $.ajax({
            url: "invoice_post.php", 
            data: {'getmore':1,'lastid':lastid,'page':10},
            method:'post',
            dataType:'json',
            async: true,
            success: function (ops) {
            if (ops.Data.Count==0) {
                $("#no-data").css("display","flex");
                setTimeout(function(){
                        $("#no-data").hide();
                    }, 2000)
                geting=false;
                return;
            }
              if (ops.RetCode==0) 
             {con = "";
            
             $.each(ops.Data.Items, function(index, item){
                var er=item.KKPJE; 
               con += ' <li class="aui-list-item"><div class="aui-list-item-label">';
               con += '<input class="aui-radio" type="checkbox" name="sel" onclick="ert(this)" value="'+item.BargainOrderCode+'-'+er+'-'+item.DiscountCharge+'">';
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
              console.log(lastid);
         }
             // console.log(con);    //可以在控制台打印一下看看，这是拼起来的标签和数据
             $("#orbox").append(con);
             // toast.hide();
            },

             complete: function () {
                setTimeout(function(){
                        geting=false;
                    }, 2000)
                           
            }
        })
       // geting=true;
   }
});