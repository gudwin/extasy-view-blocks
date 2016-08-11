<?php
namespace Extasy\ViewBlocks\tests\Samples;

use Extasy\ViewBlocks\BaseBlock;

class TestBaseBlock extends BaseBlock
{
    protected $renderCalled = 0;
    protected $phrase = '';
    public function __construct( $phrase)
    {
        $this->renderPath = 'test.base.block';
        $this->templatePath = __DIR__ . '/template.tpl';
        $this->phrase = $phrase;
    }

    public function getCachePath() {
        return $this->renderPath;
    }
    public function renderBlock() {
        $this->renderCalled++;
        return parent::renderBlock();
    }
    public function getRenderCalled() {
        return $this->renderCalled;
    }
    public function getData()
    {
        return [
            'phrase' => $this->phrase
        ];
    }
}