Feature('Test company');

Before((I) => {
    I.amOnPage('/');
})

Scenario('Create a company', (I) => {
  	I.click('Companies');
  	I.seeInCurrentUrl('/company');
  	I.click('Add new');
    I.seeInCurrentUrl('/company/add');
  	I.fillField('name', 'ESGI');
  	I.fillField('address', '242 Rue du Faubourg Saint-Antoine');
  	I.fillField('city', 'Paris');
  	I.click('Submit');
    I.seeInCurrentUrl('/company');
    I.see({css: 'td'}, 'ESGI');
    /*
    I.amOnPage('/company')
  	I.see('ESGI', 'td')
  	I.seeElementESGI('tr:last td:nth-child(2)');
    I.seeElement("//td[contains('ESGI')]");
    */
});
/*
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
*/