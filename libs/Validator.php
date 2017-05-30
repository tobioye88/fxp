<?php
/**
* $rules = 'required|max:25|min:22|number|alphabet|email|name';
*/
class Validator {
	public static $errors = [];

	public static function validate($string, $rules = []){
		if(!is_array($rules)){
			$rules = explode('|', $rules);
		}
		foreach($rules as $rule){
			if(strpos($rule, ':') === false){
				if(!method_exists(__CLASS__, $rule)){
					return 'method does not exits';
					break;
				}
				if(!self::$rule($string)){
					return false;
				}
			}else {
				$rule = explode(':', $rule);
				if(!method_exists(__CLASS__, $rule[0])){
					return 'method does not exits';
					break;
				}
				if(!self::$rule[0]($string, $rule[1])){
					return false;
				}
			}
		}
		return true;
	}
	private static function required($string){
		return (strlen($string) > 1)? true : self::error('Required Value:');
	}
	private static function max($string, $num){
		return (strlen($string) <= $num)? true : self::error('Exceeds Maximum Limit');
	}
	private static function min($string, $num){
		return (strlen($string) > $num)? true : self::error('Minimum Limit not Reached');
	}
	private static function number($string){
		return (!is_nan((int)$string))? true : self::error('Not a Number Value');
	}
	private static function alphabet($string){
		return (is_nan($string))? true : self::error('Only Alphabet Required');
	}
	private static function email($string){
		return (is_nan($string))? true : self::error('Only Alphabet Required');
	}
	private static function name($string){
		return (is_nan($string))? true : self::error('Only Alphabet Required');
	}
	private static function error($err){
		self::$errors[] = $err;
		return false;
	}
}