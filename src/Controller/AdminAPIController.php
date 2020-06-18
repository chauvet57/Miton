<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/api/admin", name="api_admin")
     */

class AdminAPIController extends AbstractController
{
    /**
     * @Route("/admin/a/p/i", name="admin_a_p_i")
     */
    public function index()
    {
        return $this->render('admin_api/index.html.twig', [
            'controller_name' => 'AdminAPIController',
        ]);
    }
}
