Feature('Create user');

Before((I) => {
    I.amOnPage('/');
})

Scenario('Create an user', (I) => {
    I.click('Users');
    I.seeInCurrentUrl('/user');
    I.click('Add new');
    I.seeInCurrentUrl('/user/add');
    I.fillField('firstname', 'Jean');
    I.fillField('lastname', 'Dupont');
    I.selectOption('Company', 'ESGI');
    I.click('Submit');
    I.see('Dupont', 'td');
    I.seeInCurrentUrl('/user');
    I.see('Jean', 'tr:last-child td:nth-child(2)');
    I.see('Dupont', 'tr:last-child td:nth-child(3)');
    I.see('ESGI', 'tr:last-child td:nth-child(4)');
});

/*
Scenario('Remove a member', (I) => {
})
*/