<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{


    function T1204AddANewUser (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoSystem $magentoSystem)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoSystem->goMagentoPermissions();
        $magentoSystem->addNewUser();
    }
    function T1201TestFiltersUser (\Page\MagentoSystem $magentoSystem)
    {
        $magentoSystem->filterUser();
    }
    function T1205EditUser (\Page\MagentoSystem $magentoSystem)
    {
        $magentoSystem->editUser();
    }
    function T1206DeleteUser (\Page\MagentoSystem $magentoSystem)
    {
        $magentoSystem->deleteUser();
    }

   
}

