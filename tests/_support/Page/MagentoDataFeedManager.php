<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 17.06.16
 * Time: 17:43
 */

namespace Page;


class MagentoDataFeedManager
{

    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';
    public static $dataFeedManagerDropDown = '//*[@class="nav-bar"]/ul/li[3]/ul/li[11]/a/span';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';

// Static Banners Page
    public static $assertDataFeedManagerPage = '//*[@class="middle"]//h3';
    public static $filterFileFormatSort = '//*[@class="headings"]//th[3]';
    public static $filterFileFormatTxt = '//*[@class="filter"]/th[3]//option[3]';
    public static $filterSearchButton = '//*[@class="actions"]//button[2]';
    public static $filterStatusEnable = '//*[@class="filter"]/th[8]//option[2]';
    public static $filterFileNameField = '//*[@class="filter"]/th[2]//input';
    public static $filterFileFormatResult = '//*[@class="data"]/tbody//td[3]';
    public static $filterStatusResult = '//*[@class="data"]/tbody//td[8]';
    public static $filterFileNameResult = '//*[@class="data"]/tbody//td[2]';
    public static $filterLastUpdateFrom = '//*[@class="filter"]/th[6]/div/div[1]/input';
    public static $filterLastUpdateTo = '//*[@class="filter"]/th[6]/div/div[2]/input';
    public static $filterResetButton = '//*[@class="actions"]//td[2]/button[1]';
    public static $createNewTemplateButton = '//*[@class="middle"]/div/div[2]//button[1]';


    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }
    public function goToDataFeedManagerPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$dataFeedManagerDropDown);
        $I->click(self::$dataFeedManagerDropDown);
        $I->waitForElementVisible(self::$assertDataFeedManagerPage);
        $I->see('Data Feed Manager',self::$assertDataFeedManagerPage);
    }

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function variousFilter($from,$to) {
        $I = $this->tester;
        $I->click(self::$filterFileFormatTxt);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterFileFormatResult);
        $I->see('txt',self::$filterFileFormatResult);
        $I->click(self::$filterResetButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click(self::$filterStatusEnable);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterStatusResult);
        $I->see('Enabled', self::$filterStatusResult);
        $I->click(self::$filterResetButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->fillField(self::$filterLastUpdateFrom,$from);
        $I->fillField(self::$filterLastUpdateTo,$to);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterStatusResult);
        }

//New feed Page
    public static $feedNameField = '//*[@id="feed_name"]';
    public static $typeXmlDropDown = '//*[@id="feed_type"]/option[1]';
    public static $pathField = '//*[@class="form-list"]//tbody/tr[9]/td[2]/input';
    public static $headerPatternField = '//*[@class="form-list"]//tbody/tr[16]/td[2]/textarea';
    public static $productPatternField = '//*[@class="form-list"]//tbody/tr[17]/td[2]/textarea';
    public static $footerPatternField = '//*[@class="form-list"]//tbody/tr[18]/td[2]/textarea';
    public static $saveButton = '//*[@class="form-buttons"]/button[3]';
    public static $backButton = '//*[@class="main-col-inner"]/div[2]/p/button[1]';
    public static $filtersLink = '//*[@class="side-col"]//li[3]/a/span';
    public static $enableStatus = '//*[@id="feed_status"]/option[2]';

// Filters
    public static $productTypeCheckbox = './/*[@id="all_type_id"]'; ////*[@class="main-col-inner"]/div[3]/form/div[4]/div[1]/div[1]/div[1]/input
    public static $attributeSetCheckbox = './/*[@id="all_attribute_set"]';
    public static $ProductVisibilityCheckbox = './/*[@id="all_visibility"]';


    public function addDataFeed($feedName,$path,$headerPattern,$productPattern,$footerPattern){
        $I = $this->tester;
        $I->click(self::$createNewTemplateButton);
        $I->waitForElementVisible(self::$assertDataFeedManagerPage);
        $I->see('Add template',self::$assertDataFeedManagerPage);
        $I->fillField(self::$footerPatternField,$footerPattern);
        $I->fillField(self::$productPatternField,$productPattern);
        $I->fillField(self::$headerPatternField,$headerPattern);
        $I->fillField(self::$pathField,$path);
        $I->click(self::$enableStatus);
        $I->click(self::$typeXmlDropDown);
        $I->fillField(self::$feedNameField,$feedName);
        $I->click(self::$filtersLink);
        $I->waitForElementVisible(self::$productTypeCheckbox);
        $I->click(self::$productTypeCheckbox);
        $I->click(self::$attributeSetCheckbox);
        $I->click(self::$ProductVisibilityCheckbox);
        $I->click(self::$saveButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
    }

    public function editDataFeed($fileName){
        $I = $this->tester;
        $I->fillField(self::$filterFileNameField,$fileName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$filterFileNameResult);
        $I->see($fileName,self::$filterFileNameResult);
        $I->click(self::$editFirstItemDropDown);
        $I->waitForElementVisible(self::$popUpMinimizeButton);
        $I->see('Edit template',self::$assertEditPage);
       // $I->click(self::$popUpMinimizeButton);
        $I->fillField(self::$extraHeaderField,$fileName);
        $I->click(self::$SaveButtonEditPage);
        $I->waitForElementVisible(self::$assertSuccessMsg);

}

    public function checkAddFeedButton(){
        $I = $this->tester;
        $I->click(self::$createNewTemplateButton);
        $I->waitForElementVisible(self::$assertDataFeedManagerPage);
        $I->see('Add template',self::$assertDataFeedManagerPage);
        $I->click(self::$backButton);
        $I->waitForElementVisible(self::$assertDataFeedManagerPage);
        $I->see('Data Feed Manager',self::$assertDataFeedManagerPage);
    }

    public static $editFirstItemDropDown = '//*[@class="grid"]//tbody/tr[1]/td[9]/select/option[2]';
    // Edit Feed Page
    public static $assertEditPage = '//*[@id="content"]/div/div[2]/h3';
    public static $popUp = '//*[@id="handler"]';
    public static $footerLocator = '//*[@id="interface_locale"]';
    public static $backButtonEditPage = '//*[@id="html-body"]/div[3]/div//button[1]';
    public static $extraHeaderField = './/*[@id="feed_extraheader"]';
    public static $SaveButtonEditPage = '//*[@class="form-buttons"]/button[6]';
    public static $popUpMinimizeButton = '//*[@id="handler"]/button[2]';

    public function checkBackEditPage(){
        $I = $this->tester;
        $I->click(self::$editFirstItemDropDown);
        $I->waitForElementVisible(self::$assertEditPage);
        $I->see('Edit template',self::$assertEditPage);
        $I->click(self::$popUp);
        $I->scrollTo(self::$footerLocator,100);
        $I->click(self::$backButtonEditPage);
        $I->waitForElementVisible(self::$assertDataFeedManagerPage);
        $I->see('Data Feed Manager',self::$assertDataFeedManagerPage);
    }




}