<?php
namespace Extasy\ViewBlocks\tests;

use PHPUnit_Framework_TestCase;
use Extasy\ViewBlocks\tests\Samples\TestBaseBlock;
use Faid\SimpleCache;

class BaseBlockTests extends PHPUnit_Framework_TestCase
{
    /**
     * @var TestBaseBlock
     */
    protected $block = null;
    public function setUp()
    {
        parent::setUp();
        $this->block = new TestBaseBlock('world');
        try {
            SimpleCache::clear( $this->block->getCachePath() );
        } catch ( \Exception $e ) {
        }
    }

    public function testGenerate() {
        $this->assertEquals(0, $this->block->getRenderCalled());
        $code = $this->block->getCode();
        $this->assertEquals("Hello world!", $code);
        $this->assertEquals(1, $this->block->getRenderCalled());
        //
        $this->block->getCode();
        $this->block->getCode();
        $this->assertEquals(1, $this->block->getRenderCalled());
        //
    }

    /**
     * @group current
     */
    public function testForceGenerate() {
        $this->block->getCode();
        $this->assertEquals(1, $this->block->getRenderCalled());
        $this->block->forceRefresh();
        $this->assertEquals(2, $this->block->getRenderCalled());
    }
}