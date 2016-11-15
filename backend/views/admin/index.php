<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\dialog\Dialog;
use backend\models\Admin;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台管理员';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss(".kv-merged-header{border-bottom:1px solid #eee !important}");
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Dialog::widget([
       'libName' => 'krajeeDialog',
       'options' => [
            'size' => Dialog::SIZE_SMALL,
       ], // default options
    ]);
    ?>

    <?= GridView::widget([
        'id'=>'admin',
        'options'=>['class'=>'grid-view box box-primary'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
                'rowSelectedClass' => GridView::TYPE_INFO
            ],

            'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            // 'status',
            // 'created_at',
            // 'updated_at',
             [ 
                'attribute' => 'status',
                'filter'=>Html::activeDropDownList($searchModel,'status',Admin::getZhStatus(),['class' => 'form-control ']),
                'value'=>function($data){
                    return Admin::getZhStatus($data->status);
                },
            ],
            [
             'class' => 'kartik\grid\ActionColumn',
             'header'=>'操作',
             'headerOptions'=>['style'=>'color:#3c8dbc'],
            ],
        ],
        'hover'=>true,
        // 'floatHeader'=>true,
        // 'floatHeaderOptions' => ['top' => 0],
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
             'minCount' => true,
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
</div>
<?php
 $this->registerJs("
    // function abc(){
    //     return window.confirm('123')    
    // }
// function abc(){
//     krajeeDialog.confirm('确定要禁止这些选中数据吗？',function(result){
//                     if(result){
//                         return true;
//                     }else{
//                         return false;
//                     }
//             });
// }
    $('#bulk_forbid').click(function(){
        var keys = $('#admin').yiiGridView('getSelectedRows').length; 
        if(keys<=0){
           krajeeDialog.alert('没有任何行被选中');
        }else{
            krajeeDialog.confirm('确定要禁止这些选中数据吗？',function(result){
                    if(result){
                        krajeeDialog.alert('true');
                    }else{
                        
                        var dialogShow=BootstrapDialog.show({
                            type:BootstrapDialog.TYPE_SUCCESS, 
                            title:'提示消息',
                            message:'创建成功，3s后自动关闭',
                            size:BootstrapDialog.SIZE_SMALL,
                            buttons:[
                                {
                                    label: '关闭',
                                    action: function(dialogItself){
                                        dialogItself.close();
                                    }
                                }
                            ]
                        });
                        setTimeout(function(){ dialogShow.close() }, 3000);

                    }
            });


        // if(abc()){
        //     alert('456');
        // }
 
    

            // krajeeDialog.confirm('确定要禁止这些选中数据吗？',function(result){
            //     if(result){
            //         $.post('".Url::toRoute('admin/bulk_forbid')."',{keys:keys},function(data){
            //             if(data){
            //                 alert('禁止成功');
            //                 window.location.reload();
            //             }else{
            //                 alert('禁止失败');
            //             }
            //         });
            //     }
            // });
        }
    });
");?>