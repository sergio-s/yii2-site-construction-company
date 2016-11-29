<?php
namespace frontend\controllers\gb;

use Yii;
use yii\helpers\Url;
use frontend\controllers\BaseFront;
use yii\data\Pagination;
use app\models\sections\Sections;
use frontend\models\gb\GbForm;
use app\models\gb\Guestbook;
use app\models\gb\GbEnum;
use app\models\tags\Tags;
use common\models\settings\SettingsEnum;
use common\services\settings\SettingsService;
/**
 * PageController
 */
class GuestBookController extends BaseFront
{
    use \common\traits\PageHelper;
    
    private $pageSize = 20;//кол-во материалов на странице пагинации
    private $section;
    private $optionsServiceGB;

    public function init()
    {
        $this->optionsServiceGB = $this->settingsService
                ->findSettings(SettingsEnum::GB_SETTINGS_ID)
                ->getOptions(SettingsService::TYPE_ARRAY);
        
//        var_dump($this->optionsServiceGB);
        
        parent::init();
    }

    public function beforeAction($action) 
    {
        $this->section = Sections::getSectionFromName(Sections::SEC_GOEST_BOOK);

        if ($action->id === 'index') {
            $this->layout = '@app/views/layouts/tpl/photogalery';
            //$this->createAction('captcha')->getVerifyCode(true);//разрешаем обновление кода капчи при рефреше
        }
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'common\components\captcha\NumCaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'foreColor' => 0x5A9B27, // цвет символов
                'minLength' => 3, // минимальное количество символов
                'maxLength' => 5, // максимальное
                'offset' => 5, // расстояние между символами (можно отрицательное)
                
            ],
        ];
    }
    
    /**
     * Print home page.
     */
    public function actionIndex($pageNum = null)
    {
        //Work wich massages
        //построение постраничной навигации
        $query = Guestbook::getChiefId();//только id сообщений первого уровня

        $redirectFromNum1 = Url::toRoute(['index'], true);
        
        //эксперимент
        $cloneQuery = clone $query;
        $totalCount = $cloneQuery->count();
        $countPagin = ceil($totalCount / $this->pageSize);

        //если введена еденица, делаем редирект на без 1
        if($pageNum == 1)
        {
            return $this->redirect($redirectFromNum1);
        }
        
        //если в адресной строке введен номер пагинации, котрого нет - выводим
        if($pageNum > $countPagin)
        {
            throw new \yii\web\HttpException(404, 'Такой страницы не существует. ');
        }
        
        $pagination = new Pagination([  'defaultPageSize' => $this->pageSize,//кол-во материалов на стр.
                                        'totalCount' => $totalCount,//кол-во всех постов
                                        'pageParam' => 'pageNum',
                                        'forcePageParam' => false,
                            ]);
        //id chief messages in single pagination page
        $paginChiefMesId = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        
        $messagesTree = false;
        
        if (isset($paginChiefMesId) && !empty($paginChiefMesId)) {
            $ids = [];

            foreach ($paginChiefMesId as $messageChiefId) {
                $ids[] = $messageChiefId->id;
            }

            //$superParentsId = implode(',', $ids);
            
            //chief messages and  their descendants generated in single  page by pagination
            $paginMessages = Guestbook::find()
//                                            ->active()
                                            ->where([
//                                                        'super_parent_id' => $ids,//дочерние сообщения
//                                                        'id' => $ids,
                                                        'or', ['in', 'id', $ids], ['in', 'super_parent_id', $ids]
                                                        
                                                    ])
                                            ->orderBy(['parent_id' => SORT_DESC, 'createdDate' => SORT_DESC])
                                            //->with('author')//class Guestbook getAutor
                                            ->all();

            if (!empty($paginMessages)) {
                
                $messagesTree = Guestbook::buildTree($paginMessages);
                
            }
        }
        
        


//        $redirectFromNum1 = Url::toRoute(['index'], true);
//        list($pagination, $paginMessages, $totalCount) = static::buildPagination($query, $this->pageSize, $pageNum, $redirectFromNum1);
        
        //Work wich form
        $gbForm = new GbForm();
        
        if ($gbForm->load(Yii::$app->request->post()) && $gbForm->validate()){
                $gb = new Guestbook();
                
                //Записываем данные из модели формы в модель гостевой книги
                $gb->parent_id = $gbForm->parent_id;//id сообщ. на которое ответили (hiddenInput)
                $gb->visitor_name = $gbForm->visitor_name;//из input
                $gb->visitor_city = $gbForm->visitor_city;//из input
                $gb->message = $gbForm->message;//из input
                $gb->tagsId = $gbForm->tags;
                
                //настройка гостевой из таблицы settings
                if(in_array('guest' ,$this->optionsServiceGB['moderation_new_messages'])){
                    $gb->status = (string)GbEnum::STATUS_MODER;
                }
                
//                var_dump($gb);die;
                if($gb->validate() && $gb->save()){
                    return $this->redirect(['index']);
                    }
        }
        
        return $this->render('index',[
                                        'section' => $this->section,
                                        'gbForm'  => $gbForm,
                                        
                                        'messagesTree'      => $messagesTree,
                                        'nestingLevel'      => GbEnum::NESTING_LEVEL,
                                        'pagination'        => $pagination,
                                        'totalCount'        => $totalCount
            
                                ]);
    }
    
    
    /**
     * Print home page.
     */
//    public function actionForm()
//    {
//        $gbForm = new GbForm();
//        
//        if(Yii::$app->user->isGuest){
//            $gbForm->scenario = GbForm::SCENARIO_GUEST;
//        }else{
//            $gbForm->scenario = GbForm::SCENARIO_REGISTERED;
//        }
//        
//        
//        
//        return $this->render('form',[
//                                        
//                                        'gbForm'           => $gbForm,
//                                ]);
//    }
   
}


