<?php

    include_once("classes.php");

    function parse_csv_file($filename, &$errors) {

        $file_contents = file_get_contents($filename);
        if ($file_contents == false) {
            $errors = "Could not read file $filename.<br>";
            return false;
        }
        
        $lines = explode("\n", $file_contents);
        if (count($lines) == 0) {
            $errors = "File is empty!<br>";
            return false;
        }
        
        $exam_name = $lines[0];
        //this is utterly fucking retarded
        $cnt = count(explode(";", $exam_name));
        if ($cnt != 1) { //we assume that whatever is in the first line is considered as exam name if it doesn't have the same format as grade info
            $errors = "File is missing an exam name in the first line.<br>";
            return false;
        }

        $file_corrupted = false;

        $students_exam_data = new CsvFileData($exam_name);

        for ($i = 1; $i < count($lines); ++$i) {
            $grade_info_parts = explode(";", $lines[$i]);
            //we have 3 parts of information: index number;grade;additional comments
            if (count($grade_info_parts) < 3) {
                $errors = $errors . "Error on line $i: not enough information about student's grade<br>";
                $file_corrupted = true;
                continue;
            }
            $index_str = trim($grade_info_parts[0]);
            if (preg_match("/\d{6}$/", $index_str) == false) {
                $errors = $errors . "Error on line $i: index number should be only digits, without any spaces between them, got $index_str<br>";
                $file_corrupted = true;
                continue;
            }
            $grade = trim($grade_info_parts[1]);
            if (preg_match("/^\d{1}(((\.|\,)\d{1})|-)?$/", $grade) == false) {
                $errors = $errors . "Error on line $i: Wrong grade format: should be a digit and optionally a '-', '.digit' or ',digit', e.g. 4.5, 4-, 3,5, got $grade<br>";
                $file_corrupted = true;
                continue;
            }
            $comments = $grade_info_parts[2];
            $grade_data = new StudentExamData(intval($index_str), $exam_name, str_replace(" ", "", $grade), $comments); 
            $students_exam_data->add_student_exam_data($grade_data);
        }

        return $students_exam_data;
    }


    function accounts_parse_csv_file($filename, &$errors) {

        $file_contents = file_get_contents($filename);
        if ($file_contents == false) {
            $errors = "Could not read file, maybe file is empty.<br>";
            return false;
        }
        
        $lines = explode("\n", $file_contents);
        if (count($lines) == 0) {
            $errors = "File is empty!<br>";
            return false;
        }

        $file_corrupted = false;
        

        for ($i = 0; $i < count($lines); ++$i) {
            $lines[$i] = str_replace (array("\r\n", "\n", "\r"), '', $lines[$i]);
            

            if (preg_match('/^[0-9\n]*$/', $lines[$i])){
                //echo $lines[$i].' - good line<br>';
            }else{
                $file_corrupte = true;
                //echo '"'.$lines[$i].'" - error<br>';
                $errors = "Error in line ".($i+1)." : '".$lines[$i]."' - student's index number should contain just numbers<br>";
                return false;
            }
            if(strlen($lines[$i]) != 6 && strlen($lines[$i]) != 0){
                $file_corrupte = true;
                //echo '"'.$lines[$i].'" - error<br>';
                $errors = "Error in line ".($i+1)." : '".$lines[$i]."' - student's index number is ".strlen($lines[$i])." and not 6 digits long<br>";
                return false;
            }

            if(strlen($lines[$i]) == 0){
                continue;//skip empty lines from checking duplicates 
            }
            //check if duplicate
            for ($j = 0; $j < $i; ++$j) {
                if($lines[$j] == $lines[$i]){
                    $file_corrupte = true;
                    //echo '"'.$lines[$i].'" - error<br>';
                    $errors = "Error in line ".($i+1)." : '".$lines[$i]."' - student's index number is duplicated. Previouosly seen in line $j<br>";
                    return false;
                }
            }

        }

        return $lines;
    }
?>