<?php

/**
 * 品牌模型
 * @author LutherCai <1334775235@qq.com>
 */
//命名空间

namespace Admin\Model;

class BrandModel extends \Think\Model {

    //开启批量验证
    protected $pathValidate = true;
    //自动验证
    protected $_validate    = array(
        /**
         * 1.品牌名称不能为空
         * 2.品牌名称唯一
         */
        array('name', 'require', '品牌名称不能为空', self::EXISTS_VALIDATE, '', self::MODEL_INSERT),
        array('name', '', '品牌名称已存在', self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),
    );
    
    public function selectBrand(array $cond=array()){
        //拼接数组,如果键名相同,以前面一个为准
        $cond=$cond+array(
            "status"=>array("gt",-1),
        );
        //查询符合要求的数据条数
        $count=$this->where($cond)->count();
        //获取分页数据
        $pageSize=C("PAGE_SIZE");
        //实例化分页类
        $pageObj=new \Think\Page($count,$pageSize);
        //修改主题
        $pageObj->setConfig("theme",C("PAGE_THEME"));
        //显示分页信息
        $page_html=$pageObj->show();
        //分页查询数据
        $rows=$this->where($cond)->page(I("get.p"),$pageSize)->select();
        //返回值
        return array(
          "rows"=>$rows,
            "page_html"=>$page_html,
        );
    }


    /**
     * 删除方法数据处理
     */
    public function deleteBrand(){
        //保存删除时要修改的数据
        $data=array(
          "status"=>-1,
            "name"=>array('exp',"CONCAT(name,'_del')"),
        );
        $this->where(array('id'=>I('get.id')))->setField($data);
    }
}
