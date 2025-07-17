<?php

// src/EventListener/ContaoPersonenListener.php
namespace Arminfrey\ContaoPersonenBundle\EventListener;

use Contao\Backend;
use Contao\StringUtil;
use Contao\Database;

class ContaoPersonenListener extends Backend
{
    public function listPersonen($arrRow): string
    {
        $name = $arrRow['name1'];
        if ($arrRow['vorname1']) {
            $name = $arrRow['vorname1'] . ' ' . $name;
        }
        
        if ($arrRow['name2'] || $arrRow['vorname2']) {
            $name .= ' & ';
            if ($arrRow['vorname2']) {
                $name .= $arrRow['vorname2'] . ' ';
            }
            $name .= $arrRow['name2'];
        }
        
        $address = '';
        if ($arrRow['strasse']) {
            $address = $arrRow['strasse'];
            if ($arrRow['hausnummer']) {
                $address .= ' ' . $arrRow['hausnummer'];
            }
        }
        
        if ($arrRow['plz'] || $arrRow['ort']) {
            if ($address) $address .= ', ';
            $address .= $arrRow['plz'] . ' ' . $arrRow['ort'];
        }
        
        $kategorie = '<span class="tl_gray">[' . $arrRow['kategorie'] . ']</span>';
        
        return '<div class="tl_content_left">' . $name . ' ' . $kategorie . 
               ($address ? '<br><span class="tl_gray">' . $address . '</span>' : '') . 
               ($arrRow['email'] ? '<br><span class="tl_gray">' . $arrRow['email'] . '</span>' : '') . '</div>';
    }
}
