<?php

// contao/dca/tl_personen.php

use Contao\DC_Table;
use Contao\DataContainer;

$GLOBALS['TL_DCA']['tl_personen'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary'
            ]
        ]
    ],

    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTABLE,
            'fields' => ['name1', 'vorname1'],
            'panelLayout' => 'filter;sort,search,limit',
            'headerFields' => ['name1', 'vorname1', 'ort', 'kategorie'],
            'child_record_callback' => ['App\\EventListener\\PersonenListener', 'listPersonen']
        ],
        'global_operations' => [
            'all' => [
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            ],
            'print' => [
                'href' => 'key=print',
                'class' => 'header_print',
                'attributes' => 'onclick="this.blur(); return AjaxRequest.toggleDetails(this, \'print\')"'
            ]
        ],
        'operations' => [
            'edit' => [
                'href' => 'act=edit',
                'icon' => 'edit.svg'
            ],
            'copy' => [
                'href' => 'act=copy',
                'icon' => 'copy.svg'
            ],
            'delete' => [
                'href' => 'act=delete',
                'icon' => 'delete.svg',
                'attributes' => 'onclick="if(!confirm(\''.($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? 'Wirklich löschen?').'\'))return false;Backend.getScrollOffset()"'
            ],
            'show' => [
                'href' => 'act=show',
                'icon' => 'show.svg'
            ]
        ]
    ],

    'palettes' => [
        'default' => '{person_legend},name1,vorname1,name2,vorname2,anrede;{address_legend},strasse,hausnummer,plz,ort;{contact_legend},email,ansprache,partnerfeld;{category_legend},kategorie'
    ],

    'fields' => [
        'id' => [
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0"
        ],
        'name1' => [
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'filter' => true,
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'vorname1' => [
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'filter' => true,
            'inputType' => 'text',
            'eval' => ['mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'name2' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'vorname2' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'anrede' => [
            'exclude' => true,
            'filter' => true,
            'inputType' => 'select',
            'options' => ['Liebe', 'Lieber'],
            'eval' => ['tl_class' => 'w50'],
            'sql' => "varchar(10) NOT NULL default ''"
        ],
        'strasse' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'hausnummer' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 20, 'tl_class' => 'w50'],
            'sql' => "varchar(20) NOT NULL default ''"
        ],
        'plz' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 10, 'tl_class' => 'w50'],
            'sql' => "varchar(10) NOT NULL default ''"
        ],
        'ort' => [
            'exclude' => true,
            'search' => true,
            'sorting' => true,
            'filter' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'email' => [
            'exclude' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'rgxp' => 'email', 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'ansprache' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'rgxp' => 'email', 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'partnerfeld' => [
            'exclude' => true,
            'inputType' => 'text',
            'eval' => ['maxlength' => 255, 'tl_class' => 'w50'],
            'sql' => "varchar(255) NOT NULL default ''"
        ],
        'kategorie' => [
            'exclude' => true,
            'filter' => true,
            'sorting' => true,
            'inputType' => 'select',
            'options' => ['Aschermittwoch', 'Sonstige'],
            'eval' => ['mandatory' => true, 'tl_class' => 'w50'],
            'sql' => "varchar(50) NOT NULL default ''"
        ]
    ]
];
