<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use EllisDotCom\Bundle\MainBundle\Entity\Orders;

/**
 * this controller manages the basket functionality for the shop...
 *
 * @author pete wond
 */

class BasketController extends Controller
{
	/**
	 * addItemToBasket function adds item to basket items array and updates basket totals...
	 *
	 * @param string $slug slug used to reference item from database...
	 * @param Request $request instance of request object...
	 *
	 * @return void
	 */
	public function addItemToBasketAction($slug, Request $request)
	{
	    // from session...
	    // retrieve session and update basket...
	    $session = $this->getRequest()->getSession();
	    
	    // retrieve basket...
	    $basket = $session->get('basket');
	    
	    // from submitted product form...
	    // retrieve amount selected...
	    $itemAmount = $request->request->get('_amount');
	    
	    // retrive price...
	    $itemPrice = $request->request->get('_price');
	    
	    // calculate item totals...  
	    $itemTotal = $itemAmount * $itemPrice;
	    
	    // calculate shipping...
	    $shipping = $itemAmount * 5;
	    
	    // build array to store item detail...
	    $itemDetail = array('amount' => $itemAmount, 'price' => $itemPrice, 'total' => $itemTotal); 
	    
	    // add item detail array into an array named with the product slug...
	    $item = array($slug => $itemDetail);
	    
	    // refresh basket values...
	    array_push($basket['basketItems'], $item);
	    $basket['basketTotalItems'] += $itemAmount; 
	    $basket['basketSubTotal'] += $itemTotal;
	    $basket['basketShippingTotal'] += $shipping;
	    $basket['basketTotal'] = $basket['basketSubTotal'] + $basket['basketShippingTotal'];
	    
	    // set basket values...
	    $basket = $session->set('basket', array('basketItems' => $basket['basketItems'],
	                                            'basketTotalItems' => $basket['basketTotalItems'], 
	                                            'basketSubTotal' => $basket['basketSubTotal'], 
	                                            'basketShippingTotal' => $basket['basketShippingTotal'],
	                                            'basketTotal' => $basket['basketTotal']));
	    
	    // flash message...
	    $this->get('session')->getFlashBag()->add(
	        'notice',
	        'Item(s) added to basket!'
	    );
	    
	    // redirect to basket page...
	    return $this->redirect($this->generateUrl('EllisDotCom_basket'), 301);
	}

	/**
	 * removeItemFromBasketAction function removes individual items from the basket...
	 *
	 * @param integer $index tells the array splice function which item to remove...
	 * @param string $slug identifier for item...
	 * @param Request $request instance of request object...
	 * 
	 * @return void 
	 */
	public function removeItemFromBasketAction($index, $slug, Request $request)
	{
	    // retrieve session and update basket...
	    $session = $this->getRequest()->getSession();
	    
	    // retrieve basket...
	    $basket = $session->get('basket');
		
		// retrieve values of selected item and calculate variables...	    
	    $itemAmount = $basket['basketItems'][$index][$slug]['amount'];
	    $itemPrice = $basket['basketItems'][$index][$slug]['price'];
	    $itemTotal = $itemAmount * $itemPrice;
	    $shipping = $itemAmount * 5;
	    
	    // recalculate the basket totals...
	    $basket['basketTotalItems'] -= $itemAmount; 
	    $basket['basketSubTotal'] -= $itemTotal;
	    $basket['basketShippingTotal'] -= $shipping;
	    $basket['basketTotal'] = $basket['basketSubTotal'] + $basket['basketShippingTotal'];

	    // call array splice to remove item (couldnt get session->remove() to work!)...
	    array_splice($basket['basketItems'], $index, 1);

	    // set basket values...
	    $basket = $session->set('basket', array('basketItems' => $basket['basketItems'],
	                                            'basketTotalItems' => $basket['basketTotalItems'], 
	                                            'basketSubTotal' => $basket['basketSubTotal'], 
	                                            'basketShippingTotal' => $basket['basketShippingTotal'],
	                                            'basketTotal' => $basket['basketTotal']));

	    // flash message...
	    $this->get('session')->getFlashBag()->add(
	        'notice',
	        'Item removed from basket!'
	    );
	    // redirect to list view...
	    return $this->redirect($this->generateUrl('EllisDotCom_basket'), 301);
	}
	
	/**
	 * clearBasketAction empties and resets the basket 
	 *
	 * @param Request $request instance of request object...
	 * 
	 * @return void
	 */
	public function clearBasketAction(Request $request)
	{
	    // retrieve session and update basket...
	    $session = $this->getRequest()->getSession();
	    
	    // empty the basket with the clear function...
	    $session->clear();
	    
	    // set to original values...
	    $session->set('basket', array('basketItems' => array(), 'basketTotalItems' => 0, 'basketSubTotal' => 0, 'basketShippingTotal' => 0, 'basketTotal' => 0));
	    
	    // flash message...
	    $this->get('session')->getFlashBag()->add(
	        'notice',
	        'Your basket has been emptied!'
	    );

	    // redirect to list view...
	    return $this->redirect($this->generateUrl('EllisDotCom_basket'), 301);
	}

	/**
	 * checkoutBasketAction, in lieu of paypal integration, saves basket to orders table...
	 *
	 * @param Request $request instance of request object...
	 * 
	 * @return void
	 */
	public function checkoutBasketAction(Request $request)
	{
		// from session...
	    // retrieve session and basket...
	    $session = $this->getRequest()->getSession();
	    
	    // retrieve basket...
	    $basket = $session->get('basket');

	    // create new order...
	    $newRecord = new Orders();
        $newRecord->setItems($basket['basketItems']);
        $newRecord->setOrderTotal($basket['basketTotal']);

        // call entity manager...
        $em = $this->getDoctrine()->getManager();

        // set persist method...
        $em->persist($newRecord);

        // complete creation action with flush method...
        $em->flush();

	    // flash message...
	    $this->get('session')->getFlashBag()->add(
	        'notice',
	        'Checkout complete, your order will be dispatched forthwith!'
	    );
	    // redirect to list view...
	    return $this->redirect($this->generateUrl('EllisDotCom_thanks'), 301);
	}
}