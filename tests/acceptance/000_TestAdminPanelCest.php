<?php
use \Step\Acceptance;

/**
 * @group test
 */
class TestAdminPanelCest
{


    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoManageCategories $manageCategories
     * Catalog -> Manage Categories
     */

    function T832AddACategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goToManageCategory();
        $manageCategories->createCategory('Test category');
    }
    function T833EditCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->editCategory('Test category');
    }
    function T834MoveAboveCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->aboveCategory();
    }
    function T835MoveBelowCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->belowCategory();
    }
    function T836838IntoCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->intoSibling();
    }
    function T839DeleteCategory(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageCategories $manageCategories)
    {
        $manageCategories->deleteCategory();

    }

}

