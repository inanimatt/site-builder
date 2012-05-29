<?php
namespace Inanimatt\SiteBuilder\ContentCollection;
class testFile
{
    public $data;
    public function __construct($fileobj, $relpath, $relpathname)
    {
        $this->data = array('fileobj' => $fileobj, 'relpath'=>$relpath, 'relpathname' => $relpathname);
    }
    public function getName()
    {
        return $this->data['relpathname'];
    }
}

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-04-21 at 00:56:46.
 */
class FileContentCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileContentCollection
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new FileContentCollection(__DIR__.'/../../../resources/content');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Inanimatt\SiteBuilder\ContentCollection\FileContentCollection::registerContentHandler
     */
    public function testRegisterContentHandler()
    {
        $this->assertNull($this->object->registerContentHandler('\\stdClass', array('php')));

    }

    /**
     * @covers Inanimatt\SiteBuilder\ContentCollection\FileContentCollection::getObjects
     * @covers Inanimatt\SiteBuilder\ContentCollection\FileContentCollection::setPath
     */
    public function testGetObjects()
    {

        $this->assertNull($this->object->registerContentHandler('Inanimatt\SiteBuilder\ContentCollection\testFile', array('php')));
        $results = $this->object->getObjects();
        $this->assertTrue(is_array($results));
        $this->assertTrue(count($results) == 2);
        $this->assertInstanceof('Symfony\Component\Finder\SplFileInfo', $results[0]->data['fileobj']);
        $this->assertInstanceof('Symfony\Component\Finder\SplFileInfo', $results[1]->data['fileobj']);

        // Sort order is not guaranteed!
        if ($results[0]->getName() == 'subdir/example.php') {
            $this->assertEquals('', $results[1]->data['relpath']);
            $this->assertEquals('subdir', $results[0]->data['relpath']);
            $this->assertEquals('example.php', $results[1]->data['relpathname']);
            $this->assertEquals('subdir/example.php', $results[0]->data['relpathname']);
        } else {
            $this->assertEquals('', $results[0]->data['relpath']);
            $this->assertEquals('subdir', $results[1]->data['relpath']);
            $this->assertEquals('example.php', $results[0]->data['relpathname']);
            $this->assertEquals('subdir/example.php', $results[1]->data['relpathname']);
        }
    }

    /**
     * @expectedException Inanimatt\SiteBuilder\Exception\SiteBuilderException
     */
    public function testGetObjectsException()
    {
        $results = $this->object->getObjects();
    }

    /**
     * @expectedException Inanimatt\SiteBuilder\Exception\SiteBuilderException
     */
    public function testRegisterContentHandlerException()
    {
        $results = $this->object->registerContentHandler('Inanimatt\SiteBuilder\ContentCollection\testFile', 'php');
    }
}
