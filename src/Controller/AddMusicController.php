<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddMusicController extends AbstractController
{
    #[Route('/add/music', name: 'app_add_music')]
    public function index(): Response
    {
        return $this->render('add_music/index.html.twig', [
            'controller_name' => 'AddMusicController',
        ]);
    }
}
