<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Meeting;
use frontend\models\MeetingSearch;
use frontend\models\MeetingNoteSearch;
use frontend\models\MeetingPlaceSearch;
use frontend\models\MeetingTimeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetingController implements the CRUD actions for Meeting model.
 */
class MeetingController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Meeting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MeetingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meeting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
      $timeSearchModel = new MeetingTimeSearch();
      $timeProvider = $timeSearchModel->search(['meeting_id'=>'id']);

      $noteSearchModel = new MeetingNoteSearch();
      $noteProvider = $noteSearchModel->search(['meeting_id'=>'id','sort'=>'created_at']);

      $placeSearchModel = new MeetingplaceSearch();
      $placeProvider = $placeSearchModel->search(['meeting_id'=>'id']);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'timeProvider' => $timeProvider,
            'noteProvider' => $noteProvider,
            'placeProvider' => $placeProvider,
        ]);
    }

    /**
     * Creates a new Meeting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Meeting();
        if ($model->load(Yii::$app->request->post())) {
          $model->owner_id= Yii::$app->user->getId();
          // validate the form against model rules
          if ($model->validate()) {
              // all inputs are valid
              $model->save();
              return $this->redirect(['view', 'id' => $model->id]);
          } else {
              // validation failed
              return $this->render('create', [
                  'model' => $model,
              ]);
          }          
        } else {
          return $this->render('create', [
              'model' => $model,
          ]);          
        }
    }

    /**
     * Updates an existing Meeting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->title = $model->getMeetingTitle($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Meeting model.
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
     * Finds the Meeting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Meeting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meeting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionSwitch($id,$val) {
      return $id.' '.$val;
    }
}
