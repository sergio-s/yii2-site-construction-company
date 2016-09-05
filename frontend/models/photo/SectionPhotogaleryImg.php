<?php

namespace app\models\photo;

use Yii;

/**
 * This is the model class for table "section_photogalery_img".
 *
 * @property string $id
 * @property string $categoryId
 * @property string $alias
 * @property string $status
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property string $imgSrc
 * @property string $content
 * @property string $didWorkTime
 * @property string $createdTime
 * @property string $updatedTime
 * @property string $createdBy
 * @property string $updatedBy
 * @property string $canComment
 *
 * @property SectionPhotogaleryCategory $category
 */
class SectionPhotogaleryImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section_photogalery_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryId'], 'integer'],
            [['alias', 'title', 'description', 'h1', 'imgSrc', 'updatedBy'], 'required'],
            [['status', 'content', 'canComment'], 'string'],
            [['didWorkTime', 'createdTime', 'updatedTime'], 'safe'],
            [['alias', 'title', 'description', 'keywords', 'h1', 'imgSrc', 'createdBy', 'updatedBy'], 'string', 'max' => 255],
            [['alias'], 'unique'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => SectionPhotogaleryCategory::className(), 'targetAttribute' => ['categoryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'categoryId' => Yii::t('app', 'Category ID'),
            'alias' => Yii::t('app', 'Alias'),
            'status' => Yii::t('app', 'Status'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'h1' => Yii::t('app', 'H1'),
            'imgSrc' => Yii::t('app', 'Img Src'),
            'content' => Yii::t('app', 'Content'),
            'didWorkTime' => Yii::t('app', 'Did Work Time'),
            'createdTime' => Yii::t('app', 'Created Time'),
            'updatedTime' => Yii::t('app', 'Updated Time'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'canComment' => Yii::t('app', 'Can Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(SectionPhotogaleryCategory::className(), ['id' => 'categoryId']);
    }

    public static function getPageFromAlias($alias)
    {
        return self::find()->whereAlias($alias)->one();
    }
    
    /**
     * @inheritdoc
     * @return SectionPhotogaleryImgQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectionPhotogaleryImgQuery(get_called_class());
    }
}
