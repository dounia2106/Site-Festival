<?php

namespace App\Controller;

use App\Entity\Attributions;
use App\Entity\Offre;
use App\Form\AttributionsType;
use App\Repository\AttributionsRepository;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/attributions')]
class AttributionsController extends AbstractController
{
    #[Route('/', name: 'app_attributions_index', methods: ['GET'])]
    public function index(AttributionsRepository $attributionsRepository): Response
    {    dump($attributionsRepository->findAll());
        return $this->render('attributions/index.html.twig', [
            'attributions' => $attributionsRepository->findAll(),
        ]);
    }

    #[Route('/{id}/new', name: 'app_attributions_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function new(Request $request, AttributionsRepository $attributionsRepository , Offre $offre, OffreRepository $offreRepository  ): Response
    {
        $attribution = new Attributions();
        $form = $this->createForm(AttributionsType::class, $attribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             $offre->setNombreChambres($offre->getNombreChambres()-$attribution->getNombreschambres());
             $offreRepository->save($offre ,true);

                   $attribution->setOffre($offre);
            $attributionsRepository->save($attribution, true);

            return $this->redirectToRoute('app_attributions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attributions/new.html.twig', [
            'attribution' => $attribution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attributions_show', methods: ['GET'])]
    public function show(Attributions $attribution): Response
    {
        return $this->render('attributions/show.html.twig', [
            'attribution' => $attribution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_attributions_edit', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function edit(Request $request, Attributions $attribution, AttributionsRepository $attributionsRepository): Response
    {
        $form = $this->createForm(AttributionsType::class, $attribution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attributionsRepository->save($attribution, true);

            return $this->redirectToRoute('app_attributions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('attributions/edit.html.twig', [
            'attribution' => $attribution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attributions_delete', methods: ['POST'])]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Request $request, Attributions $attribution, AttributionsRepository $attributionsRepository, OffreRepository $offreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attribution->getId(), $request->request->get('_token'))) {
            $offre = $attribution->getOffre();
            $offre->setNombreChambres($offre->getNombreChambres()+$attribution->getNombreschambres());
            $offreRepository->save($offre, true);
            $attributionsRepository->remove($attribution, true);
        }

        return $this->redirectToRoute('app_attributions_index', [], Response::HTTP_SEE_OTHER);
    }
}
