<?php
include("includes/header.php");

if($userRole > 1) {
    header("Location: http://localhost/quizapp/quizhomepage.php");    
    exit();
}

$subjectOptions = array(
    "english" => "english",
    "maths" => "maths",
    "physics" => "physics",
    "biology" => "biology",
    "current affairs" => "current affairs",
    "chemistry" => "chemistry",
    "general knowledge" => "general knowledge",
    "history" => "history",
    "politics" => "politics",
    "The news" => "The news"
);

?>
    
       
        <div class="container" style="margin-top: 20px;">
            <form id="indexForm" method="POST" action="quiz.php" name="uploadSubjectForm">
                <input type="hidden" name="userLoggedIn" value="<?php echo $userLoggedIn; ?>">
                <div class="form-group row">
                    <label for="subjects" class="col-sm-2 col-form-label">Choose subject to upload</label>
                    <div class="col-sm-10">
                        <select type="select" class="form-control" id="subject" name="subject">
                            <?php
                             foreach($subjectOptions as $key => $value)
                             {
                                ?>                                
                                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                                <?php
                             }
                            ?>
                        </select>           
                    </div>                    
                </div>
                        
                <div class="form-group row">
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="submitUploadSubject" name="submitUploadSubject">Proceed</button>                
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