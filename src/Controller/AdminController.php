<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\PostType;

class AdminController extends AbstractController
{   
    // CRUD POST
    /**
     * @Route("/admin/post", name="admin_post")
     */
    public function adminPost()
    {
        //1 : Récupérer tous les posts
        $repo = $this -> getDoctrine() -> getRepository(Post::class);
        $posts = $repo -> findAll();

        //2 : Afficher dans une vue
        return $this -> render('admin/post_list.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/admin/post/add", name="admin_post_add")
     */
    public function adminPostAdd(Request $request){
        $manager = $this -> getDoctrine() -> getManager();
        $post = new Post;

        //formulaire...
        $form = $this -> createForm(PostType::class, $post);
        // traitement des infos du formulaire

        $form -> handleRequest($request);// lier définitivement le $post aux infos du formulaire (récupération de données en $_POST)

        if($form -> isSubmitted() && $form -> isValid()){
            $manager -> persist($post); //Enregistrer le post dans le systeme
            $post -> setRegisterDate(new \DateTime('now'));
            //$post -> setImage('Zacian_and_Zamazenta.jpg');
            $post -> setUser('1');
            $post -> uploadFile();
            $manager -> flush();
            $this -> addFlash('Success', 'Le post N°'. $post -> getId() . 'a bien été enregistré');
            return $this -> redirectToRoute('admin_post');
        }
        
        return $this -> render('admin/post_form.html.twig', ['postForm' => $form -> createView()]);

    }
    /**
     * @Route("/admin/post/update/{id}", name="admin_post_update")
     */
    public function adminPostUpdate($id, Request $request){
        //1 : Récupérer le manager
        $manager = $this -> getDoctrine() -> getManager();
        //2 : Récupérer l'objet
        $post = $manager -> find(Post::class, $id);
        $form = $this -> createForm(PostType::class, $post);
        //Notre objet "hydrate" le formulaire//
        $form -> handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid()){
            //3 : Modifier le formulaire
            $manager -> persist($post);
            if($post -> getFile()){
                $post -> removeFile();
                $post -> uploadFile();
            }
            $manager -> flush();
            //4 : Message
            $this -> addFlash('success', 'Le post N°' . $id . 'a bien été modifié !');
            return $this -> redirectToRoute('admin_post');
        }
       
        //5 : Vue
        return $this -> render('admin/post_form.html.twig', ['postForm' => $form -> createView()]);
        

    }

    /**
     * @Route("/admin/post/delete/id", name="admin_post_delete")
     */
    public function adminPostDelete($id){
        //1:Manager
        $manager = $this -> getDoctrine() -> getManager();
        //2:Récupérer l'entrée à supprimer
        $post = $manager -> find(Post::class, $id);
        //3: Suppression
        $manager -> remove($post);
        $manager -> flush();
        //4: Message
        $this -> addFlush('success', 'Le post N°' . $id . 'a bien été supprimé');
        //5: Redirection
        return $this -> redirectToRoute('admin_post');

    }
}
