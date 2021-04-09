<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/lux/bootstrap.min.css" rel="stylesheet" />
    <title>Survey Form</title>
</head>
<body>
    <div class="container">
        <h1>Survey Form</h1>
        <div class="card p-5">
            <div class="card-body">
                <form action="result.php" method="POST">
                    <div class="form-group row align-items-center">
                        <label for="name" class="col-md-2">Your Name</label>
                        <input type="text" class="form-control col-md-10" placeholder="Please enter your full name." name="name" required>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="location" class="col-md-2">Dojo Location</label>
                        <select name="location" id="location" class="form-control col-md-10" required>
                            <option value="">Please select location</option>
                            <option value="Mountain">Mountain View</option>
                        </select>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="language" class="col-md-2">Favorite Language</label>
                        <select name="language" id="language" class="form-control col-md-10" required>
                            <option value="">Please select your language</option>
                            <option value="Javascript">Javacript</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment (Optional)</label>
                        <textarea name="comment" id="comment" class="form-control" cols="30" rows="10" placeholder="You can add your comment"></textarea>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Submit Form">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>