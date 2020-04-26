function imagenFormulario() {
  let dibujoUsuario = document.getElementById('lienzo');
  let lienzoReescalado = document.createElement('canvas');
  lienzoReescalado.width = 320;
  lienzoReescalado.height = 320;
  let nuevoCtx = lienzoReescalado.getContext('2d')
  
  nuevoCtx.scale(lienzoReescalado.width/dibujoUsuario.width, lienzoReescalado.height/dibujoUsuario.height);
  nuevoCtx.drawImage(dibujoUsuario, 0, 0);

  let campoDatos = document.getElementById('datosImagen');
  campoDatos.value = lienzoReescalado.toDataURL();
  console.log(campoDatos.value);
  
}