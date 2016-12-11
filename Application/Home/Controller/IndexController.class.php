<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController
{

    //系统首页
    public function index()
    {


        /**
         * 获取分类
         */
        $cateMap['pid'] = 47;
        $category = M('category')->where($cateMap)->select();
        $categoryS = array();
        $categoryS[] = 0;
        $categoryS[] = 47;
        foreach ($category as $v) {
            $categoryS[] = $v['id'];
        }
        $this->assign('_category_list', $category);

        $this->display();
    }

    public function getProduct($category_id)
    {
        $map = array();
        $map['category_id'] = $category_id;
        $list = M('document')
            ->join('LEFT JOIN ey_document_product on ey_document.id=ey_document_product.id')
            ->join('LEFT JOIN ey_picture on ey_document.cover_id=ey_picture.id')
            ->field('ey_document.*,ey_picture.path')
            ->where($map)
            ->select();

        $json['code'] = 200;
        $json['msg'] = 'success';
        $json['data'] = $list;
        $this->ajaxReturn($json);
    }
}