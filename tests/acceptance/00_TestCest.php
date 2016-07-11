<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{


    function T1179AddANewUrl (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoCatalog->goMagentoCatalog();
        $magentoCatalog->addNewURL();
    }
    function T1178TestFilters (\Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->filters();
        $magentoCatalog->checkUrl();
    }
    function T1180EditUrl (\Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->editUrl();
        $magentoCatalog->checkUpdateUrl();
    }
    function T1181DeleteUrl (\Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->deleteUrl();

    }


   
}

