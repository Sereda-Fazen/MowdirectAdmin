<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 04.07.16
 * Time: 13:13
 */

namespace Page;


class MagentoSearchAndReplaceCms
{

    public static $searchAndReplaceDown = '//*[@class="nav-bar"]/ul/li[12]';
    public static $searchAndReplaceCmsDown = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]/a';

    //  Page
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';

    public static $searchAndReplaceSelectPages = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[1]/a';
    public static $searchAndReplaceSearchInPages = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[2]/a';
    public static $searchAndReplaceReplaceInPages = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[3]/a';
    public static $searchAndReplaceSelectStaticBlock = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[4]/a';
    public static $searchAndReplaceSearchStaticBlocks = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[5]/a';
    public static $searchAndReplaceReplaceStaticBlocks = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[6]/a';

    public function goToSearchAndReplaceSelectPage() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceSelectPages);
        $I->click(self::$searchAndReplaceSelectPages);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Search and Replace CMS - Select Pages',self::$assertDataPage);
    }

        public function goToSearchAndReplaceSearchInPage() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceSearchInPages);
        $I->click(self::$searchAndReplaceSearchInPages);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Page Search Result List',self::$assertDataPage);
    }

    public function goToSearchAndReplaceReplacePage() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceReplaceInPages);
        $I->click(self::$searchAndReplaceReplaceInPages);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Page Replace',self::$assertDataPage);
    }

    public function goToSearchAndSelectStaticBlock() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceSelectStaticBlock);
        $I->click(self::$searchAndReplaceSelectStaticBlock);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Search and Replace CMS',self::$assertDataPage);
    }

    public function goToSearchAndSearchStaticBlock() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceSearchStaticBlocks);
        $I->click(self::$searchAndReplaceSearchStaticBlocks);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Static Block Search',self::$assertDataPage);
    }

    public function goToSearchAndReplaceStaticBlocks() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceReplaceStaticBlocks);
        $I->click(self::$searchAndReplaceReplaceStaticBlocks);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Static Block Replace',self::$assertDataPage);
    }






    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }


    public static $filterLayout1 = '//*[@class="filter"]/th[4]//option[3]';
    public static $resultLayout = '//*[@class="data"]//td[4]';
  //  public static $filterSelectProductVisibleCatalogSearch = '//*[@class="filter"]/th[9]//option[5]';
 //   public static $resultSelectProductVisible = '//*[@class="data"]//td[9]';
    public static $filterStatusPublished = '//*[@class="filter"]/th[6]//option[2]';
    public static $resultStatusPublished = '//*[@class="data"]//td[6]';
    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public static $filterSearchButton = '//*[@class="middle"]/div/div[3]/div/table//button[2]';
    public static $filterResetFilterButton = '//*[@class="middle"]/div/div[3]/div/table//button[1]';

    public function viewFilters() {
        $I = $this->tester;
        $I->waitForElementVisible(self::$filterLayout1);
        $I->click(self::$filterLayout1);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultLayout);
        $I->see('1 column',self::$resultLayout);
        $I->click(self::$filterStatusPublished);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultStatusPublished);
        $I->see('PUblished',self::$resultStatusPublished);
        $I->click(self::$filterResetFilterButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
    }





    public static $checkbox1Table = '//*[@class="data"]//tbody/tr[1]/td[1]/input';
    public static $actionSearch = '//*[@class="right"]//option[2]';
    public static $actionSubmitButton = '//*[@class="right"]//button';
    public static $searchTermField = '//*[@id="searchterm"]';
    public static $newSearchContinueButton = '//*[@id="content"]//button';

    public static $filterNameField = '//*[@class="filter"]/th[2]//input';
    public static $resultName = '//*[@class="data"]//tr[1]/td[3]';


    public function massAction($searchTerm){
        $I = $this->tester;
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click('Select All');
        $I->click(self::$actionSearch);
        $I->click(self::$actionSubmitButton);
        $I->waitForElement(self::$assertDataPage);
        $I->see('New Search',self::$assertDataPage);
        $I->fillField(self::$searchTermField,$searchTerm);
        $I->click(self::$newSearchContinueButton);
        $I->waitForElement(self::$assertSuccessMsg);
    }

    public function massAction1($searchTerm){
        $I = $this->tester;
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click(self::$checkbox1Table);
        $I->click(self::$actionSearch);
        $I->click(self::$actionSubmitButton);
        $I->waitForElement(self::$assertDataPage);
        $I->see('New Search',self::$assertDataPage);
        $I->fillField(self::$searchTermField,$searchTerm);
        $I->click(self::$newSearchContinueButton);
        $I->waitForElement(self::$assertSuccessMsg);
    }

    public function searchFilter($pageName){
        $I = $this->tester;
        $I->fillField(self::$filterNameField,$pageName);
        $I->waitForElementVisible(self::$filterSearchButton);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultName);
        $I->see($pageName,self::$resultName);
    }

    public static $filterSearchTerm = '//*[@class="filter"]/th[4]//input';
    public static $filterReplaceSearchButton = '//*[@class="middle"]//button[2]';
    public static $resultTerm = '//*[@class="data"]//tr[1]/td[4]';

    public function searchFilterReplacePage($pageName){
        $I = $this->tester;
        $I->fillField(self::$filterSearchTerm,$pageName);
        $I->waitForElementVisible(self::$filterReplaceSearchButton);
        $I->click(self::$filterReplaceSearchButton);
        $I->waitForElementVisible(self::$resultTerm);
        $I->see($pageName,self::$resultTerm);
    }

    public static $actionReplace = '//*[@class="right"]//option[3]';
    public static $replaceFilter = '//*[@id="replaceterm"]';
    public static $continueButton = '//*[@id="content"]//button';

    public function undoReplace($replace){
        $I = $this->tester;
        $I->click(self::$checkbox1Table);
        $I->click(self::$actionReplace);
        $I->click(self::$actionSubmitButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Replace',self::$assertDataPage);
        $I->fillField(self::$replaceFilter,$replace);
        $I->click(self::$continueButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);

    }



    public static $delete1Link = '//*[@class="data"]//tr[1]/td[7]//a';

    public function deleteItSelf(){
        $I = $this->tester;
        $I->click('Delete');
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('deleted successfully.',self::$assertSuccessMsg);
    }

    public function undoChangeReplace(){
        $I = $this->tester;
        $I->click(self::$checkbox1Table);
        $I->click(self::$actionReplace);
        $I->click(self::$actionSubmitButton);
        $I->acceptPopup();
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('undone',self::$assertSuccessMsg);
    }

    public static $actionDelete = '//*[@class="right"]//option[2]';
    public function deleteChangeReplace(){
        $I = $this->tester;
        $I->click(self::$checkbox1Table);
        $I->click(self::$actionDelete);
        $I->click(self::$actionSubmitButton);
        $I->acceptPopup();
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('deleted',self::$assertSuccessMsg);
    }

    public function undoReplaceItself(){
        $I = $this->tester;
        $I->click(self::$checkbox1Table);
        $I->click('Undo replacement');
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('Replacing term was undone.',self::$assertSuccessMsg);
    }

//// filters

    public static $storeView = '//*[@class="filter"]/th[4]//optgroup[4]/option';
    public static $resultStoreView = '//*[@class="data"]//tbody//td[4]';
    public static $statusDisable = '//*[@class="filter"]/th[5]//option[2]';
    public static $statusEnable = '//*[@class="filter"]/th[5]//option[3]';
    public static $resultStatus = '//*[@class="data"]//tbody//td[5]';

    public function variousView(){
        $I = $this->tester;
        $I->click(self::$storeView);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultStoreView);
        $I->click(self::$statusEnable);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultStatus);
        $I->click(self::$filterResetFilterButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
            }


    public function searchActionMassActionMenu($searchTerm){
        $I = $this->tester;
        $I->click('Select All');
        $I->click(self::$actionSearch);
        $I->click(self::$actionSubmitButton);
        $I->waitForElementVisible(self::$searchTermField);
        $I->fillField(self::$searchTermField, $searchTerm);
        $I->click(self::$continueButton);
        $I->waitForElement(self::$assertSuccessMsg);
    }



}