<?php
namespace mcanan\framework;

abstract class BasicController extends Controller
{
    private $views;

    public function __construct($layoutTemplate)
    {
        parent::__construct();
        $this->views = array();
        $this->views['layout'] = new View();
        $this->views['content'] = new View();
        $this->views['layout']->setTemplate($layoutTemplate);
        
        $this->views['content']->error = false;
        $this->views['content']->mensaje = "";
    }

    protected function render($contentTemplateName)
    {
        $this->getBenchmark()->mark("controller_render_start");
        $this->views['content']->setTemplate($contentTemplateName);
        $this->views['layout']->contenido = $this->views['content']->render();

        if ($this->isShowBenchmarks()) {
            $this->getOutput()->setHtml($this->views['layout']->render()."%BENCHMARK%");
        } else {
            $this->getOutput()->setHtml($this->views['layout']->render());
        }
        $this->getBenchmark()->mark("controller_render_end");
    }

    protected function setContentVariable($variable, $value)
    {
        $this->views['content']->$variable = $value;
    }

    protected function setLayoutVariable($variable, $value)
    {
        $this->views['layout']->$variable = $value;
    }

    protected function setMensaje($error, $mensaje)
    {
        $this->views['content']->error = $error;
        $this->views['content']->mensaje = $mensaje;
    }
}
