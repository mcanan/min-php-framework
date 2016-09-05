<?php
namespace mcanan\framework;

class View
{
    protected $vars = NULL;
    protected $template = NULL;
    protected $content = NULL;

    public function __construct($template, $vars=NULL)
    {
        $this->template = $template;
        $this->vars = $vars;
    }

    protected function setTemplate($template)
    {
        $this->template = $template;
    }

    protected function setVariables($vars)
    {
        $this->vars = $vars;
    }

    protected function setContent($content)
    {
        $this->content = $content;
    }

    protected function render()
    {
        $contents = "";
        if (isset($this->template) && file_exists($this->template)) {
            if (!is_null($this->vars)){
                if (!is_null($this->content)){
                    $this->vars['contenido']=$this->content;
                }
                extract($this->vars);
            }
            ob_start();
            include $this->template;
            $contents = ob_get_contents();
            ob_end_clean();
        }

        return $contents;
    }
}
