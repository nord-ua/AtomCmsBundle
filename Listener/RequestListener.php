<?php

namespace NordUa\AtomCmsBundle\Listener;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Templating\EngineInterface;


class RequestListener
{

  /** @var DocumentManager */
  protected $dm;

  /** @var EngineInterface */
  protected $templating;

  public function __construct(DocumentManager $dm, EngineInterface $templating)
  {
    $this->dm = $dm;
    $this->templating = $templating;
  }

  public function filterController(GetResponseEvent $event)
  {
    $attr = $event->getRequest()->attributes;
    $class = get_class($event);
  }

  public function filterControllerException(GetResponseForExceptionEvent $event)
  {
//    $attr = $event->getRequest()->attributes;
    $class = get_class($event);

    // get exception
    $exception = $event->getException();
    /* @var $exception NotFoundHttpException */

//    $event->setResponse($response);

    // get path

    if ($exception instanceof NotFoundHttpException) {
      $path = $event->getRequest()->getPathInfo();
      $path = ltrim($path, "/");

      $page = $this->dm->getRepository('AtomCmsBundle:CmsPage')->findOneByUrl($path);

      if ($page) {
        $response = new Response($this->templating->render('@AtomCms/Page/page.html.twig', ['page' => $page]));
        $event->setResponse($response);
      }
    }
  }
}