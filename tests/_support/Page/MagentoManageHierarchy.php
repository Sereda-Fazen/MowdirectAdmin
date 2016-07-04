<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 13.06.16
 * Time: 16:00
 */

namespace Page;


class MagentoManageHierarchy
{
    public static $cmsDropDown = '//*[@class="nav-bar"]/ul/li[8]';
    public static $pagesDropDown = '//*[@class="nav-bar"]/ul/li[8]/ul/li[1]/a/span';
    public static $manageHierarchy = '//*[@class="nav-bar"]/ul/li[8]/ul/li[1]/ul/li[2]/a/span';

 // Hierarchy page
    public static $addNodeButton = '//*[@id="new_node_button"]';
    public static $addToTreeButton = '//*[@id="save_node_button"]';
    public static $nodeTitleField = '//*[@id="node_label"]';
    public static $nodeUrlField = '//*[@id="node_identifier"]';
    public static $saveButton = '//*[@class="middle"]/div/div[2]//button[5]';
    public static $deleteCurrentHierarchyButton = '//*[@class="middle"]//button[1]';
    public static $addedNodeToTree = '//*[@id="extdd-7"]//a/span';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//span';
    public static $nodeTable = '//*[@id="tree-container"]';

 // Node Block ->Page Properties
    public static $assertPagePropertiesTitle = '//tr[8]/td[2]/span/a';
    public static $removeFromTreeButton = '//*[@class="col-right"]//button[2]';

 // Node Block -> Render Metadata in HTML Head
    public static $firstYesRender = '//*[@id="meta_first_last"]/option[1]';
    public static $nextPrevYesRender = '//*[@id="meta_next_previous"]/option[1]';
    public static $enableChapterYesRender = '//*[@id="meta_cs_enabled"]/option[1]';

 // Node Block -> Page Navigation Menu Options
    public static $showPageNavMenuYes = '//*[@id="menu_visibility"]/option[1]';

 // Node Block
    public static $showOptionNavMenuYes = '//*[@id="top_menu_visibility"]/option[1]';

 // Page Filter Block
    public static $filterTitleField = '//*[@class="filter"]/th[3]//input';
    public static $searchButton = '//*[@class="actions"]//td[2]/button[2]';
    public static $filterCheckbox = '//*[@class="grid"]//td[1]';
    public static $filterTitleResult = '//*[@class="grid"]//td[3]';
    public static $addPageToTreeButton = '//*[@class="entry-edit-head"]//button';

    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToManageHierarchyPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDropDown);
        $I->waitForElement(self::$pagesDropDown);
        $I->moveMouseOver(self::$pagesDropDown);
        $I->waitForElement(self::$manageHierarchy);
        $I->click(self::$manageHierarchy);
    }

    public function createNode($testTitleNode,$testUrlNode) {
        $I = $this->tester;
        $I->click(self::$addNodeButton);
        $I->waitForElement(self::$nodeTitleField);
        $I->fillField(self::$nodeTitleField,$testTitleNode);
        $I->fillField(self::$nodeUrlField,$testUrlNode);
        $I->click(self::$addToTreeButton);
        $I->waitForElement(self::$nodeTable);
        $I->see('test-title-node',self::$nodeTable);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);
    }

    public function editNode11($node) {
        $I = $this->tester;
        $I->see($node,self::$nodeTable);
        $I->click($node);
        $I->wait(2);
        $I->click(self::$firstYesRender);
        $I->click(self::$nextPrevYesRender);
        $I->click(self::$enableChapterYesRender);
        $I->click(self::$showPageNavMenuYes);
        $I->click(self::$showOptionNavMenuYes);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);

    }

    public function editNode($node) {
        $I = $this->tester;
        $I->see($node,self::$nodeTable);
        $I->click($node);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->wait(2);
        $I->click(self::$firstYesRender);
        $I->click(self::$nextPrevYesRender);
        $I->click(self::$showPageNavMenuYes);
        $I->click(self::$showOptionNavMenuYes);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->wait(2);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);

    }

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function deleteNodeFromTree ($node){
        $I = $this->tester;
        $I->see($node,self::$nodeTable);
        $I->click('test-title-node');
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click(self::$removeFromTreeButton);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);
    }

    public function addPageToTree1 ($title){
        $I = $this->tester;
        $I->fillField(self::$filterTitleField,$title);
        $I->click(self::$searchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElement(self::$filterTitleResult);
        $I->see($title,self::$filterTitleResult);
        $I->click(self::$filterCheckbox);
        $I->click(self::$addPageToTreeButton);
        $I->see($title,self::$nodeTable);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);
    }

// 2.1
    public function deleteCurrentHierarchy (){
        $I = $this->tester;
        $I->click(self::$deleteCurrentHierarchyButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Pages hierarchy has been deleted from the selected scopes.',self::$assertSuccessMsg);
    }

    public function addPageToTree2 ($title){
        $I = $this->tester;
        $I->fillField(self::$filterTitleField,$title);
        $I->click(self::$searchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElement(self::$filterTitleResult);
        $I->see($title,self::$filterTitleResult);
        $I->click(self::$filterCheckbox);
        $I->click(self::$addPageToTreeButton);
        $I->see($title,self::$nodeTable);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);
    }



    public function deletePageFromTree ($node){
        $I = $this->tester;
        $I->see($node,self::$nodeTable);
        $I->click($node);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->see($node,self::$assertPagePropertiesTitle);
        $I->click(self::$removeFromTreeButton);
        $I->click(self::$saveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The hierarchy has been saved.',self::$assertSuccessMsg);
    }





}