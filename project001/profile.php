<?php

// Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM personnel WHERE 	idPersonnel = ?');
    $stmt->execute(["1"]);
    // Fetch the data from the database and return the result as an Array
    $data_p = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$data_p) {
        // Simple error to display if the id for the data doesn't exists (array is empty)
        die ('worker does not exist!');
    }

    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM recordpoints WHERE 	idPersonnel = ?'  );
    $stmt->execute(["1"]);
    // Fetch the data from the database and return the result as an Array
    // $data_points = $stmt->fetch(PDO::FETCH_ASSOC);
     $data_points = $stmt->fetchAll();
    if (!$data_points) {
        // Simple error to display if the id for the data doesn't exists (array is empty)
        die ('worker does not exist!');
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
   
    <link rel="stylesheet" href="Chart.min.css"  type='text/css'>
    <script src="main.js"></script>
    <script src="Chart.js"></script>
    <script src="jquery.js"></script>
   
    <title>template_dahit</title>
</head>
<body>
    <div class="container">

        <div class="side_menu">
            <h1>Dahit</h1>
            <ul>
                <li><a href="">Dashboard</a> </li>
                <li><a href="">personnal</a> </li>
                <li><a href="">Alarmes</a> </li>
            </ul>
        </div>
        <div class="right_side">
                        
                        <div class="link-icons" id="menu_hea">
                            <div class="search">
                                <i class="fas fa-search"></i>
                                <input type="text" placeholder="Search...">
                            </div>
                            <div class="notifications">
                                <a href="index.php?page=cart" title="Shopping Cart">
                                    <i class="fas fa-bell"></i>
                                    
                                </a>
                            </div>
                            
                        </div>
                    
             
            
            <div class="profile_content">
                <div class="board">
                    <div class="card_p">
                        <img src="images/avatar.png" alt="pp">
                        <h2>CEO/cofounder</h2>
                        <h1><?=$data_p['nomPersonnel']?></h1>
                        <h1><?=$data_p['prenomPersonnel']?></h1>
                        
                        <div class="section_text">
                            <div class="container_text">
                                <h3>Etat:</h3>
                                <p> connecté</p>
                            </div>
                            <div class="container_text">
                                <h3>CIN:</h3>
                                <p> <?=$data_p['cinPersonnel']?></p>
                            </div>
                            <div class="container_text">
                                <h3>Adresse Mac :</h3>
                                <p> <?=$data_p['macBracelet']?></p>
                            </div>
                            <div class="container_text">
                                <h3>Date de naissance:</h3>
                                <p> <?=$data_p['dateNaisPersonnel']?></p>
                            </div>
                            <div class="container_text">
                                <h3>Département: </h3>
                                <p> <?=$data_p['departementPersonnel']?></p>
                            </div>
                            <div class="container_text">
                                <h3>Zones autorisés ::</h3>
                                <p> 1,2,3</p>
                            </div>
                            <div class="container_text">
                                <h3>Points:</h3>
                                <p> <?=$data_p['pointsPersonnel']?></p>
                            </div>
                         </div>
                            
                    </div>
                </div>
               
                <div class="graphs">
                    <div class="health_p">
                        <div class="temperature">
                            <div class="stat_header">
                                <h2>temperature</h2>
                            </div>
                            <div class="stat_values">
                                <p class="stat">37°C</p>
                                <i class="fas fa-temperature-low"></i>
                            </div>
                            
                        </div>
                        <div class="coeur">
                            <div class="stat_header">
                                <h2>Battement de coeur</h2>
                            </div>
                            <div class="stat_values">
                                <p class="stat">65</p>
                                <i class="fas fa-heartbeat"></i>
                            </div>
                        </div>
                        <div class="oxygene">
                            <div class="stat_header">
                                <h2>Niveau d'oxygene</h2>
                            </div>
                            <div class="stat_values">
                                <p class="stat">95%</p>
                                <p id="O2">O²</p>
                            </div>
                        </div>

                    </div>
                      


                 <canvas id="myChart" width="1000" height="400"></canvas>
           




                    <div class="record_p">
                        <table class="table table-dark">
                            <thead class="table_head">
                              <tr>
                                <th >id</th>
                                <th >la raison</th>
                                <th >la date</th>
                                <th >nombre de points</th>
                                <th >id broker</th>
                                <th >id personnel</th>
                              
                            
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php foreach ($data_points as $points): ?>
                              <tr>
                                
                                <th><?=$points['idRecordPoints']?></th>
                                <th><?=$points['raisonRecordPoints']?></th>
                                <th><?=$points['dateRecordPoints']?></th>
                                <th><?=$points['nbPoints']?></th>
                                <th><?=$points['idBroker']?></th>
                                <th><?=$points['idPersonnel']?></th>
                               
                              </tr>
                            <?php endforeach; ?>
                             
                            </tbody>
                          </table>
                          
                    </div>
                   
                </div>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
            {
                label: '# of Votes2',
                data: [6, 17, 8, 1, 10, 5],
                backgroundColor: [
                    'rgba(2, 188, 119, 0.2)',
                    'rgba(2, 188, 119, 0.2)',
                    'rgba(2, 188, 119, 0.2)',
                    'rgba(2, 188, 119, 0.2)',
                    'rgba(2, 188, 119, 0.2)',
                    'rgba(2, 188, 119, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                position:'right'
            }
        }
    });
  });

    </script>

</body>
</html>

