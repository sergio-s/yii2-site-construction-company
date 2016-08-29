<?php

namespace app\models\photo;

/**
 * This is the ActiveQuery class for [[SectionPhotogaleryCategory]].
 *
 * @see SectionPhotogaleryCategory
 */
class SectionPhotogaleryCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SectionPhotogaleryCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SectionPhotogaleryCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
    
    public function whereAlias($alias)
    {
        return $this->andWhere(['alias' => $alias]);
    }
    
    public function whereStatus($status)
    {
       return $this->andWhere(['status' => (string)$status]);
    }
    
}
