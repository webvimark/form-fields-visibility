Form fields visibility toggler for Yii 2 ActiveForm
=====

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webvimark/form-fields-visibility "*"
```

or add

```
"webvimark/form-fields-visibility": "*"
```

to the require section of your `composer.json` file.

Usage
-----

```php

<?= FormFieldsVisibility::widget([
        'model'=>$model,
        'attributes' => [
                'url'           => $model->getAttributeLabel('url'),
                'page_place_id' => 'Some magic place',
                'meta_keywords' => $model->getAttributeLabel('meta_keywords'),
                'meta_title'    => $model->getAttributeLabel('meta_title'),
        ],
]) ?>

```

