import { Vista } from "./template/vista.js"

export class VistaLogin extends Vista {

    constructor(controlador, contenedor) {
        super(controlador, contenedor)

        // Seleccionamos el input type submit del formulario

        const botonLogin = contenedor.querySelector('#vistaMenu')

        // Añadimos un evento al boton de login
        botonLogin.onclick = () => {
            this.controlador.irAVista('vistaMenu')
        }

    }




}