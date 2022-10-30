<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\EvenementRepository;
use App\Entity\Evenement;
use App\Entity\Tournoi;
use App\Form\TournoiType;
use Symfony\Component\HttpFoundation\Request;

class TournoiController extends AbstractController
{
    #[Route('/', name: 'menu')]
    public function index(): Response
    {
        return $this->render('tournoi/menu.html.twig',[

        ]);
    }
    #[Route('/tournoi', name: 'listEvtsTournois')]
    public function listEvtsTournois(
        ManagerRegistry $doctrine, 
        EvenementRepository $EvenementRepository): Response
    {
        // $entityManager = $doctrine->getManager();
        // $evts = $doctrine->getRepository(Evenement::class)->findAll();
        $evts = $EvenementRepository->findAll();
        return $this->render('tournoi/index.html.twig', [
            'evts' => $evts,
        ]);
    }

    #[Route('/add', name: 'saisirTournoi')]
    public function saisirTournoi(Request $request, ManagerRegistry $doctrine): Response
    {
        $tnoi = new Tournoi();
        $form = $this->createForm(TournoiType::class, $tnoi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($tnoi);
            $entityManager->flush();
            return $this->redirectToRoute('tournoi');
        }
        return $this->renderForm('tournoi/saisieTnoi.html.twig', [
            'form' => $form,
        ]);
    }

}
