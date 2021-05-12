<?php

namespace App\Controller;

use App\Model\HikingManager;

class HikingController extends AbstractController
{
    public function show()
    {
        $filter = 2;
        $hikingManager = new HikingManager();
        $lands = $hikingManager->selectAll();
        return $this->twig->render('Hiking/show.html.twig', ['lands' => $lands, 'filter' => $filter]);
    }

    public function landDisplay(int $X, int $Y)
    {
        $filter = 2;
        $filter = $_SESSION['filter'];
        $hikingManager = new HikingManager();
        if ($filter == 2) {
            $lands = $hikingManager->selectAll(2);
        } elseif ($filter == 1) {
            $lands = $hikingManager->selectAllFilter(1);
        } else {
            $lands = $hikingManager->selectAllFilter(0);
        }
        //$lands = $hikingManager->selectAll();

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

        return $this->twig->render('Hiking/show.html.twig', ['idPop' => $idPop, 'lands' => $lands, 'baliseId' => $choosenBalises, 'coordBalises' => $coordBalises, 'filter' => $filter]);
    }

    public function baliseDisplay()
    {
        $choosenBalises = [];
        $coordBalises = '';
        $filter = 2;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $balisesId = array_map('trim', $_POST);
            $filter = $balisesId['filter'];
            $balisesId = array_slice($balisesId, 1);
            //$balises = array_values($balises);
            $hikingManager = new HikingManager();

            if ($filter == 2) {
                $balises = $hikingManager->selectAll(2);
            } elseif ($filter == 1) {
                $balises = $hikingManager->selectAllFilter(1);
            } else {
                $balises = $hikingManager->selectAllFilter(0);
            }
            //$balises = $hikingManager->selectAll();
            foreach ($balises as $bal) {
                if (in_array($bal['id'], $balisesId)) {
                    $choosenBalises[] = (int)$bal['id'];
                    $coordBalises .= (int)$bal['coordinate_X'] . '-' . (int)$bal['coordinate_Y'] . '-' . (int)$bal['id'] . ' ';
                }
            }
            $coordBalises = substr($coordBalises, 0, -1);
            //var_dump($coordBalises);die;
            //var_dump($balisesId); var_dump($filter);die;
        }

        $_SESSION['baliseId'] = $choosenBalises;
        $_SESSION['coordBalises'] = $coordBalises;
        $_SESSION['filter'] = $filter;

        $hikingManager = new HikingManager();
        if ($filter == 2) {
            $lands = $hikingManager->selectAll(2);
        } elseif ($filter == 1) {
            $lands = $hikingManager->selectAllFilter(1);
        } else {
            $lands = $hikingManager->selectAllFilter(0);
        }
        //$lands = $hikingManager->selectAll();
        return $this->twig->render('Hiking/show.html.twig', ['lands' => $lands, 'baliseId' => $choosenBalises, 'coordBalises' => $coordBalises, 'filter' => $filter]);
    }
}
