<?php
namespace common\repositories\settings;

//use yii\db\Command;
use \yii\db\Query;


class SettingsRepositoryQuery implements ISettingsRepository
{
    private $query;
    
    private $field = null;//одно поле в бд
    
    private $col_options;
    
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    public static function tableName()
    {
        return 'settings';
    }
    
    /**
     * @var MemoryStorage
     */
    public function getAllSettings()
    {
        return $this->query
                ->select('*')
                ->from(self::tableName())
                ->all();
    }        

    public function getSettingsById($id)
    {
        return $this->query
                ->select('*')
                ->from(self::tableName())
                ->where('id=:id', [':id' => $id])
                ->one();
    }
    
    
}

