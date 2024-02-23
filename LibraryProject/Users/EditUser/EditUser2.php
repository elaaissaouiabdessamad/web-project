<?php 
if(isset($_POST['userNumber']) && isset($_POST['userFName']) && isset($_POST['userLName']) && isset($_POST['userAddress']) && isset($_POST['userStatus']) && isset($_POST['userEmail']))
{
    if(!empty($_POST['userNumber']) && !empty($_POST['userFName']) && !empty($_POST['userLName']) && !empty($_POST['userAddress']) && !empty($_POST['userStatus']) && !empty($_POST['userEmail']))
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
            
            $UNumber = $_POST['userNumber'] ;
            $FName = $_POST['userFName'] ;
            $LName = $_POST['userLName'] ;
            $Address = $_POST['userAddress'];
            $Status = $_POST['userStatus'] ;
            $Email = $_POST['userEmail'] ;

            $requete = "UPDATE usager
                        SET NOM = '$LName',
                        PRENOM = '$FName',
                        ADRESSE = '$Address',
                        STATUS = '$Status',
                        EMAIL = '$Email'
                        WHERE NUMERO_USAGER = $UNumber" ;

            $result = @mysqli_query($idcom ,$requete);

            if(!$result)
            {
                echo "<h1>Error Requete nest execute !</h1>"; 
            }
            else
            {
                echo "<script language=\"javascript\">
                     window.confirm(\"The User Edited Successfully \");
                     window.location.href='http://localhost/libraryproject/Home/Home.html' 
                     </script>" ;
            }

       }
}
else
{
    echo "<script language=\"javascript\">
          window.confirm(\"There are Empty fields to Complete\");
          window.location.href='http://localhost/libraryproject/Users/EditUser/EditUser.html' 
            </script>" ;

}
}
else
{
    echo "<h2>Indifined Variables<h2>";
}
















?>