<?PHP
class Test{
    public static function run(){
        echo "RUNNING ALL TESTS ...<hr>";
        $passed = 0;
        $failed = 0;
        $all = 0;
        $class_methods = get_class_methods('Test');
        foreach ($class_methods as $method_name) {
            if($method_name == "run"){
                continue;
            }
            echo "[TEST NAME] : $method_name<br>";
            $result = Test::$method_name();
            echo $result ? "[PASS]<br>" : "[FAIL]<br>";
            $result ? $passed += 1: $failed +=1 ;
            $all += 1;
            echo "<hr>";
        }
        echo "TESTS PASSED: $passed/$all<br>";
        echo "TESTS FAILED: $failed/$all<br>";
        echo "<hr>";
        echo "RESULT: ";
        echo $failed > 0 ? "FAIL" : "PASS";
    }
    public static function testDatabaseConnection(){
        //echo "test db ...<br>";
        echo "trying to connect to database ...<br>";
        echo "importing \"database_connection.php\"<br>";
        require_once('database_connection.php');
        if ($conn->connect_error) {
            echo "error: can't connect to database -> $conn->connect_error <br>";
            return False;
        }
        echo "connected successfully<br>";
        return True;
    }
    public static function testPasswordGeneration(){
        //echo "test gen ...<br>";
        echo "importing \"functions.php\"<br>";
        require_once('functions.php');
        echo "testing password length ...<br>";
        $pass_len = 0;
        $generated_pass = generate_password($pass_len);
        if(strlen($generated_pass) != $pass_len){
            echo "error: wrong length of generated password<br>";
            echo "expected $pass_len, got ".strlen($generates_pass);
            return False;
        }

        $pass_len = 10;
        $generated_pass = generate_password($pass_len);
        if(strlen($generated_pass) != $pass_len){
            echo "error: wrong length of generated password<br>";
            echo "expected $pass_len, got ".strlen($generates_pass);
            return False;
        }

        $pass_len = 100;
        $generated_pass = generate_password($pass_len);
        if(strlen($generated_pass) != $pass_len){
            echo "error: wrong length of generated password<br>";
            echo "expected $pass_len, got ".strlen($generates_pass);
            return False;
        }
        echo "testing password characters ...<br>";
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        foreach (str_split($generated_pass) as $char) {
            //$char = '*';
            //echo 'strpos($alphabet, $char) = '.strpos($alphabet, $char).'<br>';
            if(strpos($alphabet, $char) === False){
                echo "error: generated password contains forbidden character: '".$char."'<br>";
                return False;
            }
        }


        return True;
    }
    public static function testPasswordEncryption(){
        //echo "test gen ...<br>";
        echo "importing \"functions.php\"<br>";
        require_once('functions.php');
        $pass = "123456";
        $enc_pass1 = encryptPassword($pass);
        $enc_pass2 = encryptPassword($pass);
        echo "checking if encrypted password 1 is different that original<br>";
        if($pass == $enc_pass1){
            echo 'error: encrypted password equals password<br>';
            return False;
        }
        echo "checking if encrypted password 2 is different that original<br>";

        if($pass == $enc_pass2){
            echo 'error: encrypted password equals password<br>';
            return False;
        }
        echo "checking if encyption of the same password returns the same encrypted password<br>";

        if($enc_pass2 != $enc_pass1){
            echo 'error: encryption not reliable<br>';
            return False;
        }
        
        return True;
    }
}
Test::run();
?>
