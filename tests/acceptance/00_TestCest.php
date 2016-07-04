<?php
use \Step\Acceptance;

/**
 * @group test
 */
class TestCest
{

    function T832AddACategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goToManageCategory();
        $manageCategories->createCategory('Test category');
        $manageCategories->editCategory('Test category');
        $manageCategories->aboveCategory();
        $manageCategories->belowCategory();
        $manageCategories->intoSibling();
        $manageCategories->deleteCategory();

    }

}

