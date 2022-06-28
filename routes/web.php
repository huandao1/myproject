<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get','post'],'test','Login@test');

Route::get('test2','Login@test2');

Route::post('test2','Login@test2');

Route::get('test3','Login@test3');

Route::post('test3','Login@test3');

Route::get('login_password', 'Login@login_password')->middleware('checkauth');
Route::post('login_password', 'Login@login_password');

//Route::match(['get','post'], 'zhuce','Login@zhuce')->middleware('checkauth');
Route::get('zhuce', 'Login@zhuce')->middleware('checkauth');
Route::post('zhuce', 'Login@zhuce');

Route::get('login_sms','Login@login_sms')->middleware('checkauth');
Route::post('login_sms', 'Login@login_sms');

Route::post('send_sms', 'Login@send_sms');

Route::post('send_forgetsms', 'Login@send_forgetsms');

//忘记密码
Route::get('login_fgetpay','Login@fgetpay')->middleware('checkauth');

Route::post('login_fgetpay','Login@fgetpay');

Route::post('pay_apply_hou','Pay@apply_hou');

Route::view('pay_success_tips','pay.success_tips');

Route::view('pay_fangshi','pay.fangshi');

//异常上报
Route::get('pay_yichang/{BargainOrderCode?}',function($BargainOrderCode="") {
    return view('pay.yichang',['BargainOrderCode'=>$BargainOrderCode]);
})->middleware('checkauth');

//异常上传提交
Route::post('pay_yichang1','Pay@yichang1');

//计时监测
Route::post('pay_jiance','Pay@jiance');

//欠费订单
Route::get('pay_noapply', 'Pay@noapply')->middleware('checkauth');

Route::post('pay_getarrears', 'Pay@getarrears');

//已登记的欠费订单
Route::get('pay_bupay', 'Pay@bupay')->middleware('checkauth');

Route::post('pay_bupay', 'Pay@bupay');

Route::post('pay_bupay1', 'Pay@bupay1');

Route::get('pay_lastpayyinliang', 'Pay@lastpayyinliang');

Route::get('pay_dingdan', 'Pay@dingdan')->middleware('checkauth');

//订单页面
Route::get('pay_dingdan_noapply', 'Pay@dingdan_noapply')->middleware('checkauth');

//支付之前的页面
Route::get('pay_zhifu_noapply', 'Pay@zhifu_noapply')->middleware('checkauth');

Route::get('pay_zhifu', 'Pay@zhifu')->middleware('checkauth');

Route::get('pay_bj_dingdan', 'Pay@bj_dingdan')->middleware('checkauth');

Route::post('pay_OrderHaveArrears', 'Pay@OrderHaveArrears');

Route::get('pay_lubpark', 'Pay@lubpark')->middleware('checkauth');

Route::post('pay_lubpark01', 'Pay@lubpark01');

Route::post('pay_lubpark02', 'Pay@lubpark02');

Route::get('pay_lubpark2', 'Pay@lubpark2')->middleware('checkauth');

Route::get('pay_lubpark1', 'Pay@lubpark1')->middleware('checkauth');

Route::view('pay_guize','pay.guize')->middleware('checkauth');

Route::get('pay_bespeak', 'Pay@bespeak')->middleware('checkauth');

Route::get('pay_BespeakCancel', 'Pay@BespeakCancel')->middleware('checkauth');

Route::post('pay_chargetime1', 'Pay@chargetime1');

Route::post('pay_chargetime', 'Pay@chargetime');

Route::post('pay_berthstatus', 'Pay@berthstatus');

Route::post('pay_couponget', 'Pay@couponget');

Route::post('pay_getparkprice', 'Pay@getparkprice');

Route::get('pay_roompark','Pay@roompark')->middleware('checkauth');

Route::get('pay_roompark_se','Pay@roompark_se')->middleware('checkauth');

Route::get('pay_parkapply','Pay@parkapply')->middleware('checkauth');

Route::get('pay_parkapplypayyinliang','Pay@parkapplypayyinliang')->middleware('checkauth');

Route::get('pay_paymoney','Pay@paymoney');

Route::get('pay_later_pay', 'Pay@later_pay')->middleware('checkauth');

//调起支付的页面
Route::get('pay_noapplypayyinliang', 'Pay@noapplypayyinliang')->middleware('checkauth');

//预付费续费
Route::get('pay_renewapply', 'Pay@renewapply')->middleware('checkauth');

//计时页面
Route::get('pay_jishi', 'Pay@jishi')->middleware('checkauth');

Route::post('pay_jishi', 'Pay@jishi');

Route::get('user_index', 'User@index')->middleware('checkauth');

Route::get('pay_zhangdan', 'Pay@zhangdan')->middleware('checkauth');

Route::get('pay_detail','Pay@detail')->middleware('checkauth');

Route::get('Coupon','Coupon@index')->middleware('checkauth');

Route::post('get_coupon_list','Coupon@getlist');

//月卡列表
Route::get('cardlist','Card@cardlist')->middleware('checkauth');

Route::post('getcardlist','Card@getcardlist');


Route::post('card_renew','Card@renew');

//购买月卡
Route::view('card_buy', 'card.buy')->middleware('checkauth');

//月卡续费
Route::view('card_rebuy', 'card.rebuy')->middleware('checkauth');

//月卡相关协议
Route::view('card_explain', 'card.explain')->middleware('checkauth');

//月卡相关协议
Route::view('card_newrule', 'card.newrule')->middleware('checkauth');

//车牌列表
Route::get('chepaicheck','Carcode@chepaicheck')->middleware('checkauth');

//车牌取消绑定
Route::post('carno','Carcode@carno');

//修改该车牌为默认车牌
Route::post('morenche','Carcode@morenche');

//车牌添加
Route::get('chepai','Carcode@chepai')->middleware('checkauth');

Route::post('chepai','Carcode@chepai');

Route::get('chepai1','Carcode@chepai1')->middleware('checkauth');

Route::post('chepai1','Carcode@chepai1');

//车牌选择
Route::post('choosechepai','Carcode@choosechepai');

Route::get('invoice','Invoice@index')->middleware('checkauth');

Route::get('invoice_order','Invoice@order')->middleware('checkauth');

Route::get('invoice_cou_order','Invoice@cou_order')->middleware('checkauth');

Route::post('invoice_post','Invoice@post');

Route::post('invoice_cou_post','Invoice@cou_post');

Route::get('invoice_do/{amount?}',function($amount="") {
    return view('invoice.do',['amount'=>$amount]);
})->middleware('checkauth');

Route::get('invoice_do2/{amount?}',function($amount="") {
    return view('invoice.do2',['amount'=>$amount]);
})->middleware('checkauth');

Route::get('invoice_cou_do/{amount?}',function($amount="") {
    return view('invoice.cou_do',['amount'=>$amount]);
})->middleware('checkauth');

Route::get('invoice_cou_do2/{amount?}',function($amount="") {
    return view('invoice.cou_do2',['amount'=>$amount]);
})->middleware('checkauth');

Route::view('invoice_info', 'Invoice@info')->middleware('checkauth');

Route::get('invoice_history', 'Invoice@history')->middleware('checkauth');

Route::get('invoice_detail', 'Invoice@detail')->middleware('checkauth');

Route::get('invoice_resend', 'Invoice@resend')->middleware('checkauth');

Route::get('invoice_order_show', 'Invoice@order_show')->middleware('checkauth');

Route::get('invoice_cou_order_show', 'Invoice@cou_order_show')->middleware('checkauth');

Route::get('invoice_up_add', 'Invoice@up_add')->middleware('checkauth');

Route::post('invoice_up_add', 'Invoice@up_add');

//修改密码
Route::view('login_passwordjump','login.passwordjump')->middleware('checkauth');

Route::get('login_passwordedit','Login@passwordedit')->middleware('checkauth');

Route::post('login_passwordedit','Login@passwordedit');

//关于我们
Route::view('about','about.index')->middleware('checkauth');

//维护信息
Route::view('about_notice','about.notice')->middleware('checkauth');

//服务协议
Route::view('about_useragreement','about.useragreement')->middleware('checkauth');

//退出登录
Route::get('login_out','Login@login_out')->middleware('checkauth');