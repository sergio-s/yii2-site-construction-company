<?php

namespace common\models\avatars;

/**
 * This is the ActiveQuery class for [[Avatars]].
 *
 * @see Avatars
 */
class AvatarsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Avatars[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Avatars|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
