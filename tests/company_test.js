Feature('Create company');

Before((I) => {
    I.amOnPage('/');
})

Scenario('Create a first company', (I) => {
    I.click('Companies');
    I.seeInCurrentUrl('/company');
    I.click('Add new');
    I.seeInCurrentUrl('/company/add');
    I.fillField('name', 'ESGI');
    I.fillField('address', '242 Rue du Faubourg Saint-Antoine');
    I.fillField('city', 'Paris');
    I.click('Submit');
    I.amOnPage('/company')
    I.waitForElement('table');
    I.see('ESGI', 'tr:last-child td:nth-child(2)');
    I.see('242 Rue du Faubourg Saint-Antoine', 'tr:last-child td:nth-child(3)');
    I.see('Paris', 'tr:last-child td:nth-child(4)');
});

Scenario('Create a second company', (I) => {
    I.click('Companies');
    I.seeInCurrentUrl('/company');
    I.click('Add new');
    I.seeInCurrentUrl('/company/add');
    I.fillField('name', 'IPSSI');
    I.fillField('address', '25 Rue Claude Tillier');
    I.fillField('city', 'Paris');
    I.click('Submit');
    I.amOnPage('/company')
    I.waitForElement('table');
    I.see('IPSSI', 'tr:last-child td:nth-child(2)');
    I.see('25 Rue Claude Tillier', 'tr:last-child td:nth-child(3)');
    I.see('Paris', 'tr:last-child td:nth-child(4)');
});

Scenario('Edit a company', (I) => {
    I.click('Companies');
    I.seeInCurrentUrl('/company');
    I.click('Edit', '//tr[last()]/td[last()]/a[contains(text(), "edit")]');
    I.fillField('city', 'To Erase');
    I.click('Submit');
    I.wait(3)
    I.waitForElement('table');
    I.see('To Erase', 'tr:nth-child(2) td:nth-child(4)');
});

Scenario('Delete a company', (I) => {
    I.click('Companies');
    I.seeInCurrentUrl('/company');
    I.click('Delete', '//tr[last()]/td[last()]/a[contains(text(), "delete")]');
    I.dontSee('To Erase')
});