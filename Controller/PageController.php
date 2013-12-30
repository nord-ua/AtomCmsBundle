<?php

namespace NordUa\AtomCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/")
 */
class PageController extends Controller
{

  /**
   * @Route("/{url}", name="cms_page")
   * @Template()
   */
  public function pageAction($url)
  {
    $page = $this->$this->get('doctrine.odm.mongodb.document_manager')->getRepository('AtomCms:CmsPage')->findOneByUrl($url);

    $this->container->get('cms_variables')->cmsPage($url);

    if (!$page)
      throw $this->createNotFoundException();

    return array(
      'page' => $page
    );
  }

}
