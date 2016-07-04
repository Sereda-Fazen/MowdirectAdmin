<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 16.06.16
 * Time: 11:00
 */

namespace Page;


class MagentoStaticBlocks
{

    public static $cmsDropDown = '//*[@class="nav-bar"]/ul/li[8]';
    public static $staticBlock = '//*[@class="nav-bar"]/ul/li[8]/ul/li[3]/a/span';

// Static Block Page
    public static $assertStaticBlocksPage = '//*[@class="content-header"]//h3';
    public static $addNewBlockButton = '//*[@class="middle"]/div/div[2]//button';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//span';
    public static $filterSearchButton = '//*[@class="actions"]//button[2]';
    public static $filterResetButton = '//*[@class="actions"]//button[1]';
    public static $filterTitleField = '//*[@class="filter"]/th[1]//input';
    public static $filterTitleTable = './/*[@class="data"]/tbody//td[1]';

// New Block Page
    public static $titleBlockField = '//*[@id="block_title"]';
    public static $identifierField = '//*[@id="block_identifier"]';
    public static $storeViewAllStoreView = '//*[@id="block_store_id"]/option';
    public static $contentField = '//*[@id="block_content"]';
    public static $saveBlockButton = '//*[@class="form-buttons"]/button[3]';

// Edit Block Page
    public static $saveEditBlockButton = '//*[@class="form-buttons"]/button[4]';

    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }
    public function goToStaticBlocksPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$cmsDropDown);
        $I->waitForElement(self::$staticBlock);
        $I->click(self::$staticBlock);
        $I->waitForElement(self::$assertStaticBlocksPage);
        $I->see('Static Blocks',self::$assertStaticBlocksPage);
    }

    public function createNewStaticBlock($title,$identifier,$content) {
        $I = $this->tester;
        $I ->click(self::$addNewBlockButton);
        $I->waitForElement(self::$assertStaticBlocksPage);
        $I->see('New Block',self::$assertStaticBlocksPage);
        $I->fillField(self::$titleBlockField,$title);
        $I->fillField(self::$identifierField,$identifier);
        $I ->click(self::$storeViewAllStoreView);
        $I->fillField(self::$contentField,$content);
        $I ->click(self::$saveBlockButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The block has been saved.',self::$assertSuccessMsg);
    }

    public function editStaticBlock($title,$title1) {
        $I = $this->tester;
        $I->fillField(self::$filterTitleField,$title);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$filterTitleTable);
        $I->see($title,self::$filterTitleTable);
        $I->click(self::$filterTitleTable);
        $I->waitForElement(self::$assertStaticBlocksPage);
        $I->see('Edit Block',self::$assertStaticBlocksPage);
        $I->fillField(self::$titleBlockField,$title1);
     //   $I->fillField(self::$contentField,$content);
        $I ->click(self::$saveEditBlockButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The block has been saved.',self::$assertSuccessMsg);
    }

    public function deleteStaticBlock($title) {
        $I = $this->tester;
        $I->fillField(self::$filterTitleField,$title);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$filterTitleTable);
        $I->see($title,self::$filterTitleTable);
        $I->click(self::$filterTitleTable);
        $I->waitForElement(self::$assertStaticBlocksPage);
        $I->see('Edit Block',self::$assertStaticBlocksPage);
        $I ->click(self::$saveBlockButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The block has been deleted.',self::$assertSuccessMsg);
    }

    public static $filterSearchResult = '//*[@class="data"]/tbody/tr[1]/td[2]';
    public static $filterDataCreatedFrom = '//*[@class="filter"]/th[5]/div/div[1]//input';
    public static $filterDataCreatedTo = '//*[@class="filter"]/th[5]/div/div[2]//input';
    public static $filterLastModFrom = '//*[@class="filter"]/th[6]/div/div[1]//input';
    public static $filterLastModTo = '//*[@class="filter"]/th[6]/div/div[2]//input';
    public static $filterIdentifier ='//*[@class="headings"]/th[2]/span';
    public static $filterIdentifierField = '//*[@class="filter"]/th[2]//input';
    public static $filterStoreViewOpt5 = '//*[@class="filter"]/th[3]//optgroup[4]/option';

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function variosFilter($identifier,$dataCreatedFrom,$dataCreatedTo,$lastModFrom,$lastModTo) {
        $I = $this->tester;
        $I->fillField(self::$filterIdentifierField,$identifier);
        $I->click(self::$filterSearchButton);
        $I->waitForElement(self::$filterSearchResult);
        $I->see($identifier,self::$filterSearchResult);
        $I->click(self::$filterResetButton);
        $I->fillField(self::$filterDataCreatedFrom,$dataCreatedFrom);
        $I->fillField(self::$filterDataCreatedTo,$dataCreatedTo);
        $I->fillField(self::$filterLastModFrom,$lastModFrom);
        $I->fillField(self::$filterLastModTo,$lastModTo);
        $I->click(self::$filterSearchButton);
        $I->click(self::$filterIdentifier);
        $I->click(self::$filterResetButton);
        $I->click(self::$filterStoreViewOpt5);
        $I->click(self::$filterSearchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
    }

}