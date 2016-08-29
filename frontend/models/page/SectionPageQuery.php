<?php

namespace app\models\page;

/**
 * This is the ActiveQuery class for [[SectionPage]].
 *
 * @see SectionPage
 */
class SectionPageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SectionPage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SectionPage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function pageType($pageType)
    {
       return $this->andWhere(['is_home' => (string)$pageType]);
    }
    
    public function pageStatus($pageStatus)
    {
       return $this->andWhere(['status' => (string)$pageStatus]);
    }
    
    
}
