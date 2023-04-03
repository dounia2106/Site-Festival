<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\TypeChambreRepository;
use App\Repository\OffreRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index( Request $request, TypeChambreRepository $typeChambreRepository, OffreRepository $offreRepository ): Response
    {
     
      dump($request->request->get('room'));

if ($request->request->get('room') !=null){

    $array = $offreRepository->findByNbC1($request->request->get('room'),$request->request->get('nb'));
   
   dump($array);
    $offres = [];
  /*  foreach($array as $val)
    {
            if($val  instanceof App\Entity\Offre) 
                   $offres[] = $val ;
    }*/
    return $this->render('offre/index.html.twig', [
       'offres' => $array,
       
    ]);
}
        
   
      return $this->render('home/index.html.twig', [
            'type_chambres' => $typeChambreRepository->findAll(),
           
        ]);
    }

}