<?php
class Validate{
	
	// Error array
	private $errors	= array();
	
	// Source array
	private $source	= array();
	
	// Rules array
	private $rules	= array();
	
	// Result array
	private $result	= array();
	
	// Contrucst
	public function __construct($source){
		$this->source = $source;
	}
	
	// Add rules
	public function addRules($rules){
		$this->rules = array_merge($rules, $this->rules );
	}
	
	// Get error
	public function getError(){
		return $this->errors;
	}
	public function setError($element, $message){
		$this->errors[$element] = '<b>'.ucfirst($element).':</b> ' .$message;
	}
	
	// Get result
	public function getResult(){
		return $this->result;
	}
	
	// Add rule
	public function addRule($element, $type,$options = null, $required = true){
		$this->rules[$element] = array('type' => $type, 'options' => $options, 'required' => $required);
		return $this;
	}
	
	// Run
	public function run(){
		foreach($this->rules as $element => $value){
			if($value['required'] == true && trim($this->source[$element])==null){
				$this->setError($element,'is not empty');
			}else{
				switch ($value['type']) {
					case 'int':
						$this->validateInt($element, $value['options']['min'], $value['options']['max']);
						break;
					case 'string':
						$this->validateString($element, $value['options']['min'], $value['options']['max']);
						break;
					case 'url':
						$this->validateUrl($element);
						break;
					case 'email':
						$this->validateEmail($element);
						break;
					case 'status':
						$this->validateStatus($element);
						break;
					case 'password':
						$this->validatePassword($element, $value['options']);
						break;
					case 'date':
						$this->validateDate($element,$value['options']['start'], $value['options']['end']);
						break;
					case 'group':
						$this->validateGroupID($element);
						break;
					case 'existRecord':
						$this->validateExistRecord($element,$value['options']);
						break;

				}
			}
			if(!array_key_exists($element, $this->errors)) {
				$this->result[$element] = $this->source[$element];
			}
		}
		$eleNotValidate = array_diff_key($this->source, $this->errors);
		$this->result	= array_merge($this->result, $eleNotValidate);
		
	}
	
	// Validate Integer
	private function validateInt($element, $min = 0, $max = 0){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$min,"max_range"=>$max)))){
			$this->setError($element, 'is an invalid number');
		}
	}
	
	// Validate String
	private function validateString($element, $min = 0, $max = 0){
		$length = strlen($this->source[$element]);
		if($length < $min) {
			$this->setError($element, 'is too short');
		}elseif($length > $max){
			$this->setError($element, 'is too long');			
		}elseif(!is_string($this->source[$element])){
			$this->setError($element, 'is an invalid string');						
		}
	}
	
	// Validate URL
	private function validateURL($element){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_URL)){
			$this->setError($element, 'is an invalid url');		
		}
	}
	
	// Validate Email
	private function validateEmail($element){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_EMAIL)){
			$this->setError($element, 'is an invalid email');		
		}
	}
	
	public function showErrors(){
		$xhtml = '';
		if(!empty($this->errors)){
			$xhtml .= '<ul class="error">';
			foreach($this->errors as $key => $value){
				$xhtml .= '<li>'.$value.' </li>';
			}
			$xhtml .=  '</ul>';
		}
		return $xhtml;
	}
	
	public function isValid(){
	 	if(count($this->errors)>0) return false;
	 	return true;	
	}
	
	// Validate Status
	private function validateStatus($element){
		if($this->source[$element] < 0 || $this->source[$element] > 1){
			$this->setError($element, 'Select status');		
		}
	}
	// Validate groupID
	private function validateGroupid($element){
		if($this->source[$element] == 0){
			$this->setError($element, 'Select group');		
		}
	}

	// Validate password
	private function validatePassword($element, $options){
		//độ dài 8 kí tự ít nhất 1 kí tự in hoa 1 kí tự in thường 1 kí tự số Php4567!
		if($options['action'] == 'add' || ($options['action'] == 'edit' && $this->source[$element])){
			$pattern = '#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,10}$#';	// Php4567!
			if(!preg_match($pattern, $this->source[$element])){
				$this->setError($element, 'is an invalid password(8-10 character, special character, number)');		
			};
		}
		
	}
	// Validate date
	private function validateDate($element,$start, $end){
		$arrDateStart 	= date_parse_from_format('d/m/Y', $start) ;
		$tsStart		= mktime(0, 0, 0, $arrDateStart['month'], $arrDateStart['day'], $arrDateStart['year']);
				
		// End
		$arrDateEnd = date_parse_from_format('d/m/Y', $end) ;
		$tsEnd		= mktime(0, 0, 0, $arrDateEnd['month'], $arrDateEnd['day'], $arrDateEnd['year']);
			
		//Current 
		$arrDateCurrent = date_parse_from_format('d/m/Y', $this->source[$element]) ;
		$tsCurrent		= mktime(0, 0, 0, $arrDateCurrent['month'], $arrDateCurrent['day'], $arrDateCurrent['year']);
			
		if($tsCurrent < $tsStart || $tsCurrent > $tsEnd){
			$this->setError($element, 'is an invalid date');		
		}
	}

	//ValidateExistRecord
	public function validateExistRecord($element, $options){
		$database = $options['database'];
		$query = $options['query'];
		if($database->isExist($query) == false) {
			$this->setError($element, 'record is not exist');	
		}
	}
	
	
	
	
}