<?php

if(isset($_POST['BNumber']) && isset($_POST['BTitle']) && isset($_POST['Author']) && isset($_POST['PHouse']) && isset($_POST['PNumber']) && isset($_POST['INumber']))
{
    if(!empty($_POST['BNumber']) && !empty($_POST['BTitle']) && !empty($_POST['Author']) && !empty($_POST['PHouse']) && !empty($_POST['PNumber']) && !empty($_POST['INumber']))
    {
       
        define("MyHost","localhost");
        define("MyUser" , "root");
        define("MyPass" , "");
        define("NomDb" , "gestion_une_bibliothèque");

        $idcom = @mysqli_connect(MyHost , MyUser , MyPass , NomDb);
        if(!$idcom)
        {
            echo "<h3> Connexion Impossible à la base de données! </h3>" ;
        }
        else
        {
            $BNumber = $_POST['BNumber'] ;
            $BTitle = $_POST['BTitle'] ;
            $Author = $_POST['Author'] ;
            $PHouse = $_POST['PHouse'];
            $PNumber = $_POST['PNumber'] ;
            $INumber = $_POST['INumber'] ;

            $flag = mysqli_num_rows(mysqli_query($idcom , "SELECT * FROM livre l WHERE l.NUMERO_LIVRE = $BNumber"));

            if($flag != 0)
            {
                echo "<script language=\"javascript\">
                window.confirm(\"This book Number is already exists ! Please Enter another Book Number \");
                window.location.href='http://localhost/libraryproject/Books/AddBook/AddBook.html' ;
                </script>" ;
                exit();
            }

            $requete = "INSERT INTO livre VALUES ('$BNumber','$BTitle','$Author','$PHouse','$PNumber')" ;
           
            $result = mysqli_query($idcom ,$requete);

            if(!$result)
            {
                echo "<h2>Oups La Requete n'est pas executé !!</h2>";
            }
            else
            {

                for($i=0 ; $i<$INumber ; $i++)
                {
                    $requete2 = "INSERT INTO exemplaire (NUMERO_LIVRE)
                                 VALUES ('$BNumber')";
                    $result2 = mysqli_query($idcom ,$requete2);
                    if(!$result2)
                    {
                        echo "<h2>Oups La Requete n'est pas executé !!</h2>";
                    }
                }


                echo "<script language=\"javascript\">
                     window.confirm(\"Book Added Successfully\");
                     window.location.href='http://localhost/libraryproject/Home/Home.html' ;
                     </script>" ;

            }

        }

        mysqli_close($idcom);
    }
    else
    {

        echo "<script language=\"javascript\">
                     window.confirm(\"There are Empty fields to Complete\");
                     window.location.href='http://localhost/libraryproject/Books/AddBook/AddBook.html' ;
                     </script>" ;

    }
}
else
{
   echo "<h2>Indifined Variables<h2>";
}











?>