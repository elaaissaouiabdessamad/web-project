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
        $requete =  "SELECT livre.NUMERO_LIVRE, livre.TITRE, livre.AUTEUR, livre.MAISON_EDITION, livre.NB_PAGES, COUNT(exemplaire._NUMERO_EXEMPLAIRE) AS nb_exemplaires_disponibles
                    FROM livre 
                    LEFT JOIN exemplaire ON livre.NUMERO_LIVRE = exemplaire.NUMERO_LIVRE
                    WHERE livre.NUMERO_LIVRE = $search
                    GROUP BY livre.NUMERO_LIVRE, livre.TITRE, livre.AUTEUR, livre.MAISON_EDITION, livre.NB_PAGES";

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
                     window.confirm(\"This Book Not Found\");
                     window.location.href='http://localhost/libraryproject/Books/DeleteBook/DeleteBook.html' ;
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
                        <title>Delete Book</title>
                        <link rel=\"stylesheet\" href=\"http://localhost/libraryproject/Books/AddBook/AddBook.css\">
                    </head>
                    <body>
                      <div class=\"form-style-5\">
                        <form method=\"post\" action=\"DeleteBook2.php\">
                            <fieldset>
                                <legend><span class=\"number\">1</span>BOOK INFOS</legend>
                                <input type=\"text\" name=\"BNumber\" placeholder=\"Book Number *\" value=\"$tab[0]\" readonly>
                                <input type=\"text\" name=\"BTitle\" placeholder=\"Book Title *\" value=\"$tab[1]\" readonly>
                                <input type=\"text\" name=\"Author\" placeholder=\"Author *\" value=\"$tab[2]\" readonly>
                                <input type=\"text\" name=\"PHouse\" placeholder=\"Publishing House *\" value=\"$tab[3]\" readonly>
                                <input type=\"text\" name=\"PNumber\" placeholder=\"Pages Number *\" value=\"$tab[4]\" readonly>
                                <input type=\"text\" name=\"INumber\" placeholder=\"Items Number *\" value=\"$tab[5]\" readonly>
                                <input type=\"submit\" value=\"Delete Book\"/>
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