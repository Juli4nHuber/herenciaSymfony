<?php

namespace App\Controller;

use App\Entity\Arco;
use App\Form\ArcoType;
use App\Repository\ArcoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/arco")
 */
class ArcoController extends AbstractController
{
    /**
     * @Route("/", name="app_arco_index", methods={"GET"})
     */
    public function index(ArcoRepository $arcoRepository): Response
    {
        return $this->render('arco/index.html.twig', [
            'arcos' => $arcoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_arco_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArcoRepository $arcoRepository): Response
    {
        $arco = new Arco();
        $form = $this->createForm(ArcoType::class, $arco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arcoRepository->add($arco, true);

            return $this->redirectToRoute('app_arco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arco/new.html.twig', [
            'arco' => $arco,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arco_show", methods={"GET"})
     */
    public function show(Arco $arco): Response
    {
        return $this->render('arco/show.html.twig', [
            'arco' => $arco,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_arco_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Arco $arco, ArcoRepository $arcoRepository): Response
    {
        $form = $this->createForm(ArcoType::class, $arco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $arcoRepository->add($arco, true);

            return $this->redirectToRoute('app_arco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arco/edit.html.twig', [
            'arco' => $arco,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arco_delete", methods={"POST"})
     */
    public function delete(Request $request, Arco $arco, ArcoRepository $arcoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arco->getId(), $request->request->get('_token'))) {
            $arcoRepository->remove($arco, true);
        }

        return $this->redirectToRoute('app_arco_index', [], Response::HTTP_SEE_OTHER);
    }
}
