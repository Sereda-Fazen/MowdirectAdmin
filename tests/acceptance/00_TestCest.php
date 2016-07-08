<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{


    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoManageAttributes $magentoManageAttributes
     * Customers -> Attribute -> Manage Customer Attributes
     */

    function T1195AddNewAttributeAddress (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageAttributes $magentoManageAttributes)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoManageAttributes->addAddressAttribute();
    }

    function T1193TestFilters (\Page\MagentoManageAttributes $magentoManageAttributes)
    {
        $magentoManageAttributes->filters();
    }

    function T1196EditAttributeAddress (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageAttributes $magentoManageAttributes)
    {
        $magentoManageAttributes->editAttributeAddress();
    }

    function T1197DeteleAttributeAddress (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageAttributes $magentoManageAttributes)
    {
        $magentoManageAttributes->deleteAttributeAddress();

    }



   
}

