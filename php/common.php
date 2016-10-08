<?php 

    // These variables define the connection information for your MySQL database 
    $username = "root"; 
    $password = "7bitsfacebook7"; 
    $host = "localhost"; 
    $dbname = "scoutz"; 

    // UTF-8 is a character encoding scheme that allows you to conveniently store 
    // a wide varienty of special characters, like ¢ or €, in your database. 
    // By passing the following $options array to the database connection code we 
    // are telling the MySQL server that we want to communicate with it using UTF-8 
    // See Wikipedia for more information on UTF-8: 
    // http://en.wikipedia.org/wiki/UTF-8 
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
     
    // A try/catch statement is a common method of error handling in object oriented code. 
    // First, PHP executes the code within the try block.  If at any time it encounters an 
    // error while executing that code, it stops immediately and jumps down to the 
    // catch block.  For more detailed information on exceptions and try/catch blocks: 
    // http://us2.php.net/manual/en/language.exceptions.php 
    try 
    {
        // This statement opens a connection to your database using the PDO library 
        // PDO is designed to provide a flexible interface between PHP and many 
        // different types of database servers.  For more information on PDO: 
        // http://us2.php.net/manual/en/class.pdo.php 
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
    } 
    catch(PDOException $ex) 
    { 
        // If an error occurs while opening a connection to your database, it will 
        // be trapped here.  The script will output an error and stop executing. 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code
        // (like your database username and password). 
        print("Whole shit failed");
        die("Failed to connect to the database: " . $ex->getMessage()); 
    } 
    // This statement configures PDO to throw an exception when it encounters 
    // an error.  This allows us to use try/catch blocks to trap database errors. 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     
    // This statement configures PDO to return database rows from your database using an associative 
    // array.  This means the array will have string indexes, where the string value 
    // represents the name of the column in your database. 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
     
    // This block of code is used to undo magic quotes.  Magic quotes are a terrible 
    // feature that was removed from PHP as of PHP 5.4.  However, older installations 
    // of PHP may still have magic quotes enabled and this code is necessary to 
    // prevent them from causing problems.  For more information on magic quotes: 
    // http://php.net/manual/en/security.magicquotes.php 
    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
    { 
        function undo_magic_quotes_gpc(&$array) 
        { 
            foreach($array as &$value) 
            { 
                if(is_array($value)) 
                { 
                    undo_magic_quotes_gpc($value); 
                } 
                else 
                { 
                    $value = stripslashes($value); 
                } 
            } 
        } 
        undo_magic_quotes_gpc($_POST); 
        undo_magic_quotes_gpc($_GET); 
        undo_magic_quotes_gpc($_COOKIE); 
    } 
     
    // This tells the web browser that your content is encoded using UTF-8 
    // and that it should submit content back to you using UTF-8 
    header('Content-Type: text/html; charset=utf-8'); 

    $session_name = 'sec_session_id';   // Set a custom session name
    /**
     * Sets the session name. 
     * This must come before session_set_cookie_params due to an undocumented bug/feature in PHP. 
     */
    session_name($session_name);
 
    $secure = true;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);

     
    // This initializes a session.  Sessions are used to store information about 
    // a visitor from one web page visit to the next.  Unlike a cookie, the information is 
    // stored on the server-side and cannot be modified by the visitor.  However, 
    // note that in most cases sessions do still use cookies and require the visitor 
    // to have cookies enabled.  For more information about sessions: 
    // http://us.php.net/manual/en/book.session.php 
    session_start(); 
    session_regenerate_id(true); //Regenerate the session, get rid of the older one.

    // Note that it is a good practice to NOT end your PHP files with a closing PHP tag. 
    // This prevents trailing newlines on the file from being included in your output, 
    // which can cause problems with redirecting users.