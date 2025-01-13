<?php
require __DIR__ . '/vendor/autoload.php';

use MCP\Server\Server;
use MCP\Server\Transport\StdioTransport;
use MCP\Server\Tool\ToolRegistry;
use MCP\Server\Resource\ResourceRegistry;
use MCP\Server\Capability\ToolsCapability;
use MCP\Server\Capability\ResourcesCapability;

// Load server configuration
$config = require __DIR__ . '/config/server.php';

// Create server instance
$server = new Server($config['name'], $config['version']);

// Set up signal handling
if (function_exists('pcntl_signal')) {
    pcntl_signal(SIGINT, function() use ($server) {
        $server->shutdown();
        exit(0);
    });
} else if (function_exists('sapi_windows_set_ctrl_handler')) {
    sapi_windows_set_ctrl_handler(function() use ($server) {
        $server->shutdown();
    });
}

// Discover and register tools
$toolRegistry = new ToolRegistry();
$toolRegistry->discover(__DIR__ . '/tools', $config);

$toolsCapability = new ToolsCapability();
foreach ($toolRegistry->getTools() as $tool) {
    $toolsCapability->addTool($tool);
}
$server->addCapability($toolsCapability);

// Discover and register resources
$resourceRegistry = new ResourceRegistry();
$resourceRegistry->discover(__DIR__ . '/resources', $config);

$resourcesCapability = new ResourcesCapability();
foreach ($resourceRegistry->getResources() as $resource) {
    $resourcesCapability->addResource($resource);
}
$server->addCapability($resourcesCapability);

// Run server
$server->connect(new StdioTransport());
$server->run();
