<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 24.06.16
 * Time: 16:03
 */

namespace Page;


class MagentoManageCategories
{
    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';
    public static $categoriesDown = '//*[@class="nav-bar"]/ul/li[3]/ul/li[2]/a/span';
    public static $manageCategories = '//*[@class="nav-bar"]/ul/li[3]/ul/li[2]//li[1]/a/span';


// Manage Categories
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $nameField = '//*[@id="group_4name"]';
    public static $saveCategory = '//*[@class="category-content"]/div[1]//button[2]';
    public static $categoryTree = '//*[@id="tree-div"]';
    public static $loading = '//*[@id="loading_mask_loader"]';
    public static $testCategoryBelow = '//*[@class="tree-holder"]//ul/div/li[6]//a/span[text()="Test category (0)"]';
    public static $testCategoryAbove = '//*[@class="tree-holder"]//ul/div/li[5]//li//a//span[contains(text(), "Test")]';
    public static $homePage = '//*[@class="tree-holder"]//ul/div/li[5]//li//a/span[contains(text(), "Homepage")]';
    public static $best = '//*[@class="tree-holder"]//ul/div/li[5]//li//a/span[contains(text(),"The Best Deals")]';
    public static $bestAll = '//*[@class="tree-holder"]//ul/div/li[5]//li//a/span[contains(text(),"The Best Deals")]/../../img';
    public static $showTableBest = '//*[@class="tree-holder"]//ul/div/li[5]//li//a/span[contains(text(),"The Best Deals")]/../../..//ul';
    public static $zone = '//*[@class="tree-holder"]//ul/div/li[5]//li//a/span[contains(text(),"The Best Deals")]/../../..//ul//a/span[contains(text(),"Zone")]';
    public static $homePageAll = '//*[@class="tree-holder"]//ul/div/li[5]//li//a/span[contains(text(),"Homepage")]/../../img';



    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToManageCategory() {
        $I = $this->tester;
        $I->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$categoriesDown);
        $I->moveMouseOver(self::$categoriesDown);
        $I->waitForElement(self::$manageCategories);
        $I->click(self::$manageCategories);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Root Category',self::$assertDataPage);
        $I->waitForElementNotVisible(self::$loading,30);
    }

    public function createCategory($name)
    {
        $I = $this->tester;
        $I->fillField(self::$nameField, $name);
        $I->waitForElementNotVisible(self::$loading);
        $I->waitForElement(self::$saveCategory);
        $I->click(self::$saveCategory);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The category has been saved.', self::$assertSuccessMsg);
        $I->see($name, self::$categoryTree);
        $I->seeElement(self::$testCategoryBelow);
    }

    public function editCategory($name){
        $I = $this->tester;
        $I->see($name,self::$categoryTree);
        $I->click(self::$testCategoryBelow);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$nameField);
        $I->fillField(self::$nameField, $name);
        $I->waitForElement(self::$saveEditButton);
        $I->click(self::$saveEditButton);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The category has been saved.', self::$assertSuccessMsg);
    }



    public function aboveCategory()
    {
        $I = $this->tester;
        $I->dragAndDrop(self::$testCategoryBelow, self::$homePage);
        $I->waitForElementNotVisible(self::$loading,30);
    }
    public function belowCategory()
    {
        $I = $this->tester;
        $I->reloadPage();
        $I->scrollTo(self::$bestAll,500);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$bestAll);
        $I->click(self::$bestAll);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$showTableBest);
        $I->scrollDown(500);
        $I->waitForElement(self::$zone);
        $I->scrollDown(200);
        $I->waitForElement(self::$homePageAll);
        $I->click(self::$homePageAll);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->click(self::$homePageAll);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$testCategoryAbove);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->click(self::$testCategoryAbove);
        $I->waitForElementNotVisible(self::$loading,30);
    }
    public function intoSibling()
    {
        $I = $this->tester;
        $I->dragAndDrop(self::$testCategoryAbove, self::$zone);
        $I->waitForElementNotVisible(self::$loading, 30);
        $I->waitForElement(self::$testCategoryAbove);
        $I->click(self::$testCategoryAbove);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->dragAndDrop(self::$testCategoryAbove, self::$best);
        $I->waitForElementNotVisible(self::$loading, 30);
        $I->waitForElement(self::$testCategoryAbove);
    }
    public function deleteCategory(){
        $I = $this->tester;
        $I->click(self::$testCategoryAbove);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$deleteEditButton);
        $I->click(self::$deleteEditButton);
        $I->acceptPopup();
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The category has been deleted.',self::$assertSuccessMsg);


    }


    public static $saveEditButton = '//div[@id="category-edit-container"]//p/button//span[text()="Save Category"]';
    public static $deleteEditButton = '//div[@class="content-header-floating"]//button//span[text()="Delete Category"]';
    public static $logo = '//*[@class="logo"]';








}
