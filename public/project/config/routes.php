<?php

use Core\Route;

return [
        
    new Route('/', 'index', 'hi'),
    new Route('/json/', 'json', 'intro'),
    new Route('/function/:theme', 'function', 'test'),
];