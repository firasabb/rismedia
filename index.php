<?php

require_once('controllers/Controller.php');

$ctrl = new Controller();
$files = $ctrl->index_files('logs/');

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RIS Media Exercise</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">RIS Media Exercise</a>
            </div>
        </nav>
        <div class="container">
            <div class="panel-title">
                <h4>Please select a file:</h4>
            </div>
            <div class="row">
                <div class="col s6 panel-col">
                    <ul class="collection with-header">
                        <?php foreach($files as $file){
                            ?>
                            <li class="collection-item avatar">
                                <i class="material-icons circle">folder_open</i>
                                <p><strong><?php echo $file ?></strong></p>
                            </li>
                        <?php } ?>
                    </ul>
                    <form method="get" action="file.php">
                        <div class="input-field col s12">
                            <select name="file">
                                <?php foreach($files as $file){ ?>
                                    <option value="<?php echo $file?>"><?php echo $file?></option>
                                <?php }?>
                            </select>
                        </div>
                        
                        <button class="waves-effect waves-light btn" type="submit">Process File</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
