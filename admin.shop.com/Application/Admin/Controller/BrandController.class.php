<?php

/**
 * 品牌控制器
 * @author LutherCai <1334775235@qq.com>
 */
//命名空间

namespace Admin\Controller;

class BrandController extends \Think\Controller {

    /**
     * 品牌页面显示方法
     */
    public function index() {
        //创建模型
        $brand_model = D("Brand");
        $cond=array();
        if(IS_POST){
            //接收搜索的值
            $keyword=I("post.keyword");
        }
        //如果keyWord存在
        if($keyword){
            $cond['name']=array("like","%".$keyword."%");
        }
        //传值
        $this->assign($brand_model->selectBrand($cond));
        //显示页面
        $this->display();
    }

    /**
     * 添加品牌方法
     */
    public function add() {
        if (IS_POST) {
            //创建模型
            $brand_model = D("Brand");
            //获取数剧
            if ($brand_model->create() === false) {
                $this->error(get_error($brand_model->getError()));
            }
            //调用添加方法
            if ($brand_model->add() === false) {
                $this->error(get_error($brand_model->getError()));
            } else {
                $this->success('添加成功');
            }
        } else {
            //显示页面
            $this->display();
        }
    }

    /**
     * 修改品牌的方法
     */
    public function edit() {
        //创建模型
        $brand_model = D('Brand');
        if (IS_POST) {
            //获取数据
            if ($brand_model->create() === false) {
                $this->error(get_error($brand_model->getError()));
            }
            //保存数据
            if ($brand_model->save() === false) {
                $this->error(get_error($brand_model->getError()));
            } else {
                $this->success('修改成功', U("index"));
            }
        } else {
            //查询数据
            $rows = $brand_model->find(I('get.id'));
            //传输数据
            $this->assign('rows', $rows);
            //渲染页面
            $this->display("add");
        }
    }

    /**
     * 删除品牌的方法
     * 删除方法不是真的删除,而是把显示的品牌改为不显示
     */
    public function delete() {
        //创建模型
        $brand_model = D('Brand');
        //调用删除方法
        if ($brand_model->deleteBrand() === false) {
            $this->error(get_error($brand_model->getError()));
        } else {
            $this->success('删除成功', U("index"));
        }
    }

}
