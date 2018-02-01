Feature('Create company');

Before((I) => {
    I.amOnPage('/');
})

Scenario('Create an company', (I) => {
      I.click('Companies');
      I.seeInCurrentUrl('/company');
      I.click('Add new');
      I.seeInCurrentUrl('/company/add');
      I.fillField('name', 'ESGI');
      I.fillField('address', '242 Rue du Faubourg Saint-Antoine');
      I.fillField('city', 'Paris');
      I.click('Submit');
      I.seeInCurrentUrl('/company');
      I.see('ESGI', 'tr:last-child td:nth-child(2)');
      I.see('242 Rue du Faubourg Saint-Antoine', 'tr:last-child td:nth-child(3)');
      I.see('Paris', 'tr:last-child td:nth-child(4)');
});
