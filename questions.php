<?php
include("includes/header.php");

if(isset($_POST['subject'])) {
    $subject = $_POST['subject'];
}
else
{
    header("Location: http://localhost/quizapp/quizhomepage.php");    
    exit();
}

$query = 
    " SELECT * " .
    " FROM `quiz_record`" .
    " WHERE `username`='$userLoggedIn'" .
    " AND `subject`='$subject'";

$userCheck = mysqli_query($con, $query);

$check = mysqli_num_rows($userCheck);
$message = '';
if($check > 0){
    $message.= 'You cannot take the quiz on a subject more than once per quiz session.';
    header("Location: http://localhost/quizapp/quizhomepage.php?message='$message'");    
    exit();
}


$query = 
    " SELECT `question_number`, `question`, `question_image`" .
    " FROM `questions`" .
    " WHERE `subject` = '$subject'";

$result = mysqli_query($con, $query);


?>
    
                
        <div class="container" style="margin-top: 20px;">
            <h3 style="text-align: center; margin-bottom: 25px;">Test your knowledge!</h3>
            <form id="quizForm" method="post" action="handlers/quiz_handler.php" name="quizForm">
                <input type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
                <input type="hidden" name="subject" value="<?php echo $subject; ?>">
                <?php
                $count = 1;
                while($row = mysqli_fetch_array($result)) {
                    
                    ?>
                    <div class="form-group row">
                        <label for="question" class="col-sm-2 col-form-label">Question <?php echo $count; ?></label>
                        <div class="col-sm-10">
                            <p><?php echo $row['question']; ?></p>
                            <p><input type="text" class="form-control" id="question_answer_<?php echo $row['question_number']; ?>" name="question_answer_<?php echo $row['question_number']; ?>"></p>
                        </div>
                        <?php
                        if($row['question_image'] != '') { ?>
                            <label for="question" class="col-sm-2 col-form-label">Question Image</label>
                            <p><div class="col-sm-10">
                                <img src="http://localhost<?php echo $row['question_image']; ?>" class="img-responsive" style="max-height: 400px;"/>
                            </div></p>
                        <?php
                        }
                        ?>
                        
                    </div>
                    <?php
                $count++;
                }
                ?>                
                        
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="submitQuiz" name="submitQuiz">Submit Quiz</button>                
                    </div>
                </div>            
            </form>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>