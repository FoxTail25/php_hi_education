<?php

use Core\Route;

return [
        
    new Route('/', 'index', 'hi'),
    new Route('/json/:theme', 'json', 'getPage'),
    new Route('/function/:theme', 'function', 'getPage'),
];