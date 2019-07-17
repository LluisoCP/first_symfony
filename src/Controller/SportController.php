<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @IsGranted("ROLE_USER")
 */
class SportController extends AbstractController
{
    /**
     * @Route("/sports", name="sports")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Sport::class);
        $sports = $repository->findAll();
        return $this->render('sport/index.html.twig', [
            'sports' => $sports,
        ]);
    }

    /**
     * @Route("/sport/{name}", name="sport")
     */
    public function show($name)
    {
        $repository = $this->getDoctrine()->getRepository(Sport::class);
        $sport = $repository->findOneBy([
            'nom'   => $name
        ]);

        return $this->render("sport/sport.html.twig", compact('sport'));
    }

    /**
     * @Route("/sport/add", name="sport_add", methods={"GET"})
     */
    public function add()
    {
        return $this->render('sport/add.html.twig');
    }

    /**
     * @Route("/sport/add", name="sport_save", methods={"POST"})
     */
    public function save(Request $request) : Response 
    {
        $sport = new Sport;

        $sport->setNom($request->request->get('nom'));
        $sport->setNbjoueurs($request->request->get('joueurs'));
        $sport->setFormeBallon($request->request->get('ballon'));
        $sport->setSurfaceTerrain($request->request->get('surface'));
        // dump($sport);
        // dd($request);
        // $errors = $validator->validate($sport);

        // if (count($errors) > 0)
        // {
        //     return new Response((string) $errors, 400);
        // }
        
        $doctrine = $this->getDoctrine();
        
        $entityManager = $doctrine->getManager();

        $entityManager->persist($sport);
        
        $entityManager->flush();

        $added = [
            "name"          => $sport->getNom(),
            "num_players"   => $sport->getNbjoueurs(),
            "ballshape"     => $sport->getFormeBallon(),
            "surface"       => $sport->getSurfaceTerrain()
        ];

        return $this->render('sport/added.html.twig', compact('added'));

    }
    /**
     * @Route("/sport/{name}/edit", name="sport_edit", methods={"GET"})
     */
    public function edit(EntityRepository $sportRepository, $name) : Response
    {
        $sport = $sportRepository->findOneBy([
            'nom'   => $name
        ]);
        if (!$sport)
        {
            return $this->render('sport/sport.html.twig', compact('sport'));
        }

        return $this->render('sport/edit.html.twig', compact('sport'));
    }

    /**
     * @Route("/sport/{name}/edit", methods={"POST"})
     */
    public function update(EntityRepository $sportRepository, $name)
    {
        $sport = $sportRepository->findOneBy([
            'nom'   => $name
        ]);
        if (!$sport)
        {
            return $this->render('sport/sport.html.twig', compact('sport'));
        }
        

    }



}
