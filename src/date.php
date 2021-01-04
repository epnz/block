<?php
/*
 * @Author: 故乡情
 * @Date: 2021-01-04 17:12:59
 * @LastEditTime: 2021-01-05 02:23:25
 * @LastEditors: 故乡情
 * @Description: EPower Network Zealot Project Block
 * @FilePath: /block/src/date.php
 * @Copyright © 2020 EPNZ.com
 * 请保留版权信息
 */

namespace block;

use block\block;

class date extends block
{
    /**
     * @description: 实现的方法
     */
    protected $methods = [
        'timeComparison'
    ];

    /**
     * @description: 一个时间戳与当前时间的比较
     * @param   integer     $time   时间戳
     * @param   string      $form   时间格式
     * @return  string
     * @access  public
     */
    public function timeComparison($time, $form = 'Y-m-d H:i:s')
    {
        $time = intval($time);
        if(!is_int($time)) return false;
        if($time > time()) return date($form, $time);

        $lang = $this->getLang('main');

        // 本小时起始时间
        $thisHour = strtotime(date("Y-m-d H:00:00"));
        // 今天起始时间
        $todayTime = strtotime(date("Y-m-d"));
        // 本月起始时间
        $thisMonth = strtotime(date('Y-m-01'));
        // 本年起始时间
        $thisYear = strtotime(date('Y-01-01'));
        if ((time() - $time) < 60) {
            $str = $lang['Just now'];
        } elseif ($time > $thisHour) {
            $str = intval((time() - $time) / 60) . $lang['minutes ago'];
        } elseif ($time > $todayTime) {
            $str = intval((time() - $time) / 3600) . $lang['hours ago'];
        } elseif ($time > $todayTime - 86400) {
            $str = $lang['Yesterday'];
        } elseif ($time > $thisMonth) {
            $str = intval((time() - $time) / 86400) . $lang['days ago'];
        } elseif ($time > $thisYear) {
            $month = date('n');
            if ($month > 1) {
                for ($i = 1; $i <= $month; $i++) {
                    $monthStart = strtotime(date('Y-' . ($month - $i) . '-01'));
                    if ($time > $monthStart){
                        $str = $i == 1 ? $lang['Last month'] : $i - 1 . $lang['months ago'];
                        break;
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= 100; $i++) {
                $yearStart = strtotime(date(($year - $i) . '-01-01'));
                if ($time > $yearStart){
                    $str = $i == 1 ? $lang['Last year'] : $i - 1 . $lang['years ago'];
                    break;
                }
            }
        }

        return $str;
    }
}
