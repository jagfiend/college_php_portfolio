<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * this is the controlller for the content management system, it renders the page with the dashboardAction function.
 * ajax functions are then called from the page to retrieve, create, edit and delete records from the database without
 * reloading the page...
 *
 * @author pete wond
 */

class AdminDashboardController extends Controller
{
    /**
     * function to render the dashboard twig template
     * 
     * @return void
     */
    public function viewAction()
    {
        // links array....
        $links = array('portfolio','categories','products','orders');

        // render the basic dashboard twig template...
        return $this->render('EllisDotComMainBundle:Admin:dashboard.html.twig', array('links' => $links));
    }
}