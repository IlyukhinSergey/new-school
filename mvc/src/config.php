<?php

const PROJECT_ROOT_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..';

const DB_HOST = 'database:3306';
const DB_NAME = 'mvc';
const DB_USER = 'root';
const DB_PASSWORD = 'tiger';

const ADMIN_IDS = [41,];

function d(...$args)
{
    var_dump($args);
    die;
}