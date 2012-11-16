<?php
namespace Inanimatt\SiteBuilder;
use Inanimatt\SiteBuilder\ContentHandler\ContentHandlerInterface;

class SiteBuilderSansRenderFile extends SiteBuilder
{
    public function renderFile(ContentHandlerInterface $file, $extraData = null)
    {
        return 'Lorem ipsum';
    }
}

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-05-28 at 14:28:43.
 */
class SiteBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SiteBuilder
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new SiteBuilder;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @expectedException Inanimatt\SiteBuilder\Exception\ArgumentException
     */
    public function testRegisterRendererException()
    {
        $renderer = $this->getMock('Inanimatt\\SiteBuilder\\Renderer\\RendererInterface');
        $this->object->registerRenderer($renderer, 'invalid');
    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::getRenderers
     * @covers Inanimatt\SiteBuilder\SiteBuilder::registerRenderer
     */
    public function testGetSetRenderers()
    {
        $renderer = $this->getMock('Inanimatt\\SiteBuilder\\Renderer\\RendererInterface');
        $this->object->registerRenderer($renderer, array('test'));

        $result = $this->object->getRenderers();
        $this->assertArrayHasKey('test', $result);
        $this->assertEquals($result['test'], $renderer);

    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::setDefaultTemplate
     * @covers Inanimatt\SiteBuilder\SiteBuilder::getDefaultTemplate
     */
    public function testGetSetDefaultTemplate()
    {
        $this->object->setDefaultTemplate('test');
        $this->assertEquals('test', $this->object->getDefaultTemplate());
    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::setTemplatePath
     * @covers Inanimatt\SiteBuilder\SiteBuilder::getTemplatePath
     */
    public function testGetSetTemplatePath()
    {
        $this->object->setTemplatePath('test');
        $this->assertEquals('test', $this->object->getTemplatePath());
    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::renderFile
     */
    public function testRenderFile()
    {
        // Mock contenthandler object
        $testMetadata = array(
            'template' => 'template.test'
        );
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFileContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $renderer = $this->getMock('Inanimatt\\SiteBuilder\\Renderer\\PhpRenderer', array('render'), array(), 'TestRenderer', false, false);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($testMetadata), 'template.test')
            ->will($this->returnValue('Lorem ipsum'))
        ;

        $this->object->registerRenderer($renderer, array('test'));

        $this->object->renderFile($contentHandler);
    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::renderFile
     */
    public function testRenderFileExtradata()
    {
        // Mock contenthandler object
        $testMetadata = array(
            'template' => 'template.test'
        );
        $expectedMetadata = array_merge($testMetadata, array('extra_field' => 'extra value'));
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFileExtradataContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $renderer = $this->getMock('Inanimatt\\SiteBuilder\\Renderer\\PhpRenderer', array('render'), array(), 'TestRenderer2', false, false);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($expectedMetadata), 'template.test')
            ->will($this->returnValue('Lorem ipsum'))
        ;

        $this->object->registerRenderer($renderer, array('test'));

        $this->object->renderFile($contentHandler, array('extra_field' => 'extra value'));
    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::renderFile
     */
    public function testRenderFileDefaultTemplate()
    {
        // Mock contenthandler object
        $testMetadata = array();
        $testContent = 'Lorem ipsum';
        $expectedMetadata = array(
            'template' => 'template.test',
        );

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFileDefaultTemplateContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $renderer = $this->getMock('Inanimatt\\SiteBuilder\\Renderer\\PhpRenderer', array('render'), array(), 'TestRenderer3', false, false);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($expectedMetadata), 'template.test')
            ->will($this->returnValue('Lorem ipsum'))
        ;

        $this->object->registerRenderer($renderer, array('test'));
        $this->object->setDefaultTemplate('template.test');

        $this->object->renderFile($contentHandler);
    }

    /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::renderFile
     */
    public function testRenderFilePassthrough()
    {
        // Mock contenthandler object
        $testMetadata = array(
            'template' => 'none'
        );
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFilePassthroughContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $result = $this->object->renderFile($contentHandler);
        $this->assertEquals($result, 'Lorem ipsum');
    }

    /**
     * @expectedException Inanimatt\SiteBuilder\Exception\ArgumentException
     */
    public function testRenderFileDataError()
    {
        // Mock contenthandler object
        $testMetadata = array(
            'template' => 'template.test'
        );
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFileDataErrorContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $this->object->renderFile($contentHandler, 'invalid extra data');
    }

    /**
     * @expectedException Inanimatt\SiteBuilder\Exception\RenderException
     */
    public function testRenderFileTemplateError()
    {
        // Mock contenthandler object
        $testMetadata = array(
            'template' => 'problemtemplate'
        );
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFileTemplateErrorContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $this->object->renderFile($contentHandler);
    }

    /**
     * @expectedException Inanimatt\SiteBuilder\Exception\RenderException
     */
    public function testRenderFileRendererError()
    {
        // Mock contenthandler object
        $testMetadata = array(
            'template' => 'template.missingrenderer'
        );
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata'), array(), 'testRenderFileRendererContentHandler', false, false);

        $contentHandler
            ->expects($this->once())
            ->method('getMetadata')
            ->will($this->returnValue($testMetadata));

        $contentHandler
            ->expects($this->once())
            ->method('getContent')
            ->will($this->returnValue($testContent));

        $this->object->renderFile($contentHandler);
    }

     /**
     * @covers Inanimatt\SiteBuilder\SiteBuilder::renderSite
     */
    public function testRenderSite()
    {
        // Mock content handler
        $testMetadata = array(
            'template' => 'template.test'
        );
        $testContent = 'Lorem ipsum';

        $contentHandler = $this->getMock('Inanimatt\\SiteBuilder\\ContentHandler\\PhpFileContentHandler', array('__construct', 'getContent', 'getMetadata', 'getOutputName'), array(), 'TestRenderSiteContentHandler', false, false);
        $contentHandler
            ->expects($this->once())
            ->method('getOutputName')
            ->will($this->returnValue('test.html'))
        ;

        // Mock content collection with the content object
        $collection = $this->getMock('Inanimatt\\SiteBuilder\\ContentCollection\\FileContentCollection');
        $collection
            ->expects($this->once())
            ->method('getObjects')
            ->will($this->returnValue(array($contentHandler)))
        ;

        // Mock serialiser
        $serialiser = $this->getMock('Inanimatt\\SiteBuilder\\Serialiser\\FileSerialiser', array('write'), array(), 'TestSerialiser', false, false);
        $serialiser
            ->expects($this->once())
            ->method('write')
            ->with($this->equalTo($testContent), 'test.html')
            ->will($this->returnValue(true))
        ;

        // Mock the renderFile() method
        $builder = new SiteBuilderSansRenderFile;
        $builder->renderSite($collection, $serialiser);
    }

}
