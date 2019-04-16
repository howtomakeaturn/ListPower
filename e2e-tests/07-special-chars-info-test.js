require('dotenv').config()

import Page from './page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Special chars info test`;

test('the test', async t => {
  await page.login(t)

  const name = Math.random().toString(36).substring(7) + "'s test data"
  const info1 = 'http://fakeurl.com/?a=' + Math.floor(Math.random() * 10) + '&b=' + Math.floor(Math.random() * 10)
  const info2 = Math.random().toString(36).substring(7) + "'s info"

  await t
    .navigateTo(process.env.APP_URL)

    .click(Selector('.card-title').nth(-1))
    .click(Selector('.main .nav-item').nth(3))

    .typeText(Selector('input[name="name"]'), name, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(1), info1, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(2), info2, {paste: true, replace: true})

    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(info1)
    .expect(Selector('body').textContent).contains(info2)

  const nameModified = Math.random().toString(36).substring(7) + "'s test data"
  const info1Modified = 'http://fakeurl.com/?a=' + Math.floor(Math.random() * 10) + '&b=' + Math.floor(Math.random() * 10)
  const info2Modified = Math.random().toString(36).substring(7) + "'s info"

  await t
    .click(Selector('.btn-default').nth(1))

    .typeText(Selector('input[name="name"]'), nameModified, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(1), info1Modified, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(2), info2Modified, {paste: true, replace: true})

    .click(Selector('button[type="submit"]'))

    .navigateTo(process.env.APP_URL)
    .click(Selector('.card-title').nth(-1))
    .click(Selector('h6').nth(-1).find('a'))

    .expect(Selector('body').textContent).contains(nameModified)
    .expect(Selector('body').textContent).contains(info1Modified)
    .expect(Selector('body').textContent).contains(info2Modified)
});
