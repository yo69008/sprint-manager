<?php

namespace AuthBundle\Controller;

use AppBundle\Controller\AbstractAppController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use AuthBundle\Entity\User;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\Button;



abstract class AbstractAuthController extends AbstractAppController
{
    
    public function __construct()
    {
      parent::__construct(); 
    }
    
    protected function readUser(Form $form)
    {
        return $this->getDoctrine()
        ->getManager()
        ->getRepository(User::class)
        ->findOneBy([
            "email"=> $form->getData()["email"] ]);
    }
    
     protected function getAuthAndJoinForm($submitLabel)
   {
       $builder=$this->createFormBuilder();
       
       $builder->add("email",
           EmailType::class,[
               "label"=> "Email adress",
               'attr' => [
                   'placeholder' =>'Enter your Email'
               ],
               'constraints' => [
                   new Email([
                       "message" =>"incorrect email adress !"
                   ]),
                   new NotBlank([
                       "message"=>"Email adress must existing !"
                   ])
               ]
               
           ]);
       
       
       $builder->add
       ("password",
           TextType::class, [
               "label"=> "Password",
               'attr' => [
                   'placeholder' =>'Enter your Password'
               ],
               'constraints' => [
                   new Regex([
                       "pattern" =>"/^[\w]{6,32}$/",
                       "message" =>"Incorrect Password"
                   ]),
                   new NotBlank([
                       "message"=>"Email adress must existing !"
                   ])
               ]
           ]
           
           );
       $builder->add("create", SubmitType::class,[
           "label"=> $submitLabel,
           'attr' => ["class" => "btn btn-primary btn-lg "
           ]
       ]);
       
       return $builder->getForm();
       
       
   }
    
   
  
    
}

