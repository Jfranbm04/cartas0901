<?php

namespace App\Controller;

use App\Entity\Card;
use App\Repository\CardRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{

    // Mostrar la pantalla principal
    #[Route('/main', name: 'app_main')]
    public function index(GameRepository $gameRepository): Response
    {
        // partidas empezadas pero con resultado nulo
        $gamesStarted = $gameRepository->findGamesWithNullResult();

        // Partidas jugadas y completadas por el usuario
        $gamesCompleted = $gameRepository->findGamesByUser($this->getUser());

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'gamesStarted' => $gamesStarted,
            'gamesCompleted' => $gamesCompleted,
        ]);
    }




    // Mostrar pantalla startGame
    #[Route('/startGame', name: 'app_startGame')]
    public function startGame(CardRepository $cardRepository, GameRepository $gameRepository): Response
    {

        $cards = $cardRepository->findAll();
        shuffle($cards);   // Barajar cartas

        // Generar cartas para el jugador
        $playerCards = array_slice($cards, 0, 4);


        // partidas empezadas pero con resultado nulo
        $games = $gameRepository->findGamesWithNullResult();




        return $this->render('main/startGame.html.twig', [
            'controller_name' => 'GameController',
            'cards' => $cards,
            'playerCards' => $playerCards,
            'games' => $games,
        ]);
    }

    // Mostrar pantalla continueGame
    #[Route('/continueGame/{codigoJuego}', name: 'app_continueGame')]
    public function continueGame(int $codigoJuego, CardRepository $cardRepository, GameRepository $gameRepository): Response
    {

        $cards = $cardRepository->findAll();
        shuffle($cards);   // Barajar cartas

        // Generar cartas para el jugador
        $playerCards = array_slice($cards, 0, 4);

        // Partidas empezadas pero con resultado nulo
        $games = $gameRepository->findGamesWithNullResult();

        return $this->render('main/continueGame.html.twig', [
            'controller_name' => 'GameController',
            'cards' => $cards,
            'playerCards' => $playerCards,
            'games' => $games,
            'codigoJuego' => $codigoJuego,

        ]);
    }

    // Mostrar pantalla admin
    #[Route('/admin', name: 'admin', methods: ['GET', 'POST'])]
    public function adminView(): Response
    {


        return $this->render('main/admin.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
