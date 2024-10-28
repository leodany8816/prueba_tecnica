const btnRegistrar = document.getElementById("btnRegistrar");
const btnLogin = document.getElementById("btnLogin");
document.addEventListener('DOMContentLoaded', formLogin);

const telefonoInput = document.getElementById('telefono');

telefonoInput.addEventListener('input', (event) => {
    event.target.value = event.target.value.replace(/\D/g, '');
});

/**
 * Formuario Login
 */
function formLogin() {
    document.querySelector('.login').addEventListener('submit', function (e) {
        e.preventDefault();
        const form = this;
        const correo = document.getElementById('correo').value;
        const password = document.getElementById('password').value;
        const stateElement = form.querySelector('button .state');
        form.classList.add('loading');
        stateElement.textContent = 'Validando, espere un momento.';

        if (!validar_email(correo)) {
            form.classList.add('error');
            stateElement.textContent = 'El correo electrónico no tiene el formato correcto';

            setTimeout(() => {
                stateElement.textContent = 'Log in';
                form.classList.remove('ok', 'loading', 'error');
            }, 2000);
        } else {
            const data = {
                correo: correo,
                password: password
            };

            const opciones = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)

            };

            fetch('views/login.php', opciones)
                .then(async response => {
                    if (!response.ok) {
                        const text = await response.text();
                        throw new Error(text);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status) {
                        form.classList.add('ok');
                        stateElement.textContent = 'Bienvenido!';
                        // Redirigir después de 2 segundos
                        setTimeout(() => {
                            window.location.href = 'usuarios.php';
                        }, 2000);
                    } else {
                        form.classList.add('error');
                        stateElement.textContent = 'Usuario y Contraseña incorrectas.';

                        setTimeout(() => {
                            stateElement.textContent = 'Log in';
                            form.classList.remove('ok', 'loading', 'error');
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                    form.classList.add('error');
                    stateElement.textContent = 'Ocurrió un error. Intente de nuevo más tarde.';

                    setTimeout(() => {
                        stateElement.textContent = 'Log in';
                        form.classList.remove('loading', 'error');
                    }, 2000);
                });
        }
    });
}

/**
 * Formulario de registro
 */
function formRegistro() {
    const validarData = document.querySelectorAll('.requerido');

    const nombre = document.getElementById('nombre').value;
    const telefono = document.getElementById('telefono').value;
    const correo = document.getElementById('correo').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
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
    } else if (!validar_password(password, confirmPassword)) {
        Swal.fire(
            {
                icon: "error",
                title: "Error",
                text: "Las contraseñas no coinciden",
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
            nombre: nombre,
            telefono: telefono,
            correo: correo,
            password: password,
            rfc: rfc,
            notas: notas
        };

        const opciones = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)

        };

        fetch('views/newUsuario.php', opciones)
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
                            location.href = 'index.php';
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
 * validacion para que los password coincidan
 */
function validar_password(pass1, pass2) {
    if (pass1 != pass2) return false;
    return true;
}

/**
 * funcion para validar email
 */
function validar_email(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}