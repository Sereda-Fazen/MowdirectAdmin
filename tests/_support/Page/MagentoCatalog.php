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






}