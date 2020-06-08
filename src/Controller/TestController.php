<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
  /**
   * @Route("/bonjour")
   * 
   * localhost:8001/bonjour
   * www.monblog.com/bonjour
   * 
   */
    public function bonjour () {
        echo 'bonjour tout le monde !';
    }

    /**
     * 
     * @Route("/hello", name="hello")
     * localhost:8001/hello
     */
    public function hello() {
        return new Response('<h1>Hello World</h1>');
    }

    /**
     * @Route("/hola/{prenom}")
     * 
     * 
     */
    public function hola($prenom){
        return new Response('Hola ' . $prenom . ' ! ');
    }
    /**
     * @route("/ciao/{prenom}")
     * 
     */
    public function ciao($prenom){
        return $this -> render('test/ciao.html.twig', array(
            'prenom' => $prenom
        ));
    }
    /**
     * @Route("/redirect")
     * 
     * 
     */
    public function redirect2(){
        return $this -> redirectToRoute('hello');

    }
    /**
     *  @route("/message", name="message")
     * 
     * 
     */
    public function message(){
            $this -> addFlash('success', 'Felicitation vous avec un RDV avec une jolie JAPONAISE !!!!!');
            $this -> addFlash('errors','le post numero 8 n\'existe pas !');
           
            return $this -> render('test/message.html.twig',array());

    }



}
