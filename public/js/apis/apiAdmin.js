var apiAdmin = "http://localhost/prueba_coordinacion/public/apiMaestros";
var saveUser = "http://localhost/prueba_coordinacion/public/register2";

// import axios from "axios";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            message: "¡Hola desde Vue  3!",
            usuarios: [],
            name: "",
            email: "",
            password: "",
        };
    },
    created() {
        // this.fetchData();
        this.obtenerDatos();
    },
    methods: {
        sayHello() {
            alert(this.message);
        },

        obtenerDatos: function () {
            window.axios
                .get(apiAdmin)
                .then((response) => {
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },

        openModal: function () {
            $(exampleModal).modal("show"); // Usa jQuery para mostrar la ventana modal
            // console.log('hola')
        },

        guardarUsuario: function () {
            const user = {
                name: this.name,
                email: this.email,
                password: this.password,
            };

            console.log(user);

            axios
                .post(saveUser, user)
                .then((response) => {
                    // console.log("exito");
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "Usuario registrado",
                        showConfirmButton: false,
                        timer: 1500
                      });
                })
                .catch((error) => {
                    console.error("Error submitting form:", error);
                });
        },
        validarInputs: function () {
            if (!this.name) {
                // alert("El campo nombre está vacío.");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "El campo nombre está vacío!",
                });
                return false;
            }
            if (!this.email) {
                // alert("El campo email está vacío.");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "El campo email está vacío.",
                });
                return false;
            }
            if (!this.password) {
                // alert("La contraseña está vacía.");
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "La contraseña está vacía.",
                });
                return false;
            }
            this.guardarUsuario();
            this.limpiarModal();
            $(exampleModal).modal('hide'); // Usa jQuery para cerrar la ventana modal
        },
        limpiarModal:function(){
            this.name='';
            this.email='';
            this.password='';
        }
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAdmin");
