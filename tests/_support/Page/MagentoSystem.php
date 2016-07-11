<?php


namespace Page;

class MagentoSystem

{

    public static $loading = '//*[@id="loading_mask_loader"]';
    public static $assertSuccessMsg = '//*[@class="success-msg"]//li/span';

    public static $system = '//*[@class="nav-bar"]//li//span[text()="System"]';
    public static $permissions = '//*[@class="nav-bar"]//li//span[text()="System"]/../../ul//span[text()="Permissions"]';
    public static $users = '//*[@class="nav-bar"]//li//span[text()="System"]/../../ul//span[text()="Permissions"]/../../ul/li//span[text()="Users"]';
    public static $usersH3 = '//*[@class="content-header"]//h3[text()="Users"]';
    public static $addNewUser = '//*[@class="content-header"]//td/button//span[text()="Add New User"]';
    public static $save = '//*[@class="content-header"]//button//span[text()="Save User"]';

    public static $emptyUserName = '//*[@name="username"]/../div[contains(text(),"This")]';
    public static $userName = '//*[@name="username"]';

    public static $emptyFirstName = '//*[@name="firstname"]/../div[contains(text(),"This")]';
    public static $firstName = '//*[@name="firstname"]';

    public static $emptyLastName = '//*[@name="lastname"]/../div[contains(text(),"This")]';
    public static $lastName = '//*[@name="lastname"]';

    public static $emptyEmail = '//*[@name="email"]/../div[contains(text(),"This")]';
    public static $email = '//*[@name="email"]';

    public static $emptyPass = '//*[@name="password"]/../div[contains(text(),"This")]';
    public static $pass = '//*[@name="password"]';

    public static $emptyConfirmPass = '//*[@name="password_confirmation"]/../div[contains(text(),"This")]';
    public static $confirmPass = '//*[@name="password_confirmation"]';

    public static $userInfo = '//*[@class="columns "]//li//span[contains(text(),"User Info")]/../..//span[contains(@title, "This")]';

    public static $showNewUser = '//div[@class="grid"]//tbody//td[contains(text(),"Test")]/../td[contains(text(),"First Name")]/../td[contains(text(),"Last Name")]/../td[contains(text(),"")]/../td[contains(text(),"test@gmail.com")]';
    //edit
    public static $editUser = '//div[@class="grid"]//tbody//td[contains(text(),"Test Edit")]/../td[contains(text(),"First Name")]/../td[contains(text(),"Last Name")]/../td[contains(text(),"")]/../td[contains(text(),"test@gmail.com")]';
    //filter
    public static $searchEmail = '//*[@class="filter"]/.//input[@name="email"]';
    public static $search = '//*[@class="filter-actions a-right"]//button//span[text()="Search"]';
    //delete
    public static $deleteUser = '//div[@class="content-header"]//button//span[text()="Delete User"]';



    //role//
    public static $roles = '//*[@class="nav-bar"]//li//span[text()="System"]/../../ul//span[text()="Permissions"]/../../ul/li//span[text()="Roles"]';
    public static $roleH3 = '//*[@class="content-header"]//h3[text()="Roles"]';
    public static $addNewRole = '//*[@class="content-header"]//td/button//span[text()="Add New Role"]';
    public static $saveRole = '//*[@class="content-header"]//button//span[text()="Save Role"]';


    public static $emptyRole = '//*[@name="rolename"]/../div[contains(text(),"This")]';
    public static $role = '//*[@name="rolename"]';


    public static $roleInfo = '//*[@class="columns "]//li//span[contains(text(),"Role Info")]/../..//span[contains(@title, "This")]';

    public static $showNewRole = '//div[@class="grid"]//tbody//td[contains(text(),"Test Role")]';
    //edit
    public static $editRole = '//div[@class="grid"]//tbody//td[contains(text(),"Role Edit")]';
    //filter
    public static $searchRoleEnter = '//*[@class="filter"]/.//input[@name="role_name"]';
    public static $searchRole = '//*[@class="filter-actions a-right"]//button//span[text()="Search"]';
    //delete
    public static $deleteRole = '//div[@class="content-header"]//button//span[text()="Delete Role"]';




    protected $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I; // подкл. конструктора
    }

    public function goMagentoPermissions()
    {
        $I = $this->tester;
        $I->moveMouseOver(self::$system);
        $I->waitForElement(self::$permissions);
        $I->moveMouseOver(self::$permissions);
    }

    public function addNewUser(){

        $I =$this->tester;
        $I->waitForElement(self::$users);
        $I->click(self::$users);
        $I->waitForElement(self::$usersH3);

        $I->click(self::$addNewUser);
        $I->waitForElement(self::$save);
        $I->click(self::$save);
        $I->seeElement(self::$emptyUserName);
        $I->seeElement(self::$emptyFirstName);
        $I->seeElement(self::$emptyLastName);
        $I->seeElement(self::$emptyEmail);
        $I->seeElement(self::$emptyPass);
        $I->seeElement(self::$emptyConfirmPass);
        $I->seeElement(self::$userInfo);

        $I->fillField(self::$userName,'Test');
        $I->fillField(self::$firstName,'First Name');
        $I->fillField(self::$lastName,'Last Name');
        $I->fillField(self::$email, 'test@gmail.com');
        $I->fillField(self::$pass, 'test1234567');
        $I->fillField(self::$confirmPass, 'test1234567');
        $I->click(self::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The user has been saved.', self::$assertSuccessMsg);
        $I->waitForElement(self::$showNewUser);

    }

    public function filterUser()
    {
        $I = $this->tester;
        $I->fillField(self::$searchEmail, 'test@gmail.com');
        $I->click(self::$search);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->seeElement(self::$showNewUser);
    }


    public function editUser()
    {
        $I = $this->tester;
        $I->click(self::$showNewUser);
        $I->waitForElement(self::$firstName);
        $I->fillField(self::$userName,'Test Edit');
        $I->click(self::$save);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The user has been saved.',self::$assertSuccessMsg);
        $I->seeElement(self::$editUser);
    }

    public function deleteUser()
    {
        $I = $this->tester;
        $I->click(self::$editUser);
        $I->waitForElement(self::$deleteUser);
        $I->click(self::$deleteUser);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The user has been deleted.', self::$assertSuccessMsg);
        $I->waitForElementNotVisible(self::$editUser);
        $I->waitForElementNotVisible(self::$showNewUser);
    }


    /**
     * Role
     */

    public function addNewRole(){

        $I =$this->tester;
        $I->waitForElement(self::$roles);
        $I->click(self::$roles);
        $I->waitForElement(self::$roleH3);

        $I->click(self::$addNewRole);
        $I->waitForElement(self::$saveRole);
        $I->click(self::$saveRole);
        $I->seeElement(self::$emptyRole);
        $I->seeElement(self::$roleInfo);

        $I->fillField(self::$role,'Test Role');

        $I->click(self::$saveRole);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The role has been successfully saved.', self::$assertSuccessMsg);
        $I->waitForElement(self::$showNewRole);

    }

    public function filterRole()
    {
        $I = $this->tester;
        $I->fillField(self::$searchRoleEnter, 'Test Role');
        $I->click(self::$search);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->seeElement(self::$showNewRole);
    }

    public function editRole()
    {
        $I = $this->tester;
        $I->click(self::$showNewRole);
        $I->waitForElement(self::$role);
        $I->fillField(self::$role,'Role Edit');
        $I->click(self::$saveRole);
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The role has been successfully saved.',self::$assertSuccessMsg);
        $I->fillField(self::$searchRoleEnter, 'Role Edit');
        $I->click(self::$search);
        $I->waitForElementNotVisible(self::$loading,30);
        $I->seeElement(self::$editRole);
    }

    public function deleteRole()
    {
        $I = $this->tester;
        $I->click(self::$editRole);
        $I->waitForElement(self::$deleteRole);
        $I->click(self::$deleteRole);
        $I->acceptPopup();
        $I->waitForElement(self::$assertSuccessMsg);
        $I->see('The role has been deleted.', self::$assertSuccessMsg);
        $I->waitForElementNotVisible(self::$editRole);
        $I->waitForElementNotVisible(self::$showNewRole);
    }







}