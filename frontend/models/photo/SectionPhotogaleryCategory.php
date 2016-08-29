<?php

namespace app\models\photo;

use Yii;

/**
 * This is the model class for table "section_photogalery_category".
 *
 * @property string $id
 * @property string $alias
 * @property string $status
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $h1
 * @property string $imgSrc
 * @property string $createdBy
 * @property string $updatedBy
 * @property string $createdTime
 * @property string $updatedTime
 *
 * @property SectionPhotogaleryImg[] $sectionPhotogaleryImgs
 */
class SectionPhotogaleryCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section_photogalery_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'description', 'h1', 'imgSrc', 'createdBy'], 'required'],
            [['status'], 'string'],
            [['createdTime', 'updatedTime'], 'safe'],
            [['alias', 'title', 'description', 'keywords', 'h1', 'imgSrc', 'createdBy', 'updatedBy'], 'string', 'max' => 255],
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
            'alias' => Yii::t('app', 'Alias'),
            'status' => Yii::t('app', 'Status'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'h1' => Yii::t('app', 'H1'),
            'imgSrc' => Yii::t('app', 'Img Src'),
            'createdBy' => Yii::t('app', 'Created By'),
            'updatedBy' => Yii::t('app', 'Updated By'),
            'createdTime' => Yii::t('app', 'Created Time'),
            'updatedTime' => Yii::t('app', 'Updated Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectionPhotogaleryImgs()
    {
        return $this->hasMany(SectionPhotogaleryImg::className(), ['categoryId' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SectionPhotogaleryCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectionPhotogaleryCategoryQuery(get_called_class());
    }
    
    public static function getCategoryFromAlias($alias)
    {
        return self::find()->whereAlias($alias)->one();
        
    }
    
    /**
     * Для пагинации без ->all();
     * @param type $sort
     * @return type
     */
    public static function getAllCatsPagin($sort = 'SORT_DESC')
    {
        return self::find()->orderBy(['id' => $sort]);
        
    }
}
