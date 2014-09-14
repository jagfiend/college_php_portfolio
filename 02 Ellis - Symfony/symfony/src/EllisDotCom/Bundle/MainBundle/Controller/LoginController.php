<?php
namespace EllisDotCom\Bundle\MainBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * this is the controller for the login page that renders the login form and processes the basic part of the login request...
 *
 * @author pete wond
 */
 
class loginController extends Controller
{
    /**
     * loginAction renders login form and performs basic validation...
     * 
     * @return void
     */
    public function loginAction()
    {
        // retrieve request...
        $request = $this->getRequest();
        
        // retrieve session...
        $session = $request->getSession();
 
        // get the login error if there is one...
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        // render the page...
        return $this->render('EllisDotComMainBundle:Pages:cmsLogin.html.twig', array(
            // last username entered by the user
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
}