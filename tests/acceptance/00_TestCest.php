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

    function T899AddAnInvitation (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCustomer $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoCustomer();
        $manageCategories->addInvitations();
    }
    function T900ResentAnInvitation (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->resentAnInvitation();
    }
    function T902ViewAnInvitation (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->viewAnInvitation();
    }
    function T901DiscardAnInvitation (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->discardAnInvitation();
    }

}

