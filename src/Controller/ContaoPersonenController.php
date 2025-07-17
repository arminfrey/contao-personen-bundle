<?php

// src/Controller/ContaoPersonenController.php
namespace Arminfrey\ContaoPersonenBundle\Controller;

use Contao\Backend;
use Contao\BackendTemplate;
use Contao\Database;
use Contao\Input;
use Contao\System;
use Symfony\Component\HttpFoundation\Response;

class ContaoPersonenController extends Backend
{
    public function generatePrintList(): Response
    {
        $this->import('Database');
        
        $sortBy = Input::get('sort') ?: 'name1';
        $order = Input::get('order') ?: 'ASC';
        
        $objPersonen = Database::getInstance()->prepare("
            SELECT * FROM tl_personen 
            ORDER BY $sortBy $order, vorname1 ASC
        ")->execute();
        
        $template = new BackendTemplate('be_personen_print');
        $template->personen = $objPersonen->fetchAllAssoc();
        $template->title = 'Personenliste';
        $template->date = date('d.m.Y');
        
        return new Response($template->parse());
    }
}
