<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{

    function T886TestFilters (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCustomer $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoCustomer();
        $manageCategories->addNewCustomer();
        $manageCategories->filtersName();
        $manageCategories->filtersEmail();
        $manageCategories->filtersGroup();
    }
    function T888SubscribeViaActions (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->checkSubscribe('Subscribe to Newsletter');
    }
    function T889UnsubscribeViaActions (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->checkSubscribe('Unsubscribe from Newsletter');
    }
    function T890AssignViaActions (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->checkGroup('Assign a Customer Group', 'General');
    }
    function T887DeleteViaActions (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->checkSubscribe('Delete');
    }

}

