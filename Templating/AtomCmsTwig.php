<?php

namespace NordUa\AtomCmsBundle\Templating;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * GroulionVariables is the entry point for CmsBundle global variables in Twig templates.
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
      'cms' => $this
    );
  }

  public function getName() {
    return 'cms';
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

}

