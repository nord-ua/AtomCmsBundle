<?php

namespace NordUa\AtomCmsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @MongoDB\Document(collection="atom_cms_page", repositoryClass="NordUa\AtomCmsBundle\Repository\CmsPageRepository")
 */
class CmsPage
{

  /**
   * @MongoDB\Id(strategy="auto")
   */
  protected $id;

  /**
   * @MongoDB\String
   */
  protected $title;

  /**
   * @MongoDB\String
   */
  protected $url;

  /**
   * @MongoDB\String
   */
  protected $content;

  /**
   * @MongoDB\Hash
   */
  protected $metatags;

  /**
   * @MongoDB\Timestamp(name="created_at")
   */
  protected $createdAt;

  /**
   * Get id
   *
   * @return id $id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set title
   *
   * @param string $title
   * @return self
   */
  public function setTitle($title)
  {
    $this->title = $title;
    return $this;
  }

  /**
   * Get title
   *
   * @return string $title
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set content
   *
   * @param string $content
   * @return self
   */
  public function setContent($content)
  {
    $this->content = $content;
    return $this;
  }

  /**
   * Get content
   *
   * @return string $content
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Set metatags
   *
   * @param hash $metatags
   * @return self
   */
  public function setMetatags($metatags)
  {
    $this->metatags = $metatags;
    return $this;
  }

  /**
   * Get metatags
   *
   * @return hash $metatags
   */
  public function getMetatags()
  {
    return $this->metatags;
  }

  /**
   * Set createdAt
   *
   * @param timestamp $createdAt
   * @return self
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
    return $this;
  }

  /**
   * Get createdAt
   *
   * @return timestamp $createdAt
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * Set url
   *
   * @param string $url
   * @return self
   */
  public function setUrl($url)
  {
    $this->url = $url;
    return $this;
  }

  /**
   * Get url
   *
   * @return string $url
   */
  public function getUrl()
  {
    return $this->url;
  }

}
