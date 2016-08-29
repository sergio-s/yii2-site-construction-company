<?php

namespace app\models\page;

use Yii;

/**
 * This is the model class for table "section_page".
 *
 * @property string $id
 * @property string $is_home
 * @property string $alias
 * @property string $status
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property string $content
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $createdBy
 * @property string $updatedBy
 * @property string $canComment
 */
class SectionPage extends \yii\db\ActiveRecord
{
    const HOME_PAGE = 1;
    const NORMAL_PAGE = 0;
    
    const ACTIVE = 1;
    const DISABLED = 0;
    
    /**
     * Page type - home page or normal page
     * @return array
     */
    public static function getPageTypeLabels()
    {
        return[
            self::HOME_PAGE     => Yii::t('app', 'Домашняя страница'),
            self::NORMAL_PAGE   => Yii::t('app', 'Обычная страница'),
        ];
    }
    
    /**
     * Status  - active or disabled page
     * @return array
     */
    public static function getStatusesLabels()
    {
        return[
            self::ACTIVE    => Yii::t('app', 'Страница опубликована'),
            self::DISABLED  => Yii::t('app', 'Страница отключена'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_home', 'status', 'content', 'canComment'], 'string'],
            [['alias', 'title', 'h1'], 'required'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['alias', 'title', 'description', 'keywords', 'h1', 'createdBy', 'updatedBy'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'is_home' => Yii::t('app', 'Is Home'),
            'alias' => Yii::t('app', 'Alias'),
            'status' => Yii::t('app', 'Status'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'h1' => Yii::t('app', 'H1'),
            'content' => Yii::t('app', 'Content'),
            'createdDate' => Yii::t('app', 'Created Date'),
            'updatedDate' => Yii::t('app', 'Updated Date'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'canComment' => Yii::t('app', 'Can Comment'),
        ];
    }

    /**
     * @inheritdoc
     * @return SectionPageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectionPageQuery(get_called_class());
    }
    
    public static function getHomePage()
    {
        return self::find()->pageType(self::HOME_PAGE)->one();
    } 
    public static function getPageFromAlias($alias)
    {
        return self::find()->pageType(self::NORMAL_PAGE)->andWhere(['alias' => $alias])->one();
    }
}
