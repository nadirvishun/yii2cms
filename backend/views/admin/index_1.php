<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\grid\GridView;
use kartik\grid\GridView;
use common\models\user;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
    // kartik\grid\GridViewAsset::register($this);
    $this->registerCss(".kv-merged-header{border-bottom:1px solid #eee !important}");
?>

<div class="user-index">
<!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <!--   <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    

    <?= GridView::widget([
        'id'=>'user',
        'options'=>['class'=>'grid-view box box-primary'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'rowOptions' => ['class' => GridView::TYPE_DANGER],
    //     'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    // 'filterRowOptions'=>['class'=>'kartik-sheet-style'],
         // 'beforeHeader'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          
         // 'afterHeader'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
    
        // 'showPageSummary' => true,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'rowSelectedClass' => GridView::TYPE_INFO,
                // 'visible'=>false
                // 'pageSummary'=>'总计',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute'=>'id',
                'width'=>'5%',
                // 'hAlign'=>'center',
                // 'filter'=>false,
                // 'mergeHeader'=>true,
                // 'pageSummary'=>true,
            ],
            // 'id',
            'username',
            ['attribute'=>'auth_key','hidden'=>true],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [ 
            // 'class'=>'kartik\grid\BooleanColumn',
        //     'trueLabel'=>'正常',
        //     'falseLabel'=>'禁用',
        // 'attribute'=>'status', 
                'attribute' => 'status',
                'filter'=>Html::activeDropDownList($searchModel,'status',User::getZhStatus(),['class' => 'form-control ']),
                // 'filterType'=>GridView::FILTER_SELECT2,
                'value'=>function($data){
                    return User::getZhStatus($data->status);
                },
            ],
            [
                'attribute'=>'created_at',
                'format'=>['date','php:Y-m-d'],
                'value'=>'created_at',

            ],
            // 'created_at',
            // 'updated_at',

            [
                'class' => '\kartik\grid\ActionColumn',
                // 'dropdown'=>true,
                'vAlign'=>'middle',
                'header'=>'操作',
                'headerOptions'=>['style'=>'color:#3c8dbc'],
                'template' => '{view} {update} {delete} {forbid} ',
                'buttons'=>[
                    'forbid'=>function($url,$model){
                        return Html::a('<i class="glyphicon glyphicon-remove-circle"></i>',['user/view','id'=>$model->id]);     
                    }
                ],
            ],
        ],

       // 'showPageSummary' => true,
        'panel' => [
             'heading'=>false,
        //     'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'success',
            // 'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']), 
            'before'=>'<div style="margin-top:8px">{summary}</div>',
            'after'=>false,
            // 'after'=>'{pager}',
            // 'afterOption'=>['style'=>"margin:0;padding:0"],
            // 'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),                                                                                                                                                         
            // 'footer'=>false
            'footer'=>'<div class="pull-right">'.Html::button('<i class="glyphicon glyphicon-remove-circle"></i> 批量禁止', [ 'class' => 'btn btn-primary','id'=>'bulk_forbid']).'</div>', 
            'footerOptions'=>[
                'style'=>'padding:5px 15px'
            ]
        ],
        'panelFooterTemplate'=>'<div class="kv-panel-pager pull-left">{pager}</div>{footer}<div class="clearfix"></div>',
        'toolbar'=>[
            // '{summary}',
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['user/create'],['data-pjax'=>0, 'class'=>'btn btn-success','title'=>'创建']).' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['user/index'],['data-pjax'=>0, 'class'=>'btn btn-default','title'=>'重置'])
            ],
            '{toggleData}',
            '{export}',   
        ],
        'floatHeader' => true,
        'floatHeaderOptions' => ['Top' => 0],

        'toggleDataOptions'=>[
             'maxCount' => 200,
             'minCount' => 10,
             'confirmMsg' => 
             '总共'. number_format($dataProvider->getTotalCount()).'条数据，确定要显示全部？',
        ],
        'export'=>[
            'fontAwesome'=>'fa fa-share-square-o',
            'target'=>'_blank',
            'encoding'=>'gbk',
        ],
        // 'condensed'=>true,
        'hover'=>true,
        'exportConfig' => [
            GridView::EXCEL=>[
                'label' => '导出Excel',
                // 'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
                'iconOptions' => ['class' => 'text-success'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => '用户表'.date("Y-m-d"),
                'alertMsg' => '确定要导出Excel格式文件？',
                'options' => ['title' => 'Microsoft Excel 95+'],
                'mime' => 'application/vnd.ms-excel',
                'config' => [
                    'worksheet' =>  '用户表',
                    'cssFile' => ''
                ]
            ],
            'csv' => [
            // 'columnSelector'=>'password_hash',
           
             
             'label' => '导出CSV',
             // 'icon' =>  'floppy-open', 
            'iconOptions' => ['class' => 'text-primary'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => '用户表'.date("Y-m-d"),
            'alertMsg' => '确定要导出CSV格式文件？',
            'options' => [
                // 'title' => '中文',
                // 'autoLangToFont' => true,    //这几个配置加上可以显示中文
                // 'autoScriptToLang' => true,  //这几个配置加上可以显示中文
                // 'autoVietnamese' => true,    //这几个配置加上可以显示中文
                // 'autoArabic' => true,        //这几个配置加上可以显示中文
            ],
            'mime' => 'application/csv',
            'config' => [
                'colDelimiter' => ",",
                'rowDelimiter' => "\r\n",
            ],
            ],
           
        ],
          // 'exportConversions'=>[ 'status'=>[
          //       ['from'=>0, 'to'=>'Active'],
          //       ['from'=>10, 'to'=>'Inactive']
          //   ],]
    ]); ?>

</div>

<?php
 $this->registerJs("
    $('#bulk_forbid').click(function(){
        var keys = $('#user').yiiGridView('getSelectedRows').length; 
        if(keys<=0){
            alert('没有任何行被选中');
        }else{
            if(confirm('确定要禁止这些选中数据吗？')){
                $.post('".Url::toRoute('user/bulk_forbid')."',{keys:keys},function(data){
                    if(data){
                        alert('禁止成功');
                        window.location.reload();
                    }else{
                        alert('禁止失败');
                    }
                });
            }
        }
    });
");?>