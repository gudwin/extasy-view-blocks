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
        return $this->generate();
    }

    public function forceRefresh()
    {
        $this->generate(true);
    }

    public function generate($force = false)
    {
        $blockContents = '';
        $found = false;
        if (empty($force)) {
            try {
                $blockContents = SimpleCache::get($this->renderPath);
                $found = true;
            } catch (\Exception $e) {
                $found = false;
            }
        }
        if (empty($found) || $force) {
            $blockContents = $this->renderBlock();
        }

        return $blockContents;
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