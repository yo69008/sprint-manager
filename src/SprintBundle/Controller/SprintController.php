<?php

namespace SprintBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SprintController extends AbstractSprintController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * @Route("/sprint", name="sprint")
     */
    public function sprintAction(Request $request)
    {
        if (!$this->hasGlobalAccess()){
            return $this->redirectToHomePage();
        } else if (!$this->hasSprintAccess()) {
            return $this->redirectToCreate();   
        }
        
   
        
        $sprint = $this->readSprint();
       $duration = $sprint->getDay() * 86400;
          $lapsed = time()- $sprint->getTime();
          $done= $lapsed / $duration * 100;
          $percent =round($lapsed / $duration * 100,2);
          
        return $this->render('@SprintBundle/Resources/views/sprint.html.twig', [
            "title" => "The Sprint",
            "goal" => $sprint->getGoal(),
            "description" =>$sprint->getDescription(),
            "day" => $sprint->getDay(),
            "time" => $sprint->getTime(),
            "duration" => $duration,
            "lapsed" => $lapsed,
            "done" => $done,
            "percent" => $percent,
            "master" =>$this->hasScrumMasterAccess()
        ]);
        
        
      }
          
}            
           
             
            
            
        
         
         
        
    

