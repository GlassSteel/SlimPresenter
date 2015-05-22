<?php namespace glasteel\SlimPresenter;

class SlimTwigPresenter extends \Slim\Views\Twig
{
	use SlimPresenterTrait;

    public function render($template, $data = null){
	    $this->execPresenter($template,$data);
	    return parent::render($template, $data);
	}//render()

}//SlimTwigPresenter()