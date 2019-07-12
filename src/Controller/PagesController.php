<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PagesController extends AbstractController {

    /**
     * @Route("/home")
     */
    public function home() : Response
    {
        return $this->render("home.html.twig");
    }

    /**
     * @Route("/users")
     */
    public function books() : Response
    {
        return $this->render("users.html.twig");
    }

    /**
     * @Route("/contact")
     */
    public function contact() : Response
    {
        $sujets = [
            "A propos du site.",
            "Rapporter un bug.",
            "Demande d'information."
        ];

        return $this->render("contact.html.twig", [
            'sujets'  => $sujets
        ]);
    }

    /**
     * @Route("/films")
     */
    public function films()
    {
        // $films = [
        //     "Eternal sunshine of the spotless mind.",
        //     "Waking life.",
        //     "Network.",
        //     "Indagine su un cittadino al di sopra de ogni sospetto.",
        //     "Twelve angry men."
        // ];
        $films = [
            [
                "title" => "Eternal sunshine of the spotless mind",
                "year"  => 1999
            ],
            [
                "title" => "Waking life",
                "year"  => 2005
            ],
            [
                "title" => "Network",
                "year"  => 1976
            ],
            [
                "title" => "Indagine su un cittadino al di sopra de ogni sospetto",
                "year"  => 1981
            ],
            [
                "title" => "Twelve angry men",
                "year"  => 1981
            ]
        ];

        return $this->render("films.html.twig", compact('films'));
    }

    /**
     * @Route("film/{title}", name="film_show")
     */
    public function film($title) : Response
    {
        return $this->render('film.html.twig', compact('title'));
    }

}