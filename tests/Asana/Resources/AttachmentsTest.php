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

        $fileDescription = $this->dispatcher->calls[0]['request']->payload['file'];
        $this->assertEquals('multipart/form-data', $this->dispatcher->calls[0]['request']->content_type);

        // If the user's PHP version supports curl_file_create, use it.
        if (function_exists('curl_file_create')) {
                $this->assertInstanceOf('CURLFile',$fileDescription);
                $this->assertEquals('file name',$fileDescription->getPostFilename());
                $this->assertEquals('file content-type',$fileDescription->getMimeType());
        } else {
                $this->assertStringMatchesFormat('%Sfilename=file name%S', $fileDescription);
                $this->assertStringMatchesFormat('%Stype=file content-type%S', $fileDescription);
        }
    }
}
