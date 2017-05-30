<?php

class View {
	public $meta = [];
	public $title = '';
	public $body = '';
	public $css = ['bootstrap.css', 'bootstrap-theme.css', 'custom.css?v=0'];
	public $js = ['jquery.js', 'bootstrap.js', 'custom.js?v=1.2'];
	public $msg = '';
	public $fav = '';
	public $apartments = '';
	function __construct() {
		$this->fav = '<link href="'.URL.'public/imgs/favicon.png" type="image/png" rel="icon">';
	}
	public function render($name)
	{
		require 'public/inc/header.php';
		require 'views/' . $name . '.php';
		require 'public/inc/footer.php';
	}
	public function addCss($css) {
		$this->css[] = $css;
	}
	public function getCss() {
		$this->all_css = '';
		foreach ($this->css as $c){
			$this->all_css .= '<link type="text/css" rel="stylesheet" href="'.URL.'public/css/'.$c.'">';
		}
		return $this->all_css;
	}
	public function addJs($js) {
		$this->js[] = $js;
	}
	public function getJs() {
		$this->all_js = '';
		foreach ($this->js as $c){
			$this->all_js .= '<script src="'.URL.'public/js/'.$c.'"></script>';
		}
		return $this->all_js;
	}
	public function setMeta($name, $content){
		$this->meta[] = ['name'=>$name, 'content'=>$content];
	}
	public function getMeta(){
		$metas = '';
		if(is_array($this->meta)){
			foreach($this->meta as $m){
				$metas .= '<meta name="'. $m['name'] .'" content="'. $m['content'] .'" >
				';
			}
		}
		return $metas;
	}
	public function getStateOptions (){
		$states = '<option value=""></option>
				<option value="Abia State">Abia State</option>
				<option value="Abuja Federal Capital">Abuja Federal Capital</option>
				<option value="Adamawa State">Adamawa State</option>
				<option value="Akwa Ibom State">Akwa Ibom State</option>
				<option value="Anambra State">Anambra State</option>
				<option value="Bauchi State">Bauchi State</option>
				<option value="Bayelsa State">Bayelsa State</option>
				<option value="Benue State">Benue State</option>
				<option value="Borno State">Borno State</option>
				<option value="Cross River State">Cross River State</option>
				<option value="Delta State">Delta State</option>
				<option value="Ebonyi State">Ebonyi State</option>
				<option value="Edo State">Edo State</option>
				<option value="Ekiti State">Ekiti State</option>
				<option value="Enugu State">Enugu State</option>
				<option value="Gombe State">Gombe State</option>
				<option value="Imo State">Imo State</option>
				<option value="Jigawa State">Jigawa State</option>
				<option value="Kaduna State">Kaduna State</option>
				<option value="Kano State">Kano State</option>
				<option value="Katsina State">Katsina State</option>
				<option value="Kebbi State">Kebbi State</option>
				<option value="Kogi State">Kogi State</option>
				<option value="Kwara State">Kwara State</option>
				<option value="Lagos State">Lagos State</option>
				<option value="Nassarawa State">Nassarawa State</option>
				<option value="Niger State">Niger State</option>
				<option value="Ogun State">Ogun State</option>
				<option value="Ondo State">Ondo State</option>
				<option value="Osun State">Osun State</option>
				<option value="Oyo State">Oyo State</option>
				<option value="Plateau State">Plateau State</option>
				<option value="Rivers State">Rivers State</option>
				<option value="Sokoto State">Sokoto State</option>
				<option value="Taraba State">Taraba State</option>
				<option value="Yobe State">Yobe State</option>
				<option value="Zamfara State">Zamfara State</option>';
		return $states;
	}
}