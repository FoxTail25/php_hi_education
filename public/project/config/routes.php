<?php

use Core\Route;

return [
        
    new Route('/', 'index', 'hi'),
    new Route('/json/:theme', 'json', 'getPage'),
    new Route('/function/:theme', 'function', 'getPage'),
    new Route('/xml/:theme', 'xml', 'getPage'),
    new Route('/curl/:theme', 'curl', 'getPage'),
    new Route('/testloc/:theme', 'testloc', 'getPage'),
    new Route('/api/:theme', 'api', 'getPage'),
    new Route('/testapi/:theme', 'testapi', 'getPage'),
];