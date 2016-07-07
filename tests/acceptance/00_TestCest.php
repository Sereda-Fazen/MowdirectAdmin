<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoPromotions $magentoManageAttributes
     * Promotions -> Shopping Basket Price Rules
     */

    function T1110AddANewShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoCatalog->goMagentoCatalog();
        $magentoCatalog->addNewURL();
        $magentoCatalog->filters();

    }

   
}

