<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 28.06.16
 * Time: 16:29
 */

namespace Page;


class MagentoSearchTerms
{
    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';
    public static $searchTerms = '//*[@class="nav-bar"]/ul/li[3]/ul/li[6]';

// Search Term Page
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $addNewSearchTermButton = '//*[@class="middle"]/div/div[2]//button';


    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToSearchTerms() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$searchTerms);
        $I->click(self::$searchTerms);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Search',self::$assertDataPage);
    }
    //New Search Term
    public static $searchQueryField = '//*[@id="query_text"]';
    public static $storeAgriFabDown = '//*[@id="store_id"]/optgroup[2]/option';
    public static $newSaveSearchButton = '//*[@class="middle"]/div/div[2]//button[3]';

    public function addNewSearchTerm($searchQuery){
        $I = $this->tester;
        $I->click(self::$addNewSearchTermButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Search',self::$assertDataPage);
        $I->fillField(self::$searchQueryField,$searchQuery);
        $I->click(self::$storeAgriFabDown);
        $I->click(self::$newSaveSearchButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Search',self::$assertDataPage);
    }

    // Filter Fields
    public static $filterSearchQuery = '//*[@class="filter"]/th[2]//input';
    public static $filterSearchButton = '//*[@class="middle"]/div/div[3]//button[2]';
    public static $filterResetFilterButton = '//*[@class="middle"]/div/div[3]//button[2]';
    public static $resultSearchQuery = '//*[@class="data"]//td[2]';
    public static $actionDeleteDown = '//*[@class="right"]//option[2]';
    public static $actionSubmitButton = '//*[@class="right"]//button';
    public static $filterDisplayNoDown = '//*[@class="filter"]//th[8]//option[3]';
    public static $filterStoreAgrDown = '//*[@class="filter"]//th[3]//optgroup[2]/option';


    public function searchTerms($searchQuery){
        $I = $this->tester;
        $I->fillField(self::$filterSearchQuery,$searchQuery);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultSearchQuery);
        $I->see($searchQuery, self::$resultSearchQuery);
    }

    // Edit Term Page
    public static $numberResultField = '//*[@id="num_results"]';
    public static $numberUsesField = '//*[@id="popularity"]';
    public static $editSaveSearchButton = '//*[@class="middle"]/div/div[2]//button[4]';

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function editTerms($numberResult,$numberUses){
        $I = $this->tester;
        $I->click(self::$resultSearchQuery);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Search',self::$assertDataPage);
        $I->fillField(self::$numberResultField, $numberResult);
        $I->fillField(self::$numberUsesField, $numberUses);
        $I->click(self::$editSaveSearchButton);
        $I->waitForElementVisible(self::$resultSearchQuery);
    }

    public function variousFilter($searchQuery){
        $I = $this->tester;
        $I->fillField(self::$filterSearchQuery,$searchQuery);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultSearchQuery);
        $I->see($searchQuery, self::$resultSearchQuery);
        $I->click(self::$filterDisplayNoDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultSearchQuery);
        $I->click(self::$filterStoreAgrDown);
        $I->waitForElementVisible(self::$resultSearchQuery);
        $I->click(self::$filterResetFilterButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);


    }

    public function deleteTestTerms(){
        $I = $this->tester;
        $I->click('Select All');
        $I->click(self::$actionDeleteDown);
        $I->click(self::$actionSubmitButton);
        $I->acceptPopup();
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->waitForElementNotVisible(self::$resultSearchQuery);

    }




}