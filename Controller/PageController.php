<?php

namespace NordUa\AtomCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{

  public function pageAction($url)
  {
    $page = $this->get('doctrine.odm.mongodb.document_manager')->getRepository('AtomCmsBundle:CmsPage')->findOneByUrl($url);

    $this->container->get('atom_cms')->cmsPage($url);

    if (!$page)
      throw $this->createNotFoundException();

    return $this->render('@AtomCms/Page/page.html.twig', array(
      'page' => $page
    ));
  }

}