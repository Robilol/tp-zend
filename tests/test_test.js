
Feature('Create company');

Scenario('test create a company', (I) => {
	I.amOnPage('/');
  	I.click('Companies');
  	I.click('Add new');
  	I.fillField('name', 'ESGI');
  	I.fillField('address', 'rue nation');
  	I.fillField('city', 'Paris');
  	I.click('Submit');
  	I.see('ESGI', 'td');
});
