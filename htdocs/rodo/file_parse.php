<?php

    include_once("classes.php");

    function parse_csv_file($filename, &$errors) {

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if ($extension != "csv") {
            $errors = "Wrong file extension, only .csv files are valid.";
            return false;
        }

        $file_contents = file_get_contents($filename);
        if ($file_contents == false) {
            $errors = "Could not read file $filename.";
            return false;
        }
        
        $lines = explode("\n", $file_contents);
        if (count($lines) == 0) {
            $errors = "File is empty!";
            return false;
        }
        
        $exam_name = $lines[0];
        //this is utterly fucking retarded
        if (count(explode(";", $exam_name)) != 3) { //we assume that whatever is in the first line is considered as exam name if it doesn't have the same format as grade info
            $errors = "File is missing an exam name in the first line.";
            return false;
        }

        $file_corrupted = false;

        $students_exam_data = new CsvFileData($exam_name);

        for ($i = 1; $i < count($lines); ++$i) {
            $grade_info_parts = explode(";", $lines[$i]);
            //we have 3 parts of information: index number;grade;additional comments
            if (count($grade_info_parts) < 3) {
                $errors = $errors . "Error on line $i: not enough information about student's grade\n";
                $file_corrupted = true;
                continue;
            }
            $index_str = trim($grade_info_parts[0]);
            if (preg_match("\d{6}", $index_str) == false) {
                $errors = $errors . "Error on line $i: index number should be only digits, without any spaces between them\n";
                $file_corrupted = true;
                continue;
            }
            $grade = trim($grade_info_parts[1]);
            if (preg_match("\d{1}\s*[\.\,]?\s*\d?", $grade) == false) {
                $errors = $errors . "Error on line $i: Wrong grade format: should be a digit and optionally a '-', '.digit' or ',digit', e.g. 4.5, 4-, 3,5\n";
                $file_corrupted = true;
                continue;
            }
            $comments = $grade_info_parts[2];
            $grade_data = new StudentExamData(intval($index_str), $exam_name, str_replace(" ", "", $grade), $comments); 
            $students_exam_data->add_student_exam_data($grade_data);
        }

        return $students_exam_data;
    }
?>