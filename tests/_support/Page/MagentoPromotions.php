<?php


namespace Page;


use Exception;

class MagentoPromotions

{

    public static $loading = '//*[@id="loading_mask_loader"]';

    public static $movePromotions = '//*[@class="nav-bar"]//li//span[text()="Promotions"]';
    public static $managePromotions = '//*[@class="nav-bar"]//li//ul//a/span[text()="Catalog Price Rules"]';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $h3 = '//*[@class="content-header"]//h3[text()="Catalog Price Rules"]';
    public static $addRule = '//*[@class="content-header"]//td/button//span[text()="Add New Rule"]';
    public static $save = '//*[@class="content-header"]//button//span[text()="Save"]';
    public static $emptyName = '//*[@name="name"]/../div[contains(text(),"This")]';
    public static $name = '//*[@name="name"]';
    public static $doesNotSelectWebSite = '//*[@name="website_ids[]"]/../../div[contains(text(),"This")]';
    public static $selectWebSite = '//select[@name="website_ids[]"]';
    public static $doesNotSelectGroup = '//*[@name="customer_group_ids[]"]/.././div[contains(text(),"This")]';
    public static $selectGroup = '//select[@name="customer_group_ids[]"]';

    public static $ruleError = '//*[@class="columns "]//a/span/span[contains(@title,"This")]';
    public static $actionsError = '//*[@class="columns "]//li//span[contains(text(),"Actions")]/../..//span[contains(@title, "This")]';
    public static $actions = '//*[@name="discount_amount"]/../div[contains(text(),"This")]';
    public static $actionsField = '//*[@name="discount_amount"]';
    public static $enterNumber = '//*[@name="discount_amount"]/../div[contains(text(),"Please")]';
    public static $showRule = '//div[@id="promo_catalog_grid"]//div//tbody//td[contains(text(),"Test Rule")]/../td[contains(text(),"Main Website")]';
    public static $showEditRule = '//div[@id="promo_catalog_grid"]//div//tbody//td[contains(text(),"Test Edit Rule")]/../td[contains(text(),"Main Website")]';
    public static $deleteRule = '//*[@class="content-header"]//button//span[text()="Delete"]';




    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goMagentoPromotions()
    {
        $I = $this->tester;
        $I->waitForElement(self::$movePromotions);
        $I->moveMouseOver(self::$movePromotions);
    }


    public function addNewRule()
    {
        $I = $this->tester;
        $I->waitForElement(self::$managePromotions);
        $I->click(self::$managePromotions);
        $I->waitForElement(self::$h3);
        $I->waitForElement(self::$addRule);
        $I->click(self::$addRule);
        $I->waitForElement(self::$save);
        $I->click(self::$save);
        $I->seeElement(self::$emptyName);
        $I->seeElement(self::$doesNotSelectWebSite);
        $I->seeElement(self::$doesNotSelectGroup);
        $I->seeElement(self::$ruleError);
        $I->seeElement(self::$actionsError);
        $I->fillField(self::$name, 'Test Rule');
        $I->selectOption(self::$selectWebSite, 'Main Website');
        $I->selectOption(self::$selectGroup,'General');
        $I->click(self::$save);
        $I->waitForElement(self::$actions);
        $I->seeElement(self::$actions);
        $I->fillField(self::$actionsField, 'Test Discount');
        $I->click(self::$save);
        $I->seeElement(self::$enterNumber);
        $I->fillField(self::$actionsField, '10');
        $I->click(self::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The rule has been saved.',self::$assertSuccessMsg);
        $I->waitForElement(self::$showRule);
    }

    public function editRule()
    {
        $I = $this->tester;
        $I->click(self::$showRule);
        $I->fillField(self::$name, 'Test Edit Rule');
        $I->click(self::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The rule has been saved.', self::$assertSuccessMsg);
        $I->waitForElement(self::$showEditRule);
    }

    public function removeRule()
    {
        $I = $this->tester;
        $I->click(self::$showEditRule);
        $I->waitForElement(self::$deleteRule);
        $I->click(self::$deleteRule);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The rule has been deleted.', self::$assertSuccessMsg);
        $I->waitForElementNotVisible(self::$showEditRule);
    }

    /**
     * Shopping Basket Price Rules
     */

    public static $shoppingBasketPriceRules = '//*[@class="nav-bar"]//li//ul//a/span[text()="Shopping Basket Price Rules"]';
    public static $shoppingH3 = '//*[@class="content-header"]//h3[text()="Shopping Basket Price Rules"]';


    public function addNewShoppingRule(){
        $I = $this->tester;
        self::goMagentoPromotions();
        $I->waitForElement(self::$shoppingBasketPriceRules);
        $I->click(self::$shoppingBasketPriceRules);
        $I->waitForElement(self::$shoppingH3);
        $I->click(static::$addRule);
        $I->waitForElement(static::$save);
        $I->click(static::$save);
        $I->seeElement(static::$emptyName);
        $I->seeElement(static::$doesNotSelectWebSite);
        $I->seeElement(static::$doesNotSelectGroup);
        $I->seeElement(static::$ruleError);
        $I->fillField(static::$name, 'Test Shopping Rule');
        $I->selectOption(static::$selectWebSite, 'Main Website');
        $I->selectOption(static::$selectGroup,'General');
        $I->click(static::$save);
        $I->waitForElement(static::$assertSuccessMsg);
        $I->see('The rule has been saved.',static::$assertSuccessMsg);
        $I->waitForElement(static::$showRule);


    }
}