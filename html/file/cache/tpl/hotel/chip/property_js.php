<?php defined('IN_DESTOON') or exit('Access Denied');?>if(Dd('property_required') != null) {
var ptrs = Dd('property_required').getElementsByTagName('option');
for(var i = 0; i < ptrs.length; i++) {
f = 'property-'+ptrs[i].value;
var t = $('#'+f).attr('tagName').toLowerCase();
if(t == 'span') {
j = checked_count(f);
if(j == 0) {
Dmsg('请选择'+ptrs[i].innerHTML, f, 1);
return false;
}
} else if(t == 'select') {
if(Dd(f).value == '') {
Dmsg('请选择'+ptrs[i].innerHTML, f);
return false;
}
} else {
if(Dd(f).value.length < 1) {
Dmsg('请填写'+ptrs[i].innerHTML, f);
return false;
}
}
}
}