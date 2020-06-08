<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use App\Entity\User;
use App\Form\UserType;

class UserController extends AbstractController{
  
	/**
     *  @route("/register", name="register")
     * 
     * 
     */
    public function Register(Request $request, UserPasswordEncoderInterface $encoder){
      $manager = $this -> getDoctrine() -> getManager();

      $user = new User;
      $form = $this -> createForm(UserType::class, $user);

      $form -> handleRequest($request);

      if($form -> isSubmitted() && $form -> isValid()){
        $manager -> persist($user);
        //Encodage du mot de passe//
        $password = $user -> getPassword();
        $user -> setPassword($encode -> encodePassword($user, $password));


        $manager -> flush();
        $this -> addFlash('Success', 'Votre inscription à été prise en compte');
        return $this -> redirectToRoute('accueil');
      }


      return $this -> render('user/register.html.twig',array('userForm' => $form -> createView()
      ));
    }
	/**
     *  @route("/login", name="login")
     * 
     * 
     */
    public function Login(AuthenticationUtils $auth){

      $lastUsername = $auth -> getLastUsername();

      $error = $auth -> getLastAuthenticationError();

      if($error){
          $this -> addFlash('errors', 'Problème d\'identifiant');
      }
		  return $this -> render('user/login.html.twig',array('lastUsername' => $lastUsername,));
    }


  /**
   *  @route("/profil", name="profil")
   * 
   * 
   */
  public function loginCheck(){
    
  }



	/**
     *  @route("/profil", name="profil")
     * 
     * 
     */
    public function Profil(){
		return $this -> render('user/profil.html.twig',array());
    }
	/**
     *  @route("/logout", name="logout")
     * 
     * 
     */
    public function Logout(){
		return $this -> redirectToRoute('login');
    }
























}