<?php

use yii\db\Migration;

class m160724_083227_create_test_tree_table extends Migration
{
    const TBL_NAME = '{{%test_tree}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT="填写表注释"';
        }
        $this->createTable(self::TBL_NAME, [
            'id' => $this->primaryKey()." COMMENT '填写段注释'"
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
    }
}
