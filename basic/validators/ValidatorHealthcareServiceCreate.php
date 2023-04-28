<?php

namespace app\validators;

use app\models\Healthcare;
use app\models\HealthcareType;
use app\models\HealthcareTypeCoding;
use app\models\HealthcareCategory;
use app\models\HealthcareCategoryCoding;
use app\models\HealthcareCoverageArea;
use app\models\HealthcareAvailableTime;
use app\models\HealthcareNotAvailable;
use app\helpers\GenerateHashId;

class ValidatorHealthcareServiceCreate {
	public static function validate($post) 
	{
		$result  = new ValidatorHealthcareServiceCreateResult();

		$healthcareService = new Healthcare();
		
		$simpleFields = ['division_id', 'speciality_type', 'license_id', 'comment', 'providing_condition'];

		foreach ($simpleFields as $value) {
			if (isset($post[$value])) $healthcareService->{$value} = $post[$value];
		}

		$healthcareService->is_active   = true;
		$healthcareService->status      = 'ACTIVE';
		$healthcareService->inserted_by = $healthcareService->division_id;
		$healthcareService->updated_by  = $healthcareService->division_id;

		$healthcareService->legal_entity_id = GenerateHashId::gene();

		$is_valid = $healthcareService->validate();

		if (!$is_valid) {

			$result->addErrors($healthcareService->getErrors());
			
			return $result;
		}

		$result->addModels('healthcareService', $healthcareService);

		if (isset($post['type'])) {
			$healthcareType = new HealthcareType();
			if (isset($post['type']['text'])) $healthcareType->text = $post['type']['text'];

			$is_valid = $healthcareType->validate();
		
			if (!$is_valid) {

				$result->addErrors($healthcareType->getErrors());
				
				return $result;
			}

			$result->addModels('healthcareType', $healthcareType);

			if (isset($post['type']['coding']) && !empty($post['type']['coding'])) {
				$arrTypeCoding = [];
				
				foreach($post['type']['coding'] as $coding) {

					$model = new HealthcareTypeCoding();

					if (isset($coding['code'])) $model->code = $coding['code'];
					if (isset($coding['system'])) $model->system = $coding['system'];

					$is_valid = $model->validate();

					if (!$is_valid) {
						$result->addErrors($model->getErrors());
						return $result;
					}

					$arrTypeCoding[] = $model;
				}

				$result->addModels('healthcareTypeCoding', $arrTypeCoding);
			}
		}

		if (!isset($post['category'])) {
			$result->addErrors(['category' => 'Categoty is required!!!']);
			return $result;
		} else {
			$category = new HealthcareCategory();

			if (isset($post['category']['text'])) $category->text = $post['category']['text'];

			$is_valid = $category->validate();
		
			if (!$is_valid) {

				$result->addErrors($category->getErrors());
				
				return $result;
			}

			$result->addModels('category', $category);

			if (isset($post['category']['coding']) && !empty($post['category']['coding'])) {
				$arrCategoryCoding = [];
				
				foreach($post['category']['coding'] as $coding) {

					$model = new HealthcareCategoryCoding();

					if (isset($coding['code'])) $model->code = $coding['code'];
					if (isset($coding['system'])) $model->system = $coding['system'];

					$is_valid = $model->validate();

					if (!$is_valid) {
						$result->addErrors($model->getErrors());
						return $result;
					}

					$arrCategoryCoding[] = $model;
				}

				$result->addModels('categoryCoding', $arrCategoryCoding);
			}
		}

		if (isset($post['coverage_area']) && !empty($post['coverage_area'])) {

			$arrModels = [];

			foreach($post['coverage_area'] as $iteam) {

				$model = new HealthcareCoverageArea();

				$model->value = $iteam;
				
				$is_valid = $model->validate();

				if (!$is_valid) {
					$result->addErrors($model->getErrors());
					return $result;
				}

				$arrModels[] = $model;
			}

			$result->addModels('coverage_area', $arrModels );
		}

		if (isset($post['avalible_time']) && !empty($post['avalible_time'])) {
			$arrModels = [];

			foreach($post['avalible_time'] as $iteam) {
				$model = new HealthcareAvailableTime();

				if (isset($iteam['all_day'])) $model->all_day = $iteam['all_day'] === 'true';
				if (isset($iteam['days_of_week']) && !empty($iteam['days_of_week'])) $model->days_of_week = implode(',', $iteam['days_of_week']);
				if (isset($iteam['available_start_time'])) $model->available_start_time = $iteam['available_start_time'];
				if (isset($iteam['available_end_time'])) $model->available_end_time = $iteam['available_end_time'];

				
				$is_valid = $model->validate();

				if (!$is_valid) {
					$result->addErrors($model->getErrors());
					
					return $result;
				}

				$arrModels[] = $model;
			}

			$result->addModels('avalible_time', $arrModels );
		}

		if (isset($post['not_avalible']) && !empty($post['not_avalible'])) {
			$arrModels = [];

			foreach($post['not_avalible'] as $iteam) {
				$model = new HealthcareNotAvailable();
				if (isset($iteam['description'])) $model->description = $iteam['description'];

				if (isset($iteam['during'])) {
					if( isset($iteam['during']['start']) && strlen($iteam['during']['start']) > 0) $model->start = $iteam['during']['start'];
					if( isset($iteam['during']['end']) && strlen($iteam['during']['end']) > 0) $model->end = $iteam['during']['end'];
				}

				$is_valid = $model->validate();

				if (!$is_valid) {
					$result->addErrors($model->getErrors());
					
					return $result;
				}

				$arrModels[] = $model;
			}

			$result->addModels('not_avalible', $arrModels );
		}

		$result->setValid();

		return $result;
	}
}