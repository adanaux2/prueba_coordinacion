var getProfe = "http://localhost/prueba_coordinacion/public/getMaestro";

const curpValue = document.getElementById("curpInput").value;

// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: curpValue,
            principal: 0,
            maestro: [],
            curpConsultaGet: curpValue,
        };
    },
    created() {},

    methods: {
        vista1: function () {
            this.principal = 1;
        },
        vista2: function () {
            this.principal = 2;
            this.getMaestro();
        },
        getMaestro: function () {
            axios
                .get(getProfe + "/" + curpValue)
                .then((response) => {
                    this.maestro = response.data;
                    console.log(this.maestro);
                })
                .catch((error) => {
                    console.error("Error al obtener el maestro:", error);
                });
        },
        importarUsuarios: function () {
            const formData = new FormData();
            formData.append("file", this.$refs.fileInput.files[0]);

            axios
                .post("/importar-usuarios", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    console.log(response.data);
                    alert("Usuarios importados exitosamente.");
                })
                .catch((error) => {
                    console.error("Error al importar usuarios:", error);
                    alert("Hubo un error al importar usuarios.");
                });
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiProfes");
