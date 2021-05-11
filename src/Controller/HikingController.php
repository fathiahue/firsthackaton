<?php

namespace App\Controller;

use App\Model\HikingManager;

class HikingController extends AbstractController
{
    public function show()
    {

        $hikingManager = new HikingManager();
        $lands = $hikingManager->selectAll();
        return $this->twig->render('Hiking/show.html.twig', ['lands' => $lands]);
    }

    public function landDisplay(int $X, int $Y)
    {
        $hikingManager = new HikingManager();
        $lands = $hikingManager->selectAll();

        $X = (int)floor($X / 3);
        $Y = (int)floor($Y / 3);

        $idPop = [];
        foreach ($lands as $land) {
            $xMin = $land['coordinate_X'] - 20;
            $xMax = $land['coordinate_X'] + 20;
            $yMin = $land['coordinate_Y'] - 20;
            $yMax = $land['coordinate_Y'] + 20;
            if ($X > $xMin && $X < $xMax && $Y > $yMin && $Y < $yMax) {
                $idPop['id'] = $land['id'];
                $idPop['name'] = $land['name'];
                $idPop['description'] = $land['description'];
                $idPop['url'] = $land['url'];
            }
        }

        $choosenBalises = $_SESSION['baliseId'];
        $coordBalises = $_SESSION['coordBalises'];

        //$coord = [(int)floor($X/3), (int)floor($Y/3)];
        //var_dump($idPop);die;

        return $this->twig->render('Hiking/show.html.twig', ['idPop' => $idPop, 'lands' => $lands, 'baliseId' => $choosenBalises, 'coordBalises' => $coordBalises]);
    }

    public function baliseDisplay()
    {
        $choosenBalises = [];
        $coordBalises = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $balisesId = array_map('trim', $_POST);
            //$balises = array_values($balises);
            $hikingManager = new HikingManager();
            $balises = $hikingManager->selectAll();
            foreach ($balises as $bal) {
                if (in_array($bal['id'], $balisesId)) {
                    $choosenBalises[] = (int)$bal['id'];
                    $coordBalises .= (int)$bal['coordinate_X'] . '-' . (int)$bal['coordinate_Y'] . ' ';
                }
            }
            $coordBalises = substr($coordBalises, 0, -1);
            //var_dump($coordBalises); die;
        }

        $_SESSION['baliseId'] = $choosenBalises;
        $_SESSION['coordBalises'] = $coordBalises;

        $hikingManager = new HikingManager();
        $lands = $hikingManager->selectAll();
        return $this->twig->render('Hiking/show.html.twig', ['lands' => $lands, 'baliseId' => $choosenBalises, 'coordBalises' => $coordBalises]);
    }
}
