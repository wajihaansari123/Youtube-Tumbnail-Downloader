<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youtube Thumbnail Downloader</title>
    <link rel="icon" href="icons8-cute-youtube-100.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #BDEAE2;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #343a40;
        }

        .btn-custom {
            background-color: #ff0000;
            color: white;
        }

        .btn-custom:hover {
            background-color: #d00000;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .innerboard {
            margin: 30px;
            /* Applies 30px margin to all sides */
            border: 2px dotted red;
            /* Correct border syntax */
            padding: 15px;
            /* Optional: add padding to ensure the content does not touch the border */
        }

        label {
            margin-left: 200px;
            /* Optional: adjust spacing below the label */
        }

        .left-image {
            position: absolute;
            left: 60px;
            /* Adjust this value to set the distance from the left edge */
            top: 10px;
            /* Adjust this value to set the distance from the top edge */
            z-index: 1;
            /* Ensure it appears above other content if needed */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="left-image-container">
            <img src="icons8-cute-youtube-100.png" alt="Decorative Image" class="left-image">
        </div>
        <form method="POST">
            <h2 class="text-center">YouTube Thumbnail Downloader</h2>
            <!-- Input field for YouTube video URL -->
            <div class="form-group">
                <label for="youtube_url"><b>Enter Your URL here</b></label>
                <input type="text" id="youtube_url" name="youtube_url" class="form-control" placeholder="Enter YouTube video URL">
            </div>
            <!-- Submit button -->
            <div class="text-center">
                <input type="submit" value="Get Thumbnail" name="submit" class="btn btn-custom">
            </div>
        </form>

        <?php
        // IN THE URL "v" is the character that contains the path to the thumbnail
        if (isset($_POST["submit"])) {
            // trim is used to cut off any extra blank spaces present in the URL
            $vedio_url = trim($_POST['youtube_url']);
            $param = parse_url($vedio_url);

            if (empty($vedio_url)) {
                echo "<div class='alert alert-danger mt-3'>Please enter a valid URL</div>";
                exit();
            }
            if ($param['host'] !== "www.youtube.com" && $param['host'] !== "youtube.com") {
                echo "<div class='alert alert-danger mt-3'>Invalid URL</div>";
                exit();
            }
            if ($param['path'] !== "/watch") {
                echo "<div class='alert alert-danger mt-3'>Invalid URL</div>";
                exit();
            }
            if (!isset($param['query'])) {
                echo "<div class='alert alert-danger mt-3'>Invalid URL</div>";
                exit();
            }

            // we used a parse string function and gave 2 parameters one ['query'] is the query which is present in the URL and we assigned its value to $query and then printed it
            parse_str($param['query'], $query);

            // by running this we can see the parsed form of the string in the form of an array 
            // var_dump($param); 

            // here we give that array which holds the value of the thumbnail or video ID
            // echo $query['v'];

            if (isset($query['v'])) {
                $vedio_id = $query['v'];
        ?>
                <!-- Display maximum resolution thumbnail -->
                <div class="innerboard">
                    <h2 class="text-center mt-4">Maximum Resolution</h2>
                    <img src="https://img.youtube.com/vi/<?php echo $vedio_id; ?>/maxresdefault.jpg" alt="Image" class="img-fluid">
                    <!-- Display high-quality resolution thumbnail -->
                    <h2 class="text-center mt-4">High Quality Resolution</h2>
                    <img src="https://img.youtube.com/vi/<?php echo $vedio_id; ?>/hqdefault.jpg" alt="Image" class="img-fluid">
                </div>
        <?php
            } else {
                echo "<div class='alert alert-danger mt-3'>Invalid URL</div>";
            }
        }
        ?>
    </div>
</body>

</html>