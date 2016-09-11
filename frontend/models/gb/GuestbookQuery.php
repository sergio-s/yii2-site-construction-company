<?php

namespace app\models\gb;

/**
 * This is the ActiveQuery class for [[Guestbook]].
 *
 * @see Guestbook
 */
class GuestbookQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Guestbook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Guestbook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
