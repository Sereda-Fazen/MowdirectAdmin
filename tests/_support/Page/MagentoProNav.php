<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 15.06.16
 * Time: 11:52
 */

namespace Page;


class MagentoProNav
{

    public static $cmsDropDown = '//*[@class="nav-bar"]/ul/li[8]';
    public static $proNavLink = '//*[@class="nav-bar"]/ul/li[8]/ul/li[2]/a/span';


// ProVan Manager Page
    public static $assertProNavManagerPage = '//*[@class="content-header"]//h3';
    public static $addProVanItemButton = '//*[@class="middle"]/div/div[2]//button';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//span';
    public static $filterNameField = '//*[@class="filter"]/th[3]//input';
    public static $filterSearchButton = '//*[@class="actions"]//button[2]';
    public static $filterResetButton = '//*[@class="actions"]//button[1]';

    public static $filterSearchResult = '//*[@class="data"]/tbody/tr[1]/td[3]';
    public static $filterStatus = '//*[@class="data"]/tbody/tr[1]/td[12]';
    public static $deleteActionDropDown = '//*[@method="post"]//option[2]';
    public static $changeStatusActionDropDown = '//*[@method="post"]//option[3]';
    public static $disableStatusActionDropDown = './/*[@class="right"]//span[3]//option[3]';
    public static $submitActionButton = '//*[@method="post"]//button';
    public static $checkboxSearchResult = '//*[@class="data"]/tbody/tr[1]/td[1]/input';
    public static $filterID ='//*[@class="headings"]/th[2]/span';
    public static $filterName = '//*[@class="headings"]/th[3]/span';
    public static $filterUrl = '//*[@class="headings"]/th[4]/span';



/// Add ProNav Item Page
    public static $nameField = '//*[@class="form-list"]/tbody/tr[1]//input';
    public static $urlKeyField = '//*[@class="form-list"]/tbody/tr[2]//input';
    public static $itemIndexField = '//*[@class="form-list"]/tbody/tr[3]//input';
    public static $itemCssIDField = '//*[@class="form-list"]/tbody/tr[4]//input';
    public static $itemCssClassField = '//*[@class="form-list"]/tbody/tr[5]//input';
    public static $linkCssIDField = '//*[@class="form-list"]/tbody/tr[6]//input';
    public static $linkCssClassField = '//*[@class="form-list"]/tbody/tr[7]//input';
    public static $staticBlockDropDown = '//*[@class="form-list"]/tbody/tr[8]//option[3]';
    public static $disableStatusBlockDropDown = '//*[@class="form-list"]/tbody/tr[10]//option[2]';
    public static $saveItemButton = '//*[@id="content"]//button[3]';
    public static $editPageDeleteButton = '//*[@id="content"]//button[3]';

    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToProNavItemsManagerPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDropDown);
        $I->waitForElement(self::$proNavLink);
        $I->click(self::$proNavLink);
        $I->waitForElement(self::$assertProNavManagerPage);
        $I->see('ProNav Items Manager',self::$assertProNavManagerPage);
    }

    public function createProNavItem($nameProNav,$index) {
        $I = $this->tester;
        $I ->click(self::$addProVanItemButton);
        $I->waitForElement(self::$assertProNavManagerPage);
        $I->see('Add ProNav Item',self::$assertProNavManagerPage);
        $I->fillField(self::$nameField,$nameProNav);
    //    $I->fillField(self::$urlKeyField,$url);
        $I->fillField(self::$itemIndexField,$index);
    //    $I->fillField(self::$itemCssIDField,$cssId);
    //    $I->fillField(self::$itemCssClassField,$cssClass);
    //    $I->fillField(self::$linkCssIDField,$linkCssId);
    //    $I->fillField(self::$linkCssClassField,$linkCssClass);
    //    $I->click(self::$staticBlockDropDown);
        $I->click(self::$saveItemButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Item was successfully saved',self::$assertSuccessMsg);
    }

    public function createProNavItem1($nameProNav,$url,$index,$cssId,$cssClass,$linkCssId,$linkCssClass) {
        $I = $this->tester;
        $I ->click(self::$addProVanItemButton);
        $I->waitForElement(self::$assertProNavManagerPage);
        $I->see('Add ProNav Item',self::$assertProNavManagerPage);
        $I->fillField(self::$nameField,$nameProNav);
        $I->fillField(self::$urlKeyField,$url);
        $I->fillField(self::$itemIndexField,$index);
        $I->fillField(self::$itemCssIDField,$cssId);
        $I->fillField(self::$itemCssClassField,$cssClass);
        $I->fillField(self::$linkCssIDField,$linkCssId);
        $I->fillField(self::$linkCssClassField,$linkCssClass);
        $I->click(self::$staticBlockDropDown);
        $I->click(self::$disableStatusBlockDropDown);
        $I->click(self::$saveItemButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Item was successfully saved',self::$assertSuccessMsg);
    }

    public function deleteProNavItem($nameProNav) {
        $I = $this->tester;
        $I->fillField(self::$filterNameField,$nameProNav);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterSearchResult);
        $I->see($nameProNav,self::$filterSearchResult);
        $I->click(self::$filterSearchResult);
        $I->waitForElement(self::$editPageDeleteButton);
        $I->click(self::$editPageDeleteButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Item was successfully deleted',self::$assertSuccessMsg);
    }

    public function deleteProNavItemActionMenu($nameProNav) {
        $I = $this->tester;
        $I->fillField(self::$filterNameField,$nameProNav);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterSearchResult);
        $I->see($nameProNav,self::$filterSearchResult);
        $I->click(self::$checkboxSearchResult);
        $I->click(self::$deleteActionDropDown);
        $I->click(self::$submitActionButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('were successfully deleted',self::$assertSuccessMsg);
    }

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function changeItemStatusOnActionMenu($nameProNav) {
        $I = $this->tester;
        $I->click(self::$filterID);
        $I->wait(2);
        $I->waitForElementNotVisible(self::$loadPageBlock);
      //  $I->fillField(self::$filterNameField,$nameProNav);
      //  $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterSearchResult);
        $I->see($nameProNav,self::$filterSearchResult);
        $I->click(self::$checkboxSearchResult);
        $I->click(self::$changeStatusActionDropDown);
        $I->click(self::$disableStatusActionDropDown);
        $I->click(self::$submitActionButton);
        $I->waitForElement(self::$filterSearchResult);
 //       $I->see('Total of 1 record(s) were successfully updated',self::$assertSuccessMsg);
        $I->fillField(self::$filterNameField,$nameProNav);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterSearchResult);
        $I->see('Disable',self::$filterStatus);
    }

    public function variosFilter($nameProNav) {
        $I = $this->tester;
        $I->click(self::$filterID);
        $I->fillField(self::$filterNameField,$nameProNav);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterSearchResult);
        $I->see($nameProNav,self::$filterSearchResult);
        $I->click(self::$checkboxSearchResult);
        $I->click(self::$changeStatusActionDropDown);
        $I->click(self::$disableStatusActionDropDown);
        $I->click(self::$filterResetButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click(self::$filterName);
        $I->click(self::$filterUrl);

    }




}