## Articles Dashboard App

Articles Dashboard Dashboard App is a a simple platform consists of two user types (Editor, Writer) where they has the ablity to create, edit, and publish an articles.

## Functional Requirements
### Writer
         Actions:
            [x] Create article (on click submit, must automatically set Article Status Field to "For Edit"), 
            [x] Edit an unpublish article (can only edit articles where Status is "For Edit") 
         Pages:
              Writer's Dashboard
                  [x] Must show 2 list of articles: For Edit (Status is "For Edit") and Published (Status is "Published")
                  [x] Each item of For Edit Articles list must show a badge or status of the article.
                  [x] Each item of both lists must display the following fields: Image, Title, Link, Date, Writer Name and Editor Name
              All Media
                [x] Show all articles being created in tabular display and must show the following columns: 
                      actions (includes the edit action), image, title, link, writer, editor, status 
                [x]RESTRICT the writer to edit a published article

### Editor
        Actions: 
            [x] Edit and Publish articles 
            [x] In Edit Article Form, there must be 2 buttons "Save" and "Publish", 
                where if clicked on Save, will update the record 
                else if clicked on Publish, will update the record and also sets the Status to "Publish"
            [x] Ability to manage users (create and updating)
            [x] Ability to mange companies (create and updating)
        Pages: 
            Editor's Dashboard
                [x] Must show 2 list of articles: For Publish (Status is "For Edit") and Published (Status is "Published")
                [x] Each item of both lists must display the following fields: Image, Title, Link, Date, Writer Name and Editor Name
            All Media
                [x] Show all articles being created in tabular display and must show the following columns: 
                        actions (includes the edit action), image, title, link, writer, editor, status 
                [x] RESTRICT the writer to edit a published article

## About the Developer
This is a Coding Solution for Articles Dashboard App of Kieffer John M. Navarro.

## How to install the app locally
- Make sure Composer, Node.js and XAMPP is installed on your local device.
- Clone the repository using this link [https://github.com/kjmnavarro/dashboard-articles.git](https://github.com/kjmnavarro/dashboard-articles.git)

```

git clone https://github.com/kjmnavarro/dashboard-articles.git

```

- Open the folder of the newly cloned code repo to a command prompt (GitBash for Windows, Terminal for Linux)
- You need to install composer and npm before running other Laravel scripts.

```

composer install
npm install

```

- After installing composer and npm, copy the .env.example file to .env and configure your database and other settings:

```

cp .env.example .env

```

- After copying .env.example to .env, Open the .env file and update the following lines:

```

DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host
MAIL_PORT=your_mail_port
MAIL_USERNAME=your_mail_username
MAIL_PASSWORD=your_mail_password
MAIL_ENCRYPTION=your_mail_encryption
MAIL_FROM_ADDRESS=your_mail_from_address

```

- After opening and updating .env, you can now generate application key via php artisan

```

php artisan key:generate

```

- After generating app key, you can now run laravel migrations and seed database
    - NOTE: The password of all users generated by seeder is 'password'

```

php artisan migrate --seed

```

- After migrating and seeding database, you can now clear config via php artisan

```

php artisan config:clear

```

- After clearing config, you can now run npm script for processing the front end packages

```

npm run dev

```

- After running the npm scripts, you can now run the APP locally using this Laravel artisan script

```

php artisan serve

```

- Visit http://localhost:8000 in your browser.
> [!IMPORTANT]
> The default password generated from the seeder is always 'password'.
