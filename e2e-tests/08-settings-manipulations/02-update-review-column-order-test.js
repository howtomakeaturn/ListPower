require('dotenv').config()

import Page from '../page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Update review column order test`;

test('the test', async t => {
  await page.login(t)

  await t
    .navigateTo(process.env.APP_URL)

    .click(Selector('.card-title').nth(-1))
    .click(Selector('.nav-item').nth(-1))

    .click(Selector('.review-column-setting-row').nth(0).find('.down'))
    .click(Selector('.review-column-setting-row').nth(2).find('.up'))

    .click(Selector('button[type="submit"]'))

  await t
    .click(Selector('.nav-item').nth(-1))
    .expect(Selector('.review-column-setting-row').nth(0).find('input').value).eql('評分欄位3')
    .expect(Selector('.review-column-setting-row').nth(1).find('input').value).eql('評分欄位1')
    .expect(Selector('.review-column-setting-row').nth(2).find('input').value).eql('評分欄位2')
});
