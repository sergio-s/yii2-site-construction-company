<?php
namespace frontend\controllers\gb;

use Yii;
use yii\helpers\Url;
use frontend\controllers\BaseFront;
use yii\data\Pagination;
use app\models\sections\Sections;
use frontend\models\gb\GbForm;
use app\models\gb\Guestbook;

/**
 * PageController
 */
class GuestBookController extends BaseFront
{
    private $pageSize = 6;//кол-во материалов на странице пагинации
    private $section;
    
    public function beforeAction($action) 
    {
        $this->section = Sections::getSectionFromName(Sections::SEC_GOEST_BOOK);
        
        if ($action->id === 'index') {
            $this->layout = '@app/views/layouts/tpl/photogalery';
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
        $gbForm = new GbForm();
        $gb = new Guestbook();
        
        if(Yii::$app->user->isGuest){
            $gbForm->scenario = GbForm::SCENARIO_GUEST;
            $visitor_type = GbForm::VISITOR_TYPE_GUEST;
        }else{
            $gbForm->scenario = GbForm::SCENARIO_REGISTERED;
            $visitor_type = GbForm::VISITOR_TYPE_REGISTERED;
        }
        
        if ($gbForm->load(Yii::$app->request->post()) && $gbForm->validate()){
            $gb->ip = Yii::$app->getRequest()->getUserIP();
            $gb->visitor_type = Yii::$app->getRequest()->getUserIP();
        }
        
        return $this->render('index',[
                                        'section' => $this->section,
                                        'gbForm'  => $gbForm,
                                        
//                                        'paginCategories'   => $paginCategories,
//                                        'pagination'        => $pagination,
//                                        'totalCount'        => $totalCount
            
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


