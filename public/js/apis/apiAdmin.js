
var ruta = document.querySelector("[name=route]").value;

var apiUser = ruta + "/apiUser";
var saveUser = ruta + "/register2";
var apiroles = ruta + "/apiRoles";

// import axios from "axios";

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            message: "¡Hola desde Vue  3!",
            usuarios: [],
            roles: [],
            name: "",
            email: "",
            password: "",
            rol_S: "",
            vista: 0,
            agregar: true,
            id_user: "",
        };
    },
    created() {
        // this.fetchData();
        this.obtenerDatos();
        this.obtenerRoles();
    },
    mounted() {
        // Inicializar DataTables después de que Vue.js haya montado la aplicación
    },
    methods: {
        obtenerDatos: function () {
            window.axios
                .get(apiUser)
                .then((response) => {
                    this.usuarios = [];
                    this.usuarios = response.data;
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

        obtenerRoles: function () {
            window.axios
                .get(apiroles)
                .then((response) => {
                    // console.log(response.data);
                    this.roles = response.data;
                    console.log(this.roles);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },

        openModal: function () {
            this.agregar = true;
            $(exampleModal).modal("show"); // Usa jQuery para mostrar la ventana modal
            // console.log('hola')
        },

        guardarUsuario: function () {
            const user = {
                name: this.name,
                email: this.email,
                password: this.password,
                id_rol: this.rol_S,
            };

            console.log(user);
            for (const [key, value] of Object.entries(user)) {
                if (!value) {
                    // alert(
                    //     `El campo '${key}' es obligatorio y no puede estar vacío.`
                    // );
                    Swal.fire({
                        title: "Oops...",
                        text: "El campo '" + key + "' es obligatorio y no puede estar vacío.",
                        icon: "question"
                      });
                    return;
                }
            }

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
            window.location.reload();
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
            $(exampleModal).modal("hide"); // Usa jQuery para cerrar la ventana modal
        },
        limpiarModal: function () {
            this.name = "";
            this.email = "";
            this.password = "";
        },
        vista1: function () {
            this.vista = 1;
        },
        destruirDT: function () {
            $(document).ready(function () {
                // Inicializar el DataTable
                var dataTable = $("#dataTable").DataTable();

                // Destruir el DataTable
                dataTable.destroy();
            });
        },
        eliminarUsuario(id) {
            Swal.fire({
                title: "Estas seguro?",
                text: "Este elemento será eliminado!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(apiUser + "/" + id)
                        .then((response) => {
                            console.log("Usuario eliminado:", response.data);
                            //Aqui se obtienen los usuarios nuevamente
                            this.obtenerDatos();
                        })
                        .catch((error) => {
                            console.error(
                                "Error al eliminar el usuario:",
                                error
                            );
                        });

                    Swal.fire({
                        title: "Deleted!",
                        text: "El usuario ha sido eliminado",
                        icon: "success",
                    });
                }
            });
        },
        editarUser: function (id) {
            this.agregar = false;
            this.id_user = id;

            window.axios
                .get(apiUser + "/" + id)
                .then((response) => {
                    // console.log(response.data);
                    // this.roles = response.data;
                    console.log(response.data);
                    this.name = response.data.name;
                    this.email = response.data.email;
                    this.rol_S = response.data.id_rol;
                    // this.password = response.data.password; 
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
            $(exampleModal).modal("show");
        },
        actualizarUser: function () {
            var datosEditadosUser = {
                name: this.name,
                email: this.email,
                rol: this.rol_S,    
            };

            if (this.password !== null) {
                datosEditadosUser.pass = this.password;
            }

            try {
                axios
                    .put(apiUser + "/" + this.id_user, datosEditadosUser)
                    .then((response) => {
                        // alert("Usuario actualizado correctamente");
                        // Aquí puedes realizar cualquier otra acción después de actualizar el usuario, si es necesario
                        this.obtenerDatos();
                        this.destruirDT();
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "El usuario se ha actualizado",
                            showConfirmButton: false,
                            timer: 1500
                          });
                          $(exampleModal).modal("hide");
                    })
                    .catch((error) => {
                        console.error("Error al actualizar el usuario:", error);
                        // Aquí puedes manejar errores específicos de la actualización del usuario, si es necesario
                    });
            } catch (error) {
                console.error("Error al actualizar el usuario:", error);
                // Manejo de errores generales, si es necesario
            }
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAdmin");
