<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LogementController extends AbstractController
{
    /**
     * @Route("/logement", name="logement")
     */
    public function index()
    {
        return $this->render('logement/index.html.twig', [
            'controller_name' => 'LogementController',
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('logement/contact.html.twig');
    }

    /**
     * @Route("/display", name="display")
     */
    public function display(Request $request)
    {
        echo "This is the full request:<br>";
        dump($request);
        $name = $request->request->get('name');
        echo "This is the r->r->get(name):<br>";
        dump($name);
        echo "This is all:<br>";
        $all = $request->request->all();
        dump($all);
        echo "This is r->r->get('form'):<br>";
        $form = $request->request->get('form');
        dd($form);
        return $this->render( 'logement/contact.html.twig');
    }
}
