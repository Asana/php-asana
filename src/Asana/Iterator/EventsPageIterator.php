<?php

namespace Asana\Iterator;

use Asana\Iterator\PageIterator;
use Asana\Errors\InvalidTokenError;

class EventsPageIterator extends PageIterator
{
    protected function getInitial()
    {
        if (!isset($this->query['sync'])) {
            try {
                $this->client->events->get($this->query, $this->options);
            } catch (InvalidTokenError $e) {
                $this->continuation = $e->sync;
            }
        } else {
            $this->continuation = $this->query['sync'];
        }
        return $this->getNext();
    }

    protected function getNext()
    {
        $this->options['sync'] = $this->continuation;
        return $this->client->events->get($this->query, $this->options);
    }

    protected function getContinuation($result)
    {
        return isset($result->sync) ? $result->sync : null;
    }

    public function next()
    {
        while (true) {
            parent::next();
            if (count($this->current()) > 0) {
                break;
            } else {
                sleep($this->options['poll_interval']);
            }
        }
    }
}
