<?php

require 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$base_url = getenv('BASE_URL');

$template = "<!DOCTYPE html><html lang=\"en\"><head><meta charset=\"UTF-8\"><title>Great Food Lab</title></head><body><table class='table'><thead><tr><td>ID</td><td>NAME</td></tr></thead>";