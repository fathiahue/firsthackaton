<?php

namespace App\Controller;

use App\Model\HikingManager;

class HikingController extends AbstractController
{

    public function show()
    {


        return $this->twig->render('Hiking/show.html.twig');
    }

    public function landDisplay(int $X, int $Y)
    {
        $coord = [(int)floor($X/3), (int)floor($Y/3)];

        $idPop = 0;


        //var_dump($coord);die;

        return $this->twig->render('Hiking/show.html.twig', ['idPop' => $idPop]);
    }
}
