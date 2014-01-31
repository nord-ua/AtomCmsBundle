AtomBundle
================

Symfony2 simplest CMS bundle.
There is no menus and structure, just dynamic pages and partials.
Pages shows when no other routing gets request. E.g. you can create page with url ````about````, and, if no other controllers can handle this request, page's content will be shown. Page can not content ````/```` symbol yet. If you need it, feel free to contact me about this.


Installation
============
composer.json:

    "require": {
        ...
        "nord-ua/atom-cms-bundle": "2.0.*@dev",
        ....
    }
    
AppKernel.php:

      ...
      new NordUa\AtomCmsBundle\AtomCmsBundle(),
      ...

routing.yml (to the bottom)
    
    ...
    atom_cms:
        resource: "@AtomCmsBundle/Resources/config/routing.yml"


Usage
=====

After installation go to ````/admin/cms```` and create pages you need. If you need to include page's content as partial you can call ````{{ atom_cms_render('%page url here%') }}```` inside any twig template. 

That's it.
