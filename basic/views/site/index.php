    <?php

/** @var yii\web\View $this */
use yii\helpers\Html;
use yii\helpers\Url;
use janisto\timepicker\TimePickerAsset;

TimePickerAsset::register($this);

$this->title = 'Test roil integration';
$this->registerJsFile(
    '@web/js/formCreateHealthcare.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
<div class="site-index">

   
    <div class="body-content">

        <noscript class="alert-danger alert ">
            Для коректної праці сайту требо щоб працював Javascript.
        </noscript>
        <div class="alert-danger alert " style="display:none" id="errors"></div>
        <div class="form-group">
            <?= Html::beginForm(Url::toRoute('healthcare-service/create'), 'post', [ 'id' => 'formCreate']) ?>
                <div class='form-group required'>
                    <?= Html::label('Індифікатор відділення', 'division_id',  ['class' => 'control-label']) ?>
                    <?= Html::input('text', 'division_id', '', [
                        'class' => 'form-control', 
                        'required'=>true,
                    ]) ?>
                </div>
                <div class='form-group '>
                    <?= Html::label('Вид спеціальності', 'speciality_type') ?>
                    <?= Html::input('text', 'speciality_type', '', ['class' => 'form-control', ]) ?>
                </div>
                <div class='form-group '>
                    <?= Html::label('Умови надання', 'providing_condition') ?>
                    <?= Html::input('text', 'providing_condition', '', ['class' => 'form-control', ]) ?>
                </div>
                <div class='form-group '>
                    <?= Html::label('Номер ліцензії', 'license_id') ?>
                    <?= Html::input('text', 'license_id', '', [
                        'class' => 'form-control', 
                    ]) ?>
                </div>

                <div class='form-group '>
                    <?= Html::label('Категорія') ?>
                </div>
                <div class='form-group '>
                    <?= Html::label('Текст категорії', 'categoryText') ?>
                    <?= Html::input('text', 'categoryText', '', [
                        'class' => 'form-control', 
                    ]) ?>
                </div>
                <div class='form-group '>
                    <?= Html::button('Додати кодування категорії', ['id'=> 'addCategoryCoding', 'class' => 'btn btn-info']) ?>
                </div>
                <div id='categoryCoding'></div>
                <!-- Type -->
                <div class='form-group '>
                    <?= Html::label('Тип') ?>
                </div>
                <div class='form-group '>
                    <?= Html::label('Примітка', 'typeText') ?>
                    <?= Html::input('text', 'typeText', '', ['class' => 'form-control']) ?>
                </div>
                <div class='form-group '>
                    <?= Html::button('Додати кодування типу', ['id'=> 'addTypeCoding', 'class' => 'btn btn-info']) ?>
                </div>
                <div id='typeCoding'></div>
                <!-- Comment -->
                <div class='form-group '>
                    <?= Html::label('Коментар', 'comment') ?>
                    <?= Html::input('text', 'comment', '', ['class' => 'form-control']) ?>
                </div>
                <!-- Coverage area -->
                <div class='form-group '>
                    <?= Html::label('Зони покриття') ?>
                </div>
                <div class='form-group '>
                    <?= Html::button('Додати зону покриття', ['id'=> 'addCoverageArea', 'class' => 'btn btn-info']) ?>
                </div>
                <div id='coverageArea'></div>

                <!-- Avalible time -->
                <div class='form-group '>
                    <?= Html::label('Допустимий час') ?>
                </div>

                <div class='form-group '>
                    <?= Html::button('Додати допустимий час', ['id'=> 'addAvalibleTime', 'class' => 'btn btn-info']) ?>
                </div>

                <div id='avalibleTime'></div>

                <!-- Not avaliable -->
                <div class='form-group '>
                    <?= Html::label('Не допустимий час') ?>
                </div>
                 <div class='form-group '>
                    <?= Html::button('Додати недопустимий час', ['id'=> 'addNotAvalible', 'class' => 'btn btn-info']) ?>
                </div>
                <div id='notAvalible'></div>

                <!-- Button send -->
                <br />
                <?= Html::submitButton('Відправити', ['id'=> 'send', 'class' => 'btn btn-success']) ?>

            <?= Html::endForm() ?>
        </div>
        <pre class="alert alert-secondary" id="result">Result:</pre>
    </div>
</div>
