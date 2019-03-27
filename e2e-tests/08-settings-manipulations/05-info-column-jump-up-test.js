require('dotenv').config()

import Page from '../page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Info column jump up test`;

test('the test', async t => {
  await page.login(t)

  const name = 'info column jump up list #' + new Date().getTime()
  const description = 'info column jump up list description at #' + new Date().getTime()

  await t
    .navigateTo(process.env.APP_URL + '/create-list')

    .typeText(Selector('input[name="title"]'), name, {paste: true})
    .typeText(Selector('input[name="description"]'), description, {paste: true})

    .click(Selector('.button-add-section'))

    .typeText(Selector('.info-section-setting-row').nth(1)
      .find('.info-column-setting-row').nth(0).find('input'), 'target column', {paste: true, replace: true})

    .click(
      Selector('.info-section-setting-row').nth(1)
        .find('.info-column-setting-row').nth(0).find('.up'))

    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(description)

  await t
    .click(Selector('.nav-item').nth(-1))

    .expect(
      Selector('.info-section-setting-row').nth(0)
        .find('.info-column-setting-row').nth(-1).find('input').value).eql('target column')

    .expect(
      Selector('.info-section-setting-row').nth(1)
        .find('.info-column-setting-row').nth(0).find('input').value).eql('資訊欄位2')
});
