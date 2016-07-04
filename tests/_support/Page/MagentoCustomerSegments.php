<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 23.06.16
 * Time: 10:08
 */

namespace Page;


class MagentoCustomerSegments

{

    public static $CustomersDown = '//*[@class="nav-bar"]/ul/li[5]';
    public static $customerSegment = '//*[@class="nav-bar"]/ul/li[5]/ul/li[4]/a/span';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';

// Static Banners Page
    public static $assertDataPage = '//*[@class="middle"]//h3';
    public static $assertDataFeedManagerPage = '//*[@class="middle"]//h3';
    public static $filterFileFormatSort = '//*[@class="headings"]//th[3]';
    public static $filterStatusActive = '//*[@class="filter"]/th[3]//option[2]';
    public static $filterStatusActiveResult = '//*[@class="data"]/tbody//td[3]';
    public static $filterSegmentNameResult = '//*[@class="data"]/tbody//td[2]';
    public static $filterStatusResult = '//*[@class="data"]/tbody//td[3]';
    public static $filterSearchButton = '//*[@class="actions"]//button[2]';
    public static $filterResetButton = '//*[@class="actions"]//button[1]';
    public static $filterSegmentField = '//*[@class="filter"]/th[2]//input';
    public static $filterIDField = '//*[@class="filter"]/th[1]//input';
    public static $filterIDResult = '//*[@class="data"]/tbody//td[1]';
    public static $filterWebsiteDropDown = '//*[@class="filter"]/th[4]//option[4]';
    public static $filterWebsiteResult = '//*[@class="data"]/tbody//td[4]';
    public static $addSegmentButton = '//*[@class="middle"]/div/div[2]//button';

// New Segment Page
    public static $assertSegmentPage = '//*[@id="content"]//h3';
    public static $segmentNameField = '//*[@id="segment_name"]';
    public static $segmentDescription = '//*[@id="segment_description"]';
    public static $assignedWebMainTable = '//*[@title="Assigned to Website"]/option[3]';
    public static $statusActiveDropDown = '//*[@id="segment_is_active"]/option[1]';
    public static $statusInactiveDropDown = '//*[@id="segment_is_active"]/option[2]';
    public static $saveNewSegmentButton = '//*[@id="content"]//button[3]';
//Edit Segment Page
    public static $saveEditPageButton = '//*[@id="content"]//button[5]';
    public static $deleteEditPageSegmentButton = '//*[@id="content"]//button[4]';

    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToManageSegmentsPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$CustomersDown);
        $I->waitForElement(self::$customerSegment);
        $I->click(self::$customerSegment);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Manage Segments',self::$assertDataPage);
    }

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';
    public function variousFilter($id) {
        $I = $this->tester;
        $I->click(self::$filterStatusActive);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterStatusActiveResult);
        $I->see('Active',self::$filterStatusActiveResult);
        $I->fillField(self::$filterIDField,$id);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterIDResult);
        $I->see('1', self::$filterIDResult);
        $I->click(self::$filterWebsiteDropDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterWebsiteResult);
        $I->see('Main Website',self::$filterWebsiteResult);
    }

    public function createNewSegment($segmentName,$segmentDescription) {
        $I = $this->tester;
        $I->click(self::$addSegmentButton);
        $I->waitForElementVisible(self::$assertSegmentPage);
        $I->see('New Segment',self::$assertSegmentPage);
        $I->fillField(self::$segmentNameField,$segmentName);
        $I->fillField(self::$segmentDescription,$segmentDescription);
        $I->click(self::$assignedWebMainTable);
        $I->click(self::$statusActiveDropDown);
        $I->click(self::$saveNewSegmentButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The segment has been saved.',self::$assertSuccessMsg);

    }

    public function searchSegment($segmentName)
    {
        $I = $this->tester;
        $I->fillField(self::$filterSegmentField, $segmentName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterSegmentNameResult);
        $I->see($segmentName,self::$filterSegmentNameResult);
        $I->click(self::$filterSegmentNameResult);
        $I->waitForElementVisible(self::$assertSegmentPage);
        $I->see('Edit Segment', self::$assertSegmentPage);
    }
    public function editSegment($segmentDescription)
    {
        $I = $this->tester;
        $I->fillField(self::$segmentDescription,$segmentDescription);
        $I->click(self::$statusInactiveDropDown);
        $I->click(self::$saveEditPageButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The segment has been saved.',self::$assertSuccessMsg);
        $I->waitForElement(self::$filterStatusResult);
        $I->see('Inactive',self::$filterStatusResult);
    }

    public function deleteSegment()
    {
        $I = $this->tester;
        $I->click(self::$deleteEditPageSegmentButton);
        $I->acceptPopup();
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The segment has been deleted.',self::$assertSuccessMsg);
    }


}