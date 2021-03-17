<?php

session_start();

include 'database.php';

$pageMainURL = "https://spacerwirtualny.ct8.pl/strona/";

$ID = getVariable("id");
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";

if($referer != "$pageMainURL.?a=admin&password=w6EUPz4e6FyXLkAA") {
	$qry = $db->prepare("SELECT * FROM book WHERE ID = :ID AND (display = 1)");
	$qry->bindParam(":ID", $ID);
	$qry->execute();
}
else {
	$qry = $db->prepare("SELECT * FROM book WHERE ID = :ID");
	$qry->bindParam(":ID", $ID);
	$qry->execute();
}

if($qry->rowCount() > 0) {
	$person = $qry->fetch();

	$name = getVariable("name");
	$text = getVariable("text");

	if($name != "" && $text != "") {
		$qry = $db->prepare("INSERT INTO comments (ID, book_id, name, text, ip, time) VALUES (NULL, :ID, :name, :text, :ip, UNIX_TIMESTAMP())");
		$qry->bindParam(":ID", $ID);
		$qry->bindParam(":name", $name);
		$qry->bindParam(":text", $text);
		$qry->execute();

		header("Location: ".$pageMainURL."?a=person&id=".$ID);
		exit();
	}

	$qry = $db->prepare("SELECT * FROM comments WHERE book_id = :ID AND (display = 1)");
	$qry->bindParam(":ID", $ID);
	$qry->execute();

	$comments = $qry->fetchAll();
?>

		<div class="row">
			<div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning"><h1><?=$person["name"]?> <?=$person["lastname"]?></h1></div>
		</div>
				<div class="row">

			<div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning">
			<button  id="resurrect" class="btn btn-dark border-warning btn-lg formularz mb-1 mt-3">Ożyw zdjęcie</button></br>
			<img id="profilepic" src="<?=$pageMainURL?>.<?=$person["avatar_url"]?>" style="max-width: 1000px" class="rounded-circle shadow-lg p-1 mb-3 mt-3 bg-warning rounded"></div>

		</div>
		<div class="row">
			<div class="text-light text-justify mt-3"><?=$person["description"]?></div>
		</div>
		<?php
		if($person["grave_url"] != "") {
		?>
			<br />
			<div class="row">
			<div class="grave_url col-sm-12 aktualnosciNaglowek border-warning"><h1><a href="<?=$pageMainURL?>.?a=walk&id=<?=$person["ID"]?>" class="facebookKontakt text-light menuOpcja">Link do spaceru</a></h1></div>
			</div>
		<?php
		}
		?>

	<div class="row">
	<div class="col-sm-12 aktualnosciNaglowek border-warning border-top mt-5">
	<h1>Komentarze</h1>
	</div>
	</div>
<div class="row">
	<div class="mx-auto text-center w-100 p-3">
		<h3> Napisz swój komentarz </h3>




		<form action="/?a=person&id=<?=$person["ID"]?>" method="post" >
			<input class="form-control-lg bg-dark text-light color-warning formularz mb-3 mt-3 border-warning" type="text" name="name" placeholder="Twoje imię i nazwisko" />
			<textarea class="form-control bg-dark text-light text-left color-warning formularz mb-3 mt-3 border-warning mw-80" type="text" name="text" placeholder="Komentarz" rows="5"></textarea>
			<input type="submit" value="Napisz komentarz" class="btn btn-dark border-warning btn-lg formularz mb-3 mt-5" />
		</form>
	</div>
	</div>
</div>
	<?php
}
else {
	echo "<h3>Wpis o podanym ID nie istnieje</h3>";
}
?>
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
