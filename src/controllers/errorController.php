<?php

namespace controllers;

use lib\pages;

class errorController {
    private pages $pages;
    public function __construct()
    {
        $this->pages = new pages();
    }

    /**
     * @return void
     */
    public function error404() {
        $this->pages->render('error/error', ['titulo' => 'Página no encontrada']);
    }

}
