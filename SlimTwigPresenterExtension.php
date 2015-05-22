<?php namespace glasteel\SlimPresenter;

class SlimTwigPresenterExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'glasteel\SlimPresenter\SlimTwigPresenterExtension';
    }//getName()

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'present_include',
                array($this, 'presentInclude'),
                array('needs_environment' => true, 'needs_context' => true, 'is_safe' => array('all'))
            ),
        );
    }//getFunctions()

    public function presentInclude(\Twig_Environment $env, $context, $template, $variables = array()){
        $app = \Slim\Slim::getInstance();
        return $app->view->fetch($template,$variables);
    }//presentInclude()

}//class SlimTwigPresenterExtension