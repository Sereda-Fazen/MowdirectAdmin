<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 23.06.16
 * Time: 10:53
 */

namespace Page;


class MagentoManageProducts
{

    public static $catalogDown = '//*[@class="nav-bar"]/ul/li[3]';
    public static $manageProducts = '//*[@class="nav-bar"]/ul/li[3]/ul/li[1]/a/span';
    public static $bulkSyncDown = '//*[@class="nav-bar"]/ul/li[7]/ul/li[5]/ul/li[2]';
    public static $newsletterExport = '//*[@class="nav-bar"]/ul/li[7]/ul/li[5]/ul/li[2]/ul/li[1]';

// Manage Products Page
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $assertDataPage = '//*[@class="middle"]//div[2]//h3';
    public static $filterEditResult = '//*[@class="data"]/tbody//td[12]//a';
    public static $filterNameSort = '//*[@class="headings"]//th[3]';
    public static $filterNameField = '//*[@class="filter"]/th[3]//input';
    public static $filterNameResult = '//*[@class="data"]/tbody//td[3]';
    public static $filterCheckboxResult = '//*[@class="data"]/tbody//td[1]/input';
    public static $filterSearchButton = '//*[@class="actions"]//button[2]';
    public static $filterQtyFrom = '//*[@class="filter"]/th[8]/div/div[1]/input';
    public static $filterQtyTo = '//*[@class="filter"]/th[8]/div/div[2]/input';
    public static $filterQtyResult = '//*[@class="data"]/tbody//td[8]';
    public static $filterIdFrom = '//*[@class="filter"]/th[2]/div/div[1]/input';
    public static $filterIdTo = '//*[@class="filter"]/th[2]/div/div[2]/input';
    public static $filterIdResult = '//*[@class="data"]/tbody//td[2]';
    public static $filterSkuField = '//*[@class="filter"]/th[6]//input';
    public static $filterResetButton = '//*[@class="actions"]//td[2]/button[1]';
    public static $filterStatusEnable = '//*[@class="filter"]/th[10]//option[1]';
    public static $filterStatusResult = '//*[@class="data"]/tbody//td[10]';
    public static $filterWebsiteMainWebsite = '//*[@class="filter"]/th[11]//option[4]';
    public static $filterWebsiteResult = '//*[@class="data"]/tbody//td[11]';
    public static $filterTypeSimpleProduct = '//*[@class="filter"]/th[4]//option[2]';
    public static $filterTypeResult = '//*[@class="data"]/tbody//td[4]';
    //action menu
    public static $changeStatusActionDropDown = '//*[@method="post"]//option[3]';
    public static $changeUpdateAtr='//*[@method="post"]//option[4]';
    public static $disableStatusActionDropDown = './/*[@class="right"]//span[3]//option[3]';
    public static $submitActionButton = '//*[@method="post"]//button';
    public static $actionDeleteButton = '//*[@method="post"]//option[2]';

    public static $addProductButton = '//*[@class="middle"]/div/div[2]//button[1]';


    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goToManageProductsPage() {
        $I = $this->tester;
        $I ->moveMouseOver(self::$catalogDown);
        $I->waitForElement(self::$manageProducts);
        $I->click(self::$manageProducts);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Manage Products',self::$assertDataPage);
    }

    public function variousFilter() {
        $I = $this->tester;
        $I->click(self::$filterStatusEnable);
        $I->click(self::$filterSearchButton);
        $I->wait(2);
        $I->waitForElementVisible(self::$filterStatusResult);
        $I->see('Enabled',self::$filterStatusResult);
        $I->click(self::$filterWebsiteMainWebsite);
        $I->click(self::$filterSearchButton);
        $I->wait(2);
        $I->waitForElementVisible(self::$filterWebsiteResult);
        $I->see('Main Website',self::$filterWebsiteResult);
        $I->click(self::$filterNameSort);
        $I->wait(2);
        $I->click(self::$filterTypeSimpleProduct);
        $I->click(self::$filterSearchButton);
        $I->wait(2);
        $I->waitForElementVisible(self::$filterTypeResult);
        $I->see('Simple Product',self::$filterTypeResult);
    }

    // New Page
    public static $attributeSetDefault = '//*[@class="form-list"]//tr[1]//td[2]//option[39]';
    public static $attributeSetAccessoriesToys = '//*[@class="form-list"]//tr[1]//td[2]//option[2]';
    public static $productTypeSimple = '//*[@class="form-list"]//tr[2]//td[2]//option[1]';
    public static $continueButton = '//*[@class="form-list"]//button';
    public static $nameField = '//*[@id="name"]';
    public static $descriptionField = '//*[@id="description"]';
    public static $shortDescriptionField ='//*[@id="short_description"]';
    public static $skuField = '//*[@id="sku"]';
    public static $weightField = '//*[@id="weight"]';
    public static $statusEnable = '//*[@id="status"]/option[2]';
    public static $newPageSaveButton = '//*[@id="content"]/div//button[3]';
    //Price tab
    public static $priceTab = '//*[@class="side-col"]//li[2]';
    public static $priceField = '//*[@id="price"]';
    public static $taxClassNone ='//*[@id="tax_class_id"]/option[2]';
    //manufactures tab
    public static $manufacturesTab = '//*[@class="side-col"]//li[9]';
    public static $manufacturesDropDown = '//*[@id="manufacturer"]/option[2]';
    //Edit Page
    public static $editPageSaveButton = '//*[@id="content"]/div//button[5]';
    public static $editDuplicateButton = '//*[@id="content"]/div//button[4]';
    public static $editBackButton = '//*[@id="content"]/div//button[1]';
    public static $resetButton = '//*[@id="content"]/div//button[2]';
    public static $nameFieldValue = '//*[@value="simple test product"]';
    public static $createAttributeButton = '//*[@class="main-col"]//form/div[3]/div/div[1]//button';

    public function addSimpleProduct($name,$description,$shortDescription,$sku,$weight,$price){
        $I = $this->tester;
        $I->click(self::$addProductButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Product',self::$assertDataPage);
        $I->click(self::$attributeSetDefault);
        $I->see('Default',self::$attributeSetDefault);
        $I->click(self::$productTypeSimple);
        $I->see('Simple Product',self::$productTypeSimple);
        $I->click(self::$continueButton);
        $I->waitForElementVisible(self::$nameField);
        $I->fillField(self::$nameField,$name);
        $I->fillField(self::$descriptionField,$description);
        $I->fillField(self::$shortDescriptionField,$shortDescription);
        $I->fillField(self::$skuField,$sku);
        $I->fillField(self::$weightField,$weight);
        $I->click(self::$statusEnable);
        $I->click(self::$priceTab);
        $I->waitForElementVisible(self::$priceField);
        $I->fillField(self::$priceField,$price);
        $I->click(self::$taxClassNone);
        $I->click(self::$manufacturesTab);
        $I->waitForElementVisible(self::$manufacturesDropDown);
        $I->click(self::$manufacturesDropDown);
        $I->click(self::$newPageSaveButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The product has been saved.',self::$assertSuccessMsg);
    }

    public function addSimpleProductCustomerAttributes($name,$description,$shortDescription,$sku,$weight,$price){
        $I = $this->tester;
        $I->click(self::$addProductButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('New Product',self::$assertDataPage);
        $I->click(self::$attributeSetAccessoriesToys);
        $I->see('Accessories – Toys',self::$attributeSetAccessoriesToys);
        $I->click(self::$productTypeSimple);
        $I->see('Simple Product',self::$productTypeSimple);
        $I->click(self::$continueButton);
        $I->waitForElementVisible(self::$nameField);
        $I->fillField(self::$nameField,$name);
        $I->fillField(self::$descriptionField,$description);
        $I->fillField(self::$shortDescriptionField,$shortDescription);
        $I->fillField(self::$skuField,$sku);
        $I->fillField(self::$weightField,$weight);
        $I->click(self::$statusEnable);
        $I->click(self::$priceTab);
        $I->waitForElementVisible(self::$priceField);
        $I->fillField(self::$priceField,$price);
        $I->click(self::$taxClassNone);
        $I->click(self::$manufacturesTab);
        $I->waitForElementVisible(self::$manufacturesDropDown);
        $I->click(self::$manufacturesDropDown);
        $I->click(self::$newPageSaveButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The product has been saved.',self::$assertSuccessMsg);
    }

    public function searchName($name){
        $I = $this->tester;
        $I->fillField(self::$filterNameField, $name);
        $I->click(self::$filterSearchButton);
        $I->waitForElementVisible(self::$filterNameResult);
        $I->see($name, self::$filterNameResult);
        $I->wait(2);
    }

    public function editAProductLink(){
        $I = $this->tester;
        $I->click(self::$filterEditResult);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function editAProduct($sku,$weight){
        $I = $this->tester;
        $I->click(self::$filterNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->fillField(self::$skuField,$sku);
        $I->fillField(self::$weightField,$weight);
        $I->click(self::$editPageSaveButton);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The product has been saved.',self::$assertSuccessMsg);
    }

    public function changeStatus(){
        $I = $this->tester;
        $I->click(self::$filterCheckboxResult);
        $I->click(self::$changeStatusActionDropDown);
        $I->click(self::$disableStatusActionDropDown);
        $I->click(self::$submitActionButton);
        $I->wait(2);
        $I->waitForElement(self::$filterStatusResult);
        $I->see('Disable',self::$filterStatusResult);
        }

// Update attributes page
    public static $nameCheckbox = '//*[@id="name-checkbox"]';

    public function updateAttributes($name){
        $I = $this->tester;
        $I->click(self::$filterCheckboxResult);
        $I->click(self::$changeUpdateAtr);
        $I->click(self::$submitActionButton);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('Update attributes',self::$assertDataPage);
        $I->click(self::$nameCheckbox);
        $I->wait(1);
        $I->fillField(self::$nameField,$name);
        $I->click(self::$newPageSaveButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        }

    public function duplicate(){
        $I = $this->tester;
        $I->click(self::$filterNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see('simple test attribute product',self::$assertDataPage);
        $I->click(self::$editDuplicateButton);
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('The product has been duplicated.',self::$assertSuccessMsg);
        $I->click(self::$editBackButton);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    public function resetUpdates($name,$nameOld){
        $I = $this->tester;
        $I->click(self::$filterNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->see($nameOld,self::$assertDataPage);
        $I->fillField(self::$nameField,$name);
        $I->click(self::$resetButton);
        $I->waitForElementVisible(self::$nameFieldValue);
        $I->click(self::$editBackButton);
        $I->waitForElementVisible(self::$assertDataPage);
    }

    //Attribute page
    public static $attributeName = './/*[@id="attribute_code"]';
    public static $test11 = './/*[@xmlns=\'http://www.w3.org/1999/xhtml\']';

    public function createAnAttribute(){
        $I = $this->tester;
        $I->click(self::$filterNameResult);
        $I->waitForElementVisible(self::$assertDataPage);
        $I->click(self::$createAttributeButton);
        $I->wait(3);
    //    $I->waitForElementVisible(self::$assertDataPage);
    //    $I->see('New Product Attribute',self::$assertDataPage);


    }

    public function deleteTestProducts(){
        $I = $this->tester;
        $I->click('Select All');
        $I->click(self::$actionDeleteButton);
        $I->click(self::$submitActionButton);
        $I->acceptPopup();
        $I->waitForElementVisible(self::$assertSuccessMsg);
        $I->see('have been deleted.',self::$assertSuccessMsg);
}




}