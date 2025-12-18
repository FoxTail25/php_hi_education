<?php

use Core\Route;

return [
        
    new Route('/', 'index', 'hi'),
    new Route('/json/', 'json', 'intro'),
    new Route('/json/data_in_json/', 'json', 'data_in_json'),
    new Route('/json/obj_in_json/', 'json', 'obj_in_json'),
];