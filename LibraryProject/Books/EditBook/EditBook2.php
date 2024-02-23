<?php 
if(isset($_POST['BNumber']) && isset($_POST['BTitle']) && isset($_POST['Author']) && isset($_POST['PHouse']) && isset($_POST['PNumber']) && isset($_POST['INumber']))
{
    if(!empty($_POST['BNumber']) && !empty($_POST['BTitle']) && !empty($_POST['Author']) && !empty($_POST['PHouse']) && !empty($_POST['PNumber']) /*&& !empty($_POST['INumber'])*/)
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
            $AncienINumber = $_POST['AncienINumber'];

            $requete = "UPDATE livre
                        SET TITRE = '$BTitle',
                            AUTEUR = '$Author',
                            MAISON_EDITION = '$PHouse',
                            NB_PAGES = '$PNumber'
                        WHERE NUMERO_LIVRE = '$BNumber'" ;

            $result = @mysqli_query($idcom ,$requete);

            if(!$result)
            {
                echo "<h1>Error Requete nest execute !</h1>"; 
            }
            else
            {
                if($AncienINumber > $INumber)
                {
                    $n = $AncienINumber - $INumber ;

                    $requete2 = "DELETE FROM exemplaire 
                                 WHERE NUMERO_LIVRE = $BNumber 
                                 LIMIT $n";
                    $result2 = @mysqli_query($idcom ,$requete2);


                }
                else if($AncienINumber < $INumber)
                {
                    $n = $INumber - $AncienINumber;

                    for($i = 0 ; $i < $n ; $i++)
                    {
                        $requete2 = "INSERT INTO exemplaire (NUMERO_LIVRE) VALUES ('$BNumber')";
                        $result2 = @mysqli_query($idcom ,$requete2);
                    }
                }
                
                echo "<script language=\"javascript\">
                     window.confirm(\"The book Edited Successfully \");
                     window.location.href='http://localhost/libraryproject/Home/Home.html' 
                     </script>" ;
            }

       }
}
else
{
    echo "<script language=\"javascript\">
          window.confirm(\"There are Empty fields to Complete\");
          window.location.href='http://localhost/libraryproject/Books/EditBook/EditBook.html' 
            </script>" ;

}
}
else
{
    echo "<h2>Indifined Variables<h2>";
}
















?>