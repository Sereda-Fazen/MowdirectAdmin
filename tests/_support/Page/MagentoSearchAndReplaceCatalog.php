<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 30.06.16
 * Time: 10:56
 */

namespace Page;


class MagentoSearchAndReplaceCatalog
{

    public static $cmsDown = '//*[@class="nav-bar"]/ul/li[8]';
    public static $cmsSearchAndReplaceDown = '//*[@class="nav-bar"]/ul/li[8]/ul/li[7]';
    public static $cmsSelectPage = '//*[@class="nav-bar"]/ul/li[8]//li[7]//li[1]/a/span';
    public static $cmsSearchInPages = '//*[@class="nav-bar"]/ul/li[8]//li[7]//li[2]/a/span';
    public static $cmsReplaceInPages = '//*[@class="nav-bar"]/ul/li[8]//li[7]//li[3]/a/span';
    public static $cmsSelectStaticBlock = '//*[@class="nav-bar"]/ul/li[8]//li[7]//li[4]/a/span';
    public static $cmsSearchInStaticBlock = '//*[@class="nav-bar"]/ul/li[8]//li[7]//li[5]/a/span';
    public static $cmsReplaceInStaticBlock = '//*[@class="nav-bar"]/ul/li[8]//li[7]//li[6]/a/span';

//  Page
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';



    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToCmsSelectPage () {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDown);
        $I->waitForElement(self::$cmsSearchAndReplaceDown);
        $I ->moveMouseOver(self::$cmsSearchAndReplaceDown);
        $I->waitForElement(self::$cmsSelectPage);
        $I->click(self::$cmsSelectPage);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCmsSearchInPage () {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDown);
        $I->waitForElement(self::$cmsSearchAndReplaceDown);
        $I ->moveMouseOver(self::$cmsSearchAndReplaceDown);
        $I->waitForElement(self::$cmsSearchInPages);
        $I->click(self::$cmsSearchInPages);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCmsReplaceInPage () {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDown);
        $I->waitForElement(self::$cmsSearchAndReplaceDown);
        $I ->moveMouseOver(self::$cmsSearchAndReplaceDown);
        $I->waitForElement(self::$cmsReplaceInPages);
        $I->click(self::$cmsReplaceInPages);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCmsSelectInStaticBlock () {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDown);
        $I->waitForElement(self::$cmsSearchAndReplaceDown);
        $I ->moveMouseOver(self::$cmsSearchAndReplaceDown);
        $I->waitForElement(self::$cmsSelectStaticBlock);
        $I->click(self::$cmsSelectStaticBlock);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCmsSearchInStaticBlock () {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDown);
        $I->waitForElement(self::$cmsSearchAndReplaceDown);
        $I ->moveMouseOver(self::$cmsSearchAndReplaceDown);
        $I->waitForElement(self::$cmsSearchInStaticBlock);
        $I->click(self::$cmsSearchInStaticBlock);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCmsReplaceInStaticBlocks () {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDown);
        $I->waitForElement(self::$cmsSearchAndReplaceDown);
        $I ->moveMouseOver(self::$cmsSearchAndReplaceDown);
        $I->waitForElement(self::$cmsReplaceInStaticBlock);
        $I->click(self::$cmsReplaceInStaticBlock);
        $I->waitForElementVisible(self::$assertDataPage);
    }


    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';
    public static $catalogSearchAndReplaceDown = '//*[@class="nav-bar"]/ul/li[3]/ul/li[7]';
    public static $catalogSelectProducts = '//*[@class="nav-bar"]/ul/li[3]//li[7]//li[1]/a/span';
    public static $catalogSearch = '//*[@class="nav-bar"]/ul/li[3]//li[7]//li[2]/a/span';
    public static $catalogReplace = '//*[@class="nav-bar"]/ul/li[3]//li[7]//li[3]/a/span';

    public function goToCatalogSelectProducts() {
        $I = $this->tester;
        $I->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$catalogSearchAndReplaceDown);
        $I->moveMouseOver(self::$catalogSearchAndReplaceDown);
        $I->waitForElement(self::$catalogSelectProducts);
        $I->click(self::$catalogSelectProducts);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCatalogSearch() {
        $I = $this->tester;
        $I->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$catalogSearchAndReplaceDown);
        $I->moveMouseOver(self::$catalogSearchAndReplaceDown);
        $I->waitForElement(self::$catalogSearch);
        $I->click(self::$catalogSearch);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function goToCatalogReplace() {
        $I = $this->tester;
        $I->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$catalogSearchAndReplaceDown);
        $I->moveMouseOver(self::$catalogSearchAndReplaceDown);
        $I->waitForElement(self::$catalogReplace);
        $I->click(self::$catalogReplace);
        $I->waitForElementVisible(self::$assertDataPage);
    }



    public static $searchAndReplaceDown = '//*[@class="nav-bar"]/ul/li[12]';
    public static $searchAndReplaceCmsDown = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]/a';

    public static $searchAndReplaceSelectPages = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[1]/a';
    public static $searchAndReplaceSearchInPages = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[2]/a';
    public static $searchAndReplaceReplaceInPages = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[3]/a';
    public static $searchAndReplaceSelectStaticBlock = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[4]/a';
    public static $searchAndReplaceSearchStaticBlocks = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[5]/a';
    public static $searchAndReplaceReplaceStaticBlocks = '//*[@class="nav-bar"]/ul/li[12]/ul/li[2]//li[6]/a';

    public static $searchAndReplaceCatalogDown = '//*[@class="nav-bar"]/ul/li[12]/ul/li[1]/a';
    public static $searchAndReplaceSelectInProduct = '//*[@class="nav-bar"]/ul/li[12]/ul/li[1]//li[1]/a';
    public static $searchAndReplaceSearch = '//*[@class="nav-bar"]/ul/li[12]/ul/li[1]//li[2]/a';
    public static $searchAndReplaceReplace = '//*[@class="nav-bar"]/ul/li[12]/ul/li[1]//li[3]/a';

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

    public function goToSearchAndReplaceReplaceInPages() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceReplaceInPages);
        $I->click(self::$searchAndReplaceReplaceInPages);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Page Replace Result List',self::$assertDataPage);
    }

    public function goToSearchAndReplaceSelectStaticBlock() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceSelectStaticBlock);
        $I->click(self::$searchAndReplaceSelectStaticBlock);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Select Static Blocks',self::$assertDataPage);
    }

    public function goToSearchAndReplaceSearchStaticBlocks() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceSearchStaticBlocks);
        $I->click(self::$searchAndReplaceSearchStaticBlocks);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Static Block Search',self::$assertDataPage);
    }

    public function goToSearchAndReplaceReplaceStaticBlocks() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCmsDown);
        $I->moveMouseOver(self::$searchAndReplaceCmsDown);
        $I->waitForElement(self::$searchAndReplaceReplaceStaticBlocks);
        $I->click(self::$searchAndReplaceReplaceStaticBlocks);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Static Block Replace Result',self::$assertDataPage);
    }

    public function goToSearchAndReplaceSelectInProduct() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCatalogDown);
        $I->moveMouseOver(self::$searchAndReplaceCatalogDown);
        $I->waitForElement(self::$searchAndReplaceSelectInProduct);
        $I->click(self::$searchAndReplaceSelectInProduct);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Select Products',self::$assertDataPage);
    }

    public function goToSearchAndReplaceSearch() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCatalogDown);
        $I->moveMouseOver(self::$searchAndReplaceCatalogDown);
        $I->waitForElement(self::$searchAndReplaceSearch);
        $I->click(self::$searchAndReplaceSearch);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Search Result',self::$assertDataPage);
    }

    public function goToSearchAndReplaceReplace() {
        $I = $this->tester;
        $I->moveMouseOver(self::$searchAndReplaceDown);
        $I->waitForElement(self::$searchAndReplaceCatalogDown);
        $I->moveMouseOver(self::$searchAndReplaceCatalogDown);
        $I->waitForElement(self::$searchAndReplaceReplace);
        $I->click(self::$searchAndReplaceReplace);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Replace Result',self::$assertDataPage);
    }


//6.1. Select Products

    public static $filterSelectProductTypeSimple = '//*[@class="filter"]/th[4]//option[2]';
    public static $resultSelectProductType = '//*[@class="data"]//td[4]';
    public static $filterSelectProductVisibleCatalogSearch = '//*[@class="filter"]/th[9]//option[5]';
    public static $resultSelectProductVisible = '//*[@class="data"]//td[9]';
    public static $filterSelectProductStatusEnable = '//*[@class="filter"]/th[10]//option[2]';
    public static $resultSelectProductStatus = '//*[@class="data"]//td[10]';
    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public static $filterSearchButton = '//*[@class="middle"]/div/div[3]/div/table//button[2]';
    public static $filterResetFilterButton = '//*[@class="middle"]/div/div[3]/div/table//button[1]';

    public function viewFilters() {
        $I = $this->tester;
        $I->click(self::$filterSelectProductTypeSimple);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultSelectProductType);
        $I->see('Simple Product',self::$resultSelectProductType);
        $I->click(self::$filterSelectProductVisibleCatalogSearch);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultSelectProductVisible);
        $I->see('Catalog, Search',self::$resultSelectProductVisible);
        $I->click(self::$filterSelectProductStatusEnable);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$resultSelectProductStatus);
        $I->see('Enabled',self::$resultSelectProductStatus);
        $I->click(self::$filterResetFilterButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
    }

    public static $checkbox1Table = '//*[@class="data"]//tbody/tr[1]/td[1]/input';
    public static $actionSearch = '//*[@class="right"]//option[2]';
    public static $actionSubmitButton = '//*[@class="right"]//button';
    public static $searchTermField = '//*[@id="searchterm"]';
    public static $newSearchContinueButton = '//*[@id="content"]//button';

    public function searchAction($searchTerm){
        $I = $this->tester;
        $I->click(self::$checkbox1Table);
        $I->click(self::$actionSearch);
        $I->click(self::$actionSubmitButton);
        $I->waitForElement(self::$assertDataPage);
        $I->see('New Search',self::$assertDataPage);
        $I->fillField(self::$searchTermField,$searchTerm);
        $I->click(self::$newSearchContinueButton);
        $I->waitForElement(self::$assertSuccessMsg);
    }


    public static $actionReplace = '//*[@class="right"]//option[3]';
    public function replaceFunction(){
        $I = $this->tester;
        $I->click('Select Visible');
        $I->click(self::$actionReplace);
        $I->click(self::$actionSubmitButton);
        $I->waitForElement(self::$assertDataPage);
        $I->see('New Replace',self::$assertDataPage);
    }






}