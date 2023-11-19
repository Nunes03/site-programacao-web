<?php
require_once __DIR__ . str_replace("/", DIRECTORY_SEPARATOR, "/../../src/Database/DatabaseConnection.php");

echo "{\"isDevelopment\": " . DatabaseConnection::isDevelopmentFront() . "}";
