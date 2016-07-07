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

    function T1110AddANewShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoManageAttributes->goMagentoPromotions();
        $magentoManageAttributes->addNewShoppingRule();
    }
    function T1109TestFiltersShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $magentoManageAttributes->filters();
    }
    function T1111EditShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $magentoManageAttributes->editShoppingRule();
    }
    function T1112DeleteShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $magentoManageAttributes->deleteShoppingRule();
    }
   
}

