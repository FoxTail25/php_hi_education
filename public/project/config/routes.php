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
    new Route('/sqlsecure/:theme', 'sqlsecure', 'getPage'),
    new Route('/testapi/:theme', 'testapi', 'getPage'),
    new Route('/leap/:year', 'testapi', 'getLeap'),
    new Route('/diff/:year1/:year2', 'testapi', 'getDiff'),
    new Route('/i-store/product/:id', 'istore', 'ProductById'),
    new Route('/i-store/products/', 'istore', 'product'),
    new Route('/i-store/product/', 'istore', 'product'),
];