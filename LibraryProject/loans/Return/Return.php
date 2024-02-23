<?php
if(isset($_POST['id_usager']) && isset($_POST['exemplaire'])){
    if(!empty($_POST['id_usager']) && !empty($_POST['exemplaire']))
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
            $titre =$_POST['exemplaire'];
            $idUser = $_POST['id_usager'];
           /*  $query =" DELETE FROM emprunts 
            WHERE _NUMERO_EXEMPLAIRE IN (
              SELECT e._NUMERO_EXEMPLAIRE 
              FROM Exemplaire e 
              JOIN livre l ON e.NUMERO_LIVRE = l.NUMERO_LIVRE 
              WHERE l.TITRE = '$titre'
            ) AND NUMERO_USAGER = $idUser
            ORDER BY NUMERO_EMPRUNT ASC LIMIT 1;"; */
    
            $flag1 = mysqli_num_rows(mysqli_query($idcom , "SELECT * FROM usager WHERE NUMERO_USAGER = $idUser ;"));
            if($flag1 == 0 ){
                echo "<script language=\"javascript\">
                    window.confirm(\"This USER is not susbscribed in the library !\");
                    window.location.href='http://localhost/libraryproject/loans/Return/Return.html'
                    ;
                    </script>" ;
                exit();
            }
    
            $query = "SELECT * FROM livre l WHERE l.TITRE ='$titre' ";
            $resultat = mysqli_query($idcom ,$query);

            if(!$resultat)
            {
                echo "<h1>Impossible de Lire </h1>";
            }
            else
            {
                 /* SELECT _NUMERO_EXEMPLAIRE FROM exemplaire WHERE NUMERO_LIVRE = (SELECT NUMERO_LIVRE FROM livre WHERE livre.TITRE='antigone ' ) AND NUMERO_LIVRE NOT IN(SELECT _NUMERO_EXEMPLAIRE FROM emprunts ); */
            if(mysqli_num_rows($resultat) == 0){
                echo "<script language=\"javascript\">
                    window.confirm(\"The book that you entered is not exist in your library\");
                    window.location.href='http://localhost/libraryproject/loans/Return/Return.html' ;
                    </script>" ;
                exit();    
    
            }
    
            $query ="UPDATE emprunts
            SET DATE_RETOUR_REELLE = NOW()
            WHERE NUMERO_USAGER = $idUser 
              AND _NUMERO_EXEMPLAIRE IN (
                SELECT e._NUMERO_EXEMPLAIRE 
                FROM Exemplaire e 
                JOIN livre l ON e.NUMERO_LIVRE = l.NUMERO_LIVRE 
                WHERE l.TITRE = '$titre'
              )
              AND DATE_RETOUR_REELLE IS NULL
              ORDER BY NUMERO_EMPRUNT ASC
              LIMIT 1
            ";
    
            $result = mysqli_query($idcom , $query);
            if(!$result){
                echo "<script language=\"javascript\">
                    window.confirm(\"An Error Occured during return your book!\");
                    window.location.href='http://localhost/libraryproject/loans/Return/Return.html';
                    </script>" ;
                
    
            }
            else{
                echo "<script language=\"javascript\">
                    window.confirm(\"The book returned Successfully! \");
                    window.location.href='http://localhost/libraryproject/Home/Home.html'
                    </script>" ;
    
            }
    

            }
           
        }

    }
    else
    {
        echo "<script language=\"javascript\">
        window.confirm(\"There are empty champs to complete !\");
        window.location.href='http://localhost/libraryproject/loans/Return/Return.html' ;
        </script>" ;
    }
  

}
else{
  echo "<script language=\"javascript\">
  window.confirm(\"Undefined Variables !\");
  window.location.href='http://localhost/libraryproject/loans/Return/Return.html' ;
  </script>" ;
    
}
?>