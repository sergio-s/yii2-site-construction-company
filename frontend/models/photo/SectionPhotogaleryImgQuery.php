<?php

namespace app\models\photo;

/**
 * This is the ActiveQuery class for [[SectionPhotogaleryImg]].
 *
 * @see SectionPhotogaleryImg
 */
class SectionPhotogaleryImgQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SectionPhotogaleryImg[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SectionPhotogaleryImg|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
