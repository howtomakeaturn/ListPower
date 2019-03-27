require('dotenv').config()

import Page from './page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Create a new topic test`;

test('the test', async t => {
  await page.login(t)

  const name = 'test list #' + new Date().getTime()
  const description = 'description at #' + new Date().getTime()

  await t
    .navigateTo(process.env.APP_URL + '/create-list')

    .typeText(Selector('input[name="title"]'), name, {paste: true})
    .typeText(Selector('input[name="description"]'), description, {paste: true})
    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(description)
});
