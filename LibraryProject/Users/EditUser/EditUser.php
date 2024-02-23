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
        $search = $_POST['userNumber'] ;
        $requete =  "SELECT * FROM usager WHERE NUMERO_USAGER = $search" ;

        $result = mysqli_query($idcom,$requete);

        if(!$result)
        {
            echo "<h1>Lecture impossible !</h1>";
        }

        else
        {

            $ligne = mysqli_fetch_array($result,MYSQLI_ASSOC) ;

            if(!$ligne)
            {
                
                echo "<script language=\"javascript\">
                     window.confirm(\"This User Not Found\");
                     window.location.href='http://localhost/libraryproject/Users/EditUser/EditUser.html' ;
                     </script>" ;
            }
            else
            {
                $i = 0 ;
                $tab = array(0,0,0,0,0,0) ;
                foreach($ligne as $valeur)
                {
                    $tab[$i] = $valeur ;
                    $i++ ;
                }

                echo "
                <!DOCTYPE html>
                    <html lang=\"en\">
                    <head>
                        <meta charset=\"UTF-8\">
                        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
                        <title>Edit User</title>
                        <link rel=\"stylesheet\" href=\"http://localhost/libraryproject/Books/AddBook/AddBook.css\">
                    </head>
                    <body>
                      <div class=\"form-style-5\">
                        <form method=\"post\" action=\"EditUser2.php\">
                            <fieldset>
                                <legend><span class=\"number\">1</span>USER INFOS</legend>
                                <input type=\"text\" name=\"userNumber\" placeholder=\"User Number *\" value=\"$tab[0]\" readonly>
                                <input type=\"text\" name=\"userFName\" placeholder=\"First Name *\" value=\"$tab[1]\">
                                <input type=\"text\" name=\"userLName\" placeholder=\"Last Name *\" value=\"$tab[2]\">
                                <input type=\"text\" name=\"userAddress\" placeholder=\"Address *\" value=\"$tab[3]\" >
                                <input type=\"text\" name=\"userStatus\" placeholder=\"Status *\" value=\"$tab[4]\">
                                <input type=\"text\" name=\"userEmail\" placeholder=\"Email *\" value=\"$tab[5]\">
                                <input type=\"submit\" value=\"Edit User\"/>
                            </fieldset>
                        </form>
                     </div></body></html>";
                     
                  
                                
            }

        }



    }
}
else
{
    echo "<h1>Indefined Variables !</h1>";
}


?>