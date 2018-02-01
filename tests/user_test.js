Feature('Test user');

Before((I) => {
    I.amOnPage('/');
})

Scenario('Add a member', (I) => {
    I.click('Users');
    I.seeInCurrentUrl('/user');
    I.click('Add new');
    I.seeInCurrentUrl('/user/add');
    I.fillField('firstname', 'Robin');
    I.fillField('lastname', 'Regis');
    I.selectOption('company', 'ESGI');
    I.click('Submit');
    I.see('//table/tr[contains(Robin)]');
})

Scenario('Remove a member', (I) => {
})