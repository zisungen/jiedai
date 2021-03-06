<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('hotel_header', $module);?>
  <link rel='stylesheet' type='text/css' href='<?php echo DT_SKIN;?>new/page_pub.css' />
  <link rel='stylesheet' type='text/css' href='<?php echo DT_SKIN;?>new/home_v3.css' />
<style type="text/css">
  a{color: #288fe7;}
  #index{background-color:#fff;-webkit-transition:color 0.2s ease 0s;-o-transition:color 0.2s ease 0s;transition:color 0.2s ease 0s;text-decoration:none;color:#288fe7;}
  .main-col-bd .summary-list a{display: block;text-decoration: none;}
</style>
<div class="box-1180" style="margin-top: -16px;">
  
  <div id="ctl00_SubMenuContainer_homecontent" class="ebk3-main-content ">
    <div class="cols clearfix">
      <!-- 订单 -->
      <div class="main-col col-orders">
        <div id="ctl00_SubMenuContainer_divOrder">
          <div class="col-block block-untreated" id="orderContainer">
            <!-- 有未处理订单 -->
            <div class="main-col-hd ">
              <h5 class="main-col-name">
                
                <span class="text"><h5 class="main-col-name">最新未处理订单</h5></span>
              <div class="main-col-hd-opra">
                </div>
            </div>
            <div id="orderBodyContainer" class="main-col-bd">
              
              <ul class="col-orders-list" id="orderListContainer" data-bind="foreach: { data: UnProcessOrderList }, visible: UnProcessOrderList().length &gt; 0" style="">
              <?php if($neworder) { ?>
                <li class="col-orders-item" data-bind="attr: { 'orderid': OrderId }" orderid="2784331847">
                  
                  <div class="orders-item-cont clearfix">
                    <div class="cont-ariveTime">
                      <span data-bind="text: ArrivalEarlyAndLatestTime"><?php echo $neworder['arrivetime'];?>到店</span></div>
                    <div class="cont-roomInfo">
                      <p>
                        <label data-bind="text: ArrivalAndDeparture"><?php echo timetodate($neworder['intime'],2);?> 至 <?php echo timetodate($neworder['outtime'],2);?></label>&nbsp;&nbsp;
                        <span class="ebk3-c-light" data-bind="text: LiveDays">1晚</span></p>
                      <div class="roomInfo-live clearfix">
                        <div class="roomInfo-live-roomType clearfix">
                          <div class="roomInfo-live-container">
                            <p class="ebk3-ellipsis" title="精致双床房(内宾)[含早]" data-bind="text: RoomName, attr: { title: RoomName }"><?php echo $neworder['title'];?></p></div>
                          <span class="roomInfo-live-count" data-bind="text: Quantity"><?php echo $neworder['number'];?>间</span></div>
                        <span class="cus" data-bind="text: ClientName, event: { mouseenter: $root.ShowCopyTips, mouseleave: $root.HideCopyTips }"><?php echo $neworder['buyer_name'];?></span></div>
                      <span class="cus-need ebk3-c-light" data-bind="visible: !IsNewVersion, text: Remarks.length &gt; 0 ? Remarks : '无备注'" style="display: none;"><?php echo $neworder['note'];?></span>
                      
                    </div>
                    <div class="cont-orderInfo clearfix">
                      <!-- ko if:$data.IsCreditOrder -->
                      <!-- /ko -->
                      <!-- ko if:!$data.IsCreditOrder -->
                      <div class="orderInfo ebk3-c-light">
                        <label data-bind="text: Payment"></label>
                        <span class="orderInfo-price" data-bind="event: { mouseenter: $root.ShowRoomPriceDetail, mouseleave: $root.HideRoomPriceDetail }">
                          <dfn data-bind="    text: Currencty">RMB</dfn>
                          <label data-bind="text: Amount"><?php echo $neworder['amount'];?></label></span>
                      </div>
                      <!-- /ko -->
                      </div>
                  </div>
                  <div class="orders-item-opra clearfix">
                    <div class="opra-btns" data-bind="visible: OrderTypeCode != 'C'">
                      <!-- ko if:$data.NeedConfirmCreditOrder -->
                      <!-- /ko -->
                      <!-- ko if:!$data.NeedConfirmCreditOrder -->
                     
                      
                      <!-- /ko --></div>
                    
                    
                    <div class="opra-info" data-bind="visible: !IsCreditOrder">
                      <a href="trade.php?action=index" class="" >去处理</a>
                      </div>
                  </div>
                </li>
                <?php } else { ?>
                <li class="col-orders-item"  orderid="2784331847">暂无订单</li>
                <?php } ?>
              </ul>
            </div>
            
           
            <!-- 没有未处理订单 -->
            </div>
        </div>
       
      </div>
      <div class="main-col col-today">
        <!-- 今日汇总 -->
        <div class="col-block block-today-summary">
          <div class="main-col-hd clearfix ">
            <h5 class="main-col-name">今日汇总</h5>
            <div class="main-col-hd-opra" id="divToday"></div>
          </div>
          <div class="main-col-bd">
            <ul class="summary-list clearfix">
              <li class="summary-item" id="liUnOrder"><a href="message.php">未读短信&nbsp;&nbsp;
                <strong id="stUnOrder"><?php echo $_message;?></strong></a>
                <i class="ebk3-ico ebk3-ico-grayRight"></i>
              </li>
             
              <li class="summary-item" id="liTodayOrder"><a href="trade.php?action=index&fields=0&kw=&status=&fromtime=<?php echo date('Y-m-d');?>&totime=<?php echo date('Y-m-d',strtotime('+ 1 day'));?>">今日新订&nbsp;&nbsp;
                <strong id="stTodayOrder"><?php echo $todayorder;?></strong></a>
                <i class="ebk3-ico ebk3-ico-grayRight"></i>
              </li>
              <li class="summary-item" id="liTodayOrder"><a href="trade.php?action=index&fields=0&kw=&status=4&fromtime=<?php echo date('Y-m-d');?>&totime=<?php echo date('Y-m-d',strtotime('+ 1 day'));?>">今日入住&nbsp;&nbsp;
                <strong id="stTodayCheck"><?php echo $todayorderin;?></strong></a>
                <i class="ebk3-ico ebk3-ico-grayRight"></i>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="main-col col-roomMaintain">
        <div id="ctl00_SubMenuContainer_divRoomStatus" class="col-block block-maintainCalender">
          <div class="main-col-hd clearfix ">
            <h5 class="main-col-name">重要通知</h5>
            
          </div>
          <div class="main-col-bd">
          <ul>
          <?php if(is_array($tz)) { foreach($tz as $t => $tc) { ?>
          <li><a href="<?php echo $tc['linkurl'];?>" target="_blank"><?php echo dsubstr($tc['title'],28);?></a></li>
          <?php } } ?>
          </ul>
          
          </div>
          
        </div>
      </div>
    </div>
  </div>
  
  <div style="display: none;">index2</div>
  
  <bgsound id="Player" loop="-1" autostart="true">
    
    <div id="Music"></div>
</div>
<div id="jsContainer" class="jsContainer" style="height:0">
  <textarea id="jsSaveStatus" style="display:none;"></textarea>
  <div id="tuna_alert" style="display:none;position:absolute;z-index:999;overflow:hidden;">
    <table id="alertTable" style="font-family:Arial;margin:0;" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td style="margin:0;padding:0px 2px 2px 0px;background:#E7E7E7;">
            <div id="alertInfo" style="margin:0px;padding:10px;font-size:12px;text-align:left;background:#FFFFE8;border:1px solid #FFDF47;color:#000;white-space:nowrap;">内容</div></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="tuna_jmpinfo" style="position: absolute; z-index: 120;"></div>
  <div style="position: absolute;top:0; z-index: 120;display:none" id="tuna_calendar" class="tuna_calendar"></div>
</div>
<div>
  </div>
<div id="jsContainer" class="jsContainer" style="height:0">
  <textarea id="jsSaveStatus" style="display:none;"></textarea>
  <div id="tuna_alert" style="display:none;position:absolute;z-index:999;overflow:hidden;">
    <table id="alertTable" style="font-family:Arial;margin:0;" cellspacing="0" cellpadding="0">
      <tbody>
        <tr>
          <td style="margin:0;padding:0px 2px 2px 0px;background:#E7E7E7;">
            <div id="alertInfo" style="margin:0px;padding:10px;font-size:12px;text-align:left;background:#FFFFE8;border:1px solid #FFDF47;color:#000;white-space:nowrap;">内容</div></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="tuna_jmpinfo" style="position: absolute; z-index: 120;"></div>
  <div style="position: absolute;top:0; z-index: 120;display:none" id="tuna_calendar" class="tuna_calendar"></div>
</div>
</form>
<div id="divMaskSelectHotel" class="overLay" style="display: none"></div>
<div id="divPopupSelectHotel" class="ebk3-modwin mod-form mod-selectHtl" style="display: none;">
  <a href="javascript:;" class="ebk3-close" id="aCloseSelectHotel">×</a>
  <h6 class="ebk3-modwin-title">选择酒店</h6>
  <div class="ebk3-modwin-cont">
    <div class="mod-selectHtl-hd clearfix">
      <div class="ebk3-compt-lbText">
        <div class="ebk3-compt-lbText-lb">宾馆名称简拼</div>
        <div class="ebk3-compt-lbText-cont">
          </div>
      </div>
      <div class="ebk3-compt-lbText">
        <div class="ebk3-compt-lbText-lb">宾馆名称关键字</div>
        <div class="ebk3-compt-lbText-cont">
          <a href="javascript:" class="ebk3-btn ebk3-btn-blue ebk3-btn-mini" id="btQueryHotelList">查询</a></div>
      </div>
    </div>
    <div class="mod-selectHtl-bd">
      <div class="sec-hotel" id="divSelectHotel"></div>
      <div class="ebk3-pageNav" id="divPagerSelectHotel" prestr="上一页" nexstr="下一页" tostr="到" pagestr="页" submitstr="确定"></div>
    </div>
  </div>
</div>
<div class="footer">
  <p>
  </p>
</div>
<?php include template('hotel_footer', $module);?>