Feature('Create user');

Before((I) => {
    I.amOnPage('/');
});

Scenario('Create a user', (I) => {
    I.click('Users');
    I.seeInCurrentUrl('/user');
    I.click('Add new');
    I.seeInCurrentUrl('/user/add');
    I.fillField('firstname', 'Jean');
    I.fillField('lastname', 'Dupont');
    I.selectOption('Company', 'ESGI');
    I.click('Submit');
    I.amOnPage('/user')
    I.waitForElement('table');
    I.see('Jean', 'tr:last-child td:nth-child(2)');
    I.see('Dupont', 'tr:last-child td:nth-child(3)');
    I.see('ESGI', 'tr:last-child td:nth-child(4)');
});


Scenario('Edit a user', (I) => {
    I.click('Users');
    I.seeInCurrentUrl('/user');
    I.waitForElement('table');
    I.fillField('firstname', 'Jean');
    I.fillField('lastname', 'Dupont');
    I.selectOption('Company', 'IPSSI');
    I.click('Submit');
    I.click('Edit');
    I.amOnPage('/user')
    I.see('ESGI', 'tr:last-child td:nth-child(4)');
});

Scenario('Delete a member', (I) => {
    I.click('Users');
    I.seeInCurrentUrl('/user');
    I.click('Edit');
})
