<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddMusicController extends AbstractController
{
    #[Route('/add/music', name:'app_add_music')]
    public function index(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $name = $request->request->get('name');
            $desc = $request->request->get('desc');

            /** @var UploadedFile $uploadedFile */
            $photo = $request->files->get('file-photo');

            /** @var UploadedFile $uploadedFile */
            $music = $request->files->get('file-music');
            $share = $request->request->get('share');

            // two files (image and music)
            $photoFilename = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $musicFilename = pathinfo($music->getClientOriginalName(), PATHINFO_FILENAME);

            // destination folder
            $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';

            // two file extesnion
            $photoExtension = $photo->guessExtension();
            $musicExtension = $music->guessExtension();

            // normalize the file names (delete spaces and weird caracter) and add unique id
            $photoNewFilename = \Gedmo\Sluggable\Util\Urlizer::urlize($photoFilename . '-' . uniqid()) . '.' . $photoExtension;
            $musicNewFilename = \Gedmo\Sluggable\Util\Urlizer::urlize($musicFilename . '-' . uniqid()) . '.' . $musicExtension;

            // add these two files to public/uploads dir
            $photo->move($destination, $photoNewFilename);
            $music->move($destination, $musicNewFilename);

            return $this->render('add_music/index.html.twig', [
                'controller_name' => 'AddMusicController',
            ]);
        }

        return $this->render('add_music/index.html.twig', [
            'controller_name' => 'AddMusicController',
        ]);
    }
}
