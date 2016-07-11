<?php


namespace Page;


use Exception;

class MagentoCatalog

{

    public static $loading = '//*[@id="loading_mask_loader"]';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';


    public static $moveCatalog = '//*[@class="nav-bar"]//li//span[text()="Catalog"]';
    public static $manageCatalog = '//*[@class="nav-bar"]//li//ul//a/span[text()="URL Redirects"]';
    public static $h3 = '//*[@class="content-header"]//h3[text()="URL Redirect Management"]';

    //add url
    public static $addNewURL = '//*[@class="content-header"]//td/button//span[text()="Add URL Redirect"]';
    public static $urlH3 = '//*[@class="content-header"]//h3[text()="URL Redirect"]';
    public static $type = '//select[@name="options"]';
    public static $waitStore = '//div[@class="fieldset "]//label[text()="Store "]';
    public static $store = '//select[@name="store_id"]';
    // store

    public static $save = '//*[@class="content-header"]//button//span[text()="Save"]';
    public static $errorRequirePath = '//*[@name="identifier"]/../div[contains(text(),"This")]';
    public static $errorTargetPath = '//*[@name="target_path"]/../div[contains(text(),"This")]';
    public static $enterRequirePath = '//*[@name="identifier"]';
    public static $enterTargetPath = '//*[@name="target_path"]';
    // filter

    public static $enterUrl = '//*[@class="filter"]/th//input[@name="identifier"]';
    public static $searchURL = '//*[@class="filter-actions a-right"]//button//span[text()="Search"]';
    public static $foundUrl = '//*[@class="grid"]//tbody//tr/td[contains(text(),"ego/test.html")]';

    // check url

    public static $urlFront = '/ego/test.html';
    public static $productView = '//div[@class="product-view"]';
    //edit

    public static $foundEditUrl = '//*[@class="grid"]//tbody//tr/td[contains(text(),"ego/test/test.html")]';
    public static $urlUpdateFront = '/ego/test/test.html';

    //delete

    public static $deleteUrl = '//div[@class="content-header"]//button//span[text()="Delete"]';


    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goMagentoCatalog()
    {
        $I = $this->tester;
        $I->waitForElement(self::$moveCatalog);
        $I->moveMouseOver(self::$moveCatalog);
    }


    public function addNewURL()
    {
        $I = $this->tester;
        $I->waitForElement(self::$manageCatalog);
        $I->click(self::$manageCatalog);
        $I->waitForElement(self::$h3);
        $I->click(self::$addNewURL);
        $I->waitForElement(self::$type);
        $I->selectOption(self::$type, 'Custom');
        $I->waitForElement(self::$waitStore);
        $I->click(self::$save);
        $I->seeElement(self::$errorRequirePath);
        $I->seeElement(self::$errorTargetPath);
        $I->selectOption(self::$store,'    Mowdirect_Fourteen_Storeview');
        $I->fillField(self::$enterRequirePath,'ego/test.html');
        $I->fillField(self::$enterTargetPath,'catalog/product/view/id/1111');
        $I->click(self::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Redirect item has been saved.', self::$assertSuccessMsg);

    }

    public function filters(){
        $I = $this->tester;
        $I->waitForElement(self::$enterUrl);
        $I->fillField(self::$enterUrl, 'ego/test.html');
        $I->click(self::$searchURL);
        $I->waitForElement(self::$foundUrl);

    }

    public function checkUrl(){
        $I = $this->tester;
        $I->amOnPage(self::$urlFront);
        $I->waitForElement(self::$productView);
        $I->amOnUrl('http://testing:Da1mat1an5@testupgrade.ee12test.mowdirect.co.uk/admin');
        self::goMagentoCatalog();
        $I->waitForElement(self::$manageCatalog);
        $I->click(self::$manageCatalog);
        $I->waitForElement(self::$h3);
    }

    public function editUrl(){
        $I = $this->tester;
        $I->click(self::$foundUrl);
        $I->fillField(self::$enterRequirePath,'ego/test/test.html');
        $I->click(self::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Redirect item has been saved.', self::$assertSuccessMsg);

        $I->fillField(self::$enterUrl, 'ego/test/test.html');
        $I->click(self::$searchURL);
        $I->waitForElement(self::$foundEditUrl);
    }
    public function checkUpdateUrl(){
        $I = $this->tester;
        $I->amOnPage(self::$urlUpdateFront);
        $I->waitForElement(self::$productView);
        $I->amOnUrl('http://testing:Da1mat1an5@testupgrade.ee12test.mowdirect.co.uk/admin');
        self::goMagentoCatalog();
        $I->waitForElement(self::$manageCatalog);
        $I->click(self::$manageCatalog);
        $I->waitForElement(self::$h3);
    }
    public function deleteUrl()
    {
        $I = $this->tester;
        $I->click(self::$foundEditUrl);
        $I->waitForElement(self::$deleteUrl);
        $I->click(self::$deleteUrl);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('URL Redirect has been deleted.', self::$assertSuccessMsg);
    }

    /**
     * Google siteMap
     */



    public static $manageGoogleMap = '//*[@class="nav-bar"]//li//ul//a/span[text()="Google Sitemap"]';
    public static $mapH3 = '//*[@class="content-header"]//h3[text()="Google Sitemap"]';
    public static $addNewMap = '//*[@class="content-header"]//td/button//span[text()="Add Sitemap"]';
    public static $errorFileName = '//*[@name="sitemap_filename"]/../div[contains(text(),"This")]';
    public static $errorPath = '//*[@name="sitemap_path"]/../div[contains(text(),"This")]';
    public static $enterFileName = '//*[@name="sitemap_filename"]';
    public static $enterPath = '//*[@name="sitemap_path"]';
    public static $selectStore = '//select[@name="store_id"]';
    public static $errorMsg = '//*[@class="messages"]';
    public static $addedMap = '//*[@class="grid"]//tbody//tr/td[contains(text(),"sitemap.xml")]/../td[contains(text(),"/sitemap")]/../td[contains(text(),"sitemap/sitemap.xml")]';
    public static $addedEditMap = '//*[@class="grid"]//tbody//tr/td[contains(text(),"sitemap.xml")]/../td[contains(text(),"/")]/../td[contains(text(),"/sitemap.xml")]';

    public function addMap(){
        self::goMagentoCatalog();
        $I = $this->tester;
        $I->click(self::$manageGoogleMap);
        $I->waitForElement(self::$mapH3);
        $I->click(self::$addNewMap);
        $I->waitForElement(static::$save);
        $I->click(static::$save);
        $I->seeElement(self::$errorFileName);
        $I->seeElement(self::$errorPath);
        $I->fillField(self::$enterFileName, 'Test');
        $I->fillField(self::$enterPath, 'test/');
        $I->selectOption(self::$selectStore, 'Mowdirect_Fourteen_Storeview');
        $I->click(static::$save);
        $I->waitForElement(self::$errorMsg);
        $I->see('Path "test/Test" is not available and cannot be used.', self::$errorMsg);
        $I->fillField(self::$enterFileName, 'sitemap.xml');
        $I->click(static::$save);
        $I->waitForElement(self::$errorMsg);
        $I->see('Please create the specified folder "test/" before saving the sitemap.', self::$errorMsg);
        $I->fillField(self::$enterPath, 'sitemap/');
        $I->click(static::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The sitemap has been saved.', self::$assertSuccessMsg);
        $I->seeElement(self::$addedMap);
    }

    public function editMap(){
        $I = $this->tester;
        $I->click(self::$addedMap);
        $I->fillField(self::$enterPath, '/');
        $I->click(static::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The sitemap has been saved.', self::$assertSuccessMsg);
        $I->seeElement(self::$addedEditMap);
    }
    public function deleteMap(){
        $I = $this->tester;
        $I->click(self::$addedEditMap);
        $I->click(static::$deleteUrl);
        $I->acceptPopup();
        $I->see('The sitemap has been deleted.', self::$assertSuccessMsg);
        
    }








}