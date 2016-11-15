<?php

use yii\db\Migration;

class m160720_121730_create_cms_category_table extends Migration
{
    const TBL_NAME = '{{%cms_category}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT="cms分类表"';
        }
        $this->createTable(self::TBL_NAME, [
            'cat_id' => $this->primaryKey()." COMMENT '分类ID'",
            'cat_pid'=>$this->integer()->notNull()." COMMENT '父ID'",
            'cat_level'=>"TINYINT(3) NOT NULL COMMENT '层级'",
            'cat_name'=>$this->string(100)->notNull()." COMMENT '分类名称'",
            'cat_second_name'=>$this->string(100)->notNull()." COMMENT '分类副名称'",
            'cat_name_alias'=>$this->string(100)->notNull()." COMMENT '分类别名'",
            'redirect_url'=>$this->string(255)->notNull()." COMMENT '跳转地址'",
            'cat_img'=>$this->string(255)->notNull()." COMMENT '分类图片'",
            'cat_thumb_img'=>$this->string(255)->notNull()." COMMENT '分类缩略图图片'",
            'display_type'=>"TINYINT(3) NOT NULL COMMENT '模板类型，0列表，1单页'",
            'template_list'=>$this->string(100)->notNull()." COMMENT '列表模板'",
            'template_show'=>$this->string(100)->notNull()." COMMENT '内容模板'",
            'template_page'=>$this->string(100)->notNull()." COMMENT '单页模板'",
            'cat_intro'=>$this->string(255)->notNull()." COMMENT '分类简介'",
            'cat_content'=>$this->text()->notNull()." COMMENT '分类内容'",
            'seo_title'=>$this->string(255)->notNull()." COMMENT 'SEO标题'",
            'seo_keywords'=>$this->string(255)->notNull()." COMMENT 'SEO关键字'",
            'seo_description'=>$this->text()->notNull()." COMMENT 'SEO描述'",
            'sort_order'=>$this->integer()->notNull()." COMMENT '排序'",
            'is_nav'=>$this->boolean()->notNull()." COMMENT '是否导航显示，0不显示，1显示'",
            'status'=>$this->boolean()->notNull()->defaultValue(1)." COMMENT '是否开启，0不开启，1开启'",
            'created_at' => $this->integer()->notNull()." COMMENT '创建时间'",
            'updated_at' => $this->integer()->notNull()." COMMENT '更新时间'",
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
    }
}
