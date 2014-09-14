<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * The StaticPageController manages the "static" pages that dont require any local database interaction....
 *
 * @author pete wond
 */

class StaticPageController extends Controller
{
    /**
     * function to load index / home page
     * 
     * @return void
     */
    public function indexAction()
    {
        return $this->render('EllisDotComMainBundle:Pages:home.html.twig');
    }

    /**
     * function to load news page
     * 
     * @return void
     */
    public function newsAction()
    {
        return $this->render('EllisDotComMainBundle:Pages:news.html.twig');
    }
    
    /**
     * function to load about page
     * 
     * @return void
     */
    public function aboutAction()
    {
        return $this->render('EllisDotComMainBundle:Pages:about.html.twig');
    }

    /**
     * function to load contact page
     * 
     * @return void
     */
    public function contactAction()
    {
        return $this->render('EllisDotComMainBundle:Pages:contact.html.twig');
    }
}