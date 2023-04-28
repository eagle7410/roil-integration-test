<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\helpers\GenerateHashId;
use app\validators\ValidatorHealthcareServiceCreate;

class HealthcareServiceController extends Controller 
{
	/**
     * {@inheritdoc}
     */
    public function behaviors()
    {
		return [
			'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                ],
            ],
		];
	}

	/**
	 * Create healthcare service
	 */
	public function actionCreate()
    {
        $post = Yii::$app->request->post();
		
		$result = ValidatorHealthcareServiceCreate::validate($post);

		if (!$result->isValid()) {

			return json_encode([
				'errors'  => $result->getErrors()
			]);
		}

		$models = $result->getModels();

		$transaction = Yii::$app->db->beginTransaction();

		try {
			
			if (!$models->healthcareService->save()) throw new Error('Not save healthcareService');
			
			$models->category->healthcare_id = $models->healthcareService->id;
			if (!$models->category->save()) throw new Error('Not save category');

			if (isset($models->categoryCoding))  {
				foreach($models->categoryCoding as $model) {
					$model->healthcare_category_id = $models->category->id;
					if (!$model->save()) throw new Error('Not save categoryCoding');
				}
			}

			if (isset($models->healthcareType))  {

				$models->healthcareType->healthcare_id = $models->healthcareService->id;
				if (!$models->healthcareType->save()) throw new Error('Not save healthcareType');

				if (isset($models->healthcareTypeCoding))  {
					foreach($models->healthcareTypeCoding as $model) {
						$model->healthcare_type_id = $models->healthcareType->id;
						if (!$model->save()) throw new Error('Not save healthcareTypeCoding');
					}
				}
			}

			if (isset($models->coverage_area))  {
				foreach($models->coverage_area as $model) {
					$model->healthcare_id = $models->healthcareService->id;
					if (!$model->save()) throw new Error('Not save coverage_area');
				}
			}

			if (isset($models->avalible_time))  {
				foreach($models->avalible_time as $model) {
					$model->healthcare_id = $models->healthcareService->id;
					if (!$model->save()) throw new Error('Not save avalible_time');
				}
			}

			if (isset($models->not_avalible))  {
				foreach($models->not_avalible as $model) {
					$model->healthcare_id = $models->healthcareService->id;
					if (!$model->save()) throw new Error('Not save not_avalible');
				}
			}

			$transaction->commit();
			
			Yii::$app->response->statusCode = 201;

			return $this->asJson($this->getCreateDataResponce($models));
						
		} catch (Exception $e) {
			$transaction->rollBack();
			Yii::error($e->getMessage());
		}
		
    }

	/**
	 * Build responce data.
	 */
	protected function getCreateDataResponce ($models) {
		$models->healthcareService->refresh();

		$data = [
			'meta' => [
				'code' => 201,
				'url' =>  Yii::$app->request->absoluteUrl,
				'type' => [ 
					'object' => 'Is object',
					'list' => 'list string'
				],
				'request_id' => GenerateHashId::gene(),
			],
			'data' => [
				'division_id' => $models->healthcareService->division_id,
				'category' => [],
				'licensed_healthcare_service' => [
					'status' => $models->healthcareService->status,
					'updated_at' => $models->healthcareService->updated_at,
				],
			],

		];

		$arrFields = [
			'legal_entity_id',
			'license_id',
			'speciality_type',
			'providing_condition',
			'status',
			'comment',
			'is_active',
			'inserted_at',
			'inserted_by',
			'updated_at',
			'updated_by'
		];

		foreach ($arrFields as $field) {
			if (!is_null($models->healthcareService->{$field}))
				$data['data'][$field] = $models->healthcareService->{$field};
		}

		if (isset($models->coverage_area))  {
			$data['data']['coverage_area'] = [];

			foreach($models->coverage_area as $model) {
				$data['data']['coverage_area'][] = $model->value;
			}
		}
		if (isset($models->avalible_time))  {
			$data['data']['avalible_time'] = [];
			foreach($models->avalible_time as $model) {
				$arrFields = ['all_day', 'available_start_time', 'available_end_time'];
				$value = [];

				foreach ($arrFields as $field) {
					if (!is_null($model->{$field}))
						$value[$field] = $model->{$field};
				}		
				
				if (!is_null($model->days_of_week))
						$value['days_of_week'] = $model->daysOfWeek;

				$data['data']['avalible_time'][] = $value;
			}
		}

		if (!is_null($models->category->text))
			$data['data']['category']['text'] = $models->category->text;
		
		if (isset($models->categoryCoding))  {
			$data['data']['category']['coding'] =[];
			
			foreach($models->categoryCoding as $model) {
				$arrFields = ['system', 'code'];
				$value = [];

				foreach ($arrFields as $field) {
					if (!is_null($model->{$field}))
						$value[$field] = $model->{$field};
				}		
				
				$data['data']['category']['coding'][] = $value;
			}
		}

		if (isset($models->healthcareType)) {
			$data['data']['type'] = [];

			if (!is_null($models->healthcareType->text))
				$data['data']['type']['text'] = $models->healthcareType->text;

			if (isset($models->healthcareTypeCoding))  {
				$data['data']['type']['coding'] = [];

				foreach($models->healthcareTypeCoding as $model) {
					$arrFields = ['system', 'code'];
					$value = [];

					foreach ($arrFields as $field) {
						if (!is_null($model->{$field}))
							$value[$field] = $model->{$field};
					}		
					
					$data['data']['type']['coding'][] = $value;
				}
			}
		}

		if (isset($models->not_avalible)) {

			$data['data']['not_available'] = [];
			
			foreach($models->not_avalible as $model) {
				$data['data']['not_available'][] = [
					'description' => $model->description,
					'during' => [
						'start' => $model->start,
						'end' => $model->end,
					]
				];
			}
		}

		return $data;
	}

	/**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}