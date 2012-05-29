<?php
namespace Inanimatt\SiteBuilder\Renderer;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-04-26 at 00:41:14.
 */
class TwigRendererTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TwigRenderer
     */
    protected $object;

    protected $testdata;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->testdata = array('title' => 'Lorem', 'content' => 'Lorem ipsum');
        $this->expectedOutput = '<title>Lorem</title><content>Lorem ipsum</content>';

        $twig = $this->getMock('Twig_Environment', array('render'));
        $twig->expects($this->once())
            ->method('render')
            ->with($this->equalTo('template.twig'), $this->testdata)
            ->will($this->returnValue($this->expectedOutput));

        $this->object = new TwigRenderer($twig);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Inanimatt\SiteBuilder\Renderer\TwigRenderer::render
     * @covers Inanimatt\SiteBuilder\Renderer\TwigRenderer::__construct
     */
    public function testRender()
    {
        $result = $this->object->render($this->testdata, 'template.twig');
        $this->assertEquals($this->expectedOutput, $result);
    }
}
