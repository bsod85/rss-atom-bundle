<?php

namespace Debril\RssAtomBundle\Protocol\Parser;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-27 at 00:26:35.
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Factory
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Factory();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Debril\RssAtomBundle\Protocol\Parser\Factory::newFeed
     */
    public function testNewFeed()
    {
        $feed = $this->object->newFeed();
        $this->assertInstanceOf("\Debril\RssAtomBundle\Protocol\FeedInInterface", $feed);
    }

    /**
     * @covers Debril\RssAtomBundle\Protocol\Parser\Factory::newItem
     */
    public function testNewItem()
    {
        $item = $this->object->newItem();
        $this->assertInstanceOf("\Debril\RssAtomBundle\Protocol\ItemInInterface", $item);
    }

    /**
     * @covers Debril\RssAtomBundle\Protocol\Parser\Factory::setFeedClass
     */
    public function testSetFeedClass()
    {
        $this->object->setFeedClass('\Debril\RssAtomBundle\Protocol\Parser\FeedContent');
    }

    /**
     * @covers Debril\RssAtomBundle\Protocol\Parser\Factory::setFeedClass
     * @expectedException \Exception
     */
    public function testSetFeedClassException()
    {
        $this->object->setFeedClass('\Debril\RssAtomBundle\Protocol\A\Bad\Name');
    }

    /**
     * @covers Debril\RssAtomBundle\Protocol\Parser\Factory::setItemClass
     */
    public function testSetItemClass()
    {
        $this->object->setItemClass('\Debril\RssAtomBundle\Protocol\Parser\Item');
    }

    /**
     * @covers Debril\RssAtomBundle\Protocol\Parser\Factory::setItemClass
     * @expectedException \Exception
     */
    public function testSetItemClassException()
    {
        $this->object->setItemClass('Debril\RssAtomBundle\Protocol\A\Bad\Name');
    }
}
