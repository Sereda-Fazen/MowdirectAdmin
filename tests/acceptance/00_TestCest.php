<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCatalog $magentoCatalog
     * Catalog -> Google Map
     */

    function T1189AddNewMap (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoCatalog->goMagentoCatalog();
        $magentoCatalog->addMap();
    }
    function T1190EditMap (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->editMap();
    }
    function T1191DeleteMap (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->deleteMap();
    }

   
}

