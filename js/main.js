// Boite de dialogue create dir
var updateButton = document.getElementById('dirButton');
var dirDialog = document.getElementById('dirDialog');
var outputBox = document.getElementsByTagName('output')[1];
var selectEl = document.getElementById('select');
var confirmBtn = document.getElementById('confirmBtn');
// Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
updateButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    dirDialog.showModal();
  } else {
    window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

 //Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
dirDialog.addEventListener('close', function onClose() {
  if (selectEl.value==""){
    outputBox.value = "Vous n'avez pas renseigné de nom";
  }else{
    const xhttp = new XMLHttpRequest();
    const destination='add_dir.php?nom_dossier='+selectEl.value;
    
    xhttp.open("GET",destination);
    xhttp.send();
    outputBox.value = "Création du dossier \"" +selectEl.value + "\"";
    selectEl.value=="";
  }
});

// Upload file
var fileButton = document.getElementById('fileButton');
var fileDialog = document.getElementById('fileDialog');
var outputBoxfile = document.getElementsByTagName('output')[0];
var envoiFile=document.getElementById('envoiFile');
const url = 'add_file.php';

envoiFile.addEventListener('click', function() {
  const files = document.querySelector('[type=file]').files;
  const formData = new FormData();

  for (let i = 0; i < files.length; i++) {
    let file = files[i];

    formData.append('files[]', file);
  }

  fetch(url, {
    method: 'POST',
    body: formData,
  }).then(response => { console.log(response) })
  document.location.href="dashboard.php"; 
})


var dirIcon = document.getElementsByClassName('actionDirButton')[0];
var actionDirDialog= document.getElementById('actionDirDialog');
var cancerDirButton = document.getElementById('cancelDirButton');


dirIcon.addEventListener('click', function onOpen() {
  if (typeof actionDirDialog.showModal === "function") {
    actionDirDialog.showModal();
  } else {
    window.alert("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

cancelDirButton.addEventListener('click', function() {
  actionDirDialog.close('Annulé');
});