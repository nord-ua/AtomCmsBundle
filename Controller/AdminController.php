<?php

namespace NordUa\AtomCmsBundle\Controller;

use Common\CommonBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use NordUa\AtomCmsBundle\Document\CmsPage;
use NordUa\AtomCmsBundle\Form\Type\CmsPageType;


/**
 * @Route("/admin/cms")
 */
class AdminController extends BaseController
{

  /**
   * @Route("/", name="admin_cms_page_index")
   * @Template()
   */
  public function indexAction()
  {
    $pages = $this->get('doctrine.odm.mongodb.document_manager')->getRepository('AtomCms:CmsPage')->findAll();

    return array(
      'pages' => $pages
    );
  }


  /**
   * @Route("/new", name="admin_cms_page_new")
   * @Template("CommonCmsBundle:Admin:edit.html.twig")
   */
  public function newAction(Request $request)
  {
    $page = new CmsPage();
    $form = $this->createForm(new CmsPageType(), $page);

    if ('POST' == $request->getMethod()) {
      $form->bind($request);

      if ($form->isValid()) {
        $this->get('session')->getFlashBag()->add('notice', 'Successfully created!');
        $dm = $this->getDocumentManager();
        $dm->persist($page);
        $dm->flush($page);

        return $this->redirect(
          $this->generateUrl('admin_cms_page_show', array('id' => $page->getId()))
        );
      } else {
        $this->addFlash('Form data is invalid', 'notice');
      }
    }

    return array(
      'action_path' => $this->generateUrl('admin_cms_page_new'),
      'form' => $form->createView(),
    );
  }

  /**
   * @Route("/{id}/edit", name="admin_cms_page_edit")
   * @Template("CommonCmsBundle:Admin:edit.html.twig")
   */
  public function editAction($id, Request $request)
  {
    $page = $this->getCmsPage($id);

    $form = $this->createForm(new CmsPageType(), $page);

    if ('POST' == $request->getMethod()) {
      $form->bind($request);

      if ($form->isValid()) {
        $this->get('session')->getFlashBag()->add('notice', 'Successfully saved!');
        $dm = $this->getDocumentManager();
        $dm->persist($page);
        $dm->flush();

        return $this->redirect($this->generateUrl("admin_cms_page_show", array('id' => $page->getId())));
      } else {
        $this->get('session')->getFlashBag()->add('notice', 'Form data is invalid');
      }
    }

    return array(
      'action_path' => $this->generateUrl('admin_cms_page_edit', array('id' => $page->getId())),
      'form' => $form->createView(),
    );
  }

  /**
   * @Route("/show/{id}", name="admin_cms_page_show")
   * @Template()
   */
  public function showAction($id)
  {
    $page = $this->getCmsPage($id);

    return array(
      'page' => $page
    );
  }

  /**
   * @Route("/{id}/delete", name="admin_cms_page_delete")
   */
  public function deleteAction($id)
  {
    $page = $this->getCmsPage($id);

    $this->getDocumentManager()->remove($page);
    $this->getDocumentManager()->flush();

    return $this->redirect($this->generateUrl('admin_cms_page_index'));
  }

  /**
   * @param string $id
   * @throws NotFoundHttpException
   * @return CmsPage
   */
  protected function getCmsPage($id) {
    $page = $this->get('doctrine.odm.mongodb.document_manager')->getRepository('AtomCms:CmsPage')->find($id);

    if (is_null($page)) {
      throw $this->createNotFoundException('Page not found');
    }

    return $page;
  }

}
