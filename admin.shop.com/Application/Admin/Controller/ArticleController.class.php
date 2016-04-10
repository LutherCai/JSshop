<?php

/**
 * 文章控制器
 * @author LutherCai <1334775235@qq.com>
 */
//命名空间

namespace Admin\Controller;

class ArticleController extends \Think\Controller {

    /**
     * 显示文章方法
     */
    public function index() {
        //创建模型
        $article_model = D("Article");
        //拼接条件
        $cond          = array();
        //获取搜索关键词
        if (IS_POST) {
            $keyword = I('post.keyword');
        }
        $cond['name'] = array("like", "%" . $keyword . "%");

        //传输数据
        $this->assign($article_model->selectArticle($cond));
        //显示页面
        $this->display();
    }

    /**
     * 添加文章方法
     */
    public function add() {
        if (IS_POST) {
            //创建模型
            $article_model = D("Article");
            //获取数据
            if ($article_model->create() === false) {
                $this->error(get_error($article_model->getError()));
            }
            //调用添加方法
            if ($article_model->addArticle() === false) {
                $this->error(get_error($article_model->getError()));
            } else {
                $this->success("添加成功");
            }
        } else {
            $this->display();
        }
    }

    /**
     * 修改文章方法
     */
    public function edit() {
        //创建文章详情模型
        $article_model = D("Article");
        if (IS_POST) {
            if ($article_model->create() === false) {
                $this->error(get_error($article_model->getError()));
            }
            if ($article_model->editArticle() === false) {
                $this->error(get_error($article_model->getError()));
            } else {
                $this->success("修改成功", U('index'));
            }
        } else {

            //获取内容
            $rows                  = $article_model->find(I("get.id"));
            //创建文章内容模型
            $article_content_model = D("ArticleContent");
            //获取内容
            $rowContent            = $article_content_model->find(I("get.id"));
            //拼接数组
            $rows["content"]       = $rowContent['content'];
            //传输数据
            $this->assign('rows', $rows);
            //显示数据
            $this->display('add');
        }
    }

    /**
     * 删除文章方法
     */
    public function delete() {
        //创建文章详情模型
        $article_model = D("Article");
        //调用删除方法
        if ($article_model->deleteArticle() === false) {
            $this->error(get_error($article_model->getError()));
        } else {
            $this->success("删除成功");
        }
    }

}
