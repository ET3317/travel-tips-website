<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\TipsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TipsRepository $tipsRepository, UserRepository $userRepository): Response
    {
        $tips = $tipsRepository->findAll();
        $tip = $tipsRepository->findOneTip();
        $users = $userRepository->findAll();

        // Faites ce que vous voulez avec les $tips et $users

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tips' => $tips,
            'tip' => $tip,
            'users' => $users,
        ]);
    }
}
