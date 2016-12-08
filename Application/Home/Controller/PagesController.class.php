<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/12/7
 * Time: 16:52
 */

namespace Home\Controller;


class PagesController extends HomeController
{

    /**
     * 睡眠中心
     */
    public function sleep_center()
    {
        $this->display();

    }

    /**
     *
     */
    public function shop()
    {
        $this->display();
    }

    public function join_us()
    {
        $this->display();
    }
}