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
        $BNumber = $_POST['BNumber'] ;
        $requete = "DELETE FROM livre WHERE NUMERO_LIVRE = $BNumber";
        $result = mysqli_query($idcom,$requete);

        if(!$result)
        {
            echo "<h1>Lecture impossible !</h1>";
        }

        else
        {
           
            $requete2 = "DELETE FROM emprunts 
            WHERE _NUMERO_EXEMPLAIRE IN (
                SELECT _NUMERO_EXEMPLAIRE 
                FROM exemplaire 
                WHERE NUMERO_LIVRE = $BNumber)";

            $result2 = mysqli_query($idcom,$requete2);
            if(!$result2)
            {
                echo "<h1>Lecture impossible !</h1>";
            }
            else
            {
                $requete3 = "DELETE FROM exemplaire WHERE NUMERO_LIVRE = $BNumber " ;

                $result3 = mysqli_query($idcom,$requete3);  
                if(!$result3)
                {
                echo "<h1>Lecture impossible !</h1>";
                }
                else
                {
                    echo "<script language=\"javascript\">
                    window.confirm(\"This Book Deleted Successfully !\");
                    window.location.href='http://localhost/libraryproject/Home/Home.html'
                    ;
                    </script>" ;
                }
                
            }
        }
    }
}
else
{
    echo "<h1>Indefined Variables !</h1>";
}


?>