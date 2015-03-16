<?php

namespace Asana;

use Asana\Test\AsanaTest;

class AttachmentsTest extends Test\AsanaTest
{
    public function testAttachmentsCreateOnTask()
    {
        $res = '{ "data": { "id": 5678, "name": "file.txt" } }';
        $this->dispatcher->registerResponse('/tasks/1337/attachments', 200, null, $res);

        $result = $this->client->attachments->createOnTask(1337, 'file contents', 'file name', 'file content-type');
        $this->assertEquals($result, json_decode($res)->data);

        $str = $this->dispatcher->calls[0]['request']->payload['file'];
        $this->assertEquals('multipart/form-data', $this->dispatcher->calls[0]['request']->content_type);

        $this->assertStringMatchesFormat('%Sfilename=file name%S', $str);
        $this->assertStringMatchesFormat('%Stype=file content-type%S', $str);
    }
}
