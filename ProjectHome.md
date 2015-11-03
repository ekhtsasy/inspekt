![http://funkatron.com/content/inspekt_logo_v1.png](http://funkatron.com/content/inspekt_logo_v1.png)

### NOTE: Source code is now hosted on [GitHub](http://github.com/funkatron/inspekt) ###

**Inspekt is a PHP library that makes it easier to write secure web applications.**

Inspekt acts as a sort of 'firewall' API between user input and the rest of the application.  It takes PHP superglobal arrays, encapsulates their data in an "cage" object, and destroys the original superglobal.  Data can then be retrieved from the input data object using a variety of accessor methods that apply filtering, or the data can be checked against validation methods.  Raw data can only be accessed via a 'getRaw()' method, forcing the developer to show clear intent.

Read the **[User Documentation](http://funkatron.com/inspekt/user_docs)** for more details. You can also browse the generated **[API Docs](http://funkatron.com/inspekt/api_docs)**.

Inspekt can also be used on arbitrary arrays, and provides static filtering and validation methods.

Inspekt **works in PHP5**, and has no external dependencies.

Inspekt is built upon Chris Shiflett's original `Zend_Filter_Input` component (now deprecated) from the [Zend Framework](http://framework.zend.com).

Development of Inspekt is funded by [OWASP](http://owasp.org)'s [Spring of Code 2007](http://www.owasp.org/index.php/OWASP_Spring_Of_Code_2007).  You can read the original proposal on [the Applications page](http://www.owasp.org/index.php/OWASP_Spring_Of_Code_2007_Applications#EdFinkler_-_A_comprehensive_input_retrieval.2Ffiltering_system_for_PHP).