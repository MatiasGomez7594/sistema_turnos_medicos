document.addEventListener("DOMContentLoaded", function() {
    CargarObras();
    CargarEspecialidades();


});

function CargarObras() {
    fetch('obras_sociales.php')
        .then(response => response.json())
        .then(data => {
            MostrarObras(data);
        })
        .catch(error => console.error('Error al obtener los datos:', error));
}
function MostrarObras(datos) {
    const obras = document.getElementById('obrasociales');
    obras.innerHTML = ''; // Limpiar contenido previo
    obras.innerHTML+='<option selected value="0">Seleccione una obrasocial/prepaga</option>'
    datos.forEach(obra => {
        let o =`        
                <option value="${obra.id}">${obra.nombre}</option>
                `

        obras.innerHTML += o;

    });   
    


    
}

function CargarEspecialidades() {
    fetch('especialidades.php')
        .then(response => response.json())
        .then(data => {
            MostrarEspecialidades(data);
        })
        .catch(error => console.error('Error al obtener los datos:', error));
}
function MostrarEspecialidades(datos) {
    const especialidades = document.getElementById('especialidades');
    especialidades.innerHTML = ''; // Limpiar contenido previo
    especialidades.innerHTML+='<option selected value="0">Seleccione una especialidad</option>'
    datos.forEach(especialidad => {
        let e =`        
                <option value="${especialidad.id}">${especialidad.nombre}</option>
                `

        especialidades.innerHTML += e;

    });
    
}



function SolicitarTurno() {

    const formData = new FormData(document.getElementById("form"));

    // Enviar la solicitud AJAX
    fetch('solicitar_turno.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data)
        if (data.success==true) {
            mensaje = data.message
            console.log(mensaje)
        // Si el registro es exitoso, limpiar el formulario, muestro un mensaje
        var modalElement = document.getElementById('exampleModal');
        // Crear una instancia del modal usando Bootstrap 5
        var modal = new bootstrap.Modal(modalElement);
        
        modal.show();
        document.getElementById("error").innerHTML = ''

        }else{
            mensaje = data.message
            console.log(mensaje)
            document.getElementById("error").innerHTML = mensaje

 

        }


    })
    .catch(error => {
        console.log(error)
        document.getElementById('errorRegistro').innerHTML = 'Error: ' + error;
    });
}



document.getElementById("btnReiniciar").addEventListener("click",function(){
    document.getElementById("form").reset()
})

document.getElementById("btnSolicitar").addEventListener("click",function(){
    SolicitarTurno()
})