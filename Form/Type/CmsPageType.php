<?php

namespace NordUa\AtomCmsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Common\CommonBundle\Form\Transformer\HashToStringTransformer;


class CmsPageType extends AbstractType
{

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('title', 'text');
    $builder->add('url', 'text');
    $builder->add('content', 'textarea');

    $builder->add(
      $builder->create('metatags', 'textarea', array('required' => false))->addModelTransformer(new HashToStringTransformer())
    );
  }

  public function getName()
  {
    return 'cms_page';
  }

}
