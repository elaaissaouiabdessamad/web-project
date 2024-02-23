<?php
if(isset($_POST['userNumber']))
{
    define("MyHost","localhost");
    define("MyUsr","root");
    define("Password","");
    define("NomBD" , "gestion_une_bibliothèque") ;

    $idcom = mysqli_connect(MyHost,MyUsr,Password,NomBD);
    if(!$idcom)
    {
        echo "<h3> Connexion Impossible à la base de données! </h3>" ;
    }


    else
    {
        $UNumber = $_POST['userNumber'] ;
        $requete = "DELETE FROM usager WHERE NUMERO_USAGER = $UNumber";
        $result = mysqli_query($idcom,$requete);

        if(!$result)
        {
            echo "<h1>Lecture impossible !</h1>";
        }

        else
        {
            $requete2 = "DELETE FROM emprunts
                         WHERE NUMERO_USAGER = $UNumber" ;
               $result2 = mysqli_query($idcom,$requete2);

               if(!$result2)
               {
                   echo "<h1>Lecture impossible !</h1>";
               }  
               else
               {
                echo "<script language=\"javascript\">
                window.confirm(\"This User Deleted Seccessfully\");
                window.location.href='http://localhost/libraryproject/Home/Home.html' ;
                </script>" ;
               }          

               
            
        }
    }
}
else
{
    echo "<h1>Indefined Variables !</h1>";
}


?>