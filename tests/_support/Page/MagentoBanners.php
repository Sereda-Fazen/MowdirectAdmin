<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 17.06.16
 * Time: 12:30
 */

namespace Page;


class MagentoBanners
{

    public static $cmsDropDown = '//*[@class="nav-bar"]/ul/li[8]';
    public static $bannersBlock = '//*[@class="nav-bar"]/ul/li[8]/ul/li[5]/a/span';

// Static Banners Page
    public static $assertBannersPage = '//*[@class="content-header"]//h3';
    public static $addBannerButton = '//*[@class="middle"]/div/div[2]//button';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//span';
    public static $filterSearchButton = '//*[@class="actions"]//button[2]';
    public static $filterResetButton = '//*[@class="actions"]//td[2]/button[1]';
    public static $filterBannerNameField = '//*[@class="filter"]/th[3]//input';
    public static $filterBannersResult = '//*[@class="data"]/tbody//td[3]';

// New Banner Page
    public static $bannerNameField = '//*[@class="form-list"]//tr[1]//input';
    public static $bannerActiveYes = '//*[@class="form-list"]//tr[2]//option[1]';
    public static $saveBannerButton = '//*[@class="form-buttons"]/button[3]';

    public static $contentLink = '//*[@class="side-col"]//li[2]';
    public static $contentField = '//*[@class="main-col-inner"]//table//tr[2]/td[2]//textarea';

    public static $bannerNameEditPage = '//*[@class="form-list"]//tr[2]//input';
    public static $saveBannerEditPage = '//*[@class="form-buttons"]/button[4]';

    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }
    public function goToStaticBannersPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDropDown);
        $I->waitForElement(self::$bannersBlock);
        $I->click(self::$bannersBlock);
        $I->waitForElement(self::$assertBannersPage);
        $I->see('Manage Banners',self::$assertBannersPage);
    }

    public function createNewBanner($bannerName,$content) {
        $I = $this->tester;
        $I ->click(self::$addBannerButton);
        $I->waitForElement(self::$assertBannersPage);
        $I->see('New Banner',self::$assertBannersPage);
        $I->fillField(self::$bannerNameField,$bannerName);
        $I->click(self::$bannerActiveYes);
        $I->click(self::$contentLink);
        $I->waitForElementVisible(self::$contentField);
        $I->fillField(self::$contentField,$content);
        $I->click(self::$saveBannerButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The banner has been saved.',self::$assertSuccessMsg);
    }

    public function editStaticBlock($bannerName,$bannerName1) {
        $I = $this->tester;
        $I->fillField(self::$filterBannerNameField,$bannerName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterBannersResult);
        $I->see($bannerName,self::$filterBannersResult);
        $I->click(self::$filterBannersResult);
        $I->waitForElement(self::$assertBannersPage);
        $I->see('Test Banner',self::$assertBannersPage);
        $I->fillField(self::$bannerNameEditPage,$bannerName1);
        $I ->click(self::$saveBannerEditPage);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The banner has been saved.',self::$assertSuccessMsg);
    }

    public function deleteStaticBlock($bannerName) {
        $I = $this->tester;
        $I->fillField(self::$filterBannerNameField,$bannerName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterBannersResult);
        $I->see($bannerName,self::$filterBannersResult);
        $I->click(self::$filterBannersResult);
        $I->waitForElement(self::$assertBannersPage);
        $I->see('Test Banner',self::$assertBannersPage);
        $I ->click(self::$saveBannerButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The banner has been deleted.',self::$assertSuccessMsg);
    }


    public static $filterIdFrom = '//*[@class="filter"]/th[2]//div[1]/input';
    public static $filterIdTo = '//*[@class="filter"]/th[2]//div[2]/input';
    public static $filterSortBannerName = '//*[@class="headings"]//th[3]/span/a';
    public static $filterStoreViewOpt4 = '//*[@class="filter"]/th[5]//optgroup[2]/option';

    public function variousFilter($bannerName,$IdFrom,$IdTo) {
        $I = $this->tester;
        $I->fillField(self::$filterBannerNameField,$bannerName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterBannersResult);
        $I->see($bannerName,self::$filterBannersResult);
        $I->fillField(self::$filterIdFrom,$IdFrom);
        $I->fillField(self::$filterIdTo,$IdTo);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click(self::$filterSortBannerName);
        $I->click(self::$filterStoreViewOpt4);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
    }

    public static $filterResultCheckbox = './/*[@class="grid"]//tbody/tr[1]/td[1]/input';
    public static $filterActionDeleteDropDown = '//*[@class="massaction"]//option[2]';
    public static $filterActionSubmitButton = './/*[@class="massaction"]//button';
    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';


    public function deleteFromActionMenu ($bannerName){
        $I = $this->tester;
        $I->fillField(self::$filterBannerNameField,$bannerName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterBannersResult);
        $I->see($bannerName,self::$filterBannersResult);
        $I->wait(2);
        $I->click(self::$filterResultCheckbox);
        $I->click(self::$filterActionDeleteDropDown);
        $I->click(self::$filterActionSubmitButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->wait(2);


    }





}