<?php
$pathEnv = __DIR__ . '/../../';
if (file_exists($pathEnv . '.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($pathEnv);
    $dotenv->load();
}
