<?php
session_start();
require '../includes/connection.php';

$message = '';

if(isset($_POST['submitQuiz'])) {
    $answersArray = array();
    $correctAnswersArray = array();
    $userLoggedIn = $_POST['userLoggedIn'];
    $subject = $_POST['subject'];
    
    foreach($_POST as $key => $value) {
        if(strpos($key, 'question_answer_') !== false) {
            $value = mysqli_real_escape_string($con, $value);
            $value = str_replace(' ', '',$value);
            $value = strip_tags($value);
            $value = strtolower($value);
            $value = md5($value);
            $answersArray[] = $value;
        }
    }
    

    $query = 
        " SELECT `answer`" .
        " FROM `questions`" .
        " WHERE `subject` = '$subject'";

    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result)) {
        $correctAnswersArray[] = $row['answer'];
    }
        
    $totalScore = sizeof($correctAnswersArray);

    
    $new2 = array();
    foreach ($correctAnswersArray as $key => $new_val)
    {
        if (isset($answersArray[$key]))
        {
            if ($answersArray[$key] != $new_val)
                $new2[$key] = $correctAnswersArray[$key];
        }
    }
    
    $difference = sizeof($new2);

    $userScore = ($totalScore - $difference) / $totalScore * 100;
    
    $date = date('Y-m-d H:i:s');

    $query = 
    " SELECT * " .
    " FROM `quiz_record`" .
    " WHERE `username`='$userLoggedIn'" .
    " AND `subject`='$subject'";

    $userCheck = mysqli_query($con, $query);

    $check = mysqli_num_rows($userCheck);
    
    if($check < 1) {
        
        $query = 
        " INSERT INTO `quiz_record`" .
        " VALUES('', '$userLoggedIn', '$userScore', '$date', '$subject')";

        if($answerInsert = mysqli_query($con, $query)) {

            header("Location: http://localhost/quizapp/check_result.php?subject='$subject'");    
            exit(); 
        }
        else
        {
            header("Location: http://localhost/quizapp/quizhomepage.php");
            exit(); 
        }
    }
    else
    {
        $message.= 'You have taken this quiz before. You cannot take it again'; 
        header("Location: http://localhost/quizapp/quizhomepage.php?message='$message'");
        exit(); 
    }    
     
}
else
{
    header("Location: http://localhost/quizapp/login.php");    
    exit(); 
}

?>