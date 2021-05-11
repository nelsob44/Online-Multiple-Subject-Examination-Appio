<?php
session_start();
require '../includes/connection.php';

$message = '';

if(isset($_POST['submitEditQuiz'])) {
    $answersArray = array();
    $correctAnswersArray = array();
    $userLoggedIn = $_POST['userLoggedIn'];
    $subject = $_POST['subject'];

    foreach($_POST as $key => $value) {
        if(strpos($key, 'question_answer_') !== false){
            $questionArray = explode('question_answer_', $key);
            $questionNumber = $questionArray[1];
            $question = mysqli_real_escape_string($con, $_POST[$questionArray[1]]);
            $question = strip_tags($question);
            $answer = mysqli_real_escape_string($con, $value);
            $answer = str_replace(' ', '',$answer);
            $answer = strip_tags($answer);
            $answer = strtolower($answer);
            $answer = md5($answer);
             
            $imagePath = '';
            
            if(!empty($_FILES['fileToUpload_'.$questionNumber]['name'])) {
                $imagePath = '/quizapp/assets/src/images/'.$_FILES['fileToUpload_'.$questionNumber]['name'];
            
                $fullPath = $_SERVER["DOCUMENT_ROOT"].$imagePath;
                                
                if(move_uploaded_file($_FILES['fileToUpload_'.$questionNumber]['tmp_name'],  $fullPath)) {
                    
                    echo "success";
                }
                else{
                    echo "failed";
                    
                }
            }

            $query = 
                " UPDATE `questions`" .
                " SET `question`='$question', `answer`='$answer', `question_image`='$imagePath'" .
                " WHERE `question_number`='$questionNumber'";
            
            $result = mysqli_query($con, $query);

            if(!$result) {
                $message.= 'Sorry, an error occured while storing your edited questions'; 
                header("Location: http://localhost/quizapp/quizhomepage.php?message='$message'");
                exit();                
            }
            
        }
    }
    $message.= 'Questions have been edited successfully'; 
    header("Location: http://localhost/quizapp/quizhomepage.php?message='$message'");
    exit(); 
}
else
{
    header("Location: http://localhost/quizapp/login.php");    
    exit(); 
}

?>