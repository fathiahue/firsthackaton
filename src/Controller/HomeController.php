<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $content = [];
        /*$client = HttpClient::create();
        //$response = $client->request('GET', 'https://api.nasa.gov/insight_weather/?api_key=hySDNvBOvkzJtcrJ1kPsrtRxx4TqtQAigNGSE8Jt&feedtype=json&ver=1.0');
        $response = '';
        $statusCode = $response->getStatusCode();

        if($statusCode === 200 ){
            $content = $response->getContent();
            $content = $response->toArray();
        }*/
        return $this->twig->render('Home/index.html.twig', [
            'meteo' => $content
        ]);
    }
}
