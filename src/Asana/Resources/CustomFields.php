<?php

namespace Asana\Resources;

use Asana\Resources\Gen\CustomFieldsBase;

class CustomFields extends CustomFieldsBase
{
    public function addEnumOption($customField, $params = array(), $options = array())
    {
        return $this->createEnumOption($customField, $params, $options);
    }

    public function reorderEnumOption($customField, $params = array(), $options = array())
    {
        return $this->insertEnumOption($customField, $params, $options);
    }
}
