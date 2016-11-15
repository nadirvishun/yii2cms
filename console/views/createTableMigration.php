<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name */
/* @var $table string the name table */
/* @var $fields array the fields */

echo "<?php\n";
?>

use yii\db\Migration;

class <?= $className ?> extends Migration
{
    const TBL_NAME = '{{%<?=$table?>}}';
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB COMMENT="填写表注释"';
        }
        $this->createTable(self::TBL_NAME, [
<?php foreach ($fields as $field): ?>
<?php if ($field == end($fields)): ?>
            '<?= $field['property'] ?>' => $this-><?= $field['decorators'].".\" COMMENT '填写段注释'\"" . "\n"?>
<?php else: ?>
            '<?= $field['property'] ?>' => $this-><?= $field['decorators'].".\" COMMENT '填写段注释'\"" . ",\n"?>
<?php endif; ?>
<?php endforeach; ?>
        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable(self::TBL_NAME);
    }
}
