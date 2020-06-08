<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function panierAdd($postId, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();

        $panier = $session->get('panier', []);

        $postRepository = $em->getRepository();
        $post = $productRepository->find($postId);

        $panier[] = $product;


        $panier = $session->get('panier', []);

        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }


}
