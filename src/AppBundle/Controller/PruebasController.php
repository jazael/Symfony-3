<?php
/**
 * Created by PhpStorm.
 * User: miguel
 * Date: 19/02/2017
 * Time: 14:22
 */
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PruebasController extends Controller
{
    
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Pruebas:index.html.twig', array(
            'texto' => 'Te lo envio desde la accion del controlador'
        ));
    }

}
