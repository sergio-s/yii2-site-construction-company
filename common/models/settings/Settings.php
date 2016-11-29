<?php

namespace common\models\settings;

use Yii;


/**
 * This is the model class for table "settings".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $options
 */
class Settings extends Model
{
    
    public $id;
    public $title;
    public $description;
    public $options;
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['options'], 'string'],
            [['title', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'options' => Yii::t('app', 'Options'),
        ];
    }
    
   
}

