<?php

namespace Asana\Dispatcher;

use \Httpful;
use \Httpful\Mime;

class Dispatcher
{
    public function __construct()
    {
        // All of Asana's IDs are int64. If the current build of PHP does not
        // support integers that large, we specify that integers that are too
        // large should be represented as strings instead. Otherwise PHP would 
        // convert them to floats.
        // Note that Httpful's JsonHandler does not support that option which 
        // is why we have to register our own JSON handler.
        if (PHP_INT_SIZE < 8) {
            \Httpful\Httpful::register(
                \Httpful\Mime::JSON, 
                new \Asana\Dispatcher\Handlers\JsonHandler(array('parse_options' => JSON_BIGINT_AS_STRING))
            );
        }
    }

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

        if (isset($requestOptions['curl'])) {
            foreach($requestOptions['curl'] as $curlopt => $curlval){
                $request->addOnCurlOption($curlopt,$curlval);    
            }
        }

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

                // If the user's PHP version supports curl_file_create, use it.
                if (function_exists('curl_file_create')) {
                    if ( (isset($file[1]) && $file[1] != null) )  {
                        $mimetype = '';
                        if ( (isset($file[2]) && $file[2] != null) )  {
                            $mimetype = $file[2];
                        }
                        $body[$name] = curl_file_create($tmpFilePath, $mimetype, $file[1]);
                    }
                }
                // Otherwise we can still use the '@' notation.
                else {
                    $body[$name] = '@' . $tmpFilePath;
                    if (isset($file[1]) && $file[1] != null) {
                        $body[$name] .= ';filename=' . $file[1];
                    }
                    if (isset($file[2]) && $file[2] != null) {
                        $body[$name] .= ';type=' . $file[2];
                    }
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
        $posix_available = function_exists('posix_uname');
        $sys_info = $posix_available ? posix_uname() : null;
        $client_info = array(
            'version' => $this->getClientVersion(),
            'language' => 'PHP',
            'language_version' => phpversion(),
            'os' => $posix_available ? $sys_info['sysname'] : php_uname('s'),
            'os_version' => $posix_available ? $sys_info['release'] : php_uname('r')
        );

        return array(
            'X-Asana-Client-Lib' => http_build_query($client_info)
        );
    }
}
