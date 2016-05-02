<?php
namespace mcanan\framework;

class View extends Base
{
    protected $vars = array();

    public function __get($name)
    {
        return $this->vars[$name];
    }

    public function __set($name, $value)
    {
        $this->vars[$name] = $value;
    }

    public function setTemplate($template)
    {
        $this->vars['template'] = $template;
    }

    public function getTemplate()
    {
        return $this->vars['template'];
    }

    public function render()
    {
        $contents = "";
        if (isset($this->vars['template']) && file_exists($this->vars['template'])) {
            extract($this->vars);
            ob_start();
            include $this->vars['template'];
            $contents = ob_get_contents();
            ob_end_clean();
            $this->defined_vars = get_defined_vars(); // for use in nested views.
        }

        return $contents;
    }
}
