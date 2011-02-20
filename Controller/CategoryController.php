<?php

namespace Application\Jobeet2Bundle\Controller;

use Application\Jobeet2Bundle\Entity\Job;
use Application\Jobeet2Bundle\Entity\User;
use Application\Jobeet2Bundle\Entity\Category;
use Application\Jobeet2Bundle\Form\JobForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\DoctrineBundle\Form\ValueTransformer\EntityToIDTransformer;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\Events;
use Application\Jobeet2Bundle\Listener\JobEventListener;



class CategoryController extends Controller
{
    protected function getEm()
    {
        return $this->get('doctrine.orm.entity_manager');
    }    
 

    public function indexAction()
    {

    

    }

    public function showAction($slug)
    {

        $em = $this->getEm();
        
        $category = $em->getRepository('Jobeet2Bundle:Category')
                ->findOneBySlug($slug);
        
        if (!$category) {
            throw new NotFoundHttpException('The Category does not exist.');
        }
        
        $page = $this->get('request')->query->get('page', 1);
   
        return $this->render('Jobeet2Bundle:Category:show.html.twig',
            array('category'    => $category,
                  'page'        => $page));
        
    }
}