var provinces = new Array("京","沪","浙","苏","粤","鲁","晋","冀",
            "豫","川","渝","辽","吉","黑","皖","鄂",
            "津","贵","云","桂","琼","青","新","藏",
            "蒙","宁","甘","陕","闽","赣","湘");

var keyNums = new Array("0","1","2","3","4","5","6","7","8","9",
            "Q","W","E","R","T","Y","U","P",
            "A","S","D","F","G","H","J","K","L",
            "Z","X","C","V","B","N","M","港","澳","学","删除","确定");
var next=0;			
	function showProvince(){
			$("#pro").html("");
			var ss="";
			for(var i=0;i<provinces.length;i++){
				ss=ss+addKeyProvince(i)
			} 
			$("#pro").html("<ul class='clearfix ul_pro'>"+ss+"<li class='li_close' onclick='closePro();'><span>关闭</span></li><li class='li_clean' onclick='cleanPro();'><span>清空</span></li></ul>");
	} 
	function showKeybord(){
			$("#pro").html("");
			var sss="";
			for(var i=0;i<keyNums.length;i++){
				sss=sss+'<li class="ikey ikey'+i+' '+(i>9?"li_zm":"li_num")+' '+(i>37?"li_w":"")+'" ><span onclick="choosekey(this,'+i+');">'+keyNums[i]+'</span></li>'
			} 
			$("#pro").html("<ul class='clearfix ul_keybord'>"+sss+"</ul>");
	}
    function addKeyProvince(provinceIds){
        var addHtml = '<li>';
            addHtml += '<span onclick="chooseProvince(this);">'+provinces[provinceIds]+'</span>';
            addHtml += '</li>';
            return addHtml;
    }

    function chooseProvince(obj){
       $(".che_detail").text($(obj).text());
       $(".pchepai").val($(obj).text());
	   $(".input_pro").addClass("hasPro");
	   $(".input_pp").find("span").text("");
       $(".ppHas").removeClass("ppHas");
       $('.input_pp').css({'borderColor':'#0d57a0'});
       $(".input_pro").css({'borderColor':"#93cbf1"});
	   next=0;
	   showKeybord();
	}	
	
	
	function choosekey(obj,jj){	
		if(jj==38){
			// alert("车牌："+$(".car_input").attr("data-pai"));
			layer.closeAll();
		}else if(jj==37){
			if($(".input_pp").text().length!=0){
				if($(".input_pp").text().length==1){
					$('.chepai_submit').attr('disabled',true);
        			$('.chepai_submit').css('background','#93cbf1');
                    $(".input_pp").css({'borderColor':"#93cbf1"});
				}
				$(".input_pp").text($(".input_pp").text().substring(0,$(".input_pp").text().length-1));
				
				
			}else{
		 		showProvince()
		 		

			}		
		}else{	
			$(".input_pp").text($(".input_pp").text()+$(obj).text());
			if($(".input_pp").text().length>7){
				$(".input_pp").text($(".input_pp").text().substring(0,$(".input_pp").text().length-1));

			}
			  if($(".input_pp").text()!=''){
        		$('.chepai_submit').attr('disabled',false);
        		$('.chepai_submit').css('background','#0d57a0');
    		}else{
        		$('.chepai_submit').attr('disabled',true);
        		$('.chepai_submit').css('background','#93cbf1');
    		}
		}
       $(".chepai").val($(".input_pp").text());
		
		
       
	}
	function closePro(){
       layer.closeAll()
	}		
	function cleanPro(){
       $(".ul_input").find("span").text("");
       $(".hasPro").removeClass("hasPro");
       $(".ppHas").removeClass("ppHas");
	   next=0;
	}	
	function trimStr(str){return str.replace(/(^\s*)|(\s*$)/g,"");}
	function getpai(){
		var pai=trimStr($(".car_input").text());
		$(".car_input").attr("data-pai",pai);
	}
window.onload = function() {

	$(".input_pro").click(function(){
		 layer.open({
			type: 1
			,content: '<div id="pro"></div>'
			,anim: 'up'
			,shade :false 
			,style: 'position:fixed; bottom:0; left:0; width: 100%; height: auto; padding-bottom:4px; border:none;background-color:#CED3D9;'
		  });
		 showProvince()
	})
	$(".input_pp").click(function(){
		 if($(".input_pro").text()!=''){ // 如果已选择省份
			 layer.open({
				type: 1
				,content: '<div id="pro"></div>'
				,anim: 'up'
				,shade :false 
				,style: 'position:fixed; bottom:0; left:0; width: 100%; height: auto;padding-bottom:4px; border:none;background-color:#CED3D9;'
			  });
			 showKeybord()
		 }else{
			 $(".input_pro").click()
		 }
	})
	

}
