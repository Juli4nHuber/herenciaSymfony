<?php

namespace App\Controller;

use App\Entity\Arma;
use App\Entity\Arco;
use App\Entity\Espada;
use App\Form\ArmaType;
use App\Repository\ArcoRepository;
use App\Repository\ArmaRepository;
use App\Repository\EspadaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/arma")
 */
class ArmaController extends AbstractController
{

    private $em;
    private $espadaRepository;
    private $arcoRepository;

    public function __construct(EntityManagerInterface $entityManager, EspadaRepository $espadaRepository, ArcoRepository $arcoRepository){
        $this->em = $entityManager;
        $this->espadaRepository = $espadaRepository;
        $this->arcoRepository = $arcoRepository;
    }
    /**
     * @Route("/", name="app_arma_index", methods={"GET"})
     */
    public function index(ArmaRepository $armaRepository): Response
    {
        return $this->render('arma/index.html.twig', [
            'armas' => $armaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_arma_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArmaRepository $armaRepository): Response
    {
        $arma = new Arma();
        $form = $this->createForm(ArmaType::class, $arma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $armaRepository->add($arma, true);

            return $this->redirectToRoute('app_arma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arma/new.html.twig', [
            'arma' => $arma,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arma_show", methods={"GET"})
     */
    public function show(Arma $arma): Response
    {
        return $this->render('arma/show.html.twig', [
            'arma' => $arma,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_arma_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Arma $arma, ArmaRepository $armaRepository): Response
    {
        $form = $this->createForm(ArmaType::class, $arma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $armaRepository->add($arma, true);

            return $this->redirectToRoute('app_arma_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('arma/edit.html.twig', [
            'arma' => $arma,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_arma_delete", methods={"POST"})
     */
    public function delete(Request $request, Arma $arma, ArmaRepository $armaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$arma->getId(), $request->request->get('_token'))) {
            $armaRepository->remove($arma, true);
        }

        return $this->redirectToRoute('app_arma_index', [], Response::HTTP_SEE_OTHER);
    }
}
