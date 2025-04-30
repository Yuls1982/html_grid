(() => {
    let sumaTotal = 0;

    const tipoPag = document.querySelector("#base");
    const plazoMes = document.querySelector("#plazo");
    const opciones = document.querySelectorAll("#extras > input");
    const preTotal = document.querySelector("#total");

    const suma = () => {
        sumaTotal = parseInt(tipoPag.value);

        switch (plazoMes.value) {
            case "1":
                sumaTotal += parseInt(100);
                break;
            case "2":
                sumaTotal += parseInt(50);
                break;
            default:
                sumaTotal += parseInt(0);
        }

        opciones.forEach((element) => {
            if (element.checked) {
                sumaTotal += parseInt(element.value);
            }
        });

        preTotal.value = sumaTotal;
    };

    opciones.forEach((element) => {
        element.addEventListener("change", suma);
    });

    tipoPag.addEventListener("change", suma);
    plazoMes.addEventListener("change", suma);

    const formulario = document.getElementById("formulario");

    const nombre = document.getElementById("nombre");
    const apellidos = document.getElementById("apellidos");
    const telefono = document.getElementById("telefono");
    const email = document.getElementById("email");

    const validar = {
        nombre: false,
        apellidos: false,
        telefono: false,
        email: false,
    };

    nombre.addEventListener("blur", () => {
        validarCampo(nombre, /^[a-zA-Z ]{2,15}$/, "No puede dejar el nombre en blanco", "El nombre solo puede estar formado por letras y contener entre 2 y 15 caracteres");
    });

    apellidos.addEventListener("blur", () => {
        validarCampo(apellidos, /^[a-zA-Z ]{2,30}$/, "No puede dejar los apellidos en blanco", "Los apellidos solo pueden estar formados por letras y contener entre 2 y 30 caracteres");
    });

    telefono.addEventListener("blur", () => {
        validarCampo(telefono, /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3}$/, "No puede dejar el teléfono en blanco", "El teléfono solo puede estar formado por 9 números");
    });

    email.addEventListener("blur", () => {
        validarCampo(email, /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/, "No puede dejar el email en blanco", "No ingresó un email válido");
    });

    formulario.addEventListener("submit", (e) => {
        e.preventDefault();
        suma(); // Actualizar la suma antes de validar
        if (validarFormulario()) {
            formulario.submit();
        }
    });

    const botonSubmit = document.querySelector("#submit");
    const botonReset = document.querySelector("#reset");

    botonSubmit.addEventListener("click", (evento) => {
        evento.preventDefault();
        suma(); // Actualizar la suma antes de validar
        let valido = validarFormulario();
        if (valido) {
            formulario.submit();
        }
    });

    botonReset.addEventListener("click", () => {
        formulario.reset();
        limpiarEstilos();
        // Restablecer el objeto de validación
        for (const property in validar) {
            validar[property] = false;
        }
    });

    function validarCampo(input, regex, emptyMessage, invalidMessage) {
        let value = input.value.trim();
        if (value === "") {
            setErrorFor(input, emptyMessage);
            validar[input.id] = false;
        } else {
            if (!regex.test(value)) {
                setErrorFor(input, invalidMessage);
                validar[input.id] = false;
            } else {
                validar[input.id] = true;
                setSuccessFor(input);
            }
        }
    }

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
        const small = formControl.querySelector("small");
        formControl.className = "form-control error";
        small.innerText = message;
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        formControl.className = "form-control success";
    }

    function validarFormulario() {
        for (const property in validar) {
            if (validar[property] === false) {
                return false;
            }
        }
        return true;
    }

    function limpiarEstilos() {
        const formControls = document.querySelectorAll(".form-control");
        formControls.forEach((formControl) => {
            formControl.className = "form-control";
        });
    }
})();
