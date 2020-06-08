<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\HttpUtils;

use App\Entity\Post;

class PostController extends AbstractController
{

    /**
    * @Route("/", name="accueil")
    *
    */
    public function index(){

        //SELECT * FROM post
        //SELECT distinct category FROM post ORDER BY category (récupération des infos)
        //SELECT * FROM post order by registerDate DESC LIMIT 0, 3
        $repository = $this -> getDoctrine() ->
        getRepository(Post::class);

        $posts = $repository -> findAll();
        $categories = $repository -> findAllCategories();

        // Affichage de la vue
        return $this -> render("post/index.html.twig", array('posts' => $posts, 'categories' => $categories));

    }

    /**
    * @Route("/show/{id}", name="show")
    *
    */
    public function show($id){
        
        $repo = $this -> getDoctrine() -> getRepository(Post::class);
        $post = $repo -> find($id);
        return $this -> render("post/show.html.twig", array(
            'post' => $post
        ));
    }

    /**
    * @Route("/category/{cat}", name="category")
    *
    */
    public function category($cat){
        //1: Récupérer les posts de la catégorie $cat//
        $repo = $this -> getDoctrine() -> getRepository(Post::class);
        $posts = $repo -> findBy(['category' => $cat]);
        $categories = $repo -> findAllCategories();

        $manager = $this -> getDoctrine() -> getManager();
        $builder = $manager -> createQueryBuilder();

        $query = $manager -> createQuery("SELECT DISTINCT p.category FROM App\Entitypost ORDER BY p.category ASC");
        $categories = $query -> getResult();

        //2: Les afficher dans la vue//
        return $this -> render("post/index.html.twig", array('posts' => $posts, 'categories' => $categories));
        
    }
}
