
<img  src="https://website.devlopy.tn/assets/images/black-logo.png">

  

## Introduction

  

Dinvoice is an app that helps you track expenses, payments & create professional invoices & estimates.

  

Web Application is made using Laravel & VueJS.

  

# Installation
1.  Clone the repository.
2.  Install Yarn globally if you haven't installed that already , for more information please refer this  [link(opens new window)](https://classic.yarnpkg.com/en/docs/install)
3.  After installing Yarn globally , run  `yarn`  command inside your cloned folder, it will download all the required dependencies.
4.  Run  `yarn dev`  to generate the public files (do  `yarn production`  if you wish to use it on production).
5.  Install composer to your system and run  `composer install`  inside your cloned folder to install all laravel/php dependencies.
6.  Create an  `.env`  file by running the following command:  `cp .env.example .env`. Or alternately you can just copy  `.env.example`  file to the same folder and re-name it to  `.env`.
7.  run command:  `php artisan key:generate`  to generate a unique application key.
8.  Open the link to the domain in the browser (Example:  `https://dinvoice.com`) and complete the installation wizard as directed.

### Point the domain to the uploaded folder
Point your domain or subdomain to the  `public`  directory inside the Crater folder.

Please note that, Crater must be installed on a primary domain or subdomain. Installing on a sub-folder will not work, for example:

-   `example.com/dinvoice`  (Invalid)
-   `localhost/dinvoice`  (Invalid)
-   `example.com`  (Valid)
-   `dinvoice.example.com`  (Valid)

#### To achieve that result in localhost (eg: xampp):
- Add  '127.0.0.1       dinvoice.com' to C:\Windows\System32\drivers\etc\hosts 
- Add  'DocumentRoot "D:/xampp/htdocs/dinvoice.com/public"' to C:\xampp\apache\conf\extra\httpd-vhosts.conf
  
  

## Discord
Don't forget to join the Devlopy discord server:

[Invite Link](https://discord.gg/ZAJ7nVFn)

  

## Roadmap

  

~~Here's a rough roadmap of things to come (not in any specific order):

  

-  [x] Automatic Update

-  [x] Email Configuration

-  [x] Installation Wizard

-  [x] Address Customisation & Default notes

-  [x] Edit Email before Sending Invoice

-  [x] Available as a docker image

-  [x] Performance Improvements

-  [x] Customer View page

-  [x] Add and Use Custom Fields on Invoices & Estimates.

- [ ] Add stamp Fields on Invoices.

- [ ] Multiple Companies.

- [ ] Vendors, Inventory & Bills.

- [ ] Recurring Invoices & Payment Reminders.

- [ ] Accept Payments (paymee Integration).

  

## Credits

  

Dinvoice is a product of [Devlopy](https://devlopy.tn).