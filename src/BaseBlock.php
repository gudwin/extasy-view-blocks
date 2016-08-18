<?php

namespace Extasy\ViewBlocks;

use \Faid\View\View;
use Faid\SimpleCache;

class BaseBlock implements BaseBlockInterface
{
    protected $templatePath = '';
    protected $renderPath = '';
    /**
     *
     * @var \Faid\View\View;
     */
    protected $view = null;

    public function getCode()
    {
        try {
            $blockContents = SimpleCache::get($this->renderPath);
        } catch (\Exception $e) {
            $blockContents = '';
        }
        return $blockContents;
    }

    public function refresh()
    {
        return $this->renderBlock();
    }

    protected function createView()
    {
        $path = $this->templatePath;
        $this->view = new View ($path);
    }

    protected function renderBlock()
    {
        $this->createView();
        $this->view->set($this->getData());

        $blockContents = $this->view->render();
        SimpleCache::set($this->renderPath, $blockContents);

        return $blockContents;
    }

    public function getData()
    {
        return array();
    }

}