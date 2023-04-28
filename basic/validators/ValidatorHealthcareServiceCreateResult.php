<?php

namespace app\validators;

class ValidatorHealthcareServiceCreateResult {
	private $_is_valid = false;
	private $_errors = [];
	private $_models = [];

	public function setValid() 
	{
		$this->_is_valid = true;
	}

	public function isValid() 
	{
		return $this->_is_valid;
	}

	public function setModels(&$arrModels) 
	{
		$this->_models = $arrModels;
	}

	public function addErrors($arrErrors) 
	{
		$this->_errors = array_merge($this->_errors, $arrErrors);
	}

	public function addModels($name, $models) 
	{
		$this->_models[$name] =  $models;
	}
	public function getErrors() 
	{
		return $this->_errors;
	}
	public function getModels() 
	{
		return (object) $this->_models;
	}
}