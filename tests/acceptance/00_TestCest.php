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
    }
    function T832EditCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->editCategory('Test category');
    }
    function T832MoveAboveCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->aboveCategory();
    }
    function T832MoveBelowCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->belowCategory();
    }
    function T832IntoCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->intoSibling();
    }
    function T832DeleteCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->deleteCategory();

    }

}

