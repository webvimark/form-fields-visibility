<?php
/**
 * @var $this yii\web\View
 * @var $modelName string
 * @var $attributes array
 */
use yii\bootstrap\Modal;

?>

<span data-toggle="modal" data-target="#page-fields-visibility" class="pull-right btn btn-sm btn-default" style="margin-top: -5px">
	<i class="fa fa-eye-slash"></i> Показать / скрыть поля
</span>

<? Modal::begin([
	'id'=>'page-fields-visibility',
	'size'=>Modal::SIZE_SMALL,
	'header'=>'<b>Показывать поля:</b>'
]) ?>

<?php foreach ($attributes as $attribute => $name): ?>

	<div class="checkbox">
		<label>
			<input data-attribute="<?= $attribute ?>" class="visibility-data" checked type="checkbox" id="visibility-checkbox-<?= $modelName . '-' . $attribute ?>">
			<?= $name ?>
		</label>
	</div>


<?php endforeach ?>
	<hr/>

<span class="btn btn-primary btn-block" id="save-fields-visibility">
	<i class="fa fa-check"></i> Сохранить
</span>

<? Modal::end() ?>