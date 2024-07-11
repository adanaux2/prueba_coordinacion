// Crear una instancia de Vue
var ruta = document.querySelector("[name=route]").value;

var apiMaterias = ruta + "/apiMaterias";
var apiGrupos = ruta + "/apiGrupo";
var getMate = ruta + "/getMate/";
var apiProfe = ruta + "/apiProfe";
var getConsulta = ruta + "/getConsultaProfe/";
// var apiMatG = ruta + "/apiMatG";
var apiMatG = ruta + "/apimatG";

const doc = new window.jspdf.jsPDF();

// import jsPDF from 'jspdf';
// Crear una instancia de Vue
const app = Vue.createApp({
    data() {
        return {
            mensaje: "Asignar profesores final",
            grupos: [],
            unGrupo: [],
            materias: [],
            id: "",
            principal: 0,
            ProfesObtenidos: [],
            buscarCoincidencias: "",

            // name materia actualizar
            name: "",
            idActualizar: "",
            hora: "",
            hora_fin: "",
            modulo: "",

            //variables de vista configurar modulos
            asignaturas: [],
            GrupoFI: "",
            GrupoFF: "",
            turno: "",
            fechasMo1: [],
            fechasMo2: [],
            semanaExamenes: [],
            semanaExamenes2: [],
        };
    },
    created() {
        // this.obtenerMaterias();
        // this.obtenerLicenciaturas();
        this.obtenerGrupos();
    },
    watch: {
        turno(newValue) {
            switch (newValue) {
                case "Nocturno":
                case "Matutino":
                    this.claseEntreSemana();
                    break;
                case "Sabatino vespertino":
                    this.claseFinDeSemana();
                    break;
                case "3":
                    alert("Turno Nocturno");
                    break;
                default:
                    break;
            }
        },
    },

    methods: {
        openModal: function () {
            $(exampleModal).modal("show"); // Usa jQuery para mostrar la ventana modal
        },
        obtenerMaterias: function () {
            window.axios
                .get(apiMaterias)
                .then((response) => {
                    // console.log(response.data);
                    this.materias = response.data;
                    console.log(this.materias);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        obtenerLicenciaturas: function () {
            window.axios.get(apiR).then((response) => {
                // console.log(response.data);
                this.rObtenidas = response.data;
                // console.log(this.licenciaturasObtenidas);
            });
            // .catch((error) => {
            //     console.error("Hubo un error al obtener los datos:", error);
            // });
        },
        obtenerGrupos: function () {
            window.axios
                .get(apiGrupos)
                .then((response) => {
                    // console.log(response.data);
                    this.grupos = response.data;
                    // console.log(this.grupos);
                    $(document).ready(function () {
                        $("#dataTableGrupos").DataTable({
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
        editarGrupo: function (id) {
            // alert(id);
            this.id = id;
            window.axios
                .get(apiGrupos + "/" + id)
                .then((response) => {
                    // console.log(response.data);
                    this.unGrupo = response.data;
                    // console.log(this.unGrupo);
                    // $(document).ready(function () {
                    //     $("#dataTableGrupos2").DataTable({
                    //         language: {
                    //             lengthMenu:
                    //                 "Mostrando _MENU_ elementos en esta pagina",
                    //             zeroRecords: "Sin coincidencias",
                    //             info: "Página _PAGE_ de _PAGES_",
                    //             infoEmpty: "Sin datos disponibles",
                    //             infoFiltered:
                    //                 "(Filtrado de  _MAX_ datos en total)",
                    //             search: "Buscar:",
                    //         },
                    //     });
                    // });

                    this.getMate();
                    this.principal = 1;
                })

                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        getMate: function () {
            // alert(id);
            // this.unGrupo.materias = [];
            window.axios
                .get(getMate + this.id)
                .then((response) => {
                    // console.log(response.data);

                    this.materias = response.data;
                    // Si unGrupo no tiene un array materias, inicialízalo
                    if (!this.unGrupo.materias) {
                        this.unGrupo.materias = [];
                    }
                    this.unGrupo.materias.push(...this.materias);
                    $("#dataTableGrupos2").DataTable().destroy();
                    // console.log(this.unGrupo.materias);
                    $(document).ready(function () {
                        $("#dataTableGrupos2").DataTable({
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
        obtenerProfe: function () {
            // alert("buscando");
            window.axios
                .get(getConsulta + this.buscarCoincidencias)
                .then((response) => {
                    // console.log(response.data);
                    this.ProfesObtenidos = [];
                    this.ProfesObtenidos = response.data;
                    console.log(this.ProfesObtenidos);

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
        verModal: function (id) {
            //buscarcoincidencias es el id de la materia en cuestion por asignar
            this.buscarCoincidencias = id;
            $("#modalP").modal("show");
            $("#dataTable").DataTable().destroy();
            this.obtenerProfe();
        },
        agregarProfe: function (id) {
            // alert(id);
            const materia = this.unGrupo.materias.find(
                (materia) => materia.id_materia === this.buscarCoincidencias
            );
            if (materia) {
                materia.id_profesor = id;

                // Buscar en los arrays anidados dentro de ProfesObtenidos
                let profesorEncontrado = null;
                for (let subArray of this.ProfesObtenidos) {
                    profesorEncontrado = subArray.profesor.find(
                        (prof) => prof.id_profe === id
                    );
                    if (profesorEncontrado) break; // Salir del bucle si se encuentra el profesor
                }
                materia.name_profesor = profesorEncontrado
                    ? profesorEncontrado.nombre_c
                    : "Nombre no encontrado";
                // console.log(materia);
                $("#modalP").modal("hide");
            } else {
                alert("Materia no encontrada");
            }
        },
        updateItem() {
            const materias = this.unGrupo.materias;

            materias.forEach((materia) => {
                if (materia.id_profesor != null) {
                    console.log(materia);
                    const matId = materia.id;
                    const profeId = materia.id_profesor;
                    // const hora=materia.hora;
                    // const hora_fin=materia.hora_fin;
                    // const modulo=materia.modulo;

                    console.log(matId, profeId);
                    axios
                        .put(`${apiMatG}/${matId}`, {
                            id_profesor: profeId,
                            name_profesor: materia.name_profesor,
                            // hora:hora,
                            // hora_fin:hora_fin,
                            // modulo:modulo
                        })
                        .then((response) => {
                            console.log("Item actualizado:", response.data);
                            // Aquí puedes manejar la respuesta como desees
                        })
                        .catch((error) => {
                            console.error(
                                "Error al actualizar el item:",
                                error
                            );
                            // Manejo de errores
                        });
                }
            });
        },
        verModalHyM: function (id) {
            $("#modalHyM").modal("show");
            const materia = this.unGrupo.materias.find(
                (materia) => materia.id_materia === id
            );
            this.name = materia;
            this.idActualizar = materia.id;
        },
        updateHora: function () {
            axios
                .put(`${apiMatG}/${this.idActualizar}`, {
                    // id_profesor: profeId,
                    // name_profesor: materia.name_profesor,
                    hora: this.hora,
                    hora_fin: this.hora_fin,
                    modulo: this.modulo,
                })
                .then((response) => {
                    console.log("Item actualizado:", response.data);
                    // Aquí puedes manejar la respuesta como desees
                })
                .catch((error) => {
                    console.error("Error al actualizar el item:", error);
                    // Manejo de errores
                });
            $("#modalHyM").modal("hide");

            // this.editarGrupo(this.id);
            this.verCambiosHora();
        },
        verCambiosHora: function () {
            window.axios
                .get(apiGrupos + "/" + this.id)
                .then((response) => {
                    this.unGrupo = response.data;
                    this.getMate();
                    this.principal = 1;
                })

                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        configurarModulos: function () {
            this.obtenerGrupos2();
            this.principal = 2;
        },
        obtenerGrupos2: function () {
            window.axios
                .get(apiGrupos + "/" + this.id)
                .then((response) => {
                    // console.log(response.data);
                    this.asignaturas = response.data.mate;
                    this.GrupoFI = response.data.fecha_inicio;
                    this.GrupoFF = response.data.fecha_fin;
                    this.turno = response.data.turno;

                    // console.log(this.asignaturas);
                    // console.log(this.GrupoFI);
                    // console.log(this.GrupoFF);
                    // console.log(this.turno);
                })
                .catch((error) => {
                    console.error("Hubo un error al obtener los datos:", error);
                });
        },
        generarPDF() {
            const doc = new window.jspdf.jsPDF();
            doc.text("¡Hola! Este es un PDF generado desde Vue.js.", 10, 10);
            doc.save("documento.pdf");
        },
        claseEntreSemana: function () {
            dayjs.locale('es');
            //obtener las fechas del modulo 1

            const fecha_inicio = this.GrupoFI;
            const fecha_fin = this.GrupoFF;
            const meses = 2;
            const fechaInicial = dayjs(fecha_inicio);
            const fechaFF = dayjs(fecha_fin);

            const mesesObjetos = [];

            const MARTES = 2;
            const MIERCOLES = 3;
            const JUEVES = 4;

            let currentFecha = fechaInicial;

            const fechaFin = fechaInicial.add(meses, "month");

            const semanaExamenes = [];

            while (currentFecha.isBefore(fechaFin)) {
                const dayOfWeek = currentFecha.day();
                const esUltimaSemana = currentFecha.isAfter(
                    fechaFin.subtract(1, "week")
                );
                if (
                    dayOfWeek === MARTES ||
                    dayOfWeek === MIERCOLES ||
                    dayOfWeek === JUEVES
                ) {
                    const mes = currentFecha.format("MMMM");
                    const diaSemana = currentFecha.format("dddd");
                    const fecha = currentFecha.format("DD");

                    if (esUltimaSemana) {
                        semanaExamenes.push({
                            dia: diaSemana,
                            fecha: fecha,
                            mes: mes,
                        });
                    } else {
                        let mesObjeto = mesesObjetos.find((m) => m.mes === mes);
                        if (!mesObjeto) {
                            mesObjeto = {
                                mes: mes,
                                Martes: [],
                                Miércoles: [],
                                Jueves: [],
                            };
                            mesesObjetos.push(mesObjeto);
                        }

                        if (dayOfWeek === MARTES) {
                            mesObjeto.Martes.push(fecha);
                        } else if (dayOfWeek === MIERCOLES) {
                            mesObjeto.Miércoles.push(fecha);
                        } else if (dayOfWeek === JUEVES) {
                            mesObjeto.Jueves.push(fecha);
                        }
                    }
                }
                currentFecha = currentFecha.add(1, "day");
            }
            //obtener las fechas de el modulo 2
            let currentFecha2 = fechaFin;
            const fechaFin2 = fechaFF;
            const mesesObjetos2 = [];
            const semanaExamenes2 = [];

            while (currentFecha2.isBefore(fechaFin2)) {
                const dayOfWeek2 = currentFecha2.day();
                const esUltimaSemana2 = currentFecha2.isAfter(
                    fechaFin2.subtract(1, "week")
                );
                if (
                    dayOfWeek2 === MARTES ||
                    dayOfWeek2 === MIERCOLES ||
                    dayOfWeek2 === JUEVES
                ) {
                    const mes = currentFecha2.format("MMMM");
                    const diaSemana = currentFecha2.format("dddd");
                    const fecha = currentFecha2.format("DD");

                    if (esUltimaSemana2) {
                        semanaExamenes2.push({
                            dia: diaSemana,
                            fecha: fecha,
                            mes: mes,
                        });
                    } else {
                        let mesObjeto2 = mesesObjetos2.find(
                            (m) => m.mes === mes
                        );
                        if (!mesObjeto2) {
                            mesObjeto2 = {
                                mes: mes,
                                Martes: [],
                                Miércoles: [],
                                Jueves: [],
                            };
                            mesesObjetos2.push(mesObjeto2);
                        }

                        if (dayOfWeek2 === MARTES) {
                            mesObjeto2.Martes.push(fecha);
                        } else if (dayOfWeek2 === MIERCOLES) {
                            mesObjeto2.Miércoles.push(fecha);
                        } else if (dayOfWeek2 === JUEVES) {
                            mesObjeto2.Jueves.push(fecha);
                        }
                    }
                }
                currentFecha2 = currentFecha2.add(1, "day");
            }

            this.fechasMo1 = mesesObjetos;
            this.fechasMo2 = mesesObjetos2;
            this.semanaExamenes = semanaExamenes;
            this.semanaExamenes2 = semanaExamenes2;

            // console.log(this.fechasMo2);
            // console.log(this.semanaExamenes2);
            // console.log(fechaFin);
            // console.log(this.materiasModulo1);
            // alert("Turno Matutino");
        },
        claseFinDeSemana: function () {
            dayjs.locale('es');
            const inicio = this.GrupoFI;
            const fechaInicial = dayjs(inicio);
            const fechaFin = dayjs(this.GrupoFF);

            const SABADO = 6;
            const mesesObjetos = [];
            const semanaExamenes = [];

            let fechaActual = fechaInicial;

            while (
                fechaActual.isBefore(fechaFin) ||
                fechaActual.isSame(fechaFin)
            ) {
                if (fechaActual.day() === SABADO) {
                    const mes = fechaActual.format("MMMM");
                    const dia = fechaActual.format("DD");

                    let mesObjeto = mesesObjetos.find((m) => m.mes === mes);
                    if (!mesObjeto) {
                        mesObjeto = { mes, sabados: [] };
                        mesesObjetos.push(mesObjeto);
                    }
                    mesObjeto.sabados.push(dia);

                    semanaExamenes.push({
                        dia: fechaActual.format("dddd"),
                        diaNumero: dia,
                        mes,
                    });
                }
                fechaActual = fechaActual.add(1, "day");
            }

            // Dividir los meses en dos arreglos de a dos meses cada uno
            const grupo1 = mesesObjetos.slice(0, 2);
            const grupo2 = mesesObjetos.slice(2, 4);

            // Quitar la última fecha de cada bimestre y guardarlas en las variables correspondientes
            let fechaExamenes1 = null;
            let fechaExamenes2 = null;

            if (
                grupo1.length > 0 &&
                grupo1[grupo1.length - 1].sabados.length > 0
            ) {
                const ultimoSabadoGrupo1 =
                    grupo1[grupo1.length - 1].sabados.pop();
                fechaExamenes1 = {
                    dia: ultimoSabadoGrupo1,
                    mes: grupo1[grupo1.length - 1].mes,
                };
            }

            if (
                grupo2.length > 0 &&
                grupo2[grupo2.length - 1].sabados.length > 0
            ) {
                const ultimoSabadoGrupo2 =
                    grupo2[grupo2.length - 1].sabados.pop();
                fechaExamenes2 = {
                    dia: ultimoSabadoGrupo2,
                    mes: grupo2[grupo2.length - 1].mes,
                };
            }

            this.fechasMo1 = grupo1;
            this.fechasMo2 = grupo2;
            // this.fechaExamenes1 = fechaExamenes1;
            // this.fechaExamenes2 = fechaExamenes2;
            this.semanaExamenes = fechaExamenes1;
            this.semanaExamenes2 = fechaExamenes2;

            // console.log(this.fechasMo1);
            // console.log(this.fechasMo2);
            // console.log(this.fechaExamenes1);
            // console.log(this.fechaExamenes2);
            // console.log(this.semanaExamenes);
        },
    },
    computed: {
        materiasModulo1() {
            return this.asignaturas.filter(
                (materia) => materia.modulo === "Modulo 1"
            );
        },
        materiasModulo2() {
            return this.asignaturas.filter(
                (materia) => materia.modulo === "Modulo 2"
            );
        },
    },
});

// Montar la aplicación en un elemento del DOM
app.mount("#apiAsignar");
