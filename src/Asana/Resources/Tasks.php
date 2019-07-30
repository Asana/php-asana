<?php

namespace Asana\Resources;

use Asana\Resources\Gen\TasksBase;

class Tasks extends TasksBase
{
    public function search($workspace, $params = array(), $options = array())
    {
        return $this->searchInWorkspace($workspace, $params, $options);
    }
}
