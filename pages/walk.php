<?php
include 'database.php';

$ID = getVariable("id");

if($ID != "") {
	$qry = $db->prepare("SELECT * FROM book WHERE ID = :ID AND display = 1");
	$qry->bindParam(":ID", $ID);
	$qry->execute();
	
	$entry = $qry->fetch();
}

if($entry["grave_url"] == "") {
?>
                            <div class="row">
                                <div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning"><h1>Spacer wirtualny</h1></div>
                            </div>
                            <div class="row">
                                   <div class="trescSrodkowaSpacer">
                                    <!-- W tym divie maja byc wiadomosci-->
                                    <a href="https://www.theasys.io/viewer/X69oU9qbayhkCtsFzBXvbwoqhbFE5c/" target="_blank" class="facebookKontakt text-light menuOpcja" style="text-align: center;">
                                        Kliknij tutaj, aby otworzyć spacer w osobnej karcie.
                                    </a>
                                    <iframe src="https://ths.li/9wq1sc" class="spacer mt-3"></iframe>
                                </div>
                            </div>
							
							<div class="row mx-auto ">
							<!--	<iframe name="mapa" src="http://barto.ct8.pl/mapa/index.html" class="w-100" style="height: 550px"></iframe> -->
							</div>

<?php
}
else {
?>
                            <div class="row">
                                <div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning"><h1>Spacer wirtualny</h1></div>
                            </div>
                            <div class="row">
                                   <div class="trescSrodkowaSpacer">
                                    <!-- W tym divie maja byc wiadomosci-->
                                    <a href="https://www.theasys.io/viewer/X69oU9qbayhkCtsFzBXvbwoqhbFE5c/" target="_blank" class="facebookKontakt text-light menuOpcja" style="text-align: center;">
                                        Kliknij tutaj, aby otworzyć spacer w osobnej karcie.
                                    </a>
                                    <iframe src="<?=$entry["grave_url"]?>" class="spacer mt-3"></iframe>
                                </div>
                            </div>
<?php
}
?>


