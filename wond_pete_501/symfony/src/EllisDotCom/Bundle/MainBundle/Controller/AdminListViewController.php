<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EllisDotCom\Bundle\MainBundle\Entity\Portfolio;
use EllisDotCom\Bundle\MainBundle\Entity\Categories;

/**
 * this is the controlller for the listView that calls the database to populate the cms views...
 *
 * @author pete wond
 */

class AdminListViewController extends Controller
{
    /**
     * function to render view of selected table...
     * 
     * @param string $table 
     * 
     * @return void
     */
    public function viewAction($table)
    {
        // conditional to map appropriate response for selected table...
        if($table == 'portfolio')
        {
            // portfolio requires specific query to call link to categories table...
            // call entity manager...
            $em = $this->getDoctrine()->getManager();
            
            // query to retrieve portfolio data with category from categories table...
            $query = $em->createQuery('
                SELECT p.id, p.title, c.category, p.description, p.tags, p.aspect, p.filename, p.created_at as createdAt, p.updated_at as updatedAt FROM EllisDotComMainBundle:Portfolio p
                JOIN p.category c
                ORDER BY p.category_id ASC
            ');
            
            // set $rows variable to result of getResult method...
            $rows = $query->getResult();
        
        } else { 
            // call repository of appropriate table...
            $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:'.$table.'');
            
            // set $rows variable to result of findAll method...
            $rows = $repository->findAll();    
        } 
        
        // error handling...
        if(!$rows){
            throw $this->createNotFoundException('No rows found, something gone awry!?');
        } else {
            // links array....
            $links = array('portfolio','categories','products','orders');

            // render the list view twig template...
            return $this->render('EllisDotComMainBundle:Admin:listView.html.twig', array('table' => $table,'rows' => $rows, 'links' => $links));
        }
    }
}