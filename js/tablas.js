const telefonoInput = document.getElementById('telefono');
telefonoInput.addEventListener('input', (event) => {
    // Eliminamos cualquier carácter que no sea un número
    event.target.value = event.target.value.replace(/\D/g, '');
});

let tablacfdis = $("#dt_usuarios").DataTable({
    scrollX: true,
    responsive: true,
    searching: true,
    order: [0, 'desc'],
    columnDefs: [
        { targets: 0, orderable: true },
        { targets: 1, orderable: true },
        { targets: 2, orderable: true },
        { targets: 3, orderable: true },
        { targets: 4, orderable: true },
        { targets: 5, orderable: true },
        { targets: 6, orderable: false },

    ],
    dom: 'Bftip',
    buttons: [
        {
            extend: 'csvHtml5', // Especifica el tipo de exportación
            text: 'Exportar a CSV', // Texto del botón
            titleAttr: 'CSV', // Tooltip al pasar el cursor
            exportOptions: {
                columns: ':visible' // Exporta solo las columnas visibles
            },
            className: 'mx-2'
        }
    ],
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "NingÃºn dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": '<div class="input-group-text d-inline-flex width-3 align-items-center justify-content-center">Buscar</div>',
        // "sSearch": '', 
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
    dom:
        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    'serverMethod': 'POST',
    'ajax': {
        'url': 'views/usuarios.php',
        'type': 'POST',
    },
    'columns': [
        { data: 'nombre' },
        { data: 'telefono' },
        { data: 'correo' },
        { data: 'password' },
        { data: 'rfc' },
        { data: 'notas' },
        { data: 'descargar' }
    ],
    "initComplete": function (settings, json) {
        $('#dt_usuarios_filter input').attr('placeholder', 'Escriba una palabra');
        //$('#dt_basica_reporte_filter input').addClass('input-group sm-12'); 
        $('#dt_usuarios_filter input').attr('size', '20');

    },
});

$('#dt_usuarios').on('click', '.btnUsuario', function () {
    const idUsuario = $(this).attr('id');
    const myModal = new bootstrap.Modal(document.getElementById('editarModal'));
    myModal.show();

    const data = {
        id: idUsuario
    };
    const opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)

    };

    fetch('views/editUsuario.php', opciones)
        .then(async response => {
            if (!response.ok) {
                const text = await response.text();
                throw new Error(text);
            }
            return response.json();
        })
        .then(data => {
            if (data.status) {
                document.getElementById('id').value = data.usuario['id_usuario'];
                document.getElementById('nombre').value = data.usuario['nombre'];
                document.getElementById('telefono').value = data.usuario['telefono'];
                document.getElementById('correo').value = data.usuario['correo'];
                document.getElementById('password').value = data.usuario['password'];
                document.getElementById('rfc').value = data.usuario['rfc'];
                document.getElementById('notas').value = data.usuario['notas'];
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
});

function editarUsuario() {
    const myModalEl = document.getElementById('editarModal');
    const myModal = bootstrap.Modal.getInstance(myModalEl) || new bootstrap.Modal(myModalEl);

    const validarData = document.querySelectorAll('.requerido');
    const id = document.getElementById('id').value;
    const nombre = document.getElementById('nombre').value;
    const telefono = document.getElementById('telefono').value;
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;
    const rfc = document.getElementById('rfc').value;
    const notas = document.getElementById('notas').value;

    let error = false;
    let errorMsg = "";

    validarData.forEach((element, index) => {
        if (element.value.trim() === '') {
            error = true;
            let label = element.previousElementSibling || element.parentNode.querySelector('label');
            if (label) {
                let labelText = label.textContent.replace("*", "").trim();
                errorMsg += (errorMsg === "") ? labelText : ", " + labelText;
            }
        }
    });

    if (error) {
        Swal.fire(
            {
                title: "Error",
                text: "Llenar los campos requeridos. " + errorMsg,
                icon: 'error',
                allowOutsideClick: false
            });
        return false;
    } else if (!validar_email(correo)) {
        Swal.fire(
            {
                icon: "error",
                title: "Error",
                text: "El correo electrónico no tiene el formato correcto",
                allowOutsideClick: false
            });
    } else if (!validarRFC(rfc)) {
        Swal.fire(
            {
                icon: "error",
                title: "Error",
                text: "El RFC no es valido",
                allowOutsideClick: false
            });

    } else {
        const data = {
            idUsr:id,
            nombre: nombre,
            telefono: telefono,
            correo: correo,
            password: password,
            rfc: rfc,
            notas: notas,
            editar:'editar'
        };

        const opciones = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)

        };

        fetch('views/editUsuario.php', opciones)
            .then(async response => {
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text);
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    Swal.fire(
                        {
                            icon: "success",
                            text: data.mensaje,
                            allowOutsideClick: false
                        }).then(function () {
                            myModal.hide(); // Usa hide para cerrar el modal
                            $('#dt_usuarios').DataTable().ajax.reload(null, false);
                        });
                } else {
                    Swal.fire(
                        {
                            icon: "error",
                            title: "Error",
                            text: data.mensaje,
                            allowOutsideClick: false
                        });
                }
            });
    }
}

/**
 * validacion para el RFC
 */
function validarRFC(rfc) {
    // let regexRFC  = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
    let regexRFC = /^([A-ZÑ&]{3,4})\d{6}([A-Z\d]{3})?$/;
    rfc = rfc.toUpperCase().trim();

    if (!regexRFC.test(rfc)) return false;
    return true;

}


/**
 * funcion para validar email
 */
function validar_email(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}