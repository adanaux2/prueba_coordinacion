var apiUser = "http://localhost/prueba_coordinacion/public/apiUser";
var saveUser = "http://localhost/prueba_coordinacion/public/register2";
// var apiroles = "http://localhost/prueba_coordinacion/public/apiRoles";
var apiMaestros = "http://localhost/prueba_coordinacion/public/apiProfe";

// import axios from "axios";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            message: "¡Hola desde Vue  3-maestros!",
            vista: 0,
            maestrosObtenidos: [],

            //nivel de ingles
            valorHabla: 50,
            valorEscribe: 50,
            valorLee: 50,

            // datos de sesion
            name: "",
            email: "",
            password: "",

            //grado de estudios
            licenciatura: "",
            c_licenciatura: "",
            maestria: "",
            c_maestria: "",
            doctorado: "",
            c_doctorado: "",

            //datos generales
            nombre_c: "",
            domicilio: "",
            telefono: "",
            correo_institucional: "",
            genero: "",
            f_nacimiento: "",
            l_nacimiento: "",
            rfc: "",
            curp: "",
            //numeros de contacto
            nombre_contacto: "",
            relacion_contacto: "",
            telefono_contacto: "",

            nombre_contacto2: "",
            relacion_contacto2: "",
            telefono_contacto2: "",
        };
    },
    created() {
        // this.fetchData();
        this.obtenerDatos();
        // this.obtenerRoles();
    },
    methods: {
        openModal: function () {
            // this.agregar = true;
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
        // convertirAMayusculas: function () {
        //     this.nombre_c = this.nombre_c.toUpperCase();
        // },
        guardarUsuario: function () {
            const user = {
                name: this.name,
                email: this.email,
                password: this.password,
                id_rol: 3,
                curp: this.curp,
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
            this.guardarMaestro();
            this.destruirDT();
            this.obtenerDatos();
            
        },
        guardarMaestro: function () {
            const maestro = {
                // nivel de ingles
                habla: this.valorHabla,
                escribe: this.valorEscribe,
                lee: this.valorLee,
                //grado de estudios
                licenciatura: this.licenciatura,
                c_licenciatura: this.c_licenciatura,
                maestria: this.maestria,
                c_maestria: this.c_maestria,
                doctorado: this.doctorado,
                c_doctorado: this.c_doctorado,

                //datos generales
                nombre_c: this.nombre_c,
                domicilio: this.domicilio,
                telefono: this.telefono,
                correo_institucional: this.correo_institucional,
                genero: this.genero,
                f_nacimiento: this.f_nacimiento,
                l_nacimiento: this.l_nacimiento,
                rfc: this.rfc,
                curp: this.curp,

                //numeros de contacto
                nombre_contacto: this.nombre_contacto,
                relacion_contacto: this.relacion_contacto,
                telefono_contacto: this.telefono_contacto,

                nombre_contacto2: this.nombre_contacto2,
                relacion_contacto2: this.relacion_contacto2,
                telefono_contacto2: this.telefono_contacto2,
            };

            console.log(maestro);

            axios
                .post(apiMaestros, maestro)
                .then((response) => {
                    console.log(response.data);
                    // Swal.fire({
                    //     position: "top-center",
                    //     icon: "success",
                    //     title: "Usuario registrado",
                    //     showConfirmButton: false,
                    //     timer: 1500,
                    // });
                })
                .catch((error) => {
                    console.error("Error submitting form:");
                });
                $("#exampleModal").modal("hide");
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
