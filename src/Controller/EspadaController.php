<?php

namespace App\Controller;

use App\Entity\Espada;
use App\Form\EspadaType;
use App\Repository\EspadaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/espada")
 */
class EspadaController extends AbstractController
{
    /**
     * @Route("/", name="app_espada_index", methods={"GET"})
     */
    public function index(EspadaRepository $espadaRepository): Response
    {
        return $this->render('espada/index.html.twig', [
            'espadas' => $espadaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_espada_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EspadaRepository $espadaRepository): Response
    {
        $espada = new Espada();
        $form = $this->createForm(EspadaType::class, $espada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $espadaRepository->add($espada, true);

            return $this->redirectToRoute('app_espada_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('espada/new.html.twig', [
            'espada' => $espada,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_espada_show", methods={"GET"})
     */
    public function show(Espada $espada): Response
    {
        return $this->render('espada/show.html.twig', [
            'espada' => $espada,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_espada_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Espada $espada, EspadaRepository $espadaRepository): Response
    {
        $form = $this->createForm(EspadaType::class, $espada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $espadaRepository->add($espada, true);

            return $this->redirectToRoute('app_espada_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('espada/edit.html.twig', [
            'espada' => $espada,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_espada_delete", methods={"POST"})
     */
    public function delete(Request $request, Espada $espada, EspadaRepository $espadaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$espada->getId(), $request->request->get('_token'))) {
            $espadaRepository->remove($espada, true);
        }

        return $this->redirectToRoute('app_espada_index', [], Response::HTTP_SEE_OTHER);
    }
}
