Project Description

1. I have built this project in Laravel 12.
2. For authentication, I have used Laravel Breeze.

Database Architecture:
1. I created a users table.
2. I created a roles table.
3. I created a clients (company) table.
4. I created a short_urls table.

I have created all the relationships properly in the models.

Work Flow:
I created separate logins and separate dashboards based on roles:
- Super Admin
- Admin
- Member

a. Super Admin:
1. The Super Admin is inserted through seeder, so when migration runs, the data is auto-inserted.
2. The Super Admin can create companies.
3. The Super Admin can view all companies’ short URLs, but cannot click on the URLs.
4. The Super Admin can create Admin users based on companies.

b. Admin:
1. An Admin can create Admin or Member users within their own company.
2. An Admin can create short URLs, can click on the URLs, and the URL opens in a new tab and the hit count increases.

c. Member:
1. A Member can create short URLs, can click on the URLs, and the URL opens in a new tab and the hit count increases.

I have not used raw queries; I focused on using model relationships.
For coding, I used Cursor AI tool.
I did not copy any concept from ChatGPT or any browser.
