<?php

/**
 * 供货商控制器
 * @author LutherCai <1334775235@qwq.com>
 */

namespace Admin\Controller;

class SupplierController extends \Think\Controller {

    /**
     * 显示供货商列表
     */
    public function index() {
         //创建对象
       $supplier_model = D("Supplier");
          //查询条件
        $cond = array();
        //获取条件
        if(IS_POST){
            $keyword = I('post.keyword');
        }
        
        if($keyword){
            $cond['name'] = array('like','%'.$keyword.'%');
        }
        
        $this->assign($supplier_model->selectSupplier($cond));
        $this->display();
//        //创建对象
//        $supplier_model = D("Supplier");
//        if (IS_POST) {
//            //获取搜索的内容
//            $keyword = I("post.keyword");
//            
//        } else {
//            //调用查询方法
//            $rows = $supplier_model->where()->select();
//            //传递数据
//            $this->assign("rows", $rows);
//            //显示页面
//            $this->display();
//        }
    }

    public function add() {
        if (IS_POST) {
            //创建模型
            $supplier_model = D("Supplier");
            //获取数据
            if ($supplier_model->create() === false) {
                $this->error(get_error($supplier_model->getError()));
            }
            //保存数据
            if ($supplier_model->addSupplier() === false) {
                $this->error(get_error($supplier_model->getError()));
            } else {
                $this->success("添加成功", U("index"));
            }
        } else {
            //显示页面
            $this->display();
        }
    }

    public function edit() {
        //创建模型
        $supplier_model = D("Supplier");
        if (IS_POST) {
            //获取数据
            if ($supplier_model->create() === false) {
                $this->error(get_error($supplier_model->getError()));
            }
            //调用更新数剧的方法
            if ($supplier_model->saveSupplier() === false) {
                $this->error(get_error($supplier_model->getError()));
            } else {
                $this->success("修改成功", U("index"));
            }
        } else {

            //调用查询方法
            $rows = $supplier_model->find(I("get.id"));
            //传输数据
            $this->assign("rows", $rows);
            //显示页面
            $this->display('add');
        }
    }

    public function delete() {
        //创建模型
        $supplier_model = D("Supplier");
        //调用删除方法
        if ($supplier_model->deleteSupplier() === false) {
            $this->error(get_error($supplier_model->getError()));
        } else {
            $this->success("删除成功", U("index"));
        }
    }

}
