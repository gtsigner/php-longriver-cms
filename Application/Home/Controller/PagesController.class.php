<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/12/7
 * Time: 16:52
 */

namespace Home\Controller;


use Common\Helper\PageHelper;
use Home\Model\DocumentModel;

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

    public function product()
    {
        $this->display();
    }

    public function recommend()
    {
        //筛选属性
        $map = array();
        $map['category_id'] = 46;
        $list = M('document')
            ->join('LEFT JOIN ey_document_product on ey_document.id=ey_document_product.id')
            ->where($map)
            ->select();
        if (false === $list) {
            $this->error('获取列表数据失败！');
        }
        $this->assign('_list', $list);
        $this->display();
    }


    public function getProduct($p = 1)
    {
        $map = array();
        /**
         * 获取子节点
         */
        $cateMap['pid'] = 47;
        $category = M('category')->where($cateMap)->select();
        $categoryS = array();
        $categoryS[] = 0;
        $categoryS[] = 47;
        foreach ($category as $v) {
            $categoryS[] = $v['id'];
        }
        $list = M('document')
            ->join('LEFT JOIN ey_document_product on ey_document.id=ey_document_product.id')
            ->join('LEFT JOIN ey_picture on ey_document.cover_id=ey_picture.id')
            ->field('ey_document.*,ey_picture.path')
            ->where(array('category_id' => array('in', $categoryS)))
            ->select();

        if (false === $list) {
            $this->error('获取列表数据失败！');
        }
        /*ZHAOJUNLIKE@  */

        $json['data'] = $list;
        $json['code'] = 200;
        $this->ajaxReturn($json);
    }

    public function getProductAttr()
    {
        $map['model_id'] = 4;
        $map['type'] = 'select';
        $attr = M('attribute')->where($map)->field('remark,extra')->select();
        $json['code'] = 200;
        $json['data'] = $attr;
        $this->ajaxReturn($json);
    }

    public function diy()
    {
        $this->display();
    }

    public function good()
    {


    }

    /**
     * 公司介绍
     */
    public function company()
    {
        $this->display();
    }

    public function join_us()
    {
        $this->display();
    }

    public function service()
    {

        $Document = D('Document');
        //p分页最好不要
        $list['xz_list'] = $Document->lists(41);
        $list['qt_list'] = $Document->lists(40);


        $this->assign('_service', $list);
        $this->display();
    }


}