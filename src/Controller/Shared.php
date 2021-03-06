<?php
namespace AccountModule\Controller;

use PPI\Framework\Module\Controller as BaseController;

class Shared extends BaseController
{

    /**
     * Render a template
     *
     * @param  string $template The template to render
     * @param  array $params The params to pass to the renderer
     * @param  array $options Extra options
     * @return string
     */
    protected function render($template, array $params = array(), array $options = array())
    {
        $options['helpers'][] = $this->getService('auth.security.templating.helper');
        return parent::render($template, $params, $options);
    }
}
