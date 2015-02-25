# Phonebook
Test project for realstrategic. It's based on Zend Framework 1.12 and Bootstrap (which I've used only 1 time before).

## Demo

You can check demo at http://phonebook.abvestka.by/ 
(just pointed that subdomain to another server, so, it may need some time)

## Installation

- Your server environment should have Zend Framework 1.12.X
- PHP _include_path_ should include directory /library/Zend/
- DB dump located at root directory
- Check _application/configs/application.ini_ file to change DB username/password/dbname

## Featuers

All features, which were requested:

- It should have a login with username and password so the user can access the main user interface.
- Once the user is logged in you will need to have a logout button where he can go out of the protected area.
- There should also be an option to add new records in the phone book which will contain: Name, Phone number, Date of adding, Additional Notes
- We need to have an option to edit/delete existing records in the phone book.
- It needs to have a pagination for the records which are more than 10 on page
- Need to have a search field on the top allowing the user to search through all the fields mentioned above (Name, Phone number, Date of adding, Additional Notes)

Moreover features, which I've added:

- Added "role" parameter. In future, we can add more features for "admin" role
- Password is secured by salt parameter
- Forms are secured by CSRF-protection
- Also added ability to make flag (active/inactive), so it's easily to disable user, but not delete them (for example, if we have paid subscription or whatever or need to activate account via e-mail/SMS)
