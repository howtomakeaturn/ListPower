require('dotenv').config()

import Page from './page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Edit an entity test`;

test('the test', async t => {
  await page.login(t)

  await t
    .navigateTo(process.env.APP_URL)

    .click(Selector('.card-title').nth(-1))

    .click(Selector('h6').nth(-1))

    .click(Selector('.btn-default').nth(1))

  const name = 'modified data #' + new Date().getTime()
  const info1 = 'modified info1 at #' + new Date().getTime()
  const info2 = 'modified info2 at #' + new Date().getTime()

  await t
    .typeText(Selector('input[name="name"]'), name, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(1), info1, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(2), info2, {paste: true, replace: true})

    .click(Selector('button[type="submit"]'))

    .navigateTo(process.env.APP_URL)
    .click(Selector('.card-title').nth(-1))
    .click(Selector('h6').nth(-1))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(info1)
    .expect(Selector('body').textContent).contains(info2)
});
