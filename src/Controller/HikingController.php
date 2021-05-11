<?php

namespace App\Controller;

use App\Model\HikingManager;

class HikingController extends AbstractController
{

    public function show()
    {


        return $this->twig->render('Hiking/show.html.twig');
    }
}
