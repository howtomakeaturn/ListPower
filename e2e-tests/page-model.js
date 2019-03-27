import { Selector } from 'testcafe';
require('dotenv').config()

export default class Page {
  constructor () {
    //
  }

  async login (t) {
    await t
      .useRole(regularUser)
  }
}

import { Role } from 'testcafe';

/*
const regularUser = Role(process.env.APP_URL + '/login', async t => {
  await t
    .click(Selector('a'))
    .typeText(Selector('input[name="login"]'), process.env.E2E_TEST_ACCOUNT_EMAIL, {paste: true})
    .typeText(Selector('input[name="password"]'), process.env.E2E_TEST_ACCOUNT_PASSWORD, {paste: true})
    .click(Selector('input[name="commit"]'))
});
*/

const regularUser = Role(process.env.APP_URL + '/a-very-secret-really-dangerous-url-for-testing', async t => {
  //
});
