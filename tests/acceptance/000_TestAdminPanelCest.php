<?php
use \Step\Acceptance;

/**
 * @group test
 */
class TestAdminPanelCest
{

    /***************************Catalog******************************/

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

    /*************************CMS*****************************/


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


    /*****************************Customers***************************/


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

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCustomer $manageCategories
     * Customers -> Invitations
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

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCustomer $manageCategories
     * Customers -> Online Customers
     */

    function T903OnlineCustomers (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCustomer $manageCategories)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $manageCategories->goMagentoCustomer();
        $manageCategories->checkOnlineCustomers();
    }


    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoManageAttributes $magentoManageAttributes
     * Customers -> Attribute -> Manage Customer Address Attributes
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


    /**************************Promotions***************************/

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoPromotions $manageCategories
     * Promotions -> Catalog Price Rules
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

    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoPromotions $magentoManageAttributes
     * Promotions -> Shopping Basket Price Rules
     */

    function T1110AddANewShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoManageAttributes->goMagentoPromotions();
        $magentoManageAttributes->addNewShoppingRule();
    }
    function T1109TestFiltersShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $magentoManageAttributes->filters();
    }
    function T1111EditShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $magentoManageAttributes->editShoppingRule();
    }
    function T1112DeleteShoppingRule (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoPromotions $magentoManageAttributes)
    {
        $magentoManageAttributes->deleteShoppingRule();
    }





    /*********************************Catalog************************************/
    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCatalog $magentoCatalog
     * Catalog -> Url Redirects
     */

    function T1179AddANewUrl (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoCatalog->goMagentoCatalog();
        $magentoCatalog->addNewURL();
    }
    function T1178TestFilters (\Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->filters();
        $magentoCatalog->checkUrl();
    }
    function T1180EditUrl (\Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->editUrl();
        $magentoCatalog->checkUpdateUrl();
    }
    function T1181DeleteUrl (\Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->deleteUrl();

    }


    /**
     * @param Acceptance\AdminPanelLoginSteps $I
     * @param \Page\MagentoCatalog $magentoCatalog
     * Catalog -> Google Map
     */

    function T1189AddNewMap (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $I->loginAdminPanel('testing', 'Da1mat1an5');
        $magentoCatalog->goMagentoCatalog();
        $magentoCatalog->addMap();
    }
    function T1190EditMap (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->editMap();
    }
    function T1191DeleteMap (Step\Acceptance\AdminPanelLoginSteps $I, \Page\MagentoCatalog $magentoCatalog)
    {
        $magentoCatalog->deleteMap();
    }



}

