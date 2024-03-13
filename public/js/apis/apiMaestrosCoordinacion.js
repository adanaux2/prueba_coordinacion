var apiUser = "http://localhost/prueba_coordinacion/public/apiUser";
var saveUser = "http://localhost/prueba_coordinacion/public/register2";
// var apiroles = "http://localhost/prueba_coordinacion/public/apiRoles";
var apiMaestros = "http://localhost/prueba_coordinacion/public/apiMaestros";

// import axios from "axios";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            message: "¡Hola desde Vue  3-maestros!",
            vista: 0,
            maestrosObtenidos: [],
            valorHabla: 50,
            valorEscribe: 50,
            valorLee: 50,
            agregar:true,
            


            // datos de sesion
            name:'',
            email:'',
            password:'',

            nombre_c: "",
        };
    },
    created() {
        // this.fetchData();
        this.obtenerDatos();
        // this.obtenerRoles();
    },
    methods: {
        openModal: function () {
            this.agregar = true;
            $(exampleModal).modal("show"); // Usa jQuery para mostrar la ventana modal
            // console.log('hola')
        },
        vista1: function () {
            this.vista = 1;
        },
        obtenerDatos: function () {
            window.axios
                .get(apiMaestros)
                .then((response) => {
                    this.maestrosObtenidos = [];
                    this.maestrosObtenidos = response.data;
                    // console.log(this.usuarios);
                    $(document).ready(function () {
                        $("#dataTable").DataTable({
                            language: {
                                lengthMenu:
                                    "Mostrando _MENU_ elementos en esta pagina",
                                zeroRecords: "Sin coincidencias",
                                info: "Página _PAGE_ de _PAGES_",
                                infoEmpty: "Sin datos disponibles",
                                infoFiltered:
                                    "(Filtrado de  _MAX_ datos en total)",
                                search: "Buscar:",
                            },
                        });
                    });
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        convertirAMayusculas: function () {
            this.nombre_c = this.nombre_c.toUpperCase();
        },
        guardarUsuario: function () {
            const user = {
                name: this.name,
                email: this.email,
                password: this.password,
                id_rol: 3,
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
                        timer: 1500,
                    });
                })
                .catch((error) => {
                    console.error("Error submitting form:", error);
                });
            this.destruirDT();
            this.obtenerDatos();
        },
        destruirDT: function () {
            $(document).ready(function () {
                // Inicializar el DataTable
                var dataTable = $("#dataTable").DataTable();

                // Destruir el DataTable
                dataTable.destroy();
            });
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiMaestros");
