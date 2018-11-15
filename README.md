# Testing GraphQL + PHP

## I wanted to understand how to do the following:

### Get different sets of data depending on permission (e.g. an admin gets all data where an assistant gets partial data)
Yes, you can manipulate the data based on different permission in your resolver (or preferably in your business logic layer).
### Get calculated data (e.g. a user has first- and last name but one attribute is the non-persisted full name)
Yes, you can derive and add attributes to the object you return in your resolver.
### Evolve the schema by removing a field
Yes, you can mark an attribute as deprecated and migrate users to use other fields or methods. After a while you can remove the field all together.
### Document the API
Yes, you can add something similar to a docblock for your types, fields and methods. There is also a tool called [graphdoc](https://github.com/2fd/graphdoc) that generates nice HTML documentation.
### Subscribe to a list of contracts and receive updates when new contracts are created
I didn't have time to get this working

## Installing requirements (Debian)

```bash
composer install && sudo apt install sqlite3 php-sqlite
```

## Running the application

```bash
php test.php
```

## Testing with Chrome

Install ChromeiQL and open it. Set endpoint to `http://127.0.0.1:8080`

### Getting 'secret' data

Set endpoint to `http://127.0.0.1:8080?user=tomas`

## Generating documentation

```bash
sudo npm install -g @2fd/graphdoc
graphdoc -e http://localhost:8080 -o ./doc/schema
firefox doc/schema/index.html
```

## Resources
* http://graphql.org/
* https://siler.leocavalcante.com/graphql/
* https://github.com/chentsulin/awesome-graphql
