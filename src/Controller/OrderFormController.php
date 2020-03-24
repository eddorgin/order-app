<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderFormController extends AbstractController
{
    public function index()
    {
        return $this->render(
            'order/order.html.twig'
        );
    }
}