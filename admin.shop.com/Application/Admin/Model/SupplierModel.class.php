<?php

/**
 * 供货商模型
 * @author LutherCai <1334775235@qwq.com>
 */

namespace Admin\Model;

class SupplierModel extends \Think\Model {

    //开启批量验证
    protected $patchValidate = true;
    //自动验证
    protected $_validate     = array(
        /**
         * 1.供货商不能为空
         * 2.供货商唯一
         */
        array('name', 'require', '供货商名称不能为空', self::EXISTS_VALIDATE, '', self::MODEL_INSERT),
        array('name', '', "供货商名称已存在", self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
    );
    
    public function selectSupplier(array $cond=array()) {
        $cond = $cond + array(
            'status'=>array('gt',-1),
        );
         //查询数据
        $count = $this->where($cond)->count();
        //显示分页
        $size = C('PAGE_SIZE');
        $page_obj = new \Think\Page($count,$size);
        $page_obj->setConfig('theme', C('PAGE_THEME'));
        $page_html = $page_obj->show();
        $rows = $this->where($cond)->page(I('get.p'),$size)->select();
        
        return array(
            'rows'=>$rows,
            'page_html'=>$page_html,
        );
    }

    public function addSupplier() {
        $data = $this->data;
        $this->add($data);
    }

    public function saveSupplier() {
        $data = $this->data;
        $this->save($data);
    }

    public function deleteSupplier() {
        $data = array(
            "status" => -1,
            'name'=>array('exp',"CONCAT(name,'_del')"),
        );
        $this->where(array("id" => I("get.id")))->setField($data);
    }

}
