<?php 

define("MyHost","localhost");
define("MyUsr","root");
define("Password","");
define("NomDB","gestion_une_bibliothèque");


$idcom = mysqli_connect(MyHost,MyUsr,Password,NomDB); 

if(!$idcom)
{
    echo "<h3> Connexion Impossible à la base de données! </h3>" ;
}
else
{

    $requete =  "SELECT * FROM usager " ;
   
    
    $result = mysqli_query($idcom,$requete);

    if(!$result)
    {
        echo "<h1>Lecture impossible !</h1>";
    }
    else
    {
          
 echo "
<style>
        
h1{
    font-weight: bold;
    font-size: 50px;
    color: black;
    text-transform: uppercase;
    text-align: center;
    margin-bottom: 15px;
  }
  table{
    width:100%;
    table-layout: fixed;
  }
  .tbl-header{
    background-color: rgba(255,255,255,0.3);
   }
  .tbl-content{
    height:300px;
    overflow-x:auto;
    margin-top: 0px;
    border: 1px solid rgba(255,255,255,0.3);
  }
  th{
    padding: 20px 15px;
    text-align: left;
    font-weight: bold;
    font-size: 12px;
    color: white;
    text-transform: uppercase;
  }
  td{
    padding: 15px;
    text-align: left;
    vertical-align:middle;
    font-weight: 300;
    font-size: 12px;
    color: #fff;
    border-bottom: solid 1px rgba(255,255,255,0.1);
  }
  
  
  /* demo styles */
  
  @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
  body{
    background: -webkit-linear-gradient(left, #25c481, #25b7c4);
    background: linear-gradient(to right, #25c481, #25b7c4);
    font-family: 'Roboto', sans-serif;
  }
  section{
    margin: 50px;
  }
  
  
  /* follow me template */
  .made-with-love {
    margin-top: 40px;
    padding: 10px;
    clear: left;
    text-align: center;
    font-size: 10px;
    font-family: arial;
    color: #fff;
  }
  .made-with-love i {
    font-style: normal;
    color: #F50057;
    font-size: 14px;
    position: relative;
    top: 2px;
  }
  .made-with-love a {
    color: #fff;
    text-decoration: none;
  }
  .made-with-love a:hover {
    text-decoration: underline;
  }
  
  
  /* for custom scrollbar for webkit browser*/
  
  ::-webkit-scrollbar {
      width: 6px;
  } 
  ::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
  } 
  ::-webkit-scrollbar-thumb {
      -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
  }
 </style>
 <section>
    <div class=\"tbl-header\">
        <h1>Users List</h1> 
            <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                <thead>
                    <tr>
                        <th>User Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Email</th>
                    </tr>
                </thead>
            </table>
    </div> 
    <div class=\"tbl-content\">
        <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
             <tbody> "  ;      
                while($ligne = mysqli_fetch_array($result,MYSQLI_ASSOC))      
                {
                    echo "<tr>" ;
        
                    foreach($ligne as $valeur)
                    {
                        echo "<td> $valeur </td>" ;
                    }

                    echo "</tr>";
                }
             echo "</tbody>
        </table>
     </div>
 </section>" ;
    }
}


?>