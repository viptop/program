<?php

namespace App\Http\Controllers;

use Overtrue\Wechat\Payment;
use Overtrue\Wechat\Payment\Order;
use Overtrue\Wechat\Payment\Notify;
use Overtrue\Wechat\Payment\Business;
use Overtrue\Wechat\Payment\UnifiedOrder;


class PaymentController extends WeChatController
{

    public function __construct()
    {
      parent::__construct();
    }

    public function index(Request $request)
    {



    /**
     * 第 1 步：定义商户
     */
    $business = new Business(
      config('wechat.wx_base.app_id'),
      config('wechat.wx_base.secret'),
      config('wechat.payment.merchant_id'),
      config('wechat.payment.key'),
    );

    /**
     * 第 2 步：定义订单
     */
    $order = new Order();
    $order->body = 'test body';
    $order->out_trade_no = md5(uniqid().microtime());
    $order->total_fee = '1'; // 单位为 “分”, 字符串类型
    $order->openid = $this->openid;
    $order->notify_url = 'http://logingame.bosengame.com/lns/weixin/notify/5/notify';

    /**
     * 第 3 步：统一下单
     */
    $unifiedOrder = new UnifiedOrder($business, $order);

    /**
     * 第 4 步：生成支付配置文件
     */
    $payment = new Payment($unifiedOrder);

    }

    public function notify(){
      $notify = new Notify(
        config('wx_base.app_id'),
        config('wx_base.secret'),
        config('payment.merchant_id'),
        config('payment.key'),
      );

      $transaction = $notify->verify();

      if (!$transaction) {
          $notify->reply('FAIL', 'verify transaction error');
      }

      // var_dump($transaction);
      echo $notify->reply();
      
    }

}

