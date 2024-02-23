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
        $requete1 = "SELECT _NUMERO_EXEMPLAIRE FROM exemplaire WHERE NUMERO_LIVRE = $search LIMIT 1";
        $result1 = mysqli_query($idcom,$requete1);

        if(!$result1)
        {
            echo "<script language=\"javascript\">
            window.confirm(\"There is No Item For this Book !\");
            window.location.href='http://localhost/libraryproject/Books/DeleteItem/DeleteItem.html' ;
            </script>" ;
            exit();    
        }
        
        if(mysqli_num_rows($result1)==0)
        {
            echo "<script language=\"javascript\">
                window.confirm(\"There is No Item For this Book !\");
                window.location.href='http://localhost/libraryproject/Books/DeleteItem/DeleteItem.html' ;
                </script>" ;
            exit();    
        }

        $row1 = mysqli_fetch_assoc($result1);
        $idExemplaire = $row1['_NUMERO_EXEMPLAIRE'];


        $requete2 = "DELETE FROM emprunts WHERE _NUMERO_EXEMPLAIRE = $idExemplaire";
        if(!mysqli_query($idcom, $requete2))
        {
            echo "<h1>Lecture impossible !</h1>";
            exit();
        }
    
        $requete = "DELETE FROM exemplaire
                   WHERE _NUMERO_EXEMPLAIRE = $idExemplaire";

        $result = mysqli_query($idcom,$requete);

        if(!$result)
        {
            echo "<h1>Lecture impossible !</h1>";
        }
        else
        {
            echo "<script language=\"javascript\">
                     window.confirm(\"Item Deleted Successfully\");
                     window.location.href='http://localhost/libraryproject/Home/Home.html' ;
                     </script>";
        }
    }
}
else
{
    echo "<h1>Indefined Variables !</h1>";
}