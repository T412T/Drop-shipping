<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ControleController extends AbstractController
{
   /**
     * @Route("/register", name="register")
     * 
     * localhost:8000/register
     * www.monblog.com/register
     */
    public function register(){
        echo 'Vous êtes sur la page d inscription';
    }

       /**
     * @Route("/login", name="login")
     * 
     * localhost:8000/login
     * www.monblog.com/login
     */
    public function login(){
        echo 'Vous êtes sur la page de connexion';
    }

       /**
     * @Route("/profile", name="profile")
     * 
     * localhost:8000/profile
     * www.monblog.com/profile
     */
    public function profile(){
        echo 'Vous êtes sur votre profil';
    }

       /**
     * @Route("/logout", name="logout")
     * 
     * localhost:8000/logout
     * www.monblog.com/logout
     */
    public function logout(){
        echo 'Vous êtes déconnecté';
        return $this -> redirectToRoute('login');
    }


}

