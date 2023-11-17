document.getElementById("formCrearProducto").addEventListener("submit", function(e) {
    e.preventDefault();
  

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Control/Ajax/altaProducto.php");
  
    var formData = new FormData(document.getElementById("formCrearProducto"));
    xhr.send(formData);
/*
    var formData = new FormData();
    formData.append("pronombre", document.getElementById("pronombre").value);
    formData.append("prodetalle", document.getElementById("prodetalle").value);
    formData.append("procantstock", document.getElementById("procantstock").value);
    formData.append("tipo", document.getElementById("tipo").value);
    formData.append("imagenproducto", document.getElementById("imagenproducto").value);

xhr.send(formData);*/

xhr.onload = function() {
  if (xhr.status == 200) {
    var respuesta = JSON.parse(xhr.responseText);
    if (respuesta.resultado == "exito") {
       alert("La carga fue exitosa");
       $("#modalNuevoProducto").modal('hide');
    } else {
        alert("Ha ocurido un error");
    }
  } else {
    alert("Ocurrió un error de conexión");
  }
};
});