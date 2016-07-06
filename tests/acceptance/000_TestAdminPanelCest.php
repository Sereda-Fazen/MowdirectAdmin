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


    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoManageHierarchy $magentoManageHierarchy
     * CMS > Pages > Manage Hierarchy
     */


    function T765CreateANewNode(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageHierarchy $magentoManageHierarchy) {
        $I->loginAdminPanel('testing','Da1mat1an5');
        $magentoManageHierarchy->goToManageHierarchyPage();
        $magentoManageHierarchy->createNode('test-title-node','test-url-node');
    }

    function T766MoveAnExistingNode(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageHierarchy $magentoManageHierarchy) {

        $magentoManageHierarchy->moveNode();
    }

    function T774EditANode(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageHierarchy $magentoManageHierarchy) {

        $magentoManageHierarchy->editNode('test-title-node');
    }

    function T767DeleteANode(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageHierarchy $magentoManageHierarchy) {
        $magentoManageHierarchy->deleteNodeFromTree('test-title-node');
    }

    function T768AddAPageToTheTree(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageHierarchy $magentoManageHierarchy) {
        $magentoManageHierarchy->addPageToTree1('test-title-1');
    }

    function T769RemoveAPageFromTheTree(Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoManageHierarchy $magentoManageHierarchy) {
        $magentoManageHierarchy->deletePageFromTree('test-title-1');
    }

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCustomer $manageCategories
     * Customers -> Manage Customers
     * 1.1. Grid View
     */



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

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCustomer $manageCategories
     * 1.2. New/Edit Customer View
     */
/*
    function T891AddNewCustomer (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCustomer $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoCustomer();
        //$manageCategories->addNewCustomer();
        $manageCategories->editCustomer();
    }
*/


    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCustomer $manageCategories
     * 2. Customers -> Customer Groups
     */

    function T897AddNewGroup (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCustomer $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoCustomer();
        $manageCategories->addGroup();
    }
    function T896TestFilters (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->filterGroup();
    }
    function T898EditGroup (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->editGroup();
    }
    function T905DeleteGroup (\Page\MagentoCustomer $manageCategories)
    {
        $manageCategories->deleteGroup();
    }
}

