<?php
namespace mcanan\framework;

class View
{
    private $vars = NULL;
    private $template = NULL;
    private $content = NULL;

    public function __construct($template, $vars=NULL)
    {
        $this->template = $template;
        $this->vars = $vars;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
    }
    
    public function setVariables($vars)
    {
        $this->vars = $vars;
    }

    public function setVariable($name, $v)
    {
        if (is_null($this->vars)){
            $this->vars = array();
        }
        $this->vars["$name"]= $v;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function render()
    {
        $contents = "";
        if (isset($this->template) && file_exists($this->template)) {
            if (!is_null($this->content)){
                if (is_null($this->vars)){
                    $this->vars = array();
                }
                $this->vars['contenido']=$this->content;
            }
            if (!is_null($this->vars)){
                extract($this->vars);
            }
            ob_start();
            include $this->template;
            $contents = ob_get_contents();
            ob_end_clean();
            $this->defined_vars = get_defined_vars();
        }

        return $contents;
    }
}
