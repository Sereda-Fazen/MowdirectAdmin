<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 28.06.16
 * Time: 9:41
 */

namespace Page;


class MagentoManageAttributes
{

    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';
    public static $attributesDown = '//*[@class="nav-bar"]/ul/li[3]/ul/li[3]/a/span';
    public static $manageAttributes = '//*[@class="nav-bar"]/ul/li[3]/ul/li[3]//li[1]/a/span';
    public static $manageAttributesSet = '//*[@class="nav-bar"]/ul/li[3]/ul/li[3]//li[2]/a/span';

// Manage Attributes
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $addNewAttributeButton = './/*[@class="middle"]/div/div[2]//button';

    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToManageAttributes() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$attributesDown);
        $I ->moveMouseOver(self::$attributesDown);
        $I->waitForElement(self::$manageAttributes);
        $I->click(self::$manageAttributes);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Manage Attributes',self::$assertDataPage);
        }

    public function goToManageAttributesSet() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$attributesDown);
        $I ->moveMouseOver(self::$attributesDown);
        $I->waitForElement(self::$manageAttributesSet);
        $I->click(self::$manageAttributesSet);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Manage Attribute Sets',self::$assertDataPage);
    }

 //Filters Block
    public static $filterAttributesCodeField = '//*[@class="filter"]/th[1]//input';
    public static $filterAttributesLabelField = '//*[@class="filter"]/th[2]//input';
    public static $filterRequiredYesDown = '//*[@class="filter"]/th[3]//option[2]';
    public static $filterRequiredNoDown = '//*[@class="filter"]/th[3]//option[3]';
    public static $filterSystemYesDown = '//*[@class="filter"]/th[4]//option[2]';
    public static $filterSystemNoDown = '//*[@class="filter"]/th[4]//option[3]';
    public static $filterVisibleYesDown = '//*[@class="filter"]/th[5]//option[2]';
    public static $filterVisibleNoDown = '//*[@class="filter"]/th[5]//option[3]';
    public static $filterScoreGlobalDown = '//*[@class="filter"]/th[6]//option[4]';
    public static $filterSearchableNosDown = '//*[@class="filter"]/th[7]//option[3]';
    public static $searchButton = '//*[@class = "actions"]//button[2]';
    public static $resetFilterButton = '//*[@class = "actions"]//button[1]';

// Result
    public static $filterAttributeCodeResult = '//*[@class="data"]//td[1]';
    public static $filterRequiredResult = '//*[@class="data"]//td[3]';
    public static $filterSystemResult = '//*[@class="data"]//td[4]';
    public static $filterVisibleResult = '//*[@class="data"]//td[5]';
    public static $filterScopeResult = '//*[@class="data"]//td[6]';


    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function variousFilter() {
        $I = $this->tester;
        $I->click(self::$filterRequiredNoDown);
        $I->click(self::$searchButton);
        $I->waitForElementVisible(self::$filterRequiredResult);
        $I->see('No',self::$filterRequiredResult);
        $I->click(self::$filterSystemNoDown);
        $I->click(self::$searchButton);
        $I->waitForElementVisible(self::$filterSystemResult);
        $I->see('No',self::$filterSystemResult);
        $I->click(self::$filterVisibleNoDown);
        $I->click(self::$searchButton);
        $I->waitForElementVisible(self::$filterVisibleResult);
        $I->see('No',self::$filterVisibleResult);
        $I->click(self::$resetFilterButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click(self::$filterScoreGlobalDown);
        $I->waitForElementVisible(self::$filterScopeResult);
        $I->see('Global',self::$filterScopeResult);
    }

    public static $attributeCodeField = '//*[@id="attribute_code"]';
    public static $scopeWebsiteDrDown = '//*[@id="is_global"]/option[2]';
    public static $applyToAllProdDown = '//*[@id="base_fieldset"]//tr[11]//select[1]/option[1]';
    public static $saveNewAttributeButton = '//*[@id="content"]//button[3]';
    public static $manageLabelOptionTab = '//*[@class="side-col"]//li[2]/a';
    public static $adminField = '//*[@class="main-col-inner"]//tr[2]/td[1]/input';

    public function addAttribute($attributeTestCode,$admin){
        $I = $this->tester;
        $I->click(self::$addNewAttributeButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Product Attribute',self::$assertDataPage);
        $I->fillField(self::$attributeCodeField,$attributeTestCode);
        $I->click(self::$applyToAllProdDown);
        $I->click(self::$manageLabelOptionTab);
        $I->waitForElementVisible(self::$adminField);
        $I->fillField(self::$adminField,$admin);
        $I->click(self::$saveNewAttributeButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The product attribute has been saved.',self::$assertSuccessMsg);
    }

    public function searchAttributeCode($attributeCode){
        $I = $this->tester;
        $I->fillField(self::$filterAttributesCodeField, $attributeCode);
        $I->click(self::$searchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementVisible(self::$filterAttributeCodeResult);
        $I->see($attributeCode, self::$filterAttributeCodeResult);
    }

    public static $saveEditButton = '//*[@id="content"]//button[4]';
    public static $deleteEditButton = '//*[@id="content"]//button[3]';

    public function editAttribute(){
        $I = $this->tester;
        $I->click(self::$filterAttributeCodeResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Product',self::$assertDataPage);
        $I->click(self::$scopeWebsiteDrDown);
        $I->click(self::$saveEditButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The product attribute has been saved.',self::$assertSuccessMsg);
    }

    public function deleteAttribute(){
        $I = $this->tester;
        $I->click(self::$filterAttributeCodeResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Product',self::$assertDataPage);
        $I->click(self::$deleteEditButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The product attribute has been deleted.',self::$assertSuccessMsg);
    }

    // New attribute set page
    public static $attributeSetNameField = '//*[@id="attribute_set_name"]';
    public static $saveAttributeSetButton = '//*[@class="middle"]//button[2]';

    public function addNewSet($attributeSet){
        $I = $this->tester;
        $I->click(self::$addNewAttributeButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Add New Attribute Set',self::$assertDataPage);
        $I->fillField(self::$attributeSetNameField,$attributeSet);
        $I->click(self::$saveAttributeSetButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('saved',self::$assertSuccessMsg);
    }

    // attribute set page
    public static $setNameField = '//*[@class="filter"]//input';
    public static $setNameResult = './/*[@class="data"]//td';
    public static $searchSetButton = '//*[@class="middle"]//button[2]';
    public static $resetFilterSetButton = '//*[@class="actions"]//button[1]';

    public function search($attributeSet){
        $I = $this->tester;
        $I->fillField(self::$setNameField,$attributeSet);
        $I->click(self::$searchSetButton);
        $I->waitForElementVisible(self::$setNameResult);
        $I->see($attributeSet,self::$setNameResult);
    }

    public function filterTests($attributeSet){
        $I = $this->tester;
        $I->fillField(self::$setNameField,$attributeSet);
        $I->click(self::$searchSetButton);
        $I->waitForElementVisible(self::$setNameResult);
        $I->see($attributeSet,self::$setNameResult);
        $I->click(self::$resetFilterSetButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
    }

    // Edit Attribute Page
    public static $addNewGroupButton = '//*[@class="middle"]/div/table/tbody/tr/td[2]//button[1]';
    public static $deleteNewGroupButton = '//*[@class="middle"]/div/table/tbody/tr/td[2]//button[2]';
    public static $deleteSetButton = '//*[@class="middle"]//button[3]';
    public static $groupTable = '//*[@class="middle"]/div/table/tbody/tr/td[2]/div[2]/ul/div';

 /*   public function addGroup($testGroup){
        $I = $this->tester;
        $I->click(self::$setNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Attribute Set',self::$assertDataPage);
        $I->click(self::$addNewGroupButton);
        $I->wait(3);
        $I->typeInPopup($testGroup);
        $I->wait(3);
    }
*/
    public function deleteSetAttribute(){
        $I = $this->tester;
        $I->click(self::$setNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Attribute Set',self::$assertDataPage);
        $I->click(self::$deleteSetButton);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The attribute set has been removed.',self::$assertSuccessMsg);
    }

    public function deleteSetGroup(){
        $I = $this->tester;
        $I->click(self::$setNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Attribute Set',self::$assertDataPage);
        $I->waitForElementVisible(self::$groupTable);
        $I->click('Google Shopping');
        $I->click(self::$deleteNewGroupButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->waitForElementNotVisible('Google Shopping');
        }

    public static $editGroup = '//*[@id="extdd-2"]';
    public static $editGroup2 = '//*[@id="ext-comp-1001"]';
    public static $editSetName = '//*[@id="attribute_set_name"]';

    public function editSetGroup(){
        $I = $this->tester;
        $I->click(self::$setNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Edit Attribute Set',self::$assertDataPage);
        $I->waitForElementVisible(self::$groupTable);
     //   $I->doubleClick(self::$editGroup);
        $I->click(self::$editGroup);
        $I->click(self::$editGroup);
        $I->wait(1);
        $I->fillField(self::$editGroup2,'Test');
        $I->click(self::$editSetName);
        $I->wait(2);
    //    $I->waitForElementNotVisible('Google Shopping');
    }












}