<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Form\GameType;
use App\Repository\CardRepository;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/game')]
final class GameController extends AbstractController
{
    #[Route(name: 'app_game_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }


    #[Route('/new', name: 'app_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    // Seleccionar carta jugador 1
    #[Route('/selectCard1', name: 'selectCard1', methods: ['GET', 'POST'])]
    public function selectCard1(Request $request, EntityManagerInterface $entityManager, CardRepository $cardRepository)
    {
        // Obtener el ID de la carta desde la solicitud
        $selectedCards = $request->get('idCards');

        $cardId1 = $selectedCards[0];
        $cardId2 = $selectedCards[1];

        // Buscar las cartas en la base de datos
        $card1 = $cardRepository->find($cardId1);
        $card2 = $cardRepository->find($cardId2);

        // Saco el usuario de la sesion
        $user = $this->getUser();


        // // Crear un nuevo juego
        $game = new Game();
        $game->setLocal($user);

        $game->setLocalCard($card1);
        $game->setLocalCard2($card2);

        // // Añado el nuevo juego a la BD
        $entityManager->persist($game);
        $entityManager->flush();

        // return $this->render('main/index.html.twig', []);
        return $this->redirectToRoute('app_main');
    }


    // Seleccionar carta jugador 2
    #[Route('/selectCard2', name: 'selectCard2', methods: ['GET', 'POST'])]
    public function selectCard2(Request $request, EntityManagerInterface $entityManager, CardRepository $cardRepository, GameRepository $gameRepository)
    {
        // Obtener el ID de la carta desde la solicitud
        $selectedCards = $request->get('idCards');

        $cardId1 = $selectedCards[0];
        $cardId2 = $selectedCards[1];

        // Buscar las cartas en la base de datos
        $card1 = $cardRepository->find($cardId1);
        $card2 = $cardRepository->find($cardId2);

        // Saco el usuario de la sesion
        $user = $this->getUser();

        // Busco el juego por id 
        $gameId = $request->query->get('idGame');
        $game = $gameRepository->find($gameId);

        // // Saco el resultado de la partida
        // if ($game->getLocalCard()->getNumber() > $card->getNumber()) {
        //     $result = -1;
        // } else if ($game->getLocalCard()->getNumber() < $card->getNumber()) {
        //     $result = 1;
        // } else {
        //     $result = 0;
        // }

        // Actualizo el objeto juego
        $game->setAway($user);

        $game->setAwayCard($card1);
        $game->setAwayCardId2($card2);
        // $game->setResult($result);

        // Actualizo la base de datos con el juego actualizado  (Al utilizar $gameRepository->find($gameId)), Doctrine lo considera gestionado y cualquier cambio que haga en las propiedades del objeto automáticamente marca ese objeto como modificado y al utilizar flush lo actualiza en la BD)
        $entityManager->flush();

        // return $this->render('main/index.html.twig', []);
        return $this->redirectToRoute('app_main');
    }
    /**
        // Obtener el ID de la carta desde la solicitud
        $selectedCards = $request->get('idCards');

        $cardId1 = $selectedCards[0];
        $cardId2 = $selectedCards[1];

        // Buscar las cartas en la base de datos
        $card1 = $cardRepository->find($cardId1);
        $card2 = $cardRepository->find($cardId2);

        // Saco el usuario de la sesion
        $user = $this->getUser();


        // // Crear un nuevo juego
        $game = new Game();
        $game->setAway($user);

        $game->setAwayCard($card1);
        $game->setAwayCardId2($card2);

        // Saco el resultado de la partida
        // if ($game->getLocalCard()->getNumber() > $card->getNumber()) {
        //     $result = -1;
        // } else if ($game->getLocalCard()->getNumber() < $card->getNumber()) {
        //     $result = 1;
        // } else {
        //     $result = 0;
        // }


        // Actualizo la base de datos con el juego actualizado  (Al utilizar $gameRepository->find($gameId)), Doctrine lo considera gestionado y cualquier cambio que haga en las propiedades del objeto automáticamente marca ese objeto como modificado y al utilizar flush lo actualiza en la BD)
        $entityManager->flush();

        // return $this->render('main/index.html.twig', []);
        return $this->redirectToRoute('app_main'); 

     */



    #[Route('/{id}', name: 'app_game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        return $this->render('game/show.html.twig', [
            'game' => $game,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    public function delete(Request $request, Game $game, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
    }
}
