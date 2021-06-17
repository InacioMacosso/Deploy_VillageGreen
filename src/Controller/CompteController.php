<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/compte")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/", name="compte")
     */
    public function index(): Response
    {
        return $this->render('compte/index.html.twig');
    }
}
