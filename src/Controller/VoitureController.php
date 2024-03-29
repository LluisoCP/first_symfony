<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @Route("/voiture")
 */
class VoitureController extends AbstractController
{
    /**
     * @Route("/", name="voiture_index", methods={"GET"})
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voiture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**@var UploadedFile $image */
            $image = $form['image']->getData();
            if ($image)
            {
                //$plate = $form['Immatriculation'];
                //dump($plate);  //Let's check this out
                //dd($form);  //Let's check this out
                $data = $request->request->all(); //get the request post data
                $plaque = $data['voiture']['Immatriculation']; // get the plate number
                $nameWithoutExtension = strtolower(str_replace(['_', '-'], '', $plaque)); //remove hyphens / underscores, make it lowercase
                $extension = $image->guessExtension(); // get the original file extension
                $nameWithExtension = $nameWithoutExtension . '.' . $extension; // new name ~ pm786rt.ext

                try
                {
                    $image->move(
                        $this->getParameter('voiture_directory'),
                        $nameWithExtension
                    );
                }
                catch (FileException $e)
                {
                    $error = [$e->getCode(), $e->getMessage()];
                }
                $voiture->setImage($nameWithExtension);
            }



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_show", methods={"GET"})
     */
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voiture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voiture $voiture): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form['image']->getData();
            if ($image)
            {
                $data = $request->request->all(); //get the request post data
                $plaque = $data['voiture']['Immatriculation']; // get the plate number
                $nameWithoutExtension = strtolower(str_replace(['_', '-'], '', $plaque)); //remove hyphens / underscores, make it lowercase
                $extension = $image->guessExtension(); // get the original file extension
                $nameWithExtension = $nameWithoutExtension . '.' . $extension; // new name ~ pm786rt.ext

                try
                {
                    $image->move(
                        $this->getParameter('voiture_directory'),
                        $nameWithExtension
                    );
                }
                catch (FileException $e)
                {
                    $error = [$e->getCode(), $e->getMessage()];
                }
                $voiture->setImage($nameWithExtension);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voiture_index');
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="voiture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Voiture $voiture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voiture_index');
    }
}
