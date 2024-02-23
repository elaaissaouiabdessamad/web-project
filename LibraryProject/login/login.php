<?php 

if(isset($_POST['username']) && isset($_POST['password']))
{
    if(!empty($_POST['username']) && !empty($_POST['password']))
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
            $username = $_POST['username'];
            $password = $_POST['password'];

            $requete = "SELECT * FROM login" ;
            $result = mysqli_query($idcom,$requete);

            if(!$result)
            {
                echo "<h1>Lecture impossible !</h1>";
            }
            else
            {
                $ligne = mysqli_fetch_array($result,MYSQLI_ASSOC);

                $i = 0 ;

                foreach($ligne as $valeur)
                {
                    $tab[$i] = $valeur ;
                    $i++ ;
                }

                if($tab[0] == $username && $tab[1] == $password)
                {
		            echo "<script language=\"javascript\"> window.location.href='http://localhost/libraryproject/Home/Home.html'</script>" ;
                }
                else
                {
                    echo "<script language=\"javascript\">
                     window.confirm(\"You have entered an invalid username or password\");
                     window.location.href='http://localhost/libraryproject/login/login.html' ;
                    </script>" ;
                }

                mysqli_close($idcom);
            }

        }

    }
    else
    {
        echo "<h1>il ya des des Champs vide à compléter<\h1>" ;
    }
    
}
else
{
    echo "<h1>Les Champs Sont indéfinit<\h1>" ;
}
?>