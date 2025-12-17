<?php

use Core\Route;

return [
        
    new Route('/', 'index', 'hi'),
    new Route('/my-page1/', 'page', 'show1'),
    new Route('/my-page2/', 'page', 'show2'),
];