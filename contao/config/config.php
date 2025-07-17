<?php

// contao/config/config.php

use Contao\ArrayUtil;

// Backend Module
ArrayUtil::arrayInsert($GLOBALS['BE_MOD']['content'], 1, [
    'personen' => [
        'tables' => ['tl_personen'],
        'icon' => 'bundles/contaocore/images/modules/user.svg',
        'print' => ['App\\Controller\\ContaoPersonenController', 'generatePrintList']
    ]
]);
