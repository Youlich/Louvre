<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LouvreController extends Controller
{
    /**
     * @Route("/", name="louvre")
     */
    public function index()
    {
        return $this->render('louvre/index.html.twig', [
            'controller_name' => 'LouvreController',
        ]);
    }
}
