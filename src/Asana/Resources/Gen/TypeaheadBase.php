<?php

namespace Asana\Resources\Gen;

class TypeaheadBase {

    /**
    * @param Asana/Client client  The client instance
    */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getTypeahead($workspace_gid, $params = array(), $options = array()) {
        /** Get objects via typeahead
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/typeahead";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }
}
