<?php

namespace controllers;
use lib\pages;

class dashboardController {
    private pages $pages;
    function __construct() {
        $this->pages = new pages();
    }

    /**
     * @return void
     */
    public function index():void {
        $this->pages->render('layout/header');
    }
}