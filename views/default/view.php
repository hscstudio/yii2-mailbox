<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Nav;

/**
 * @var yii\web\View $this
 * @var hscstudio\startup\models\Mailbox $model
 */

$this->title = 'View Mailbox';
$this->params['breadcrumbs'][] = ['label' => 'Mailboxs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailbox-view">
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default box box-default">
		<div class="panel-body box-body">
	<?php
		$menuItems = [
			['encode'=>false,'label' => '<i class="fa fa-inbox"></i> Inbox', 'url' => ['index']],
			['encode'=>false,'label' => '<i class="fa fa-envelope-o"></i> Sent', 'url' => ['sent']],
			['encode'=>false,'label' => '<i class="fa fa-file-text-o"></i> Draft', 'url' => ['draft']],
		];
		echo Nav::widget([
			'options' => ['class' => 'nav nav-pills nav-stacked'],
			'items' => $menuItems,
		]);
	?>
		</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default box box-default">
		<div class="panel-heading box-header with-border">
			<h3 class="panel-title box-title"><?= Html::encode($this->title) ?></h3>
		</div>
		<div class="panel-body box-body">

		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'id',
				'sender',
				'receiver',
				'subject',
				'content:ntext',
				'readed',
				'status',
				'created_at',
				'updated_at',
			],
		]) ?>
		</div>
		</div>
	</div>
</div>
</div>
