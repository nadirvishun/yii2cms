<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;//时间行为
/**
 * This is the model class for table "{{%cms_category}}".
 *
 * @property integer $cat_id
 * @property integer $cat_pid
 * @property integer $cat_level
 * @property string $cat_name
 * @property string $cat_second_name
 * @property string $cat_name_alias
 * @property string $redirect_url
 * @property string $cat_img
 * @property string $cat_thumb_img
 * @property integer $display_type
 * @property string $template_list
 * @property string $template_show
 * @property string $template_page
 * @property string $cat_intro
 * @property string $cat_content
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property integer $sort_order
 * @property integer $is_nav
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class CmsCategory extends \yii\db\ActiveRecord
{
    const STATUS_DISPLAY=1;
    const STATUS_HIDDEN=0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cms_category}}';
    }

    /**
     * 行为
     * @return [type] [description]
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),//默认名称就为create_at和updae_at，且默认是before_insert和before_update
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_pid', 'cat_level', 'cat_name', 'cat_second_name', 'cat_name_alias', 'redirect_url', 'cat_img', 'cat_thumb_img', 'display_type', 'template_list', 'template_show', 'template_page', 'cat_intro', 'cat_content', 'seo_title', 'seo_keywords', 'seo_description', 'sort_order', 'is_nav', 'created_at', 'updated_at'], 'required'],
            [['cat_pid', 'cat_level', 'display_type', 'sort_order', 'is_nav', 'status', 'created_at', 'updated_at'], 'integer'],
            [['cat_content', 'seo_description'], 'string'],
            [['cat_name', 'cat_second_name', 'cat_name_alias', 'template_list', 'template_show', 'template_page'], 'string', 'max' => 100],
            [['redirect_url', 'cat_img', 'cat_thumb_img', 'cat_intro', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => Yii::t('app', '分类ID'),
            'cat_pid' => Yii::t('app', '父ID'),
            'cat_level' => Yii::t('app', '层级'),
            'cat_name' => Yii::t('app', '分类名称'),
            'cat_second_name' => Yii::t('app', '分类副名称'),
            'cat_name_alias' => Yii::t('app', '分类别名'),
            'redirect_url' => Yii::t('app', '跳转地址'),
            'cat_img' => Yii::t('app', '分类图片'),
            'cat_thumb_img' => Yii::t('app', '分类缩略图'),
            'display_type' => Yii::t('app', '模板类型'),
            'template_list' => Yii::t('app', '列表模板'),
            'template_show' => Yii::t('app', '内容模板'),
            'template_page' => Yii::t('app', '单页模板'),
            'cat_intro' => Yii::t('app', '分类简介'),
            'cat_content' => Yii::t('app', '分类内容'),
            'seo_title' => Yii::t('app', 'SEO标题'),
            'seo_keywords' => Yii::t('app', 'SEO关键字'),
            'seo_description' => Yii::t('app', 'SEO描述'),
            'sort_order' => Yii::t('app', '排序'),
            'is_nav' => Yii::t('app', '是否导航显示'),
            'status' => Yii::t('app', '是否开启'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '更新时间'),
        ];
    }
    /**
     * 保存前将时间写入
     * 由于上方已有behaviors方法，所以此方法可以不用了，
     * @param  [type] $insert [description]
     * @return [type]         [description]
     */
    /*public function beforeSave($insert){
        if(parenet::beforeSave($insert)){
            if($this->IsNewRecord){
                $this->created_at=time();
            }else{
                $this->updated_at=time();
            }
            return true;
        }else{
            return false;
        }
    }*/

    /**
     * 显示状态
     * @param  boolean $status [description]
     * @return [type]          [description]
     */
    public static function getStatusOption($status=false){
        $status_array= [
            ''=>'请选择',
            self::STATUS_HIDDEN=>'隐藏',
            self::STATUS_DISPLAY=>'显示'
        ];
        return $status==false?$status_array:ArrayHelper::getValue($status_array,$status,'未知');
    }

    /**
     * 是否导航显示
     * @param  boolean $is_nav [description]
     * @return [type]          [description]
     */
    public static function getNavOption($is_nav=false){
        $nav_array= [
            ''=>'请选择',
            self::STATUS_HIDDEN=>'不显示',
            self::STATUS_DISPLAY=>'显示'
        ];
        return $is_nav==false?$nav_array:ArrayHelper::getValue($nav_array,$is_nav,'未知');
    }

}
