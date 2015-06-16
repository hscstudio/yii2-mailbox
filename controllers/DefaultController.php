<?php

namespace hscstudio\mailbox\controllers;

use Yii;
use hscstudio\mailbox\models\Mailbox;
use hscstudio\mailbox\models\MailboxSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class DefaultController extends Controller
{
	/**
     * @var User User for check access.
     */
	
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ];
    }
	
	/**
     * Lists all Mailbox models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MailboxSearch();
		$params = ArrayHelper::merge(Yii::$app->request->getQueryParams(),[
			'MailboxSearch' => [
				'receiver' => Yii::$app->user->id,
				'status' => 1,
			]
		]);
        $dataProvider = $searchModel->search($params);		
		$dataProvider->setSort([
			'defaultOrder' => ['updated_at'=>SORT_DESC],
		]);		
		
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
	
	public function actionSent()
    {
        $searchModel = new MailboxSearch();
		$params = ArrayHelper::merge(Yii::$app->request->getQueryParams(),[
				'MailboxSearch' => [
					'sender' => Yii::$app->user->id,
					'status' => 1,
				]
			]);
        $dataProvider = $searchModel->search($params);
		$dataProvider->setSort([
			'defaultOrder' => ['updated_at'=>SORT_DESC],
		]);
		
        return $this->render('sent', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }
	
	public function actionDraft()
    {
        $searchModel = new MailboxSearch();
		$params = ArrayHelper::merge(Yii::$app->request->getQueryParams(),[
				'MailboxSearch' => [
					'sender' => Yii::$app->user->id,
					'status' => 0,
				]
			]);
        $dataProvider = $searchModel->search($params);
		$dataProvider->setSort([
			'defaultOrder' => ['updated_at'=>SORT_DESC],
		]);
		
        return $this->render('draft', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Mailbox model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		if($model->receiver==Yii::$app->user->id){
			$model->readed = true;
			$model->save();
		}
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Mailbox model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mailbox([
			'status' => 1
		]);

        if ($model->load(Yii::$app->request->post())) {
			$model->sender = Yii::$app->user->id;	
			$receivers = $model->receiver;
			if(count($receivers)>1){
				$receivers = $model->receiver;
				foreach($receivers as $receiver){
					$model2 = new Mailbox;
					$model2->attributes = $model->attributes;
					$model2->receiver = $receiver;
					$model2->save();
				}
			}
			else{
				if ($model->save()){
				 
				}
			}
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Mailbox model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			$model->sender = Yii::$app->user->id;	
			if ($model->save()){
			 
			}
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Mailbox model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mailbox model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mailbox the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mailbox::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionGetMailbox() 
	{		    
		$session = Yii::$app->session;
		$stream = false;
		$objMailboxs = Mailbox::find()
			->where([
				'receiver' => Yii::$app->user->id,
				'readed' => 0,
				'status' => 1,
			])
			->orderBy('updated_at DESC')
			->one();
		if($objMailboxs){
			if ($session->has('message_time')){
				if($session->get('message_time')==$objMailboxs->updated_at){
					// TETAP
					$stream = 1;
				}
				else{
					// BERUBAH
					$stream = 1;
				}
			}
			else{
				$session->set('message_time', $objMailboxs->updated_at);
				// BERUBAH
				$stream = 1;
			}
		}
		else{
			// BERUBAH
			$stream = 1;
			
		}
		
		header('Content-Type: text/event-stream');
		if($stream){
			header('Cache-Control: no-cache');
			echo "retry: 10000\n"; // Optional. We tell the browser to retry after 10 seconds
			$countMailbox = 0;
			$objMailboxs = Mailbox::find()
				->where([
					'receiver' => Yii::$app->user->id,
					'readed' => 0,
					'status' => 1,
				])
				->orderBy('updated_at DESC')
				->all();
			$listMailbox = "";
			if($objMailboxs){					
				$subjects=[];
				$photos=[];
				$i=1;
				foreach($objMailboxs as $message){	
					$ds = DIRECTORY_SEPARATOR;
					$global_path = Yii::getAlias("@common") . $ds . 'files' . $ds; 
					$path = $global_path.$ds.'users'.$ds;
					if(file_exists($path . $message->sender . '.jpg')){
						$photos[] = Url::to(['site/download','file'=>'users/'.$message->sender.'.jpg','preview'=>true]);
					}
					else{
						$photos[] = $AdminLTEAsset->baseUrl . '/img/user2-160x160.jpg';
					}	
					$subjects[] = "".$message->subject."";
					$urls[] = Url::to(['message/view','id'=>$message->id]); 
					$times[] = $message->updated_at;				
					$i++;				
				}
				$subjects = '' . implode('|',$subjects) . '';
				$urls = '' . implode('|',$urls) . '';
				$times = '' . implode('|',$times) . '';
				$photos = '' . implode('|',$photos) . '';
				$countMailbox = $i-1;
			}	
			echo "data: {\"subjects\": \"".$subjects."\",\"times\": \"".$times."\",\"photos\": \"".$photos."\",\"urls\": \"".$urls."\",\"count\": \"".$countMailbox."\"}\n\n";
			flush();
		}
	}
	
}