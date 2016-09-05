<?php
namespace mcanan\framework;

abstract class BasicController extends Controller
{
    private $contentView = NULL;
    private $layoutView = NULL;
    private $vars = array();

    public function __construct($layoutTemplate)
    {
        parent::__construct();
        $this->layoutView = new View($layoutTemplate);
    }

    protected function render($contentTemplate)
    {
        $this->getBenchmark()->mark("controller_render_start");
        $this->contentView = new View($contentTemplate, $this->vars);
        $this->layoutView->setVariables($this->vars);
        $this->recursiveRender(array($this->contentView, $this->layoutView));
        $this->getBenchmark()->mark("controller_render_end");
    }
    
    protected function renderToString($contentTemplate)
    {
        $this->getBenchmark()->mark("controller_rendertostring_start");
        $this->contentView = new View($contentTemplate, $this->vars);
        $this->layoutView->setVariables($this->vars);
        $retorno = $this->recursiveRenderToString(array($this->contentView, $this->layoutView));
        $this->getBenchmark()->mark("controller_rendertostring_end");
        return $retorno;
    }
    
    protected function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }
}
