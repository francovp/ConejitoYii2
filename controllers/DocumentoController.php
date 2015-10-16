<?php

namespace app\controllers;

use Yii;
use app\models\documento;
use app\models\documentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\UploadedForm;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
 * DocumentoController implements the CRUD actions for documento model.
 */
class DocumentoController extends Controller
{
  public function behaviors()
  {

      return [
        'access'=>[
            'class'=>AccessControl::classname(),
            'only'=>['create','update','delete',"upload"],
            'rules'=>[
                [
                  'allow'=>true,
                  'roles'=>['@']
                ],
        ]
      ],
          'verbs' => [
              'class' => VerbFilter::className(),
              'actions' => [
                  'delete' => ['post'],
              ],
          ],
      ];
  }

    /**
     * Lists all documento models.
     * @return mixed
     */


    public function actionIndex()
    {
        $searchModel = new documentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single documento model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new documento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new documento();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

          // get the instance of the uploaded file
          $imageName= $model->nombre;
          $model->file = UploadedFile::getInstance($model,'file');
          $model->file->saveAS('uploads/'.$imageName.'.'.$model->file->extension);

          //save the path in the DB
          $model->link = 'uploads/' . $model->nombre.'.' . $model->file->extension;
          $model->fecha = date('Y-m-d h:m:s');
          $model->save();


            return $this->redirect(['view', 'id' => $model->id_documento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing documento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_documento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing documento model.
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
     * Finds the documento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return documento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = documento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
