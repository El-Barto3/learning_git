<?php
include 'database.php';

$ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];

//$qry = $db->prepare("SELECT * FROM book WHERE (display = 1 OR ip = :ip)"); //for trolling trolls
$qry = $db->prepare("SELECT * FROM book WHERE display = 1");
$qry->bindParam(":ip", $ip);
$qry->execute();

$bookEntries = $qry->fetchAll();
?>
<div class="row">
<div class="col-sm-12 aktualnosciNaglowek border-bottom border-warning"><h1>Księga zmarłych</h1></div>
</div>
<div class="row">
<div class="col-sm-12 bg-secondary border-warning mb-3 mt-3 mx-0 px-0 pb-1 pt-1">
<table id="book" class="table table-hover row-border text-light">
    <thead class="bg-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Imię</th>
			<th scope="col">Nazwisko</th>
			<th scope="col">Lata życia</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$entryNumber = 1;
		foreach($bookEntries as $entry) {
			echo
		'<tr class="bg-dark table-hover tabela" style="cursor: pointer;" data-id="'.$entry["ID"].'">
				<td>'.$entryNumber.'</td>
				<td>'.$entry["name"].'</td>
				<td>'.$entry["lastname"].'</td>
				<td>'.$entry["birthday"].'</td>
			</tr>';
			$entryNumber = $entryNumber + 1;
		}
	?>
    </tbody>
</table>
</div>
</div>
<script type="text/javascript">
document.querySelectorAll("table tr").forEach((e, i) => {
   if(e.dataset["id"]) {
       e.addEventListener("click", () => { document.location.href = "?a=person&id=" + e.dataset["id"]; });
    }
});

$(document).ready(function () {
    $('#book').DataTable({
		language: {
			url: '//cdn.datatables.net/plug-ins/1.10.22/i18n/Polish.json'
		}
	});
});
</script>