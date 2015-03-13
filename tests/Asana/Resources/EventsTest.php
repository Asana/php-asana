<?php

namespace Asana;

use Asana\Test\AsanaTest;

class EventsTest extends Test\AsanaTest
{
    public function testEventsGet()
    {
        $res = '{ "data": ["a", "b"], "sync": "b" }';
        $this->dispatcher->registerResponse('/events?resource=14321&sync=a', 200, null, $res);

        $result = $this->client->events->get(array('resource' => 14321, 'sync' => 'a' ));
        $this->assertEquals($result, json_decode($res));
    }

    /**
     * @expectedException Asana\Errors\InvalidTokenError
     */
    public function testEventsGetInvalidToken()
    {
        $res = '{ "message": "Sync token invalid or too old", "sync": "b" }';
        $this->dispatcher->registerResponse('/events?resource=14321&sync=a', 412, null, $res);

        $this->client->events->get(array('resource' => 14321, 'sync' => 'a' ));
    }

    public function testEventsGetNext()
    {
        $res = '{ "sync": "1" }';
        $this->dispatcher->registerResponse('/events?limit=50&resource=1', 412, null, $res);
        $res = '{ "data": [], "sync": "2" }';
        $this->dispatcher->registerResponse('/events?limit=50&sync=1&resource=1', 200, null, $res);
        $res = '{ "data": [{}, {}], "sync": "3" }';
        $this->dispatcher->registerResponse('/events?limit=50&sync=2&resource=1', 200, null, $res);

        $this->assertEquals(count($this->client->events->getNext(array('resource' => '1'))), 2);
    }

    /**
     * @expectedException Asana\Errors\InvalidRequestError
     */
    public function testEventsGetNextUnknownObject()
    {
        $this->dispatcher->registerResponse('/events?limit=50&resource=1', 400, null, '{ "sync": "1" }');

        $this->client->events->getNext(array('resource' => '1'));
    }

    /**
     * @expectedException Asana\Errors\InvalidTokenError
     */
    public function testEventsGetNextInvalidToken()
    {
        $this->dispatcher->registerResponse('/events?limit=50&sync=invalid&resource=1', 412, null, '{ "sync": "1" }');

        $this->client->events->getNext(array('resource' => '1', 'sync' => 'invalid'));
    }

    public function testEventsGetIterator()
    {
        $res = '{ "sync": "1" }';
        $this->dispatcher->registerResponse('/events?limit=50&resource=1', 412, null, $res);
        $res = '{ "data": [], "sync": "2" }';
        $this->dispatcher->registerResponse('/events?limit=50&sync=1&resource=1', 200, null, $res);
        $res = '{ "data": ["a", "b"], "sync": "3" }';
        $this->dispatcher->registerResponse('/events?limit=50&sync=2&resource=1', 200, null, $res);
        $res = '{ "data": ["c"], "sync": "4" }';
        $this->dispatcher->registerResponse('/events?limit=50&sync=3&resource=1', 200, null, $res);

        $iterator = $this->client->events->getIterator(array('resource' => '1'));
        $iterator->rewind();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'a');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'b');
        // FIXME: ItemIterator currently fetches one page ahead
        // $iterator->next();
        // $this->assertEquals($iterator->valid(), true);
        // $this->assertEquals($iterator->current(), 'c');
    }

    /**
     * @expectedException Asana\Errors\InvalidRequestError
     */
    public function testEventsGetIteratorUnknownObject()
    {
        $this->dispatcher->registerResponse('/events?limit=50&resource=1', 400, null, '{ "sync": "1" }');

        $this->client->events->getIterator(array('resource' => '1'))->rewind();
    }

    /**
     * @expectedException Asana\Errors\InvalidTokenError
     */
    public function testEventsGetIteratorInvalidToken()
    {
        $this->dispatcher->registerResponse('/events?limit=50&sync=invalid&resource=1', 412, null, '{ "sync": "1" }');

        $this->client->events->getIterator(array('resource' => '1', 'sync' => 'invalid'))->rewind();
    }
}
