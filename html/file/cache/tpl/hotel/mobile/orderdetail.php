<?php defined('IN_DESTOON') or exit('Access Denied');?><!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>订单详情</title>
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
<link rel="stylesheet" href="static/style/weui.min.css">
<link rel="stylesheet" href="static/style/index.min.css">
    <link rel="stylesheet" href="static/dialog/ui-dialog.css" />
    <script type="text/javascript" src="static/script/jquery-2.1.1.min.js"></script>
    <script type='text/javascript' src='static/dialog/dialog-min.js'></script>
    <script type="text/javascript">
    //jquery和tap冲突的解决方式
   /* $.noConflict();*/
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
    <script>
        function cancelorder(){
        if (confirm("您确定要取消当前订单吗？")){
        var url = window.location.href+"&action=cancel";
$.getJSON(url,function(result){
if(result.stat == 1){
jAlert2('取消订单成功,正在跳转到订单页!','myorder.php');
} else {
            jAlert(result.msg);
        }
});
        }
        }
    </script>
</head>
<body style="background: #f4f4f4;margin-bottom: 40px;">
<div class="head" style="position:fixed;top:0;width:100%;background:#FFF;z-index:99">
<a onclick="history.go(-1)"><img src="static/style/back.png" width="22" height="14"  alt=""/></a>
  <div>订单详情</div>
    <a href="../mobile"><img src="static/style/home.png" width="22" height="21"  alt=""/></a>
</div>
<div class="orderdetailtime" style="margin-top: 45px;">
    <div id="clock"></div>
  
<div class="weui-form-preview">
    <div class="weui-form-preview__hd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">申请状态</label>
            <em class="weui-form-preview__value orderstate"><?php echo $orderstatus[$order['status']];?></em>
        </div>
    </div>

    <div class="weui-form-preview__bd">
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">订单编号</label>
            <span class="weui-form-preview__value"><?php echo $order['ordercode'];?></span>
        </div>
     
        
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">姓名</label>
            <span class="weui-form-preview__value"><?php echo $order['name'];?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">手机</label>
            <span class="weui-form-preview__value"><?php echo $order['mobile'];?></span>
        </div>
 <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">年纪</label>
            <span class="weui-form-preview__value"><?php echo $order['nianling'];?></span>
        </div>
        
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">下单时间</label>
            <span class="weui-form-preview__value" id="addtime"><?php echo timetodate($order['addtime']);?></span>
            <span style="display: none;" id="nowtime" ><?php echo $DT_TIME;?></span>
            <span style="display: none;" id="updatetime" ><?php echo timetodate($order['updatetime']);?></span>
        </div>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">留言</label>
            <span class="weui-form-preview__value"><?php echo $order['note'];?></span>
        </div>
        <?php if($order['status']!=0) { ?>
        <div class="weui-form-preview__item">
            <label class="weui-form-preview__label">审核回复</label>
            <span class="weui-form-preview__value"><?php echo $order['shhuifu'];?></span>
        </div>
        
        <?php } ?>
    </div>
    <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn" href="tel:0516-66651975">联系平台</a>
       
    </div>
    <div class="weui-form-preview__ft">
        
       
    </div>
</div>
<!-- 如果商家未处理，并且未入住，用户可以取消订单 -->
<?php if ($order['access']==0): ?>
    <?php if ($order['status']==0 || $order['status']==1 || $order['status']==7): ?>
        <div class="weui-form-preview__ft" style="background:#FFF;margin-top:20px;">
        <a class="weui-form-preview__btn" href="javascript:cancelorder();">取消申请</a>
        </div>
    <?php endif ?> 
<?php endif ?>
<p class="dzdh clearfix">
    <input type="hidden" id = "companyname" value="<?php echo $company;?>" />
    <input type="hidden" id = "curLat" value="<?php echo $order['latitude'];?>" />
    <input type="hidden" id = "curLong" value="<?php echo $order['longitude'];?>" />
    <input type="hidden" id = "commentcount" value="<?php echo $commentcount;?>" />
</p>
<?php include template('footer', 'mobile');?>
</body>
<script>
$(function(){
    var status=$("#order_status").text();
    var abcde=$("#updatetime").text();
    (function (a) { 
                    abcde = a.replace(/\-/g, "/");   
    })(abcde);
    var startTime=new Date(abcde);
    var abc=parseInt(startTime.getTime()/1000);
    var old = parseInt(abc);
    var now=parseInt($("#nowtime").text());
    var future=parseInt(old+10*60);
    if(status==1){
        var timer=setInterval(function (){
            now=parseInt(now+1);
            var time=future-now;
            var min=Math.floor(time/60%60);
            var sec=Math.floor(time%60);
            if(time<0){
                $("#clock").text("订单已作废");
                $("#tips").hide();
                $("#dingdan").text("超时取消");
                clearInterval(timer);
                var url = window.location.href+"&action=cancel_11";
                $.getJSON(url,function(result){
                    if(result.stat == 1){
                    resultStr = "您的订单已作废,将跳往订单页";
                    jAlert(resultStr);
                    window.location.href='myorder.php';
                    } else {
                            jAlert(result.msg);
                    }
                });
            }else{
                $("#clock").text(min+"分"+sec+"秒");
            }
        },1000);
    }else if(status==7){
        $("#clock").text("到店付款");
        $("#tips").hide();
    }else if(status==0){
        $("#clock").text("");
        $("#tips").hide();
    }else{
        $("#clock").text("");
        $("#tips").hide();
    }
    
})
function init() {
      //设置地图中心点
      var myLatlng = new qq.maps.LatLng($('#curLat').val(),$('#curLong').val());
      var hotel_name=$("#companyname").val();
      //定义工厂模式函数
      var myOptions = {
        zoom: 20,
        center: myLatlng,
        content:'文本标注'
      }
      //获取dom元素添加地图信息
      var map = new qq.maps.Map(document.getElementById("container"), myOptions);
      var marker = new qq.maps.Marker({
            position: myLatlng,
            map: map
        });
      var label = new qq.maps.Label({
            position: myLatlng,
            map: map,
            content:hotel_name
        });
      $(".mask").show();
    }
(function(){
    //创建script标签
      var script = document.createElement("script");
      //设置标签的type属性
      script.type = "text/javascript";
      //设置标签的链接地址
      script.src = "http://map.qq.com/api/js?v=2.exp&key=V6IBZ-J5NRF-5NIJE-JX227-FCSDE-IYB26&libraries=convertor&callback=init";
      //添加标签到dom
      document.body.appendChild(script);
      
})();
</script>
<div style="height: 36px;"></div>
 <?php include template('footer', 'mobile');?>
</html>
