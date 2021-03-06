<?php

namespace app\admin\controller;

use app\common\controller\Backend;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    /**
     * 查看
     */
    public function index()
    {
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $this->view->assign([
            'totaluser'          => 35200,
            'totalviews'         => 219390,
            'totalorder'         => 32143,
            'totalorderamount'   => 174800,
            'todayuserlogin'     => 321,
            'todayusersignup'    => 430,
            'todayorder'         => 2324,
            'todayunsettleorder' => 132,
            'sevendnu'           => '80%',
            'sevendau'           => '32%',
            'paylist'            => $paylist,
            'createlist'         => $createlist,
        ]);


        return $this->view->fetch();
    }

}
