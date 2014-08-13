<?php
namespace app\webvimark\extensions\FormFieldsVisibility;


use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

class FormFieldsVisibility extends Widget
{
	/**
	 * Model itself or it's class name
	 *
	 * @var ActiveRecord|string
	 */
	public $model;

	/**
	 * Example (key - attributes, value - description):
	 * 	[
	 * 		'url'=>'Some short url',
	 * 		'meta_keywords'=> 'Some seo stuff',
	 * 	]
	 *
	 * @var array
	 */
	public $attributes = [];

	/**
	 * @var string
	 */
	protected $_modelName;

	/**
	 * Initialize attributes
	 *
	 * @throws \yii\base\InvalidConfigException
	 */
	public function init()
	{
		if ( ! $this->model )
		{
			throw new InvalidConfigException('Model is missing');
		}

		$this->_modelName = $this->model instanceof ActiveRecord ? Inflector::camel2id(StringHelper::basename(get_class($this->model))) : $this->model;
	}

	/**
	 * @return string
	 */
	public function run()
	{
		$this->initJs();

		return $this->render('button', [
			'modelName'      => $this->_modelName,
			'attributes' => $this->attributes,
		]);
	}

	/**
	 * Hide fields that already has been saved as "need to disappear"
	 */
	protected function initJs()
	{
		$js = <<<JS

		var encodedFields = localStorage.getItem('__field_visibility_$this->_modelName');

		if ( encodedFields )
		{
			var fields = JSON.parse(encodedFields);

			fields.forEach(function(name) {
				$('.field-$this->_modelName-' + name).hide();

				// Also disable checkboxes in modal window
				$('#' + 'visibility-checkbox-$this->_modelName-' + name).prop('checked', false);
			})
		}

		// On click "Save" button
		$('#save-fields-visibility').on('click', function(){
			var fieldsToHide = [];

			$.each($('.visibility-data'), function(index, value){

				var _t = $(this);

				if ( ! _t.is(':checked') )
				{
					fieldsToHide.push(_t.data('attribute'))
				}
			});

			localStorage.setItem('__field_visibility_$this->_modelName', JSON.stringify(fieldsToHide));

			location.reload();
		});
JS;

		$this->view->registerJs($js);
	}
}