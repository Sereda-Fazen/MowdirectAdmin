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

    function T897AddNewGroup (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCustomer $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoCustomer();
        $manageCategories->addInvitations();
        $manageCategories->resentAnInvitation();
        $manageCategories->discardAnInvitation();
    }

}

