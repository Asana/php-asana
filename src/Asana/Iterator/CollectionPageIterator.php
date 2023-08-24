<?php

namespace Asana\Iterator;

use Asana\Iterator\PageIterator;

#[\AllowDynamicProperties]
class CollectionPageIterator extends PageIterator
{
    public $sync = null;

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
        if (!empty($result->sync)) {
            $this->sync = $result->sync;
        }

        return isset($result->next_page) ? $result->next_page : null;
    }
}
