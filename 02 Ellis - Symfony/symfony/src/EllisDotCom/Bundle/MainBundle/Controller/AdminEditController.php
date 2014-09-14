<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EllisDotCom\Bundle\MainBundle\Entity\Portfolio;
use EllisDotCom\Bundle\MainBundle\Entity\Categories;
use EllisDotCom\Bundle\MainBundle\Entity\Products;


/**
 * this is the controlller for the editView that calls the database for a single record to populate the cms view and updates the 
 * record with the users changes...
 *
 * @author pete wond
 */

class AdminEditController extends Controller
{
    /**
     * function to...
     * 
     * @param string $table 
     * @param integer $id id of row to be edited with selected table...
     * 
     * @return void
     */
    public function viewAction($table, $id)
    {
        // call repository of selected table...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:'.$table.'');
        
        // set $rows variable to result of findAll method...
        $record = $repository->findOneBy(array('id' => $id));
        
        // error handling...
        if(!$record){
            throw $this->createNotFoundException('No rows found, something gone awry!?');
        } else {
            // conditional to create form appropriate for selected table...
            if($table == 'portfolio')
            {
                $form = $this->createFormBuilder($record)
                ->setMethod('POST')
                ->add('title','text')
                // call to add dropdown populated by values from categories table...
                ->add('category','entity', array('class' => 'EllisDotComMainBundle:Categories', 'property' => 'category'))
                ->add('description','textarea')
                ->add('tags','text')
                ->add('aspect','choice', array('choices' => array('square' => 'Square','landscape' => 'Landscape','portrait' => 'Portrait')))
                ->getForm();
            } elseif ($table == 'categories') 
            {
                $form = $this->createFormBuilder($record)
                ->setMethod('POST')
                ->add('category','text')
                ->getForm();
            } elseif ($table == 'products') 
            {
                $form = $this->createFormBuilder($record)
                ->setMethod('POST')
                ->add('name','text')
                ->add('description','textarea')
                ->add('price','number')
                ->add('stock','number')
                ->getForm();
            }               
            
            // render the view with appropriate form...
            return $this->render('EllisDotComMainBundle:Admin:edit.html.twig', array('table' => $table, 'record' => $record, 'form' => $form->createView()));
        }
    }

    /**
     * function to update record within the selected table...
     * 
     * @param string $table name of the selected table...
     * @param integer $id id of row to be edited with selected table...
     * @param array $request instance of request object...
     * 
     * @return void
     */
    public function updateAction($table, $id, Request $request)
    {
        // call entity manager...
        $em = $this->getDoctrine()->getManager();
        
        // set record variable to result of find method...
        $recordForUpdate = $em->getRepository('EllisDotComMainBundle:'.$table.'')->find($id);
        
        // error handling...
        if(!$recordForUpdate){
            throw $this->createNotFoundException('No rows found, something gone awry!?');
        }
        
        // get form data from request object...
        $formData = $request->request->get('form');
        
        // conditional to create form appropriate for selected table...
        if($table == 'portfolio')
        {
            // call set methods...
            $recordForUpdate->setTitle($formData['title']);
            $recordForUpdate->setCategoryId($formData['category']);
            $recordForUpdate->setDescription($formData['description']);
            $recordForUpdate->setTags($formData['tags']);
            $recordForUpdate->setAspect($formData['aspect']);
        } elseif ($table == 'categories') 
        {
            // call set methods...
            $recordForUpdate->setCategory($formData['category']);
        } elseif ($table == 'products') 
        {
            // call set methods...
            $recordForUpdate->setName($formData['name']);
            $recordForUpdate->setDescription($formData['description']);
            $recordForUpdate->setPrice($formData['price']);
            $recordForUpdate->setStock($formData['stock']);
        }
        
        // complete update action with flush method...
        $em->flush();
        
        // flash message...
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Record successfully updated!'
            );
        
        // redirect to list view...
        return $this->redirect($this->generateUrl('EllisDotCom_ListView', array('table' => $table)), 301);
    }
}