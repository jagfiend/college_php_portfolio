<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * this controller manages the portfoliio section of the site...
 *
 * @author pete wond
 */

class PortfolioController extends Controller 
{
    /**
     * the portfolioAction function loads the main page, displaying the parent categories of the clients work
     * 
     * @return void
     */
	public function portfolioAction()
    {
        // function calls data via categories entity file...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:Categories');
        // set categoires variable to result of find all method...
        $categories = $repository->findAll();
        
        // error handling...
        if(!$categories){
            throw $this->createNotFoundException('No categories found...');
        }

        // render the twig template and give it the repository data in an array to play with...
        return $this->render('EllisDotComMainBundle:Pages:portfolio.html.twig',array('categories' => $categories));
    }

    /**
     * the categoryAction function loads the thumbnail images of the category selected on the main portfolio page...
     * 
     * @param  string $page selected category
     * 
     * @return void
     */
    public function categoryAction($slug)
    {
        // match category to $page value...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:Categories');
        
        // set portfolio variable to result of find by one method...
        $portfolio = $repository->findOneBy(array('slug' => $slug));
        
        // error handling...
        if(!$portfolio){
            throw $this->createNotFoundException('No images under this category found...have you done a typo?');
        } else {
            // return the portfolio data relating to retrieved category...
            $images = $portfolio->getPortfolio();
        }
        
        // render the twig template and give it the repository data in an array to play with...
        return $this->render('EllisDotComMainBundle:Pages:category.html.twig',array('slug' => $slug, 'images' => $images));
    }  

    /**
     * the imageAction function loads the image detail page of the image selected on the 'category' page...
     * 
     * @param  string $slug
     * 
     * @return void
     */
    public function imageAction($slug)
    {
        // retrieve all data relating to given slug...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:Portfolio');
        
        // set image variable to result of find by one method...
        $image = $repository->findOneBy(array('slug' => $slug));

        // error handling...
        if(!$image){
            throw $this->createNotFoundException('No images here...have you done a typo?');
        } else {
            // return the category of the image...
            $category = $image->getCategory();
        }
        
        // render the twig template and give it the repository data in an array to play with...
        return $this->render('EllisDotComMainBundle:Pages:image.html.twig',array('image' => $image, 'category' => $category));
    }
}