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

    protected function render($contentTemplate, $commonVariables=null)
    {
        $this->getBenchmark()->mark("controller_render_start");
        $this->contentView = new View($contentTemplate, $this->vars);
        $this->layoutView->setVariables($this->vars);
        $this->renderViews([$this->contentView, $this->layoutView], $commonVariables);
        $this->getBenchmark()->mark("controller_render_end");
    }
    
    protected function renderToString($contentTemplate, $commonVariables=null)
    {
        $this->getBenchmark()->mark("controller_rendertostring_start");
        $this->contentView = new View($contentTemplate, $this->vars);
        $this->layoutView->setVariables($this->vars);
        $retorno = $this->renderViewsToString([$this->contentView, $this->layoutView], $commonVariables);
        $this->getBenchmark()->mark("controller_rendertostring_end");
        return $retorno;
    }
    
    protected function set($name, $value)
    {
        $this->vars[$name] = $value;
    }
}
