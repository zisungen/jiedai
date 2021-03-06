<?php defined('IN_DESTOON') or exit('Access Denied');?><!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>我的订单</title>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="static/style/weui.min.css">
<link rel="stylesheet" href="static/style/index.min.css">
  <link rel="stylesheet" href="static/dialog/ui-dialog.css" />
  <style type="text/css">
    .fp{width: 150px;margin: 0 auto;}
    .fp input{width: 150px; margin-bottom: 15px;height: 26px;line-height: 26px;font-size: 14px;}
    .fp select{width: 150px;height: 28px;background-color: #FFF;line-height: 28px;font-size: 14px;}
    .bottom_box {
    background-color: rgba(255, 99, 76, 1);
    border-radius: 23px;
    color: #fff;
    display: block;
    height: 45px;
    width: 100%;
    margin-top: 40px;
    border: none;
    font-size: 16px;
}
.mask{width:100%; height:100%; position:fixed; top:0; left:0; z-index:100; background-color:#000; filter:alpha(opacity=70); -moz-opacity:0.3;-khtml-opacity: 0.3;opacity: 0.7; }
.btn_guanbi{display:block; padding:15px; position:absolute; top:0; right:0;}
.mingxi_info{width:90%; background:#fff; position:absolute; z-index:101; top:25%; left:5%; padding: 0 10px; border-radius: 10px;}
.mingxi_info dl dt{text-align:center; font-size:16px; line-height:48px; font-weight:normal; border-bottom:1px solid #e3e3e3;}
.mingxi_info dl dd{font-size:14px; line-height:36px; border-bottom:1px solid #e3e3e3;}
.mingxi_info dl dd span{display: inline-block; float:left; width: 33.3%; text-align: center;}
.mingxi_info p{padding:0 15px; font-size:14px; line-height:80px;  font-weight:400;}
.mingxi_info p span:nth-child(1) em{ color:#ff0000;}
.mingxi_info p span:nth-child(2) em{color:#ff3b30;}
.mingxi_info p span:nth-child(2) em .realPrice{font-size:24px;line-height:70px;}
.mingxi_info .btn_guanbi img{float: right;}
  </style>
  <script type="text/javascript" src="static/script/jquery-2.1.1.min.js"></script>
  <script type='text/javascript' src='static/dialog/dialog-min.js'></script>
  <script type="text/javascript">
  //jquery和tap冲突的解决方式
/*  $.noConflict();*/
  //自定义弹出框，dialog
  function jAlert(content){
    var d = dialog({
        title: '提示',
        content: content,
        okValue: '确定',
        ok: function () {
        }
    });
    d.showModal();
  }
  //提示后，点击确定跳转
  function jAlert2(content,redictUrl){
    var d = dialog({
        title: '提示',
        content: content,
        okValue: '确定',
        ok: function () {
          window.location.href = redictUrl;
        }
    });
    d.showModal();
  }
  //转菊花的加载效果
  jQuery(function() {
    var d = dialog( {
      zIndex : 87
    });
    jQuery(document).ajaxStart(function() {
      d.showModal();
    });
    jQuery(document).ajaxComplete(function() {
      d.close();
    });
  });
  </script>
</head>
<body style="background: #f4f4f4">
<script type="text/javascript">
function goBack(){
var referrer = document.referrer;
var url = window.location.href;
//alert(url);
if(referrer == null || referrer ==''){
//从微信访问进来，没有上一个页面时，默认返回到首页
window.location.href="/index.htm";
}else{
/* window.history.back(); */

window.history.back();

}
}
</script>
<div class="head" style="position:fixed;top:0;width:100%;background:#FFF;z-index:99">
<a onclick="history.go(-1)" class="back"><img src="static/style/back.png" width="22" height="14"  alt=""/></a>
  <div>我的订单</div>
    <a href="../mobile"><img src="static/style/home.png" width="22" height="21"  alt=""/></a>
</div>
<div style="margin-bottom: 40px;" id="piao_hide">
 <span style="display:none;" id="nowtime" ><?php echo $DT_TIME;?></span>
<?php if(is_array($order)) { foreach($order as $k => $v) { ?>
<div class="weui-panel weui-panel_access" style="margin-top: 38px;" data-id="<?php echo $v['itemid'];?>" >
    <!-- <input type="hidden" id="" value=""> -->
   
    <span style="display:none;" id="updatetime_<?php echo $v['itemid'];?>" ><?php echo timetodate($v['updatetime']);?></span>
    <span style="display:none;" id="status_<?php echo $v['itemid'];?>" ><?php echo $v['status'];?></span>
    <a href="showorder.php?itemid=<?php echo $v['itemid'];?>">
        <div class="weui-panel__hd weui-cell">
                <span class="weui-cell__bd">订单编号： <?php echo $v['ordercode'];?></span>
                <span class="weui-cell__ft">时间：<?php echo timetodate($v['addtime'],0);?></span>
        </div>
        <div class="weui-panel__bd">
            <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title"><?php echo $v['company'];?></h4>
                
                <ul class="weui-media-box__info">
                    <li class="weui-media-box__info__meta">订单状态：</li>
                    <li class="weui-media-box__info__meta orderstate" id="zhuangtai_<?php echo $v['itemid'];?>"><?php echo $orderstatus[$v['status']];?>----------
<?php if($v['leixing']==1) { ?>公积金社保卡借款<?php } else if($v['leixing']==2) { ?>企业法人借款
<?php } else if($v['leixing']==3) { ?>卡帐借款<?php } else if($v['leixing']==4) { ?>房借<?php } else if($v['leixing']==5) { ?>车借
<?php } else if($v['leixing']==6) { ?>申请提现<?php } ?>
</li>
                    
                </ul>
                <ul class="weui-media-box__info" id="remain_<?php echo $v['itemid'];?>" style="display: none;">
                    <li class="weui-media-box__info__meta" id="weui-media-box__info__meta">剩余时间：</li>
                    <li id="clock_<?php echo $v['itemid'];?>"></li>    
                </ul>
            </div>
           
        </div>
    </a>
</div>
<?php } } ?>
</div>
<div class="mask" style="display:none;"></div>
<div class="mingxi_info" id="piao_show" style="display: none;">
<a class="btn_guanbi"><img alt="" src="static/images/guanbi.png" height="20"></a>
<dl>
    <dt>开票信息</dt>
    
  </dl>
<form action="?action=update" id="submitForm" method="post">
<div style="height: 60px;"></div>
  <div class="">
    <div id="spaninvoice" style="">
     <div class="fp"><input type="hidden" name="itemid" id="itemid" value="">
        <select name="invoice_type" id="invoice_type" style="float: right;margin-bottom: 10px;height: 28px;background-color: #FFF;line-height: 28px;font-size: 14px;">
          <option value="电子票">电子票</option>
          <option value="纸质票">纸质票</option>
        </select>
      </div>
      <div class="fp"><input class="xinxi" type="text" name="invoice" id="invoice_tt" placeholder="请输入发票抬头"></div>
      <div class="fp"><input class="xinxi" type="text" name="invoice_number" id="invoice_number" placeholder="请输入纳税人识别号"></div>
      <div class="fp">
        <select name="invoice_item" id="invoice_item" style="float: right;margin-bottom: 10px;height: 28px;background-color: #FFF;line-height: 28px;font-size: 14px;">
                    <option value="住宿费">住宿费</option>
        </select>
      </div>
      <div class="fp"><input class="xinxi" type="text" name="invoice_email" id="invoice_email" style="display: none;" placeholder="请输入电子邮箱"></div>
      <div class="fp"><input class="xinxi" type="text" name="invoice_address" id="invoice_address" style="display: none;" id="zhi_piao" placeholder="请输入邮寄地址" /></div>
      <div class="fp"><font size="2">说明：如果您选择纸质发票，我们将采用到付的方式快递给您。</font></div>
    </div>
  </div>
    <div style="padding: 0 30px;"><input type="button" class="bottom_box" value="提 交" name="" id="btnSave"></div>
  <form>
</div>
<?php include template('footer', 'mobile');?>
</body>
<script>  
        function trans(a){
            return a.replace(/\-/g, "/");
        }
        $(".weui-panel").each(function(){
           var this_id=$(this).data("id");
           var status=$("#status_"+this_id).text();
           var xiadan=$("#updatetime_"+$(this).data("id")).text();
           xiadan=trans(xiadan);
           var startTime=new Date(xiadan);
           var old=parseInt(startTime.getTime()/1000);
           var now=parseInt($("#nowtime").text());
           var future=parseInt(old+10*60);
           var state_text=$("#zhuangtai_"+this_id).text();
           //下单后倒计时
         
           //用户取消订单，申请退款
           var url_11 = window.location.href.replace("myorder","showorder")+"?itemid="+this_id+"&action=cancel_11";
           
          
           $("#yao_"+this_id).click(function(){
                var partype=$(this).parent().data("paytype");
                if (partype==1){
                  jAlert("请联系酒店处理");
                }else{
                  scrolltop=$(document).scrollTop();
                  if (scrolltop<=0) scrolltop=$('html,body').scrollTop();
                  nowtop= ($(window).height() - $('#piao_show').outerHeight())/2+scrolltop;
                  $('#piao_show').css({top: nowtop});
                  $("#piao_show,.mask").show();
                  var itemid=$(this).parent().data("itemid");
                  $.getJSON("myorder.php?action=getinvoice&itemid="+itemid,function(res){
                    if (res.stat==1){
                      $("#itemid").val(itemid);
                      $("#invoice_type option[value='"+res.msg.fapiao_type+"']").attr("selected", true);
                      $("#invoice_tt").val(res.msg.fapiao);
                      $("#invoice_number").val(res.msg.fapiao_number);
                      $("#invoice_item option[text='"+res.msg.fapiao_item+"']").attr("selected", true);
                      if (res.msg.fapiao_type=="电子票"){
                        $("#invoice_email").val(res.msg.fapiao_email);
                        $("#invoice_email").show();
                      }else{
                        $("#invoice_address").val(res.msg.fapiao_address);
                        $("#invoice_address").show();
                      }
                      
                      
                    }
                  });
                }
           });
           $("#invoice_type").change(function(){
              if ($(this).val()=="电子票"){
                        $("#invoice_address").hide();
                        $("#invoice_email").show();
                      }else{
                        $("#invoice_email").hide();
                        $("#invoice_address").show();
              }
           });
           $("#btnSave").on('click',function(){
              if ($("#itemid").val()==""){
                return false;
              }
              if ($("#invoice_tt").val()==""){
                $("#invoice_tt").focus();
                return false;
              }
              var param = $('#submitForm').serialize();
              var url = "myorder.php?" + param + "&action=updateinvoice";
              $('#piao_show,.mask').hide();
              $("#itemid").val("");
              $.getJSON(url,function(result){
                
                jAlert(result.msg);
              });
           });
           $('.btn_guanbi').click(function(){
              $('#piao_show,.mask').hide();
            });
        })
</script>
</html>