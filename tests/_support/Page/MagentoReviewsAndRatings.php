<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 29.06.16
 * Time: 9:59
 */

namespace Page;


class MagentoReviewsAndRatings
{
    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';

    public static $reviewAndRatingsDown = '//*[@class="nav-bar"]/ul/li[3]/ul/li[8]';
    public static $customerReviewDown = '//*[@class="nav-bar"]/ul/li[3]/ul/li[8]/ul/li[1]/a/span';
    public static $manageRatings = '//*[@class="nav-bar"]/ul/li[3]/ul/li[8]/ul/li[2]/a/span';
    public static $pendingReview = '//*[@class="nav-bar"]/ul/li[3]/ul/li[8]/ul/li[1]/ul/li[1]/a/span';
    public static $allReviews = '//*[@class="nav-bar"]/ul/li[3]/ul/li[8]/ul/li[1]/ul/li[2]/a/span';

// Pending Reviews Page
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';



    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToPendingReviews() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$reviewAndRatingsDown);
        $I ->moveMouseOver(self::$reviewAndRatingsDown);
        $I->waitForElement(self::$customerReviewDown);
        $I ->moveMouseOver(self::$customerReviewDown);
        $I->waitForElement(self::$pendingReview);
        $I->click(self::$pendingReview);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Pending Reviews',self::$assertDataPage);
    }

    public function goToAllReviews() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$reviewAndRatingsDown);
        $I ->moveMouseOver(self::$reviewAndRatingsDown);
        $I->waitForElement(self::$customerReviewDown);
        $I ->moveMouseOver(self::$customerReviewDown);
        $I->waitForElement(self::$allReviews);
        $I->click(self::$allReviews);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('All Reviews',self::$assertDataPage);
    }

    public function goToManageRatings() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$reviewAndRatingsDown);
        $I ->moveMouseOver(self::$reviewAndRatingsDown);
        $I->waitForElement(self::$manageRatings);
        $I->click(self::$manageRatings);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Manage Ratings',self::$assertDataPage);
    }


// Filter Fields Pending Reviews Page
    public static $filterIDField = '//*[@class="filter"]/th[2]//input';
    public static $filterSearchButton = '//*[@class="middle"]/div/div[3]/div/table//button[2]';
    public static $filterResetFilterButton = '//*[@class="middle"]/div/div[3]/div/table//button[1]';
    public static $resultID = '//*[@class="data"]//td[2]';
    public static $actionDeleteDown = '//*[@class="right"]//option[2]';
    public static $actionSubmitButton = '//*[@class="right"]//button';
    public static $actionUpdateStatusDown = '//*[@class="right"]/div[1]//option[3]';
    public static $actionPendingDown = './/*[@id="status"]/option[3]';

    public static $filterVisibleInMowdirectDown = '//*[@class="filter"]//th[7]//optgroup[7]/option';
    public static $filterTypeGuestPendingDown = '//*[@class="filter"]//th[8]//option[4]';

    public static $resultVisibleIn = '//*[@class="data"]//td[7]';
    public static $resultPendingType = '//*[@class="data"]//td[8]';
    public static $resultCheckbox1 = '//*[@class="data"]//tbody/tr[1]/td[1]/input';
    public static $result1Link = '//*[@class="data"]//tr[1]/td[7]';


    public function updateStatus() {
        $I = $this->tester;
        $I->click(self::$resultCheckbox1);
        $I->click(self::$actionUpdateStatusDown);
        $I->wait(1);
        $I->click(self::$actionPendingDown);
        $I->click(self::$actionSubmitButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('have been updated.',self::$assertSuccessMsg);

    }

    public function variousFilterPendingReviewsPage () {
        $I = $this->tester;
        $I->click(self::$filterVisibleInMowdirectDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultVisibleIn);
        $I->click(self::$filterTypeGuestPendingDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultPendingType);
        $I->click(self::$filterResetFilterButton);
        $I->wait(2);
    }


    //Edit Review Page

    public static $editReviewField = '//*[@id="detail"]';
    public static $editSaveReviewHeaderButton = './/*[@class="middle"]//button[4]';
    public static $header = '//*[@class="header-top"]';

    public function editReview ($review) {
        $I = $this->tester;
        $I->click(self::$result1Link);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Review',self::$assertDataPage);
        $I->fillField(self::$editReviewField,$review);
        $I->scrollTo(self::$header);
        $I->click(self::$editSaveReviewHeaderButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('saved.',self::$assertSuccessMsg);
        $I->wait(2);
    }







// Filter Fields All Reviews Page
    public static $filterTypeGuestDown = '//*[@class="filter"]//th[9]//option[4]';
    public static $resultType = '//*[@class="data"]//td[9]';
    public static $filterStatusApprovedDown = '//*[@class="filter"]//th[4]//option[2]';
    public static $resultStatus = '//*[@class="data"]//td[4]';
    public static $filterVisibleInAgriFabDown = '//*[@class="filter"]//th[8]//optgroup[2]/option';
    public static $resultVisibleInAgriFab = '//*[@class="data"]//td[8]';

    public function variousFilterAllReviewsPage() {
        $I = $this->tester;
        $I->click(self::$filterStatusApprovedDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultStatus);
        $I->click(self::$filterVisibleInAgriFabDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultVisibleInAgriFab);
        $I->click(self::$filterTypeGuestDown);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultType);

    }




    // All Reviews Page
    public static $addNewReviewButton = '//*[@class="middle"]/div/div[2]//button';

    public function addNewReview (){
        $I = $this->tester;
        $I->click(self::$addNewReviewButton);
        $I->waitForElementVisible(self::$assertDataPage);
    }


/////Manage Ratings Page

    //New Rating Page
    public static $defaultValueField = '//*[@id="rating_code"]';
    public static $ratingVisibleInAgriFab = '//*[@id="stores"]/optgroup[2]/option';
    public static $newSaveRatingButton = '//*[@id="content"]/div/div[2]//button[3]';
    public static $editSaveRatingButton = '//*[@id="content"]/div/div[2]//button[4]';
    public static $sortOrderField = '//*[@id="position"]';

    public function addNewRating($value){
        $I = $this->tester;
        $I->click(self::$addNewReviewButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Rating',self::$assertDataPage);
        $I->fillField(self::$defaultValueField,$value);
        $I->click(self::$ratingVisibleInAgriFab);
        $I->click(self::$newSaveRatingButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('saved.',self::$assertSuccessMsg);
    }

    public static $filterRatingNameField = '//*[@class="filter"]//th[2]//input';
    public static $resultRatingName = './/*[@class="data"]//tr//td[2]';

    public function searchRatingName($ratingName){
        $I = $this->tester;
        $I->fillField(self::$filterRatingNameField,$ratingName);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$resultRatingName);
        $I->see($ratingName,self::$resultRatingName);
    }

    public function editRating($sortOrder){
        $I = $this->tester;
        $I->click(self::$resultRatingName);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Rating',self::$assertDataPage);
        $I->fillField(self::$sortOrderField,$sortOrder);
        $I->click(self::$editSaveRatingButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('saved.',self::$assertSuccessMsg);
    }

    public function deleteRating(){
        $I = $this->tester;
        $I->click(self::$resultRatingName);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Rating',self::$assertDataPage);
        $I->click(self::$newSaveRatingButton);
        $I->acceptPopup();
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('deleted.',self::$assertSuccessMsg);
    }







}