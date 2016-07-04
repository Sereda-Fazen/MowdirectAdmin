<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 22.06.16
 * Time: 12:57
 */

namespace Page;


class MagentoNewsletters
{

    public static $newsletterDown = '//*[@class="nav-bar"]/ul/li[7]';
    public static $mailChimpDown = '//*[@class="nav-bar"]/ul/li[7]/ul/li[5]/a/span';
    public static $bulkSyncDown = '//*[@class="nav-bar"]/ul/li[7]/ul/li[5]/ul/li[2]';
    public static $newsletterExport = '//*[@class="nav-bar"]/ul/li[7]/ul/li[5]/ul/li[2]/ul/li[1]';



// Export Page
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $listChooseTestSend = '//*[@id="list"]/option[2]';
    public static $sourceSendToMailbox = '//*[@id="data_source_entity"]/option[2]';
    public static $storeAllStoresTable = '//*[@id="store_id"]/option[1]';
    public static $allSetButton = './/*[@class="middle"]/div/div[2]//button[3]';


    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToExportNewsletter() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$newsletterDown);
        $I->waitForElement(self::$mailChimpDown);
        $I ->moveMouseOver(self::$mailChimpDown);
        $I->waitForElement(self::$bulkSyncDown);
        $I ->moveMouseOver(self::$bulkSyncDown);
        $I->waitForElement(self::$newsletterExport);
        $I->click(self::$newsletterExport);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Export',self::$assertDataPage);
    }

    public function runExport (){
        $I = $this->tester;
        $I->click(self::$sourceSendToMailbox);
        $I->see('Test Send',self::$listChooseTestSend);
        $I->click(self::$listChooseTestSend);
        $I->click(self::$storeAllStoresTable);
        $I->click(self::$allSetButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('was sucessfully scheduled.',self::$assertSuccessMsg);

    }

}