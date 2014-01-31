<?php

namespace NordUa\AtomCmsBundle\Templating;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * This class is the entry point for AtomCmsBundle global variables in Twig templates.
 *
 * @author Sergey Ryabenko <ryabenko.sergey@gmail.com>
 */
class AtomCmsTwig extends \Twig_Extension {

  /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
  protected $container;

  /** @var \Twig_Environment */
  protected $environment = "";
  
  /**
   * Current cms page
   * @var string
   */
  private $cmsPage = '';

  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }

  public function initRuntime(\Twig_Environment $environment) {
    $this->environment = $environment;
  }

  /**
   * @return ContainerInterface
   */
  public function getContainer() {
    return $this->container;
  }

  public function getGlobals() {
    return array(
      'atom_cms' => $this
    );
  }

  public function getName() {
    return 'atom_cms';
  }

  public function getFilters() {
    return array(
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFunctions() {
    return array(
      new \Twig_SimpleFunction('cms_page', array($this, 'cmsPage')),
      new \Twig_SimpleFunction('is_cms_page', array($this, 'isCmsPage')),
      new \Twig_SimpleFunction('atom_cms_render', array($this, 'render'), array(
          'is_safe' => array('html')
        ))
      );
  }

  public function cmsPage($value = null) {
    if (!is_null($value)) {
      $this->cmsPage = $value;
    }
    
    return $this->cmsPage;
  }

  public function isCmsPage($value) {
    return $this->cmsPage == $value;
  }

  public function render($page) {
    $doc = $this->container->get('doctrine_mongodb.odm.default_document_manager')->getRepository('AtomCmsBundle:CmsPage')->findOneByUrl($page);
    if (!$doc) {
      return $this->container->get('translator')->trans('AtomCms page "%page%" not found.', array('%page%' => $page), 'AtomCms');
    }

    return $doc->getContent();
  }

}

