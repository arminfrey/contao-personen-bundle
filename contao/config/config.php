<?php

// contao/config/config.php

use Arminfrey\ContaoPersonenBundle\Model\ContaoPersonenModel;

/**
 * -------------------------------------------------------------------------
 * BACK END MODULES
 * -------------------------------------------------------------------------
 */

// Add configuration to Backend
$GLOBALS['BE_MOD']['Personen']['Personenverwaltung'] = [
	'tables'		=>     ['tl_personen'],
	'icon'          => 'bundles/contaocore/images/modules/user.svg',
	'print'         => ['Arminfrey\\ContaoPersonenBundle\\Controller\\ContaoPersonenController', 'generatePrintList']
];


$GLOBALS['TL_MODELS']['tl_personen'] = ContaPpersonenModel::class;
