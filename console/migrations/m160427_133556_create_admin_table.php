<?php

use yii\db\Migration;

class m160427_133556_create_admin_table extends Migration
{
    const TBL_NAME = '{{%admin}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT="后台管理员表"';
        }
        $this->createTable(self::TBL_NAME, [
             'id' => $this->primaryKey(),
            'username'=>$this->string()->notNull()->unique()." COMMENT '用户名'",
            'auth_key'=>$this->string(32)->notNull()." COMMENT '认证Key'",
            'password_hash'=>$this->string()->notNull()." COMMENT '密码'",
            'password_reset_token'=>$this->string()->unique()." COMMENT '密码重置Token'",
            'email'=>$this->string()->notNull()->unique()." COMMENT '邮箱'",
            'status'=>$this->smallInteger()->notNull()->defaultValue(10)." COMMENT '状态'",
            'created_at' => $this->integer()->notNull()." COMMENT '创建时间'",
            'updated_at' => $this->integer()->notNull()." COMMENT '更新时间'",
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
    }
}
