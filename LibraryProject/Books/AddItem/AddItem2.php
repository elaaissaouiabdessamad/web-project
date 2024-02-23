<?php
if(isset($_POST['BNumber']))
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
        $search = $_POST['BNumber'] ;
        $requete = "INSERT INTO exemplaire (NUMERO_LIVRE) VALUES ('$search')";

        $result = mysqli_query($idcom,$requete);

        if(!$result)
        {
            echo "<h1>Lecture impossible !</h1>";
        }
        else
        {
            echo "<script language=\"javascript\">
                     window.confirm(\"Item Added Successfully\");
                     window.location.href='http://localhost/libraryproject/Home/Home.html' ;
                     </script>";
        }
    }
}
else
{
    echo "<h1>Indefined Variables !</h1>";
}