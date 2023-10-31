<?php

namespace App\Controller;

use App\Entity\Tips;
use App\Entity\User;
use App\Form\TipsType;
use App\Repository\TipsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TipsRepository $tipsRepository, UserRepository $userRepository, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager, Request $request): Response
    {
        $tips = $tipsRepository->findAll();
        $tip = $tipsRepository->findOneTip();
        $users = $userRepository->findAll();
        // Créez une nouvelle instance de Tips
        $newTip = new Tips();

        // Créez un formulaire basé sur cette instance
        $tipsForm = $formFactory->create(TipsType::class, $newTip);

        // Gérez la soumission du formulaire
        $tipsForm->handleRequest($request);

        if ($tipsForm->isSubmitted() && $tipsForm->isValid()) {

            // Récupérer l'utilisateur
            $newTip->setUser($this->getUser());

            // Utilisez $entityManager pour persister l'objet Tips
            $entityManager->persist($newTip);
            $entityManager->flush();
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tips' => $tips,
            'tip' => $tip,
            'users' => $users,
            'tipsForm' => $tipsForm->createView(),
        ]);
    }
}
