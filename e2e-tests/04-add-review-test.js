require('dotenv').config()

import Page from './page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Add a review test`;

test('the test', async t => {
  await page.login(t)

  await t
    .navigateTo(process.env.APP_URL)

    .click(Selector('.card-title').nth(-1))

    .click(Selector('h6').nth(-1))

    .click(Selector('.btn-default').nth(0))

  await t
    .click(Selector('select').nth(0))
    .click(Selector('select').nth(0).find('option').withAttribute('value','1'))

    .click(Selector('select').nth(1))
    .click(Selector('select').nth(1).find('option').withAttribute('value','5'))

    .click(Selector('button[type="submit"]'))

    .navigateTo(process.env.APP_URL)
    .click(Selector('.card-title').nth(-1))
    .click(Selector('h6').nth(-1))

    .expect(Selector('body').textContent).contains('1.0')
    .expect(Selector('body').textContent).contains('5.0')
    .expect(Selector('body').textContent).contains('0.0')
});
