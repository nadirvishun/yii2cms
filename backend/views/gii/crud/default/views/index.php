<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss(".kv-merged-header{border-bottom:1px solid #eee !important}");
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

<?php if(!empty($generator->searchModelClass)): ?>
<?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>


<?= $generator->enablePjax ? '<?php Pjax::begin(); ?>' : '' ?>
<?php if ($generator->indexWidgetType === 'grid'): ?>
    <?= "<?= " ?>GridView::widget([
        'options'=>['class'=>'grid-view box box-primary'],
        'dataProvider' => $dataProvider,
        <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'rowSelectedClass' => GridView::TYPE_INFO
            ],

<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "            '" . $name . "',\n";
        } else {
            echo "            // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "            // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>

            [
             'class' => 'kartik\grid\ActionColumn',
             'header'=>'操作',
             'headerOptions'=>['style'=>'color:#3c8dbc'],
            ],
        ],
        'hover'=>true,
        'panel' => [
            'heading'=>false,
            'before'=>'<div style="margin-top:8px">{summary}</div>',
            'after'=>false,
            'footer'=>'<div class="pull-right">'.Html::button('<i class="glyphicon glyphicon-remove-circle"></i> 批量禁止', [ 'class' => 'btn btn-primary','id'=>'bulk_forbid']).'</div>', 
            'footerOptions'=>[
                'style'=>'padding:5px 15px'
            ]
        ],
        'panelFooterTemplate'=>'<div class="kv-panel-pager pull-left">{pager}</div>{footer}<div class="clearfix"></div>',
        'toolbar'=>[
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],['data-pjax'=>0, 'class'=>'btn btn-success','title'=>'创建']).' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'],['data-pjax'=>0, 'class'=>'btn btn-default','title'=>'重置'])
            ],
            '{toggleData}',
            '{export}',   
        ],
        'toggleDataOptions'=>[
             'maxCount' => 200,
             'minCount' => 1,
             'confirmMsg' => '总共'. number_format($dataProvider->getTotalCount()).'条数据，确定要显示全部？',
        ],
        'export'=>[
            'fontAwesome'=>'fa fa-share-square-o',
            'target'=>'_blank',
            'encoding'=>'gbk',
        ],
        'exportConfig' => [
            GridView::CSV => [
                'label' => '导出CSV',
                'iconOptions' => ['class' => 'text-primary'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => '用户表'.date("Y-m-d"),
                'alertMsg' => '确定要导出CSV格式文件？',
                'options' => [
                     'title' => 'CSV',
                ],
                'mime' => 'application/csv',
                'config' => [
                    'colDelimiter' => ",",
                    'rowDelimiter' => "\r\n",
                ],
            ],
        ],
    ]); ?>
<?php else: ?>
    <?= "<?= " ?>ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
        },
    ]) ?>
<?php endif; ?>
<?= $generator->enablePjax ? '<?php Pjax::end(); ?>' : '' ?>
</div>
