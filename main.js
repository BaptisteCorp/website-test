
var updateButton = document.getElementById('updateDetails');
var dirDialog = document.getElementById('dirDialog');
var outputBox = document.getElementsByTagName('output')[1];
var selectEl = document.getElementById('select');
var confirmBtn = document.getElementById('confirmBtn');
// Le bouton "mettre à jour les détails" ouvre la boîte de dialogue
updateButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    dirDialog.showModal();
  } else {
    console.error("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

 //Le bouton "Confirmer" déclenche l'évènement "close" sur le dialog avec [method="dialog"]
dirDialog.addEventListener('close', function onClose() {
  if (selectEl.value==""){
    outputBox.value = "Vous n'avez pas renseigné de nom"
  }else{
    outputBox.value = "Création du dossier \"" +selectEl.value + "\"";
  }
});

var fileButton = document.getElementById('fileButton');
var fileDialog = document.getElementById('fileDialog');
var outputBoxfile = document.getElementsByTagName('output')[0];
const url = 'add_file.php'
const form = document.querySelector('form_file')

fileButton.addEventListener('click', function onOpen() {
  if (typeof dirDialog.showModal === "function") {
    fileDialog.showModal();
  } else {
    console.error("L'API dialog n'est pas prise en charge par votre navigateur");
  }
});

form.addEventListener('submit', e => {
  e.preventDefault()

  const files = document.querySelector('[type=file]').files
  const formData = new FormData()

  for (let i = 0; i < files.length; i++) {
    let file = files[i]

    formData.append('files[]', file)
  }

  fetch(url, {
    method: 'POST',
    body: formData,
  }).then(response => {
    console.log(response)
  })
})