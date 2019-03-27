require('dotenv').config()

import Page from '../page-model';

const page = new Page();

import { Selector } from 'testcafe';

fixture `Address test`;

test('the test', async t => {
  await page.login(t)

  const name = 'List for address test #' + new Date().getTime()
  const description = 'description at #' + new Date().getTime()

  await t
    .navigateTo(process.env.APP_URL + '/create-list')

    .typeText(Selector('input[name="title"]'), name, {paste: true})
    .typeText(Selector('input[name="description"]'), description, {paste: true})

    .click(Selector('.info-column-setting-row').nth(0).find('select'))
    .click(Selector(Selector('.info-column-setting-row').nth(0).find('select').find('option').withText('地址')))

    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(description)

  const dataName = 'data #' + new Date().getTime()
  const address = '台北市大安區羅斯福路四段1號'
  const info2 = 'info2 at #' + new Date().getTime()

  await t
    .click(Selector('.nav-item').nth(-3))

    .typeText(Selector('input[name="name"]'), name, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(1), address, {paste: true, replace: true})
    .typeText(Selector('input[type="text"]').nth(2), info2, {paste: true, replace: true})

    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(name)
    .expect(Selector('body').textContent).contains(address)
    .expect(Selector('body').textContent).contains(info2)
    .expect(Selector('iframe').getAttribute('src')).contains('https://www.google.com/maps/embed/v1/place')

  const newAddress = '台北市大安區和平東路一段162號'

  await t
    .click(Selector('.btn-default').nth(1))

    .expect(Selector('input[type="text"]').nth(1).value).eql(address)

    .typeText(Selector('input[type="text"]').nth(1), newAddress, {paste: true, replace: true})
    .click(Selector('button[type="submit"]'))

    .expect(Selector('body').textContent).contains(newAddress)
});
