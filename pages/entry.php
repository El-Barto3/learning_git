<?php
include 'database.php';

$response = "";

$createEntry = getVariable("createEntry");
$name = getVariable("name");
$description = isset($_POST["description"]) ? $_POST["description"] : "";
$description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
$description = strip_tags($description);

function uploadAvatar() {
	$tmp = explode('.', $_FILES['image']['name']);
	$_FILES['image']['extension'] = strtolower(end($tmp));
	$_FILES['image']['name'] = "avatar_".md5(microtime(true) . " - " . mt_rand(0,99999999)).".png";
	
	if(
		($_FILES['image']['type'] == "image/gif") &&
		($_FILES['image']['type'] == "image/jpeg") &&
		($_FILES['image']['type'] == "image/jpg") &&
		($_FILES['image']['type'] == "image/png")
	) {
		$response = "Zły typ przesyłanego pliku";
		return $response;
	}
	
	if(in_array($_FILES['image']['extension'], ["jpeg", "jpg", "png", "gif"]) === false) {
		$response = "Złe rozszerzenie przesyłanego pliku";
		return $response;
	}
	
	if($_FILES['image']['size'] > 2097152) {
		$response = "Przesyłany plik jest za duży (> 2MB)";
		return $response;
	}
	
	/*$data = getimagesize($_FILES['image']['tmp_name']);
	
	if($data[0] / $data[1] != 1) {
		$response = "Złe wymiary";
	}*/
	
	move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$_FILES['image']['name']);
	return "/uploads/".$_FILES['image']['name'];
}

if($createEntry == 1) {
	$ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];
	
	if(!isset($_FILES["image"])) {
		$qry = $db->prepare("INSERT INTO book (ID, name, description, avatar_url, ip, display) VALUES (NULL, :name, :description, '/images/defaultAvatar.png', :ip, '0')");
		$qry->bindParam(":name", $name);
		$qry->bindParam(":description", $description);
		$qry->bindParam(":ip", $ip);
		$qry->execute();
		
		$response = "Pomyślnie przesłano wpis, po sprawdzeniu będzie on dostępny w księdze zmarłych";
	}
	else {
		$avatarUrl = uploadAvatar();
		
		if(preg_match("/uploads/", $avatarUrl)) {
			$qry = $db->prepare("INSERT INTO book (ID, name, description, avatar_url, ip, display) VALUES (NULL, :name, :description, :avatarUrl, :ip, '0')");
			$qry->bindParam(":name", $name);
			$qry->bindParam(":description", $description);
			$qry->bindParam(":avatarUrl", $avatarUrl);
			$qry->bindParam(":ip", $ip);
			$qry->execute();
			
			$response = "Pomyślnie przesłano wpis, po sprawdzeniu będzie on dostępny w księdze zmarłych";
		}
		else {
			$response = $avatarUrl;
		}
	}
}
?>      
                   
<div class="row">
        <div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning"><h1>Dodaj wpis</h1></div>
</div>
<div class="createEntry">
	<h4> <?=$response?> </h4>
	
    <nav class="navbar navbar-expand-lg navbar-dark">

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
									<ul class="navbar-nav mx-auto mt-3 mb-3 border-bottom border-warning">
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="#">Informacja</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="#">Osoba</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="#">Wydarzenie</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="#">Pogrzeb</a>
										</li>
										<li class="nav-item active">
											<a class="nav-link menuOpcja" href="#">Inne</a>
										</li>
									</ul>
									
                            </div>
                        </nav>
						
	<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2 bg-dark">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3 bg-dark">
                <h2 id="heading" class="text-warning">Dodaj osobę zmarłą</h2>
                <p>Wypełnij wszystkie dane oznaczone *gwiazdką</p>
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Dane podstawowe</strong></li>
                        <li id="personal"><strong>Dane opcjonalne</strong></li>
                        <li id="payment"><strong>Zdjęcie</strong></li>
                        <li id="confirm"><strong>Koniec</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dane podstawowe</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 1 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Imię: *</label> <input type="text" name="name" placeholder="Imię" /> <label class="fieldlabels">Nazwisko: *</label> <input type="text" name="surname" placeholder="Nazwisko" /> <label class="fieldlabels">Data urodzenia: *</label> <input type="date" name="birthday" placeholder="Data urodzenia" /> <label class="fieldlabels">Data śmierci: *</label> <input type="date" name="deathday" placeholder="Data śmierci" />
                        </div> <input type="button" name="next" class="next action-button" value="Dalej" />
                    </fieldset>
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dane dodatkowe</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 2 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Zawód: </label> <input type="text" name="job" placeholder="Zawód" /> <label class="fieldlabels">Opis: </label> <textarea type="text" name="description" placeholder="Opis życia" rows="15"></textarea>
                        </div> <input type="button" name="next" class="next action-button" value="Dalej" /> <input type="button" name="previous" class="previous action-button-previous" value="Poprzedni" />
                    </fieldset>
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dodaj zdjęcie:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 3 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Wstaw zdjęcie:</label> <input type="file" name="image" id="avatar" accept="image/*"> 
                        </div> <input type="button" name="next" class="next action-button" value="Potwierdź" /> <input type="button" name="previous" class="previous action-button-previous" value="Poprzedni" />
                    </fieldset>
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
  
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 4 - 4</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUKCES !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">Udało ci się dodać wpis</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
	
	
	
	
	
	
	  <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2 bg-dark">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3 bg-dark">
                <h2 id="heading" class="text-warning">Podziel się z nami swoimi przemyśleniami</h2>
                <p>Wypełnij wszystkie dane oznaczone *gwiazdką</p>
                <form id="msform">
                    <!-- progressbar -->
      

                    <fieldset class="bg-dark">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dane podstawowe</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 1 - 4</h2>
                                </div>
								 <label class="fieldlabels">Tytuł: *</label> <input type="text" name="name" placeholder="Imię" /> 
									<label class="fieldlabels"> Wiadomość </label> <textarea type="text" name="description" placeholder="Opis życia" rows="15"></textarea>
                            </div>
                        </div> <input type="button" name="next" class="next action-button" value="Dalej" />
                    </fieldset>
             
                    <fieldset class="bg-dark">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dodaj zdjęcie:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 2 - 3</h2>
                                </div>
                            </div> <label class="fieldlabels">Wstaw zdjęcie:</label> <input type="file" name="image" id="avatar" accept="image/*"> 
                        </div> <input type="button" name="next" class="next action-button" value="Potwierdź" /> <input type="button" name="previous" class="previous action-button-previous" value="Poprzedni" />
                    </fieldset>
                    <fieldset class="bg-dark">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
  
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 3 - 3</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUKCES !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">Udało ci się dodać wpis</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
	
	
	
	    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2 bg-dark">
            <div class="card px-3 pt-4 pb-0 mt-3 mb-3 bg-dark">
                <h2 id="heading" class="text-warning">Dodaj osobę zmarłą</h2>
                <p>Wypełnij wszystkie dane oznaczone *gwiazdką</p>
                <form id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Dane podstawowe</strong></li>
                        <li id="personal"><strong>Dane opcjonalne</strong></li>
                        <li id="payment"><strong>Zdjęcie</strong></li>
                        <li id="confirm"><strong>Koniec</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dane podstawowe</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 1 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Imię: *</label> <input type="text" name="name" placeholder="Imię" /> <label class="fieldlabels">Nazwisko: *</label> <input type="text" name="surname" placeholder="Nazwisko" /> <label class="fieldlabels">Data urodzenia: *</label> <input type="date" name="birthday" placeholder="Data urodzenia" /> <label class="fieldlabels">Data śmierci: *</label> <input type="date" name="deathday" placeholder="Data śmierci" />
                        </div> <input type="button" name="next" class="next action-button" value="Dalej" />
                    </fieldset>
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dane dodatkowe</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 2 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Zawód: </label> <input type="text" name="job" placeholder="Zawód" /> <label class="fieldlabels">Opis: </label> <textarea type="text" name="description" placeholder="Opis życia" rows="15"></textarea>
                        </div> <input type="button" name="next" class="next action-button" value="Dalej" /> <input type="button" name="previous" class="previous action-button-previous" value="Poprzedni" />
                    </fieldset>
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title text-warning">Dodaj zdjęcie:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 3 - 4</h2>
                                </div>
                            </div> <label class="fieldlabels">Wstaw zdjęcie:</label> <input type="file" name="image" id="avatar" accept="image/*"> 
                        </div> <input type="button" name="next" class="next action-button" value="Potwierdź" /> <input type="button" name="previous" class="previous action-button-previous" value="Poprzedni" />
                    </fieldset>
                    <fieldset class="bg-dark  ">
                        <div class="form-card bg-dark">
                            <div class="row">
                                <div class="col-7">
  
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Krok 4 - 4</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUKCES !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">Udało ci się dodać wpis</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
	
	
	
	
	
</div>
</div>
<script type="text/javascript">
const avatar = document.getElementById('avatar');
const fileChosen = document.getElementById('file-chosen');
avatar.addEventListener('change', function(){
	fileChosen.textContent = this.files[0].name
})
</script>