require('dotenv').config()

import Page from '../page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Change review column order test`;

test('the test', async t => {
  await page.login(t)

  const name = 'review column order changed list #' + new Date().getTime()
  const description = 'review column order changed list description at #' + new Date().getTime()

  await t
    .navigateTo(process.env.APP_URL + '/create-list')

    .typeText(Selector('input[name="title"]'), name, {paste: true})
    .typeText(Selector('input[name="description"]'), description, {paste: true})

    .click(Selector('.review-column-setting-row').nth(0).find('.down'))
    .click(Selector('.review-column-setting-row').nth(2).find('.up'))

    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(description)

  await t
    .click(Selector('.nav-item').nth(-1))
    .expect(Selector('.review-column-setting-row').nth(0).find('input').value).eql('評分欄位2')
    .expect(Selector('.review-column-setting-row').nth(1).find('input').value).eql('評分欄位3')
    .expect(Selector('.review-column-setting-row').nth(2).find('input').value).eql('評分欄位1')
});
