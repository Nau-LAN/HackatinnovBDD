<?php

namespace routes;

use controllers\Main;
use routes\base\Route;

class Web
{
    function __construct()
    {
        $main = new Main();

        Route::Add('/', [$main, 'home']);
        Route::Add('/offre', [$main, 'offre']);
        Route::Add('/createOffre', [$main, 'createTeam']);
    }
}

