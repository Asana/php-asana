<?php

namespace Asana\Iterator;

use Asana\Iterator\PageIterator;

class CollectionPageIterator extends PageIterator
{
    protected function getInitial()
    {
        return $this->client->get($this->path, $this->query, $this->options);
    }

    protected function getNext()
    {
        $this->options['offset'] = $this->continuation->offset;
        return $this->client->get($this->path, $this->query, $this->options);
    }

    protected function getContinuation($result)
    {
        return isset($result->next_page) ? $result->next_page : null;
    }
}
