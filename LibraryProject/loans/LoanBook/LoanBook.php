<?php
  
if(isset($_POST['id_usager']) && isset($_POST['exemplaire']) && isset($_POST['retour']))
{
   
    if(!empty($_POST['id_usager']) && !empty($_POST['exemplaire']) && !empty($_POST['retour']))
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
        else{
            $titre = $_POST['exemplaire'];
            $idUser = $_POST['id_usager'];
            $retour = $_POST['retour'];
            $flag1 = mysqli_num_rows(mysqli_query($idcom , "SELECT * FROM usager WHERE NUMERO_USAGER = $idUser"));
            if($flag1 == 0 ){
                echo "<script language=\"javascript\">
                    window.confirm(\"This USER is not susbscribed in the library !\");
                    window.location.href='http://localhost/libraryproject/loans/LoanBook/LoanBook.html'
                    ;
                    </script>" ;
                exit();
            }
            $flag2 = mysqli_num_rows(mysqli_query($idcom,"SELECT * FROM emprunts
            WHERE NUMERO_USAGER = $idUser
            AND MONTH(DATE_EMPRUNT) = MONTH(NOW())
            AND YEAR(DATE_EMPRUNT) = YEAR(NOW())"));
            if ($flag2 >= 5){
                echo "<script language=\"javascript\">
                    window.confirm(\"This USER have more than 5 Loans this month , Wait till the next month ! \");
                    window.location.href='http://localhost/libraryproject/Home/Home.html'
                    </script>" ;
                exit();
            }
            //first we need to check if the exemplaire is available
            $query = "SELECT _NUMERO_EXEMPLAIRE FROM exemplaire e 
            JOIN livre l ON e.NUMERO_LIVRE= l.NUMERO_LIVRE 
            WHERE l.TITRE ='$titre'
            AND NOT EXISTS(SELECT * FROM emprunts em WHERE em._NUMERO_EXEMPLAIRE = e._NUMERO_EXEMPLAIRE AND em.DATE_RETOUR_REELLE IS NULL)";
           
            $resultat = mysqli_query($idcom ,$query);
            /* SELECT _NUMERO_EXEMPLAIRE FROM exemplaire WHERE NUMERO_LIVRE = (SELECT NUMERO_LIVRE FROM livre WHERE livre.TITRE='antigone ' ) AND NUMERO_LIVRE NOT IN(SELECT _NUMERO_EXEMPLAIRE FROM emprunts ); */
            if(mysqli_num_rows($resultat)==0){
                echo "<script language=\"javascript\">
                    window.confirm(\"The book that you Want is not available at this moment\");
                    window.location.href='http://localhost/libraryproject/Home/Home.html' ;
                    </script>" ;
                exit();    
    
            }
            else{
                $resultat = mysqli_fetch_array($resultat)['_NUMERO_EXEMPLAIRE'];
                $query2 = "INSERT INTO emprunts VALUES(DEFAULT , $idUser, $resultat, NOW(), '$retour', NULL)";
                $result = mysqli_query($idcom , $query2);
                if(!$result ){
                    echo "<script language=\"javascript\">
                    window.confirm(\"Can't add your loan to the database !!!! \");
                    window.location.href='http://localhost/libraryproject/loans/LoanBook/LoanBook.html' ;
                    </script>" ;
                }
                else{
    
                    echo "<script language=\"javascript\">
                    window.confirm(\"The Loan of the book is done successfully !!!!! \");
                    window.location.href='http://localhost/libraryproject/Home/Home.html' ;
                    </script>" ;
                }
            }
        }
    }
    else
    {
        echo "<script language=\"javascript\">
        window.confirm(\"There is an empty champs!\");
        window.location.href='http://localhost/libraryproject/loans/LoanBook/LoanBook.html' ;
        </script>" ;
    }
   
}
else{
    echo "<script language=\"javascript\">
    window.confirm(\"Undefined Variables !\");
    window.location.href='http://localhost/libraryproject/loans/LoanBook/LoanBook.html' ;
    </script>" ;
}

?>