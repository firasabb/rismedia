<?php

require_once('controllers/Controller.php');

$ctrl = new Controller();
$file = $_GET['file'];
$bouncesCount = $ctrl->bounces_count($file);
$lines = $ctrl->bounced_only($file);

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
    <script src="./js/csv.js"></script>


</head>
<body>
    <div id="app">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">RIS Media Exercise</a>
            </div>
        </nav>
        <div class="container">
            <div class="row bounces">
                <div class="col s12">
                    <button id="btn-csv" class="waves-effect waves-light btn" type="submit">Download CSV</a>
                </div>
            </div>
            <div class="row bounces">
                <div class="col s6 m5 bounces-col">
                    <div class="card-panel square">
                        <h4>Bounces: <?php echo $bouncesCount['bounces'] ?></h4>
                    </div>
                </div>
                <div class="col s6 m5 bounces-col">
                    <div class="card-panel">
                        <h4>Deferred: <?php echo $bouncesCount['deferred'] ?></h4>
                    </div>
                </div>
            </div>

            <div class="divider">
            </div>
            <div class="panel-title">
                <h4>Bounced Emails:</h4>
            </div>
            <div class="divider">
            </div>
        </div>
        <div class="table-row bounces">
            <div class='table-container'>
                <table>
                    <thead>
                        <tr>
                            <th width="15%">Email</th>
                            <th width="25%">Relay</th>
                            <th width="50%">Message</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($lines)){
                            foreach($lines as $line){ ?>
                                <tr>
                                    <td><?php       
                                        $ctrl->findAndReplace($line, 'to=&lt;', '&gt;');
                                    ?></td>

                                    <td><?php 

                                        $ctrl->findAndReplace($line, 'relay=');

                                    ?></td>

                                    <td><?php 

                                        foreach($line as $key => $value){  
                                            $arr = array();
                                            if(preg_match('/(said:)/', $value) != false){
                                                for($i = $key; $i < count($line); $i++){
                                                    array_push($arr, $line[$i]);
                                                }
                                                $str = implode($arr, ' ');
                                                echo $str;
                                            }
                                        }

                                    ?></td>

                                    <td><?php 

                                        $ctrl->findAndReplace($line, 'status=');

                                    ?></td>
                                </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
