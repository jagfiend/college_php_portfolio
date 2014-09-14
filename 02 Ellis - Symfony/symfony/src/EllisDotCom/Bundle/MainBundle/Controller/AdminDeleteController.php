<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * this is the controlller for the deleteView that calls the database to populate the cms view and deletes records...
 *
 * @author pete wond
 */

class AdminDeleteController extends Controller
{
    /**
     * function to render view of selected record...
     *
     * @param string $id id of selected record...
     * @param string $table name of parent table of selected record...
     * 
     * @return void
     */
    public function viewAction($table, $id)
    {
        // call repository of selected table...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:'.$table.'');
        
        // set $record variable to result of findOneBy method...
        $record = $repository->findOneBy(array('id' => $id));
        
        // error handling...
        if(!$record){
            throw $this->createNotFoundException('No record found, something gone awry!?');
        } else {    
            // render the delete view twig template...
            return $this->render('EllisDotComMainBundle:Admin:delete.html.twig', array('table' => $table, 'record' => $record));
        }
    }

    /**
     * function to delete selected record from parent table and redirect user back to list view of parent table...
     *
     * @param string $id id of selected record...
     * @param string $table name of parent table of selected record...
     * 
     * @return void
     */
    public function deleteAction($table, $id)
    {
        // call entity manager...
        $em = $this->getDoctrine()->getManager();
        
        // set $recordToDelete to variable to result of find method...
        $recordToDelete = $em->getRepository('EllisDotComMainBundle:'.$table.'')->find($id);
        
        // error handling...
        if (!$recordToDelete){
            throw $this->createNotFoundException('No record found, something gone awry!?');
        } else {
            // retrieve filename for deletion...
            $filename = $recordToDelete->getFilename();
            
            // set fileToDelete to location of file...
            $fileToDelete = 'img/'.$table.'/'.$filename;
            
            // double check file exists and is deletable...
            if (file_exists($fileToDelete) && is_writable($fileToDelete))
            {
                // remove file...
                unlink ($fileToDelete);
            }
            
            // set remove method...
            $em->remove($recordToDelete);
            
            // complete deletion action with flush method...
            $em->flush();
            
            // flash message...
            $this->get('session')->getFlashBag()->add(
                'notice',
                'Record successfully deleted!'
            );
            
            // redirect to list view...
            return $this->redirect($this->generateUrl('EllisDotCom_ListView', array('table' => $table)), 301);
        }
    }
}