<?php

use Core\Route;

return [
        
    new Route('/', 'index', 'hi'),
    // new Route('/function/anonim_func/', 'function', 'anonim_func'),
    // new Route('/function/external_var_anonim_func/', 'function', 'external_var_anonim_func'),
    // new Route('/function/anonim_func_get_outer_var/', 'function', 'anonim_func_get_outer_var'),
    new Route('/json/', 'json', 'intro'),
    // new Route('/function/:theme', 'function', 'intro'),
    new Route('/function/:theme', 'function', 'test'),
];