var ruta = document.querySelector("[name=route]").value;

var LiscMaterias = ruta + "/apiLisc";
var apiLicenciaturas = ruta + "/apiLicenciaturas";
var apiRvoe = ruta + "/apiR";
// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: "apiLic desde vue 3",
            principal: 0,
            lisc: [],
            licenciaturasObtenidas: [],
            id_rvoe: "",
            licenciatura_rvoe: "",
        };
    },
    created() {
        this.obtenerLisc();
        this.obtenerLiscenciaturas();
    },

    methods: {
        openModal: function () {
            $(exampleModal).modal("show"); // Usa jQuery para mostrar la ventana modal
        },
        vista1: function () {
            this.principal = 1;
        },
        vista2: function () {
            this.principal = 2;
        },
        obtenerLisc: function () {
            window.axios
                .get(LiscMaterias)
                .then((response) => {
                    // console.log(response.data);
                    this.lisc = response.data;
                    console.log(this.lisc);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        verModal: function () {
            $("#rvoeModal").modal("show");
        },
        obtenerLiscenciaturas: function () {
            window.axios
                .get(apiLicenciaturas)
                .then((response) => {
                    // console.log(response.data);
                    this.licenciaturasObtenidas = response.data;
                    console.log(this.licenciaturasObtenidas);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        guardarRvoe: function () {
            const rvoe = {
                id_rvoe: this.id_rvoe,
                nombre: this.id_rvoe,
                id_licenciatura: this.licenciatura_rvoe,
            };

            console.log(rvoe);
            axios
                .post(apiRvoe, rvoe)
                .then((response) => {
                    // console.log("exito");
                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: "RVOE registrado",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                })
                .catch((error) => {
                    console.error("Error submitting form:", error);
                });
            $(rvoeModal).modal("hide");
            this.obtenerLisc();
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiLic");
