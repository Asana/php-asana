<?php

namespace Asana\Dispatcher;

use \Httpful;
use \Httpful\Mime;

class Dispatcher
{
    public function request($method, $uri, $requestOptions)
    {
        if (isset($requestOptions['params'])) {
            $qs = http_build_query($requestOptions['params']);
            if (strlen($qs) > 0) {
                $uri .= "?" . $qs;
            }
        }

        $request = $this->createRequest()
            ->method($method)
            ->uri($uri)
            ->expectsJson();

        if (isset($requestOptions['headers'])) {
            $request->addHeaders($requestOptions['headers']);
        }
        $request->addHeaders($this->versionHeader());

        if (isset($requestOptions['data'])) {
            $request->sendsJson()->body($requestOptions['data']);
        }

        $tmpFiles = array();
        if (isset($requestOptions['files'])) {
            foreach ($requestOptions['files'] as $name => $file) {
                $tmpFilePath = tempnam(null, null);
                $tmpFiles[] = $tmpFilePath;
                file_put_contents($tmpFilePath, $file[0]);
                $body[$name] = '@' . $tmpFilePath;
                if (isset($file[1]) && $file[1] != null) {
                    $body[$name] .= ';filename=' . $file[1];
                }
                if (isset($file[2]) && $file[2] != null) {
                    $body[$name] .= ';type=' . $file[2];
                }
            }
            $request->body($body)->sendsType(\Httpful\Mime::UPLOAD);
        }

        $this->authenticate($request);

        try {
            $result = $request->send();
            foreach ($tmpFiles as $tmpFilePath) {
                unlink($tmpFilePath);
            }
        } catch (Exception $e) {
            // fake "finally"
            foreach ($tmpFiles as $tmpFilePath) {
                unlink($tmpFilePath);
            }
            throw $e;
        }
        return $result;
    }

    protected function createRequest()
    {
        return \Httpful\Request::init();
    }

    protected function authenticate($request)
    {
        return $request;
    }

    private function getClientVersion()
    {
        $version_file = dirname(__FILE__) . "/../../../VERSION";
        $version_info = file_get_contents($version_file) ?: "0.0.0";

        return str_replace(array("\r", "\n"), "", $version_info);
    }

    private function versionHeader()
    {
        $sys_info = posix_uname();
        $client_info = array(
            'version' => $this->getClientVersion(),
            'language' => 'PHP',
            'language_version' => phpversion(),
            'os' => $sys_info['sysname'],
            'os_version' => $sys_info['release']
        );

        return array(
            'X-Asana-Client-Lib' => http_build_query($client_info)
        );
    }
}
