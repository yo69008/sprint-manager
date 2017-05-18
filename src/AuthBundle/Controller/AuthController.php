<?php

namespace AuthBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;




class AuthController extends AbstractAuthController
{
    const
    /**
     * @var string error message for auth
     */
    ERROR_MESSAGE_AUTH ="Incorrect email adress or password !";
    
    
    public function __construct()
    {
       parent::__construct();     
    }        
    
    
    /**
     * @Route("/auth", name="auth")
     */
      public function authAction(Request $request)
      {
            
            
          if ($this->hasGlobalAccess()){
                return $this->redirectToHomePage();
            }
            
            $form =$this->getAuthAndJoinForm("Sign In");
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $user =$this->readUser($form);
                
            if ($user && password_verify(
                    $form->getData()["password"],
                    $user->getPassword()))
                 {
                    $this->setGlobalAccess($user);
                    return  $this->redirectToHomePage();
                    
                }
                $message =self::ERROR_MESSAGE_AUTH;    
               
           
                   
          }
          return $this->render('@AuthBundle/Resources/views/sign.html.twig', [
                    "title" => "Sign In",
                    "link" =>"Sign Out",
                    "legend" => "New to Sprint.io ? Create an account !",
                    "url" => $this->generateUrl("join"),
                    "form"  => $form->createView(),
                    "message" =>isset($message) ? $message : "",
                ]
              );  
       }         
                
 }               
      
        
       



