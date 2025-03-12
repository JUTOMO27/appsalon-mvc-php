let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id:'',
    nombre:'',
    fecha:'',
    hora:'',
    servicios:[]
}

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});


function iniciarApp(){
    mostrarSeccion(); //Muestra y oculta las secciones
    tabs(); //Cambia la seccion cuando se presionan los tabs
    botonesPaginador(); //Agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI(); //Consulta la API en el backend de PHP

    idCliente();
    nombreCliente(); //Añade el nombre del cliente al objeto de cita
    seleccionarFecha(); //Añade la fecha de la cita en el objeto
    seleccionarHora(); //Añade la hora de la cita en el objeto

    mostrarResumen(); //Muestra el resumen del "carrito"
}

function mostrarSeccion() {
    //Ocualtar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }

    //Seleccionar la seccion con el paso...
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');
    
    //Ocualtar el tab que tenga la clase de actual
    const tabOcultar = document.querySelector('.actual');
    if(tabOcultar){
        tabOcultar.classList.remove('actual');
    }

    //Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`)
    tab.classList.add('actual');

}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton =>{
        boton.addEventListener('click', function (e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function botonesPaginador(){
    const paginaSiguiente = document.querySelector('#siguiente')
    const paginaAnterior = document.querySelector('#anterior')

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 2){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
        mostrarResumen();
    }
    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    })

}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    })

}

async function consultarAPI(){
    try {
        const url = '/api/servicios'
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios){
    servicios.forEach(servicio =>{
        const {id, nombre, precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `${precio}€`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);

    });
}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita;
    //Identificar el elemento al que se le da click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    //Comprobar si un servicio ya ha sido agregado
    if(servicios.some(agregado => agregado.id === id)){
        //Eliminarlo
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove('seleccionado');
    } else{
        //Añadirlo
        cita.servicios = [...servicios, servicio];
        divServicio.classList.add('seleccionado');
    }

}

function idCliente(){
    cita.id = document.querySelector('#id').value;

}

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;

}

function seleccionarFecha(){  
    // Obtener la fecha de mañana
    const hoy = new Date();
    const mañana = new Date();
    mañana.setDate(hoy.getDate() + 1);

    if(mañana.getDay() === 0 || mañana.getDay() === 1 || hoy.getDay() === 0 || hoy.getDay() === 1){
        mañana.setDate(hoy.getDate() + 2);
    } else {
        mañana.setDate(hoy.getDate() + 1);
    }

    flatpickr("#fecha", {
    disable: [
        function(date) {
            // Deshabilitar domingos (0) y lunes (1)
            return (date.getDay() === 0 || date.getDay() === 1);
        }
    ],
    locale: "es",
    onChange: function(selectedDates, dateStr, instance) {
        // console.log("Fecha seleccionada:", dateStr); // Muestra la fecha seleccionada en la consola
    },
    defaultDate: mañana,
    minDate: mañana
    });
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();

        if([0, 1].includes(dia)){
            e.target.value = '';
            mostrarAlerta('Estamos abiertos de Martes a Sábado, por favor selecciona otro dia', 'error', '.formulario');
        }else{
            cita.fecha = e.target.value;
        }
    });
}

function seleccionarHora(){
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e){

        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        if(hora < 10 || hora > 18){
            e.target.value = '';
            mostrarAlerta('Hora no vàlida', 'error','.formulario')
        } else{
            cita.hora = e.target.value;
        }
    })
}

function mostrarAlerta(mensaje, tipo, elemento, desaparece = true){
    //Previene que hayan mas de 1 alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia) {
        alertaPrevia.remove();
    };

    //Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    //Elimina la alerta despues de un tiempo
    if(desaparece){
        setTimeout(() =>{
        alerta.remove();
        }, 3000);
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.resumen');
    
    //Limpiar el contenido de resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes('')){
        mostrarAlerta('Parece que faltan datos, revisa la informacion y vuelve a intentarlo','error', '.resumen', false)
        return;
    } 
    if(cita.servicios.length === 0){
        mostrarAlerta('No has selecciona ningun servicio, selecciona al menos uno para poder reservar tu cita', 'error', '.resumen', false);
        return;
    } 

    const contenedorResumen = document.createElement('DIV');
    contenedorResumen.classList.add('contenido-resumen');
    resumen.appendChild(contenedorResumen);

    //Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;

    const titulo = document.createElement('H3');
    titulo.textContent = `APP SALON`;
    contenedorResumen.appendChild(titulo);
    
    //Heading para cita en Resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de tu cita';
    contenedorResumen.appendChild(headingServicios);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    //Formatear la fecha
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate();
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date (Date.UTC(year, mes, dia));

    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day:'numeric'};
    const fechaFormateada = fechaUTC.toLocaleDateString('es-ES', opciones);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora}`;


    
    const servicioYPrecio = document.createElement('P');
    servicioYPrecio.classList.add('servicio-precio');
    servicioYPrecio.innerHTML = `<span>Servicio</span><span>Precio</span>`;

    //Iterando y mostrando los servicios
    contenedorResumen.appendChild(nombreCliente);
    contenedorResumen.appendChild(fechaCita);
    contenedorResumen.appendChild(horaCita);
    contenedorResumen.appendChild(servicioYPrecio);

    let total = 0;
    servicios.forEach(servicio => {
        const { id, precio, nombre} = servicio
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = `1 x ${nombre}`;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `${precio}<span>€</span>`;
        
        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        contenedorResumen.appendChild(contenedorServicio);

        // Sumar el precio del servicio al total
        total += parseFloat(precio);
    });

    // Mostrar el total
    const totalPagar = document.createElement('P');
    totalPagar.classList.add('resumen-total');
    totalPagar.innerHTML = `<span>Total a pagar:</span> ${total.toFixed(2)}<span>€</span>`;
    contenedorResumen.appendChild(totalPagar);

    const frase = document.createElement('P');
    frase.innerHTML = `
        ***Gracias por elegir nuestros servicios***<br>
        BARBERIA APPSALON, CIF: A-123456789<br>
        Avda. Can N'oriac Nº27<br>
        Sabadell
    `;
    frase.classList.add('pie-ticket')
    contenedorResumen.appendChild(frase);

    //Boton para crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(botonReservar);

    async function reservarCita() {

        const {id, fecha, hora, servicios } = cita;

        const idServicios = servicios.map(servicio => servicio.id);

        const datos = new FormData();
        datos.append('fecha', fecha);
        datos.append('hora', hora);
        datos.append('usuarioId', id);
        datos.append('servicios', idServicios);

        // console.log([...datos]);

        try{
            //Petición hacia la API
            const url = '/api/citas'

            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            console.log(resultado.resultado);

            if(resultado.resultado){
                Swal.fire({
                    icon: "success",
                    theme: "dark",
                    title: "Cita Creada",
                    text: "Tu cita ha sido creada correctamente!",
                    confirmButtonColor:"#0da6f3"
                }).then(()=> {
                    setTimeout(() =>{
                        window.location.reload();
                    });
                })
            }
            // console.log([...datos]); //Con este console.log podemos ver la informació que estamos enviando en el formData, sin [...datos] no nos lo imprime bien.

        } catch {
            Swal.fire({
                icon: "error",
                theme: "dark",
                title: "Error",
                text: "Algo ha salido mal al guardar tu cita.",
                confirmButtonColor:"#bb3524"
            });
        }
        
    }
}