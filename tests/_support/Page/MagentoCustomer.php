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
    }


    public function addNewCustomer()
    {
        $I = $this->tester;
        $I->waitForElement(self::$manageCustomers);
        $I->click(self::$manageCustomers);
        $I->waitForElement(self::$h3);
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



    // Edit

    public static $createOrder = '//*[@class="form-buttons"]/button//span[text()="Create Order"]';


    public function editCustomer(){
        $I = $this->tester;
        $I->waitForElement(self::$foundEmail);
        $I->click(self::$foundEmail);
        $I->waitForElement(self::$createOrder);
    }


    /**
     * Customers Group
     */

    //add group
    public static $customerGroup = '//*[@class="nav-bar"]//li//ul//a/span[text()="Customer Groups"]';
    public static $groupH3 = '//*[@class="content-header"]//h3[text()="Customer Groups"]';
    public static $addGroup = '//*[@class="content-header"]//td/button';
    public static $emptyGroup = '//*[@name="code"]/../div[contains(text(),"This")]';
    public static $max = '//*[@name="code"]/../div[contains(text(),"Text")]';
    public static $fieldGroup = '//*[@name="code"]';
    public static $saveGroup = '//*[@class="content-header"]//button//span[text()="Save Customer Group"]';

    //filter
    public static $foundNewGroup = '//*[@class="grid"]//tbody//tr/td[contains(text(),"Test")]';
    public static $groupFilter = '//*[@class="filter"]//div/input[@name="type"]';
    public static $searchGroup = '//*[@class="filter-actions a-right"]//button//span[text()="Search"]';
    public static $resetGroup = '//*[@class="filter-actions a-right"]//button//span[text()="Reset Filter"]';
    //edit

    public static $foundNewGroup2 = '//*[@class="grid"]//tbody//tr/td[contains(text(),"Edit")]';
    // delete

    public static $delete = '//div[@class="content-header"]//button//span[text()="Delete Customer Group"]';


    public function addGroup(){
        $I = $this->tester;
        self::goMagentoCustomer();
        $I->waitForElement(self::$moveCustomer);
        $I->moveMouseOver(self::$moveCustomer);
        $I->waitForElement(self::$customerGroup);
        $I->click(self::$customerGroup);
        $I->waitForElement(self::$groupH3);
        $I->click(self::$addGroup);
        $I->waitForElement(self::$fieldGroup);
        $I->click(self::$saveGroup);
        $I->seeElement(self::$emptyGroup);
        $I->fillField(self::$fieldGroup, 'Test Group Test Group Test Group Test Group Test Group Test Group');
        $I->click(self::$saveGroup);
        $I->seeElement(self::$max);
        $I->fillField(self::$fieldGroup, 'Test Group');
        $I->click(self::$saveGroup);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The customer group has been saved.' ,self::$assertSuccessMsg);
        $I->waitForElement(self::$foundNewGroup);

    }

    public function filterGroup()
    {
        $I = $this->tester;
        $I->waitForElement(self::$groupFilter);
        $I->fillField(self::$groupFilter, 'Test Group');
        $I->click(self::$searchGroup);
        try {
            $I->waitForElementNotVisible(self::$loading, 30);
        } catch (Exception $e){}
        $I->waitForElement(self::$foundNewGroup);
        $I->click(self::$resetGroup);
        try {
            $I->waitForElementNotVisible(self::$loading, 30);
        } catch (Exception $e){}
    }

    public function editGroup(){
        $I = $this->tester;
        $I->waitForElement(self::$foundNewGroup);
        $I->click(self::$foundNewGroup);
        $I->waitForElement(self::$fieldGroup);
        $I->fillField(self::$fieldGroup, 'Test Group Edit');
        $I->click(self::$saveGroup);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The customer group has been saved.' ,self::$assertSuccessMsg);
        $I->waitForElement(self::$foundNewGroup2);
        $I->click(self::$foundNewGroup2);
    }

    public function deleteGroup(){
        $I = $this->tester;
        $I->waitForElement(self::$delete);
        $I->click(self::$delete);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The customer group has been deleted.',self::$assertSuccessMsg);
    }

    /**
     * Invitations
     */
    public static $customerInvitations = '//*[@class="nav-bar"]//li//ul//a/span[text()="Invitations"]';
    public static $invitations = '//*[@class="content-header"]//h3[text()="Manage Invitations"]';

    public static $saveInvitation = '//*[@class="content-header"]//button//span[text()="Save"]';
    public static $emptyEmailInvitation = '//*[@name="email"]/../div[contains(text(),"This")]';
    public static $fieldEmail = '//*[@name="email"]';
    public static $searchEmail = '//input[@name="email"]';
    public static $view = '//*[@class="content-header"]//h3[contains(text(),"View")]';
    public static $statusHistory = '//*[@class="columns "]//li//span[text()="Status History"]';
    public static $sent = '//*[@class="note-list"]/li//strong[text()="Sent"]/../../li/strong[text()="Not Sent"]';
    public static $back = '//*[@class="content-header"]//button/span//span[text()="Back"]';

    public static $foundEmailInvitations = '//*[@class="grid"]//tbody//tr/td[contains(text(),"test_mowdirect@yahho.co.uk")]';
    public static $emailInvitation = '//*[@class="grid"]//tbody//tr/td[contains(text(),"test_mowdirect@yahho.co.uk")]/../td[contains(text(),"Sent")]/../td/input';
    public static $emailInvitation1 = '//*[@class="grid"]//tbody//tr/td[contains(text(),"test_mowdirect@yahho.co.uk")]/../td[contains(text(),"Sent")]';
    public static $error = '//div[@id="messages"]';
    public static $discardedInvitation = '//*[@class="grid"]//tbody//tr/td[contains(text(),"test_mowdirect@yahho.co.uk")]/../td[contains(text(),"Discarded")]/../td/input';


    public function addInvitations()
    {
        $I = $this->tester;
        self::goMagentoCustomer();
        $I->waitForElement(self::$customerInvitations);
        $I->click(self::$customerInvitations);
        $I->waitForElement(self::$invitations);
        $I->click(static::$addGroup);
        $I->waitForElement(self::$saveInvitation);
        $I->click(self::$saveInvitation);
        $I->seeElement(self::$emptyEmailInvitation);
        $I->fillField(self::$fieldEmail, 'test_mowdirect@yahho.co.uk');
        $I->click(self::$saveInvitation);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('1 invitation(s) were sent.', self::$assertSuccessMsg);
        $I->waitForElement(self::$foundEmailInvitations);
    }
    public function resentAnInvitation(){
        $I = $this->tester;
        $I->waitForElement(self::$searchEmail);
        $I->fillField(self::$searchEmail, 'test_mowdirect');
        $I->click(static::$searchGroup);
        $I->waitForElement(self::$emailInvitation);
        $I->click(self::$emailInvitation);
        $I->selectOption(static::$actions, 'Send Selected');
        $I->click(static::$submit);
        $I->waitForElement(self::$error);
        $I->see('No invitations have been resent',self::$error);
    }
    public function viewAnInvitation(){
        $I = $this->tester;
        $I->waitForElement(self::$emailInvitation1);
        $I->click(self::$emailInvitation1);
        $I->waitForElement(self::$view);
        $I->click(self::$statusHistory);
        $I->waitForElement(self::$sent);
        $I->click(self::$back);
    }
    
    public function discardAnInvitation(){
        $I = $this->tester;
        $I->waitForElement(self::$emailInvitation);
        $I->click(self::$emailInvitation);
        $I->selectOption(static::$actions, 'Discard Selected');
        $I->click(static::$submit);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('1 of 1 invitations were discarded.', self::$assertSuccessMsg);
        $I->waitForElement(self::$discardedInvitation);


    }



}