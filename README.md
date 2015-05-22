# slimPresenter

Allows for a presenter method to be invoked on every use of a given template.

## Configuring Slim Framework

Sample usage when using [Twig and Slim-Views](https://github.com/slimphp/Slim-Views):
	
	//index.php or wherever you instantiate Slim $app
	$app->config(
    	'view',
    	new \glasteel\SlimPresenter\SlimTwigPresenter()
	);

Adding Twig extension will invoke presenter class via **present_include()** in templates:

	$view = $app->view();
	$view->parserExtensions = [
	    new \glasteel\SlimPresenter\SlimTwigPresenterExtension(),
	];

## Using Presenters

Presenter classes must implement **SlimPresenterInterface** with **present()** method:
	
	class MyPresenter implements glasteel\SlimPresenter\SlimPresenterInterface
	{
	    public function present($view){

	    	//use the presenter to modify an existing value
	    	$old_val = $view->get('my_view_data_key');
	    	$new_val = $this->someFormatFunction($old_val);
			$view->set('my_view_data_key',$new_val);
	        	
	        //use the presenter to add a new value
	        $app = \Slim\Slim::getInstance();
	        $view->set(
	        	'authuser_name',
	        	(($app->auth_user) ? $app->auth_user->name : '')
	        );
	    
	    }//present()
	
	}//class MyPresenter

Register the presenter class on one or more templates (first parameter can be string or array):

	$app->view->setPresenter('my_template.php','MyPresenter');
	$app->view->setPresenter(
		[
			'partials/h1.php',
			'partials/special_h1.php
		],
	'H1Presenter');

## Using The SlimTwigPresenterExtension

The **present_include()** function mimics Twigs native **include()**:

	<div class="row">
		<div class="col-xs-12">
            {{ present_include('partials/h1.php') }}
        </div>
    </div>

    //pass local variables with Twig object syntax

    <div class="row">
		<div class="col-xs-12">
            {{ present_include('partials/h1.php',{local_var:'something'}) }}
        </div>
    </div>