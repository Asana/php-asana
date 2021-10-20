<?php

namespace Asana\Resources\Gen;

class AuditLogAPIBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get audit log events
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getAuditLogEvents($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/audit_log_events";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
