require('dotenv').config()

import Page from '../page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Info column jump down test`;

test('the test', async t => {
  await page.login(t)

  await t
    .navigateTo(process.env.APP_URL)

    .click(Selector('.card-title').nth(-1))
    .click(Selector('.nav-item').nth(-1))

    .click(
      Selector('.info-section-setting-row').nth(0)
        .find('.info-column-setting-row').nth(-1).find('.down'))

    .click(Selector('button[type="submit"]'))

  await t
    .click(Selector('.nav-item').nth(-1))

    .expect(
      Selector('.info-section-setting-row').nth(1)
        .find('.info-column-setting-row').nth(0).find('input').value).eql('target column')

    .expect(
      Selector('.info-section-setting-row').nth(0)
        .find('.info-column-setting-row').nth(-1).find('input').value).eql('資訊欄位3')
});
