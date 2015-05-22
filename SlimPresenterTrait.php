<?php namespace glasteel\SlimPresenter;

trait SlimPresenterTrait
{
	
	protected $presenter_classmap = [];

	public function setPresenter($templates, $presenter_class){
	    if ( !class_exists($presenter_class) ){
	        return false;
	    }
	    $presenter_class_interfaces = class_implements($presenter_class);
	    if ( !in_array('SlimPresenterInterface', $presenter_class_interfaces) ){
	        return false;
	    }
	    foreach ( (array)$templates as $template) {
	    	$this->presenters[$template] = $presenter_class;
	    }
	    return true;
	}//setPresenter()

	public function getPresenter($template){
		if ( array_key_exists($template, $this->presenters) ){
	        $presenter_class = $this->presenters[$template];
	        return new $presenter_class;
	    }
	    return false;
	}//getPresenter()

	public function execPresenter($template,$data){
		if ( is_array($data) ){
		    $this->appendData($data);
		}
		$presenter_instance = $this->getPresenter($template);
        if ( $presenter_instance ){
            call_user_func([$presenter_instance,'present'],$this);
        }
	}//execPresenter()

}//trait SlimPresenterTrait