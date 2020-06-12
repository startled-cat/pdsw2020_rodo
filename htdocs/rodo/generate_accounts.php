<?PHP

include_once("classes.php");
if(isset($_SESSION["user"])){
    $user = $_SESSION["user"];
}else{
    echo "<b> u r not logged, go away!</b>";
    //header('Location: ' . "index.php", true, $permanent ? 301 : 302);
}

include_once("file_parse.php");

if (isset($_FILES) && isset($_POST) && isset($_FILES["accounts_fileToUpload"])) {

    if($_POST["submit"] == "accounts_file_check"){
        //just simulate
        echo "Checking accounts file<hr>";
        //$insert_result = true;
    }else{
        echo "Generating accounts<hr>";
    }

    $file_name = $_FILES["accounts_fileToUpload"]["name"];
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $expire_date = $_POST['expire-date'];

    $today = date("Y-m-d");
    if ($expire_date <= $today) {
        echo "Incorrent expire date";
    }elseif ($extension != "csv" && $extension != "txt") {
        echo "Only .csv and .txt files are supported try again";
    }else{
        $errors = "";
        
        $result = accounts_parse_csv_file($_FILES["accounts_fileToUpload"]["tmp_name"], $errors);
        if ($result == false || $errors != "") {
            //echo "something went wrong";
            //echo "<br>";
            echo $errors;
        }else{
            include_once("database_connection.php");
            include_once("functions.php");

            $sql_select = "SELECT `rodo`.`students`.`number` as number FROM `rodo`.`students` WHERE `number` in(";
            $sql_insert = "INSERT INTO `rodo`.`students` (`number`, `password`, `expire_date`) VALUES ";
            $accounts_table = '
            <div class="alert alert-success"> Successfully generated students\' accounts: </div>
            <table class="table table-striped">
            <thead>
            <tr>
            <th scope="col">Index</th>
            <th scope="col">Password</th>
            <th scope="col">Expire date</th>
            </tr>
            </thead>
            <tbody>';
            $accounts_counter = 0;

            foreach($result as $student_nr) {
                if($student_nr == '' || strlen($student_nr) != 6){
                    continue;
                }

                $accounts_counter = $accounts_counter + 1;

                $sql_select = $sql_select."'$student_nr',";//TODO clean bc sql injection

                $password = generate_password($student_nr);
                $enc_password = encryptPassword($password);

                $accounts_table = $accounts_table.'
                <tr>
                    <th scope="row">'.$student_nr.'</th>
                    <td>'.$password.'</td>
                    <td>'.$expire_date.'</td>
                </tr>';
                
                $sql_insert = $sql_insert."('$student_nr', '$enc_password', '$expire_date'),";//TODO clean bc sql injection
            }
            $sql_insert = substr($sql_insert, 0, strlen($sql_insert)-1); 
            $sql_select = substr($sql_select, 0, strlen($sql_select)-1); 
            $sql_select = $sql_select.');';
            $sql_insert = $sql_insert.';';

            //echo '$sql_insert = '.$sql_insert.'<hr>';
            //echo '$sql_select = '.$sql_select.'<hr>';


            //echo 'brr checking for duplicate accounts<br>';
            $select_result = $conn->query($sql_select);
            if(!$select_result){
                $accounts_table = "";
                echo "<hr>";
                echo "Cound not connect to database :c (can't check for duplicate accounts)<br />";
                echo $conn->error;
            }else{
                $duplicates = "";
                //number
                while($select_result_row = $select_result->fetch_assoc()) {
                    $duplicates = $duplicates."'".$select_result_row['number']."' ";
                }

            }
            if($duplicates == ""){
                //echo 'brr inserting data<br>';

                //$insert_result = $conn->query($sql_insert);
                if($_POST["submit"] == "accounts_file_check"){
                    //just simulate
                    $accounts_table = "";
                    echo "Success, file is correct, can genearte $accounts_counter accounts";
                    //$insert_result = true;
                }else{
                    $insert_result = $conn->query($sql_insert);
                    if(!$insert_result){
                        $accounts_table = "";
                        echo "<hr>";
                        echo "Cound not insert accounts to database :c<br />";
                        echo $conn->error;
                    }else{
                        //success
                        $accounts_table = $accounts_table."</tbody>
                        </table>";
    
                        echo "Success, generated $accounts_counter accounts";
                        echo '
                        <br />
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseAccounts" aria-expanded="false" aria-controls="collapseAccounts">
                            Show accounts
                        </button>
                        
                        <div class="collapse" id="collapseAccounts">
                            <div class="card card-body">
                            '.$accounts_table.'
                            </div>
                        </div>
                        ';
                        
                        //sleep(5);
                        //header('Location: ' . "main_teacher.php", true, $permanent ? 301 : 302);
                        //header( "Refresh:5; url='main_teacher.php'");
                    }
                }
                

                
            }else{
                $accounts_table = "";
                echo 'Operation aborted. trying to create duplicate accounts for those students: '.$duplicates;
            }

            
            
        }

    

    }

}else{
    echo "error";
}


?>