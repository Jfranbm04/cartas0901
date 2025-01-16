<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    #[Route('/startGame', name: 'app_startGame')]
    public function startGame(CardRepository $cardRepository): Response
    {

        $cards = $cardRepository->findAll();
        shuffle($cards);   // Barajar cartas

        // Generar cartas para el jugador
        $playerCards = array_slice($cards, 0, 2);







        return $this->render('main/startGame.html.twig', [
            'controller_name' => 'StartGameController',
            'cards' => $cards,
            'playerCards' => $playerCards,
        ]);
    }
}




/*

    #[Route('/selectCard', name: 'selectCard', methods: ['GET', 'POST'])]
    public function selectCard(Request $request, EntityManagerInterface $entityManager)
    {
        // Obtener el ID de la carta desde la solicitud
        $cardId = $request->request->get('card_id');

        // Saco el ID del usuario de la sesion
        $user = new User($this->getUser());
        $userId = $user->getId();



        // Crear un nuevo juego
        $game = new Game();
        $game->setDate(new \DateTime());  // Establecer la fecha actual
        $game->setLocal('Jugador');


        return $this->render('main/index.html.twig', []);
    }

*/