<?php

namespace Asana\Resources;

use Asana\Resources\Gen\ProjectStatusesBase;

class ProjectStatuses extends ProjectStatusesBase
{
    public function create($project, $params = array(), $options = array())
    {
        return $this->createInProject($project, $params, $options);
    }
}
