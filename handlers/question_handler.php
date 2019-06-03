<?php
session_start();
require '../includes/connection.php';

if(isset($_POST['userRole'])) {
    $userRole = $_POST['userRole'];
}

if($userRole > 1) {
    header("Location: http://localhost/quizapp/quizhomepage.php");    
    exit();
}


if(isset($_POST['submitQuestion'])) {
    
    $questionNumber = $_POST['questionNumber'];
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $answer = mysqli_real_escape_string($con, $_POST['answer']);
    $answer = str_replace(' ', '',$answer);
    $answer = strip_tags($answer);
    $answer = strtolower($answer);
    $answer = md5($answer);
    $question = mysqli_real_escape_string($con, $_POST['question']);    
    $question = strip_tags($question);  
    $imagePath = '';  

    if(!empty($_FILES['fileToUpload']['name'])) {
        $imagePath = '/quizapp/assets/src/images/'.$_FILES['fileToUpload']['name'];
    
        $fullPath = $_SERVER["DOCUMENT_ROOT"].$imagePath;
        
        
        if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],  $fullPath)) {
            
            echo "success";
        }
        else{
            echo "failed";
            
        }
    }
    
    
    $query = 
        " INSERT INTO `questions`" .
        " VALUES('', '$questionNumber', '$question', '$answer', '$imagePath', '$subject')";
    
    $result = mysqli_query($con, $query);

    if($result) {
        header("Location: http://localhost/quizapp/upload_subject.php");    
        exit();               
    }
    else
    {
        die('Insert error');   
    } 
     
}
else
{
    header("Location: http://localhost/quizapp/quiz.php");    
    exit(); 
}

?>