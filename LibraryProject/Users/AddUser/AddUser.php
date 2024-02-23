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


            $flag = mysqli_num_rows(mysqli_query($idcom , "SELECT * FROM usager u WHERE u.NUMERO_USAGER = $UNumber"));

            if($flag != 0)
            {
                echo "<script language=\"javascript\">
                window.confirm(\"This user Number is already exists ! Please Enter another user Number \");
                window.location.href='http://localhost/libraryproject/Users/AddUser/AddUser.html' ;
                </script>" ;
                exit();
            }


            $requete = "INSERT INTO usager VALUES ('$UNumber','$LName','$FName','$Address','$Status','$Email')" ;
           
            $result = @mysqli_query($idcom ,$requete);

            if(!$result)
            {
                
                echo "<script language=\"javascript\">
                     window.confirm(\"This User Number is already exists ! Please Enter another User Number \");
                     window.location.href='http://localhost/libraryproject/Users/AddUser/AddUser.html' ;
                     </script>" ;
            }
            else
            {
                echo "<script language=\"javascript\">
                     window.confirm(\"User Added Successfully\");
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
                     window.location.href='http://localhost/libraryproject/Users/AddUser/AddUser.html' ;
                     </script>" ;

    }
}
else
{
   echo "<h2>Indifined Variables<h2>";
}











?>