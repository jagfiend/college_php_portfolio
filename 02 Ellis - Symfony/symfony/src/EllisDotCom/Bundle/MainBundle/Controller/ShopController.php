<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * this controller manages the shop section of the site...
 *
 * @author pete wond
 */

class ShopController extends Controller
{
	/**
	 * shopAction renders the main shop page
     *
     * @param Request $request instance of request object...
	 * 
	 * @return void
	 */
	public function shopAction(Request $request)
    {
        // function calls data via products entity file...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:Products');
        
        // set products variable...
        $products = $repository->findAll();
        
        // error handling...
        if(!$products){
            throw $this->createNotFoundException('No products found...');
        }
        
        // create new session (this is automatically ignored if a session already exists which
        // prevents basket being cleared when returning to shop page)
        $session = new Session();
        
        // check for basket...
        $checkForBasket = $session->has('basket');
        
        // set a new basket if none found...
        if($checkForBasket == false){
            $session->set('basket', array('basketItems' => array(), 'basketTotalItems' => 0, 'basketSubTotal' => 0, 'basketShippingTotal' => 0, 'basketTotal' => 0));
        }
        
        // retrieve basket...
        $basket = $session->get('basket');
        
        // render the twig template and give it the repository data and basket in an array to play with...
        return $this->render('EllisDotComMainBundle:Pages:shop.html.twig',array('products' => $products, 'basket' => $basket));
    }

    /**
     * productAction renders the page for the selected product
     *
     * @param string $slug slug used to retrieve item from database...
     * @param Request $request instance of request object...
     *
     * @return void
     */
    public function productAction($slug, Request $request)
    {
        // function calls data via products entity file...
        $repository = $this->getDoctrine()->getRepository('EllisDotComMainBundle:Products');
        
        // set products variable...
        $product = $repository->findOneBy(array('slug' => $slug));
        
        // error handling...
        if(!$product){
            throw $this->createNotFoundException('No product found...have you done a typo?');
        }
        
        // retrieve session to retrieve basket...
        $session = $this->getRequest()->getSession();
        
        // retrieve basket...
        $basket = $session->get('basket');
        
        // render the twig template and give it the repository data and basket in an array to play with...
    	return $this->render('EllisDotComMainBundle:Pages:product.html.twig', array('product' => $product, 'basket' => $basket));
    }
    
    /**
     * basketAction renders the page to display the contents of the user's basket...
     *
     * @param Request $request instance of request object...
     * 
     * @return void
     */
    public function basketAction(Request $request)
    {
        // retrieve session and update basket...
        $session = $this->getRequest()->getSession();
        
        // retrieve basket...
        $basket = $session->get('basket');
        
        // render the twig template and give it the basket in an array to play with...
        return $this->render('EllisDotComMainBundle:Pages:basket.html.twig', array('basket' => $basket));
    }
    
    /**
     * thanksAction renders thank you page...
     * 
     * @return void
     */
    public function thanksAction(Request $request)
    {
        // clear the basket...
        // retrieve session and update basket...
        $session = $this->getRequest()->getSession();
        
        // empty the basket with the clear function...
        $session->clear();
        
        // set to original values...
        $session->set('basket', array('basketItems' => array(), 'basketTotalItems' => 0, 'basketSubTotal' => 0, 'basketShippingTotal' => 0, 'basketTotal' => 0));
        
        // render the twig template...
    	return $this->render('EllisDotComMainBundle:Pages:thanks.html.twig');
    }
}