<?php

/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use \yii\grid\GridView;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php $form = ActiveForm::begin([
        'id' => 'dirinfo',
        'fieldConfig' => [
            'template' => "{label}\n{hint}\n{input}\n<div style='color: red;'>{error}</div>"
        ],
        'options' => ['data' => ['pjax' => true]],
        'method' => 'post',
        'action' => ['site/update'],
    ]); ?>
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'filename',
                    'filesize',
                    'filetype',
                    'filetime'
                ]
            ]);
            ?>
        <?php Pjax::end(); ?>
        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary']); ?>
    <?php ActiveForm::end(); ?>
</div>
