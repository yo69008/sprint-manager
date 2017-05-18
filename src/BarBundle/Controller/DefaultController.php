<?php

namespace BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    //pour recupérer une variable ($id par ex) - changer la route (l13)
    // et puis mettre Request en arg (lign16) --
    //ne pas oublier l'expression reguliere (elements acceptés dans l'url)
    //->[0-9] (accept les chiffre de 0 a 9) {2} => 2 chiffres acceptes
    //possibilité d'integrer plusieurs routes
//     /**
//      * @Route("/bar/{id}/{nic}", name="bar",
//      *  requirements={
//      *  "id": "[0-9]{2}",
//      *  "nic" : "[0-9]{4}"
//      *  })
//      */
    //dans l'uri la route sera :
    //http://localhost/FormationSymphony/sprint-io/web/app_dev.php/bar/22/0000 par ex.
//     public function indexAction(Request $request)
//     {
        //pour générer une url
//         $url = $this->generateUrl("bar", ["id" =>22,
//             "nic" =>4444
//         ]);
//         $this->redirectToRoute($url);
        

//         exit;
       // chemin dans app/Resources/views
        //return $this->render('base.html.twig');
         // Chemin dans le bundle BarBundle/Resources/views
         //=> mauvaise pratique
        //return $this->render('BarBundle:Default:index.html.twig');
        
         // bonne pratique et nouvelle pratique:
         //pour donner un second arg tableau afin de faire passer une variable (clé=> valeur)
//         return $this->render('@BarBundle/Resources/views/Default/index.html.twig', [
//             "hello"=>"hello LYON"
//         ]);
//     }

    // REDIRECTION
    /**
     * @Route("/bar/{id}/{nic}", name="bar",
     *  requirements={
     *  "id": "[0-9]{2}",
     *  "nic" : "[0-9]{4}"
     *  })
     */
    public function indexAction($id)
    {
        $url = $this->generateUrl("baz");
        return $this->redirectToRoute("baz");
    }
    
    
   
    /**
     * @Route("/baz", name="baz")
     */
    public function baz()
    {
        die("baz baz");
        return $this->render('@BarBundle/Resources/views/Default/index.html.twig', [
            "hello"=>"hello LYON"
        ]);
    }
}
