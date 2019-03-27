require('dotenv').config()

import Page from './page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Edit a topic test`;

test('the test', async t => {
  await page.login(t)

  const name = 'modified list #' + new Date().getTime()
  const description = 'modified description at #' + new Date().getTime()

  await t
    .navigateTo(process.env.APP_URL)

    .click(Selector('.card-title').nth(-1))
    .click(Selector('.nav-item').nth(-1))

    .typeText(Selector('input[name="title"]'), name, {paste: true, replace: true})
    .typeText(Selector('input[name="description"]'), description, {paste: true, replace: true})
    .click(Selector('button[type="submit"]'))

    .click(Selector('.container .nav-item').nth(0))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(description)
});
