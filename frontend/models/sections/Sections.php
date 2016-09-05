<?php

namespace app\models\sections;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property string $id
 * @property string $section_name
 * @property string $title
 * @property string $descriptions
 * @property string $keywords
 * @property string $h1
 * @property string $content
 */
class Sections extends \yii\db\ActiveRecord
{
    const SEC_PHOTOGALERY = 'section_photogalery';
    const SEC_GOEST_BOOK = 'section_goest_book';
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'section_name'], 'required'],
            [['id'], 'integer'],
            [['content'], 'string'],
            [['section_name', 'title', 'descriptions', 'keywords', 'h1'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'section_name' => Yii::t('app', 'Section Name'),
            'title' => Yii::t('app', 'Title'),
            'descriptions' => Yii::t('app', 'Descriptions'),
            'keywords' => Yii::t('app', 'Keywords'),
            'h1' => Yii::t('app', 'H1'),
            'content' => Yii::t('app', 'Content'),
        ];
    }

    /**
     * @inheritdoc
     * @return SectionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SectionsQuery(get_called_class());
    }
    
    public static function getSectionFromName($sectionName)
    {
        return self::find()->andWhere(['section_name' => $sectionName])->one();
    } 
    
}
