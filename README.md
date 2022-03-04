# backend

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)
* [Modules](#modules)


## General info
Application is meant to manage users, products and users likes for products.

## Technologies
* Symfony 5.4
* PHP 7.4
* Apache

## Setup
To install project you need to use
`composer install`

Before using application database URL should be configured like below:
`DATABASE_URL="mysql://db_user:db_password@db_address:db_port/db_name?serverVersion=5.7`

It's good to have that in env file separate from project's `.env` file that od ignored by git like `.env.local`.

After that application should be working.

## Modules
Application consists of three modules to separate specifica parts of the project.
These modules are:

### User
#### List
`/user/list`
List of users. Their names, logins and account statuses are shown here. For every user you can access user edit page or delete them.
User list can be filtered by their first name, last name and login.
User creation form is accessible from there.

#### Add
`/user/add`
User creation form that consists of fields for user's first name, last name, login and account status.
After submission page redirects to user list.

#### Edit
`/user/edit/{person}`
User edit form with the same fields like creation form with addition of delete button.
After submission page redirects to user list.

#### Delete
`/user/delete/{person}`
Sets user account as deleted and redirects to user list.

### Product
#### List
`/product/list`
List of products, their names and descriptions are shown here. For every product you can access user edit page or delete them.
Product list can be filtered by their name and description.
Product creation form is accessible from there.

#### Add
`/product/add`
Product creation form that consists of fields for product's name, publication date and description.
After submission page redirects to product list.

#### Edit
`/product/edit/{product}`
Product edit form with the same fields like creation form with addition of delete button.
After submission page redirects to product list.

#### Delete
`/product/delete/{product}`
Sets user account as deleted and redirects to user list.
All product likes are also deleted.

### Like
#### List
`/like/list`
List of likes. Users and their liked products are shown here. For every like you can access like edit page or delete them.
Like list can be filtered by user (first name, last name or login) and product name.
Like creation form is accessible from there.

#### Add
`/like/add`
Like creation form that consists of select fields for user and product.
After submission page redirects to like list.

#### Edit
`/like/edit/{person}`
Like edit form with the same fields like creation form with addition of delete button.
After submission page redirects to like list.

#### Delete
`/like/delete/{person}`
Deletes user's product like and redirects to like list.
