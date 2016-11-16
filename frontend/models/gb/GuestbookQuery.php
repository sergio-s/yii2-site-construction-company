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
    
//    public function whereStatus($status)
//    {
//        return $this->andWhere(['status' => $alias]);
//    }
    
    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => GbEnum::STATUS_ACTIVE]);
        return $this;
    }
    
    /**
     * @return $this
     */
    public function desabled()
    {
        $this->andWhere(['status' => GbEnum::STATUS_DISABLED]);
        return $this;
    }
    
    /**
     * @return $this
     */
    public function spam()
    {
        $this->andWhere(['status' => GbEnum::STATUS_SPAM]);
        return $this;
    }
    
    //сообщение 0-го уровня
    public function chiefAncestor()
    {
        return $this->andWhere(['parent_id' => 0]);
    }
}
