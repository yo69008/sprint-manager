<?php

namespace AuthBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AuthBundle\Entity\User;
use Throwable;



class JoinController extends AbstractAuthController
{
    
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
   /**
    * @Route("/join", name="join")
    */
    public function joinAction(Request $request)
    {
       
        if ($this->hasGlobalAccess()) {
             return $this->redirectToHomePage();
        }
         $form=$this->getAuthAndJoinForm("Submit");
       
         $form->handleRequest($request);
     
        
       
        
       if ($form->isSubmitted() && $form->isValid()) {
           
           if (!$this->readUser($form)) {
            //---si user n'existe pas on le creé
            //--Recuperation des données
            //-1°) le mail
            $user =new User();
            $user->setEmail($form->getData()["email"]);
            
            
            
            //-2°) le password
            
            $user->setPassword(
                password_hash(
                     $form->getData()["password"],
                     PASSWORD_DEFAULT));
            
            //insertion dans la base
                    try {
                    $this->getDoctrine()->getManager()->persist($user);
                    $this->getDoctrine()->getManager()->flush();
                    } catch (Throwable $e) {
                        
                        $message="An Error as occured";
                    }
            
            $this->setGlobalAccess($user);
             return  $this->redirectToHomePage();
            
            } 
            $message = "Account already exists !";
        
        }    
         return $this->render('@AuthBundle/Resources/views/sign.html.twig', [
            "title" => "Sign up",
            "link" =>"Sign In",
            "legend" => "Already an account ? please",
            "url" => $this->generateUrl("auth"),
            "form"  => $form->createView(),
            "message" => isset($message) ? $message : "",
            
        ]);
     }   
}             
           
       
           
        
    

        
        
       
           
          
           
       
