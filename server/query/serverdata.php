<?php
	require __DIR__ . '/../SourceQuery/bootstrap.php';

	use xPaw\SourceQuery\SourceQuery;
	
	// For the sake of this example

	
	// Edit this ->
	define( 'SQ_SERVER_ADDR', 'scprp.modern-gaming.net' );
	define( 'SQ_SERVER_PORT', 27015 );
	define( 'SQ_TIMEOUT',     1 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-
	
	$Query = new SourceQuery( );
	
	try
	{
		$Query->Connect( SQ_SERVER_ADDR, SQ_SERVER_PORT, SQ_TIMEOUT, SQ_ENGINE );
		


		$server_info = json_encode($Query->GetInfo());
		$user_info = json_encode($Query->GetPlayers());
		if($_SERVER['PHP_SELF'] == "/server/query/serverdata.php") {
			echo "<p>Die Nutzung dieses pfades ist nich gestattet.</p>";
			return;
		}
		require_once("system/database.php");
        $server_vars = runQuery("SELECT * FROM mtf_cache WHERE k='scpstatus_delay'");
        $server_vars = mysqli_fetch_array($server_vars);
        //print_r($server_vars);
        //echo json_encode($server_vars);

        if($server_vars["v"] < time()) {
            // Update variables

            runQuery("UPDATE mtf_cache SET v='".$server_info."' WHERE k='scpstatus_serverdata'");
            runQuery("UPDATE mtf_cache SET v='".$user_info."' WHERE k='scpstatus_userdata'");
        }


	}
	catch( Exception $e )
	{
		echo $e->getMessage( );
	}
	finally
	{
		$Query->Disconnect( );
	}
