<?php

namespace App\Controller;

use App\Entity\TypeChambre;
use App\Form\TypeChambreType;
use App\Repository\TypeChambreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/typechambre')]
class TypeChambreController extends AbstractController
{
    #[Route('/', name: 'app_type_chambre_index', methods: ['GET'])]
    public function index(TypeChambreRepository $typeChambreRepository): Response
    {
        return $this->render('type_chambre/index.html.twig', [
            'type_chambres' => $typeChambreRepository->findAll(),
        ]);
    }

    

    
    #[Route('/chambreDispo', name: 'app_type_chambredispo', methods: ['GET', 'POST'])]
    public function chambreDispo(Request $request, TypeChambreRepository $typeChambreRepository): Response
    {
      
     

            $type = $request->resquest->get('chambreDispo');
              dump($type);
            $chambredispo = $typeChambreRepository->findbydispo($type) ;
            return $this->render('type_chambre/index.html.twig', [
                'type_chambres' =>   $chambredispo ,
            ]);
         
        }
    



    #[Route('/new', name: 'app_type_chambre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeChambreRepository $typeChambreRepository, SluggerInterface $slugger): Response
    {
        $typeChambre = new TypeChambre();
        $form = $this->createForm(TypeChambreType::class, $typeChambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFilename = $form->get('imageFilename')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFilename) {
                $originalFilename = pathinfo($imageFilename->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFilename->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageFilename->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the PDF file name
                // instead of its contents
                $typeChambre->setimageFilename($newFilename);
            }

            $typeChambreRepository->save($typeChambre, true);

            return $this->redirectToRoute('app_type_chambre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_chambre/new.html.twig', [
            'type_chambre' => $typeChambre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_chambre_show', methods: ['GET'])]
    public function show(TypeChambre $typeChambre): Response
    {
        return $this->render('type_chambre/show.html.twig', [
            'type_chambre' => $typeChambre,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_chambre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeChambre $typeChambre, TypeChambreRepository $typeChambreRepository, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(TypeChambreType::class, $typeChambre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            
            $imageFilename = $form->get('imageFilename')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFilename) {
                $originalFilename = pathinfo($imageFilename->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFilename->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageFilename->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the PDF file name
                // instead of its contents
                $typeChambre->setimageFilename($newFilename);
            }





            $typeChambreRepository->save($typeChambre, true);

            return $this->redirectToRoute('app_type_chambre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_chambre/edit.html.twig', [
            'type_chambre' => $typeChambre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_chambre_delete', methods: ['POST'])]
    public function delete(Request $request, TypeChambre $typeChambre, TypeChambreRepository $typeChambreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeChambre->getId(), $request->request->get('_token'))) {
            $typeChambreRepository->remove($typeChambre, true);
        }

        return $this->redirectToRoute('app_type_chambre_index', [], Response::HTTP_SEE_OTHER);
    }
}
