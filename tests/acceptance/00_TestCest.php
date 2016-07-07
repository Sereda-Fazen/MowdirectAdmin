<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{
    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCustomer $manageCategories
     * 2. Customers -> Customer Groups
     */

    function T1106AddANewRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoPromotions();
        $manageCategories->addNewRule();
    }
    function T1107EditRule (\Page\MagentoPromotions $manageCategories)
    {
        $manageCategories->editRule();
    }

    function T1108DeleteRule (\Page\MagentoPromotions $manageCategories)
    {
        $manageCategories->removeRule();
    }
   
}

