<?php
	header("Content-Type: text/plain; charset=utf-8");
?>

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
		
		$data = $Query->GetPlayers();
		if(!isset($_GET["type"])) {
			print_r($data);
		} else {
			$t = $_GET["type"];
			if($t == "raw") {
				echo json_encode($data);
			} elseif($t == "array") {
				print_r($data);
			}
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
