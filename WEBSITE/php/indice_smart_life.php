<?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
			$id_device=isset($_POST["id_device"])?$_POST["id_device"]:-1;
			if( !is_numeric($id_device) || $id_device==-1){
				die();
			}
			
			//connessione al DataBase
			$conn=new mysqli("localhost","3110366","","my_hyp2016abate7annunziata");
			//$conn=new mysqli("localhost","root","","mytim");
			//controllo avvenuta connessione
			if(mysqli_connect_errno()){
				$errore = array("nome_smart_life"=>"Errore DataBase");
				die ( json_encode($errore) );
			}
			
			//prendo i dati dalla tabella for_device1sl
			$query="SELECT smart_life.nome, smart_life.categoria FROM smart_life JOIN for_device1sl ON smart_life.nome=for_device1sl.nome_smart_life WHERE for_device1sl.id_device='$id_device'";
			$result=$conn->query($query);
			
			if($result->num_rows > 0){
				$array_righe = array();
				
				while($riga=$result->fetch_array(MYSQL_ASSOC)){
					$array_righe[] = $riga;
				}
				echo json_encode($array_righe);//esporta in json
			}
			else{
				$not_found = array("nome_smart_life"=>" ");
				echo json_encode($not_found);
			}

			//free result
			$result->close();
			//close connection
			$conn->close();
        }
    ?>