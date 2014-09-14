<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use EllisDotCom\Bundle\MainBundle\Entity\Portfolio;
use EllisDotCom\Bundle\MainBundle\Entity\Categories;
use EllisDotCom\Bundle\MainBundle\Entity\Products;

/**
 * this is the controlller for the createView that allows the user to add new records to the database (by selected table)..
 *
 * @author pete wond
 */

class AdminCreateController extends Controller
{
    /**
     * function to render view of new record creation form...
     * 
     * @param string $table parent table for new record...
     * 
     * @return void
     */
    public function viewAction($table)
    {
        // conditional to create form appropriate for selected table...
        if($table == 'portfolio')
        {
            $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->add('title','text')
            // call to add dropdown populated by values from categories table...
            ->add('category','entity', array('class' => 'EllisDotComMainBundle:Categories', 'property' => 'category'))
            ->add('description','textarea')
            ->add('tags','text')
            // call to add dropdown populated by values in the array...
            ->add('aspect','choice', array('choices' => array('square' => 'Square','landscape' => 'Landscape','portrait' => 'Portrait')))
            ->add('file','file')
            ->getForm();
        } elseif ($table == 'categories') 
        {
            $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->add('category','text')
            ->add('file','file')
            ->getForm();
        } elseif ($table == 'products') 
        {
            $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->add('name','text')
            ->add('description','textarea')
            ->add('price','number')
            ->add('stock','number')
            ->add('file','file')
            ->getForm();
        }   
        // render the view with appropriate form...
        return $this->render('EllisDotComMainBundle:Admin:create.html.twig', array('table' => $table, 'form' => $form->createView()));
    }

    /**
     * function to create a new record within the selected table...
     * 
     * @param string $table name of the selected table...
     * @param array $request instance of request object...
     * 
     * @return void
     */
    public function createAction($table, Request $request)
    {
        // file data...
        // get uploaded file data from request object...
        $fileForUpload = $request->files->get('form');
        $fileData = $fileForUpload['file'];
        $filename = $fileData->getClientOriginalName();
        
        // move file into appropriate web folder...
        $fileData->move('./img/'.$table.'/', $filename);
        
        // form data...
        // get form data from request object...
        $formData = $request->request->get('form');        
        
        // call entity manager...
        $em = $this->getDoctrine()->getManager();
        
        // conditional required to ensure the form data can persisted correctly
        if($table == 'portfolio')
        {
            // call new instance of portfolio entity and set methods...
            $newRecord = new Portfolio();
            $newRecord->setTitle($formData['title']);     
            // call categories repository to set $category variable with value from appropriate value from categories table...
            $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:Categories');
            $category = $repository->find($formData['category']);
            // pass category varible into setCategory method...
            $newRecord->setCategory($category);     
            $newRecord->setDescription($formData['description']);
            $newRecord->setTags($formData['tags']);
            $newRecord->setAspect($formData['aspect']);
        } elseif ($table == 'categories') 
        {
            // call new instance of categories entity and set methods...
            $newRecord = new Categories();
            $newRecord->setCategory($formData['category']);
        } elseif ($table == 'products') 
        {
            // call new instance of categories entity and set methods...
            $newRecord = new Products();
            $newRecord->setName($formData['name']);
            $newRecord->setDescription($formData['description']);
            $newRecord->setPrice($formData['price']);
            $newRecord->setStock($formData['stock']);
        }
        
        // set filename...
        $newRecord->setFilename($filename);
        
        // set persist method...
        $em->persist($newRecord);
        
        // complete creation action with flush method...
        $em->flush();
        
        // flash message...
        $this->get('session')->getFlashBag()->add(
            'notice',
            'New record successfully added!'
        );
        
        // redirect to list view...
        return $this->redirect($this->generateUrl('EllisDotCom_ListView', array('table' => $table)), 301);           
    }
}