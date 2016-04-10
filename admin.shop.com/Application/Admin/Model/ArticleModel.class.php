<?php

/**
 * 文章管理模型
 * @author LutherCai <1334775235@qq.com>
 */
//命名空间

namespace Admin\Model;

class ArticleModel extends \Think\Model {

    //开启批量验证
    protected $pathValidate = true;
    //自动验证
    protected $_validate    = array(
        /**
         * 1.文章标题必须填写
         */
        array('name', 'require', "文章标题不能为空", self::EXISTS_VALIDATE, "", self::MODEL_INSERT),
    );
    //自动完成
    protected $_auto        = array(
        /**
         * 1.自动获取系统当前时间
         */
        array('inputtime', NOW_TIME),
    );

    //查询方法
    public function selectArticle(array $cond = array()) {
        //拼接条件
        $cond      = $cond + array(
            "status" => array("gt", -1),
        );
        //查询符合要求数据的条数
        $count     = $this->where($cond)->count();
        //获取每页条数
        $pageSize  = C("PAGE_SIZE");
        //实例化分页类
        $pageObj   = new \Think\Page($count, $pageSize);
        //添加分页主题数据的总条数
        $pageObj->setConfig("theme", C("PAGE_THEME"));
        //显示分页
        $page_html = $pageObj->show();
        //分页查询数据
        $rows      = $this->where($cond)->page(I("get.p"), $pageSize)->select();
        //返回值
        return array(
            "rows"      => $rows,
            "page_html" => $page_html,
        );
    }

    //添加文章方法
    public function addArticle() {
        //保存数据
        $require_data    = $this->data;
        //插入数据
        $id              = $this->add($require_data);
        //$content         = I('post.content');
        //实例化文章内容类
        $article_content = D("ArticleContent");
        $data            = array(
            "content"    => I('post.content'),
            "article_id" => $id,
        );
        $article_content->add($data);
    }

    //修改方法
    public function editArticle() {
        //保存数据
        $require_data          = $this->data;
        $this->save($require_data);
        //创建文章内容模型
        $article_content_model = D("ArticleContent");
        $article_content_model->where(array("article_id" => $require_data['id']))->save(array('content' => I('post.content')));
    }

    //删除方法
    public function deleteArticle() {
        //保存删除时要修改的数据
        $data = array(
            "status" => -1,
            "name"   => array('exp', "CONCAT(name,'_del')"),
        );
        $this->where(array('id' => I('get.id')))->setField($data);
    }

}
