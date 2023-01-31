<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=0.6" rel="stylesheet">
        <link href="plugins/trumbowyg/trumbowyg.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/style/loader.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poppins&family=Raleway:wght@500;600&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <style> 
            table{
                margin: 3rem;
            }
            tr th{
                font-family: 'Rubik', sans-serif;
                font-weight: 0,500;
                font-size: 24px;
            }

            tr td{
                font-family: 'Roboto', sans-serif;
                font-weight: 500;
                text-transform: uppercase;
            }
            .msg_container {
                position: fixed;
                width: 470px;
                right: 0;
                bottom: 0;
                background: #f7efef;
                padding: 15px;
                border-radius: 2px;   
                color: #000;
                box-shadow: -2px -5px 20px 0px #00000040;
            }

            .msg_container h4{
                margin-top: 0;
            }
            
            .trumbowyg-editor, .trumbowyg-textarea {
                min-height: 200px;
            }

            input[type='checkbox'] {
                accent-color: #57d8cd;  
            }   
            #subject:focus{
                border-color: #57d8cd;
            }
            input:focus::-webkit-input-placeholder {
                color: #03989e;
                text-align: -1px;
            }
            #message:focus{
                border-color: #57d8cd;
            }
            #emails:focus{
                border-color: #57d8cd;
            }
            textarea:focus::-webkit-input-placeholder{
                color: #03989e;
                text-align: -1px;
            }
            #send:focus{
                outline: none;
            }
        </style>
    </head>
    <body>
        <?php
        include 'connection.php';
        include 'special_features/vendor/autoload.php';
        // Get count of data set first
        $sql = "SELECT * FROM `email_tbl`";
        $count = $con->query($sql)->num_rows;

        // Initialize a Data Pagination with previous count number
        $pagination = new \yidas\data\Pagination([
            'totalCount' => $count,
            
        ]);

        // Get range data for the current page
        $sql = "SELECT * FROM `email_tbl` LIMIT {$pagination->offset}, {$pagination->limit}";
        $users = $con->query($sql);
        ?>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>
                        <!-- <input type="checkbox" id="mcheck"> Check All </input> -->
                    </th>
                    <th>USERNAME</th>
                    <th>EMAIL</th>
                    <th>REGISTERED ON</th>
                    <th>CITY</th>
                    <th>COUNTRY</th>
                </tr>
            </thead>
            <tbody id="alluser">
                <?php while ($user = $users->fetch_assoc()): ?>



                    <tr>
                        <td>
                            <input type="checkbox" value="<?php echo $user['email']; ?>" onclick="updateTextArea();">
                        </td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php  echo $user['email']; ?>
                        </td>
                        <td><?php echo $user['member_since']; ?></td>
                        <td><?php echo $user['city']; ?></td>
                        <td><?php echo $user['country']; ?></td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
        <div>
            <?php
            \yidas\widgets\Pagination::widget([
                'pagination' => $pagination
            ])
            ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="plugins/trumbowyg/trumbowyg.min.js" type="text/javascript"></script>
        <script src="main.js" type="text/javascript"></script>
      

        <form action="" method="post" class="msg_container">
            <h4>Schedule</h4>
            <p id="multi-responce"></p>
            <div class="form-group">
                <textarea class="form-control" id="emails" name="emails" placeholder="Email list" style="height: 120px;" required></textarea>
             </div>
            <div class="form-group">
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Title" required>
            </div>
            <div class="form-group">
                <textarea style="height: 220px;" id="message" name="message" class="form-control" placeholder="Message" rows="5" required></textarea>
            </div>
            <button type="button" onclick="multi_email();" class="btn btn-lg col-lg-12" id="send" style="background: #57d6cd; color: white;">Send Now </button>
        </form>
         
    </body>
</html>