<?php

namespace SprintBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SprintBundle\Entity\Sprint;
use SprintBundle\Entity\User;





class DeleteController extends AbstractSprintController
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 
     * @Route("/delete", name="delete")
     */
    public function deleteAction()
    {
        
        if(!$this->hasGlobalAccess())
        {
            return $this->redirectToHomePage();
        }
        if(!$this->hasScrumMasterAccess() || !$this->hasScrumMasterAccess())
        {
            return  $this->redirectToSprint();
        }
        //remove sprint
        $sprint=$this->readSprint();
        $sprint->getUser()->setSprint(null);
//         $this->getDoctrine()->getManager()->flush();
        
        //enlever les references
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(\AuthBundle\Entity\User::class)
            ->findBy(["sprint" => $this->getSprintAccess(),
          ]); 
        
       
        foreach ($users as $user) 
        {
           $user->setSprint(null);
           $this->getDoctrine()->getManager()->flush();
           
        }
        
       
        $this->getDoctrine()->getManager()->remove($sprint);
        $this->getDoctrine()->getManager()->flush();
        
        //revocation des droits
        $this->session->remove("sprint");
        $this->session->remove("master");
        return $this->redirectToCreate();
        
     } 
        
        
}        
        
        
        
     
        
        
      
    
        
    
    
    
