# MCP PHP Application

The **MCP PHP Application** is a stub application designed to work with the [MCP PHP Server framework](https://github.com/james2037/mcp-php-server). It serves as a starting point for users implementing the [Model Context Protocol](https://modelcontextprotocol.io/) (MCP) in their projects.

## Prerequisites

Before using this application, ensure that you have the following installed:

1. **PHP**: Running `php --version` should report 8.1 or greater.
2. **Composer**: The dependency manager for PHP. You can find it [here](https://getcomposer.org/).

## Installation

To set up the application, follow these steps:

1. Clone this repository:
   ```bash
   git clone https://github.com/james2037/mcp-php-application.git
   ```

2. Navigate to the project directory:
   ```bash
   cd mcp-php-application
   ```

3. Install the dependencies using Composer:
   ```bash
   composer install
   ```

## Creating a Tool

To create a tool for the application, follow these steps:

1. Create a new class in the `tools/` directory. For example:

   ```php
   <?php

   namespace App\Tools;

   use MCP\Server\Tool\Tool;
   use MCP\Server\Tool\Attribute\Tool as ToolAttribute;
   use MCP\Server\Tool\Attribute\Parameter as ParameterAttribute;

   #[ToolAttribute('example', 'An example tool showing basic functionality')]
   class ExampleTool extends Tool {
       protected function doExecute(
           #[ParameterAttribute('input', type: 'string', description: 'Text to echo back')]
           array $arguments
       ): array {
           return $this->text("You said: " . $arguments['input']);
       }
   }
   ```

2. The `#[ToolAttribute]` annotation defines the name and description of the tool.
3. Parameters for the tool are defined using the `#[ParameterAttribute]` annotation.
4. Implement the `doExecute` method to define the tool's functionality.

## Running the Server

To start the MCP PHP server, run the following command:
   ```bash
   php path/to/mcp_server.php
   ```
the `mcp_server.php` file is located in the root of this repository.

The server will start and listen for requests based on the Model Context Protocol.

## Features

Currently, you can write tools. The server supports the STDIO transport only. New capabilities and transports coming soon.

## Contributing

Contributions to the MCP PHP Application are welcome! Feel free to submit issues or pull requests to improve functionality, documentation, or examples.

## License

This project is licensed under the [MIT License](LICENSE).
