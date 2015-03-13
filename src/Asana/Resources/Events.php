<?php

namespace Asana\Resources;

use Asana\Resources\Gen\EventsBase;
use Asana\Iterator\EventsPageIterator;

class Events extends EventsBase
{
    public function get($query = array(), $options = array())
    {
        $options['full_payload'] = true;
        return $this->client->get('/events', $query, $options);
    }

    public function getNext($query = array(), $options = array())
    {
        $iterator = new EventsPageIterator($this->client, '/events', $query, $options);
        $iterator->rewind();
        return array($iterator->current(), $iterator->continuation);
    }

    public function getIterator($query = array(), $options = array())
    {
        $iterator = new EventsPageIterator($this->client, '/events', $query, $options);
        return $iterator->items();
    }
}
