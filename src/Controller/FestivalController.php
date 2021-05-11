<?php

namespace App\Controller;

class FestivalController extends AbstractController
{

    public function index()
    {
        return $this->twig->render('Festival/festival.html.twig');
    }
}
