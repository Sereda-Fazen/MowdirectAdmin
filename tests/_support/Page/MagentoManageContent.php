<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 10.06.16
 * Time: 16:17
 */

namespace Page;


class MagentoManageContent
{

    public static $cmsDropDown = '//*[@class="nav-bar"]/ul/li[8]';
    public static $pagesDropDown = '//*[@class="nav-bar"]/ul/li[8]/ul/li[1]/a/span';
    public static $manageContent = '//*[@class="nav-bar"]/ul/li[8]/ul/li[1]/ul/li[1]/a/span';

// Manage Pages

    public static $addNewPageButton = '//*[@class="content-header"]//button';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $urlSearchField = '//*[@class="filter"]/th[2]//input';
    public static $titleSearchField = '//*[@class="filter"]/th[1]//input';
    public static $searchButton = '//*[@class="actions"]//button[2]';
    public static $resetFilterButton = '//*[@class="actions"]//button[1]';
    public static $urlColumnResult = '//*[@class="hor-scroll"]//td[2]';
    public static $titleColumnResult = '//*[@class="hor-scroll"]//td[1]';

// New Page

    public static $assertNewPage = '//*[@class="content-header"]/h3';
    public static $titleField = '//*[@class="hor-scroll"]/table//tr[1]/td[2]/input';
    public static $urlKeyField = '//*[@class="hor-scroll"]/table//tr[2]/td[2]/input';
    public static $allStoreView = '//*[@class="hor-scroll"]/table//tr[3]/td[2]//select/option[1]';
    public static $statusPublished = '//*[@class="form-list"]//tr[4]//option[1]';
    public static $underVerContrYes = '//*[@id="page_under_version_control"]/option[1]';
    public static $underVerContrNo = '//*[@id="page_under_version_control"]/option[2]';

    public static $contentLink = '//*[@class="side-col"]//li[2]';
    public static $assertContentHeading = '//*[@class="fieldset fieldset-wide"]//tr[1]/td[1]/label';
    public static $contentHeadingField = '//*[@class="fieldset fieldset-wide"]//tr[1]/td[2]/input';
    public static $pageContentField = '//*[@id="page_content"]';
    public static $savePageButton = '//*[@class="main-col-inner"]/div[2]//button[3]';

    public static $titleEditPage = '//*[@id="page_title"]';
    public static $urlEditPage = '//*[@id="page_identifier"]';
    public static $SaveEditPageButton = '//*[@class="main-col-inner"]/div[2]//button[5]';



    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToManagePage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDropDown);
        $I->waitForElement(self::$pagesDropDown);
        $I->moveMouseOver(self::$pagesDropDown);
        $I->waitForElement(self::$manageContent);
        $I->click(self::$manageContent);

    }


    public function createNewControlledPage ($title,$urlKey,$contentHeading,$content){
        $I = $this->tester;
        $I ->click(self::$addNewPageButton);
        $I->waitForElement(self::$assertNewPage);
        $I->see('New Page',self::$assertNewPage);
        $I->fillField(self::$titleField,$title);
        $I->fillField(self::$urlKeyField,$urlKey);
        $I->click(self::$allStoreView);
        $I->click(self::$statusPublished);
        $I->click(self::$underVerContrYes);
        $I->click(self::$contentLink);
        $I->waitForElement(self::$assertContentHeading);
        $I->see('Content Heading',self::$assertContentHeading);
        $I->fillField(self::$contentHeadingField,$contentHeading);
        $I->fillField(self::$pageContentField,$content);
        $I->click(self::$savePageButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The page has been saved.',self::$assertSuccessMsg);
        return $this;


    }


    public function createNewNonVersionControlledPage ($title,$urlKey,$contentHeading,$content){
        $I = $this->tester;
        $I ->click(self::$addNewPageButton);
        $I->waitForElement(self::$assertNewPage);
        $I->see('New Page',self::$assertNewPage);
        $I->fillField(self::$titleField,$title);
        $I->fillField(self::$urlKeyField,$urlKey);
        $I->click(self::$allStoreView);
        $I->click(self::$statusPublished);
        $I->click(self::$underVerContrNo);
        $I->click(self::$contentLink);
        $I->waitForElement(self::$assertContentHeading);
        $I->see('Content Heading',self::$assertContentHeading);
        $I->fillField(self::$contentHeadingField,$contentHeading);
        $I->fillField(self::$pageContentField,$content);
        $I->click(self::$savePageButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The page has been saved.',self::$assertSuccessMsg);
        return $this;
    }

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function searchPage ($urlKey)
    {
        $I = $this->tester;
        $I->fillField(self::$urlSearchField, $urlKey);
        $I->click(self::$searchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElement(self::$urlColumnResult);
    }

        public function changeNonVersionPage ($title1,$url1){

            $I = $this->tester;
            $I->click(self::$urlColumnResult);
            $I->waitForElement(self::$assertNewPage);
            $I->see('Edit Page', self::$assertNewPage);
            $I->fillField(self::$titleEditPage,$title1);
            $I->fillField(self::$urlEditPage,$url1);
            $I->click(self::$SaveEditPageButton);
            $I->waitForElement(self::$assertSuccessMsg);
            $I->see('The page has been saved.',self::$assertSuccessMsg);
            return $this;
        }


    public static $URL1 = '/test-url-1';
    public static $URL2 = '/test-non-url-1';
    public static $assertTitle= './/*[@class="page-title"]/h1';
    public static $assertText = './/*[@class="std"]';

    public function checkControlledVersionPage(){
        $I = $this->tester;
        $I->amOnPage(self::$URL1);
        $I->waitForElement(self::$assertTitle);
        $I->waitForElement(self::$assertText);
        $I->see('Test Heading',self::$assertTitle);
        $I->see('this is the test message',self::$assertText);
    }

    public function checkNonControlledVersionPage(){
        $I = $this->tester;
        $I->amOnPage(self::$URL2);
        $I->waitForElement(self::$assertTitle);
        $I->waitForElement(self::$assertText);
        $I->see('Test Heading non-version',self::$assertTitle);
        $I->see('this is the test message for non-version page',self::$assertText);
    }


    public function deletePage(){
        $I = $this->tester;
        $I->click(self::$urlColumnResult);
        $I->waitForElement(self::$assertNewPage);
        $I->see('Edit Page', self::$assertNewPage);
        $I->click(self::$savePageButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The page has been deleted.',self::$assertSuccessMsg);
    }

    public function searchFilter ($urlKey,$title)
    {
        $I = $this->tester;
        $I->fillField(self::$urlSearchField, $urlKey);
        $I->click(self::$searchButton);
        $I->waitForElement(self::$urlColumnResult);
        $I->click(self::$resetFilterButton);
        $I->fillField(self::$titleSearchField, $title);
        $I->click(self::$searchButton);
        $I->waitForElement(self::$titleColumnResult);
    }




}