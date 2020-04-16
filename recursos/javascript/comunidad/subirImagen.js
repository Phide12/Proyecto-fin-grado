function imagenFormulario() {
  var lienzo = document.getElementById('lienzo');
  let campoDatos = document.getElementById('datosImagen');
  campoDatos.value = lienzo.toDataURL();
  console.log(campoDatos);
  
  
}