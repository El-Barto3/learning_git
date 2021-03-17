<?php

	session_start();

	include 'database.php';

	$ID = getVariable("id");
	$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";

	$qry = $db->prepare("SELECT * FROM comments WHERE (display = 1)");
	$qry->bindParam(":ID", $ID);
	$qry->execute();

	$comments = $qry->fetchAll();
?>

<div class="row">
	<div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning"><h1>Aktualności</h1></div>
</div>
	<div class="row">
		<div class="aktualnosci">
			<div class="row">
				<div class="comments mx-auto border-warning border-bottom pb-5">
					<?php
					foreach($comments as $comment) {
						echo 
						'<div class="comment">
							<div class="top">
								<div class="text-center"><h3>'.$comment["name"].'</h3></div>
								<div class="date text-center mb-5">'.date("d.m.Y H:i:s", $comment["time"]).'</div>
							</div>
							<div class="text-center">'.$comment["text"].'</div>
						</div>';
					}
					?>
				</div>
			</div>
		</div>
</div>