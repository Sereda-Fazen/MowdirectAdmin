<?php


namespace Page;


use Exception;

class MagentoCustomer

{

    public static $loading = '//*[@id="loading_mask_loader"]';

    public static $moveCustomer = '//*[@class="nav-bar"]//li//span[text()="Customers"]';
    public static $manageCustomers = '//*[@class="nav-bar"]//li//ul//a/span[text()="Manage Customers"]';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';
    public static $h3 = '//*[@class="content-header"]//h3[text()="Manage Customers"]';

    //new customer
    public static $addCustomer = '//*[@class="content-header"]//td/button';
    public static $associate = '//*[@class="form-list"]//select';

    public static $firstName = '//*[@name="account[firstname]"]';
    public static $emptyFirstName = '//*[@name="account[firstname]"]/../div[contains(text(),"This")]';

    public static $lastName = '//*[@name="account[lastname]"]';
    public static $emptyLastName = '//*[@name="account[lastname]"]/../div[contains(text(),"This")]';

    public static $testEmail = '//*[@name="account[email]"]';
    public static $emptyEmail = '//*[@name="account[email]"]/../div[contains(text(),"This")]';

    public static $password = '//*[@name="account[password]"]';
    public static $emptyPass = '//*[@name="account[password]"]/../div[contains(text(),"This")]';


    public static $saveCustomer = '//*[@class="content-header"]//button//span[text()="Save Customer"]';



    public static $email ='//*[@class="grid"]//tbody//tr/td[contains(text(),"testEmail@gmail.com")]/../td/input';



    protected $tester;
    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goMagentoCustomer()
    {
        $I = $this->tester;
        $I->waitForElement(self::$moveCustomer);
        $I->moveMouseOver(self::$moveCustomer);
        $I->waitForElement(self::$manageCustomers);
        $I->click(self::$manageCustomers);
        $I->waitForElement(self::$h3);
    }





    public function addNewCustomer()
    {
        $I = $this->tester;
        $I->click(self::$addCustomer);
        $I->waitForElement(self::$associate);
        $I->click(self::$saveCustomer);
        $I->seeElement(self::$emptyFirstName);
        $I->seeElement(self::$emptyLastName);
        $I->seeElement(self::$emptyEmail);
        $I->seeElement(self::$emptyPass);

        $I->selectOption(self::$associate, 'Admin');
        $I->fillField(self::$firstName, 'Test Name');
        $I->fillField(self::$lastName, 'Test Last Name');
        $I->fillField(self::$testEmail, 'testEmail@gmail.com');
        $I->fillField(self::$password, '123456');
        $I->waitForElement(self::$saveCustomer);
        $I->click(self::$saveCustomer);
        $I->waitForElementNotVisible(self::$loading, 30);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The customer has been saved.', self::$assertSuccessMsg);
        $I->waitForElement(self::$email);
    }


    //public static $foundEmail = '//*[@class="grid"]//tbody//tr/td[contains(text(),"mowdirect@gmail.com")]/../td/input';
    public static $filterName = '//*[@class="filter"]/th//input[@name="name"]';
    public static $filterEmail = '//*[@class="filter"]/th//input[@name="email"]';
    public static $filterGroup = '//*[@class="filter"]/th//select[@name="group"]';
    public static $search = '//*[@id="customerGrid"]//td/button//span[text()="Search"]';
    public static $resetFilter = '//*[@id="customerGrid"]//td/button//span[text()="Reset Filter"]';
    public static $foundName = '//*[@class="grid"]//tbody//tr/td[contains(text(),"Test Name")]';
    public static $foundEmail = '//*[@class="grid"]//tbody//tr/td[contains(text(),"testEmail@gmail.com")]';
    public static $foundGroup = '//*[@class="grid"]//tbody//tr/td[contains(text(),"Test Name")]/../td[contains(text(),"General")]';







    public function filtersName(){
        $I = $this->tester;
        $I->waitForElement(self::$filterName);
        $I->fillField(self::$filterName, 'Test Name');
        $I->click(self::$search);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$foundName);
        $I->click(self::$resetFilter);
        $I->waitForElementNotVisible(self::$loading,30);
    }
    public function filtersEmail(){
        $I = $this->tester;
        $I->waitForElement(self::$filterEmail);
        $I->fillField(self::$filterEmail, 'testEmail@gmail.com');
        $I->click(self::$search);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$foundEmail);
        $I->click(self::$resetFilter);
        $I->waitForElementNotVisible(self::$loading,30);
    }
    public function filtersGroup(){
        $I = $this->tester;
        $I->waitForElement(self::$filterGroup);
        $I->selectOption(self::$filterGroup, 'General');
        $I->click(self::$search);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->waitForElement(self::$foundGroup);
        $I->click(self::$resetFilter);
        $I->waitForElementNotVisible(self::$loading,30);
    }




    public static $actions = '//div[@class="right"]//select';
    public static $submit = '//div[@class="right"]//button//span[text()="Submit"]';
    public static $group = '//div[@class="entry-edit"]//select/../..//span[3]//select';




    public function checkSubscribe($actions){
        $I = $this->tester;
        $I->click(self::$email);
        $I->waitForElement(self::$actions);
        $I->selectOption(self::$actions, $actions);
        $I->waitForElement(self::$submit);
        $I->click(self::$submit);
        try{$I->acceptPopup();} catch (Exception $e){}
        $I->waitForElement(self::$assertSuccessMsg);

        $msg = $I->grabTextFrom('//div[@id="messages"]');
        $I->comment($msg);
        if (preg_match('/updated/i', $msg) == 1){
            $I->see('Total of 1 record(s) were updated.', '//div[@id="messages"]');
        } else {
            $I->see('Total of 1 record(s) were deleted.', '//div[@id="messages"]');
        }
    }

    public function checkGroup($actions, $group){
        $I = $this->tester;
        $I->click(self::$email);
        $I->waitForElement(self::$actions);
        $I->selectOption(self::$actions, $actions);
        $I->waitForElement(self::$group);
        $I->selectOption(self::$group, $group);
        $I->waitForElement(self::$submit);
        $I->click(self::$submit);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('Total of 1 record(s) were updated.',self::$assertSuccessMsg);
    }

    
}