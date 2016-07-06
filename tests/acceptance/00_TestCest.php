<?php
use \Step\Acceptance;

/**
 * @group template
 */
class TestCest
{

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

}

