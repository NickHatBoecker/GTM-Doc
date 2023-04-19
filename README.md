# GTM Doc

![All Your Tags On One Page - Google Tag Manager Documentation](https://github.com/NickHatBoecker/GTM-Doc/blob/master/public/img/gtm_doc_social_sm.jpg?raw=true)

GTM Doc is a utility created for Google's Tag Manager.<br>
Based on Symfony, [Google's PHP Client](https://github.com/googleapis/google-api-php-client) and Vue.js.

For non-technical users the Tag Manager interface is often confusing. That's why I developed GTM Doc. For those users the tags are the most important items of Google's Tag Manager. With GTM Doc you can inspect all your tags on one simple page.
## Features

- Simple and clean view of all your tags
- Inspect what's sent to Google Analytics (e.g. Eventcategory, -action and -label) 
- Define custom titles and descriptions
- Simply login with your Google account
- Open Source & free

Wanna try? [Check it out!](https://gtm.nick-hat-boecker.de)

## Technologies / Tools

- Backend
  - PHP 8.1
  - Symfony (PHP Framework, Backend)
  - Google PHP Client (Tag Manager API)
  - KnpUniversity oAuth2 Client Bundle (google login)
  
- Frontend
  - Node12
  - yarn
  - Vue.js (JS Framework)
  - Bootstrap Vue
  - AOS (animations)

## Install

```
$ git clone https://github.com/NickHatBoecker/GTM-Doc.git gtm-doc
$ cd gtm-doc
$ composer install
```

- Create a file called `.env.local`, put your `GOOGLE_CLIENT_ID` and `GOOGLE_CLIENT_SECRET` in it and save.
- Run `yarn`
- After this, use `yarn dev` to watch all files in dev mode or `yarn build` for production mode.

### With docker

```
$ git clone https://github.com/NickHatBoecker/GTM-Doc.git gtm-doc
$ cd gtm-doc/docker
$ ./docker-start.sh       # Start docker container
$ ./docker-login.sh php   # Log into docker shell
$ composer install
$ yarn
```

After this, use `yarn dev` to watch all files in dev mode or `yarn build` for production mode (not working in docker yet).

You can access the page via http://localhost:7800/

## Contributions

Please feel free to contribute. Leave a star, a ticket or a merge request. I'm looking forward to your suggestions and ideas. 
