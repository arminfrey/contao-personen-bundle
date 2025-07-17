<?php

namespace Arminfrey\ContaoPersonenBundle\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\SqlGetFromFileEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InstallListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ContaoCoreEvents::SQL_GET_FROM_FILE => 'onSqlGetFromFile',
        ];
    }

    public function onSqlGetFromFile(SqlGetFromFileEvent $event): void
    {
        $event->setSql($event->getSql() . "
            CREATE TABLE IF NOT EXISTS `tl_personen` (
                `id` int(10) unsigned NOT NULL auto_increment,
                `tstamp` int(10) unsigned NOT NULL default 0,
                `name1` varchar(255) NOT NULL default '',
                `vorname1` varchar(255) NOT NULL default '',
                `name2` varchar(255) NOT NULL default '',
                `vorname2` varchar(255) NOT NULL default '',
                `anrede` varchar(10) NOT NULL default '',
                `strasse` varchar(255) NOT NULL default '',
                `hausnummer` varchar(20) NOT NULL default '',
                `plz` varchar(10) NOT NULL default '',
                `ort` varchar(255) NOT NULL default '',
                `email` varchar(255) NOT NULL default '',
                `ansprache` varchar(255) NOT NULL default '',
                `partnerfeld` varchar(255) NOT NULL default '',
                `kategorie` varchar(50) NOT NULL default '',
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");
    }
}
