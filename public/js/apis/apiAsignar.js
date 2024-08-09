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
            todosProfes: [],
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

            //variable de dia para filtro exacto
            diaFiltro: "",
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
                    // this.diaFiltro = "Nocturno";
                    this.claseEntreSemana();
                    break;
                case "Matutino":
                    // this.diaFiltro = "Matutino";
                    this.claseEntreSemana();
                    break;
                case "Sabatino vespertino":
                    // this.diaFiltro = "Sabatino vespertino";
                    this.claseFinDeSemana();
                    break;
                case "Sabatino matutino":
                    // this.diaFiltro = "Sabatino matutino";
                    this.claseFinDeSemana();
                    break;
                case "Dominical":
                    // this.diaFiltro = "Dominical";
                    this.claseDominical();
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
            // const diaConsulta = this.unGrupo.turno;
            // console.log(this.unGrupo);

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
        verModal2: function (id) {
            //buscarcoincidencias es el id de la materia en cuestion por asignar
            this.buscarCoincidencias = id;
            // console.log(this.buscarCoincidencias);
            $("#modalP2").modal("show");
            $("#dataTableTodos").DataTable().destroy();
            this.obtenerProfe2();
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
                    if (profesorEncontrado) break;
                    // Salir del bucle si se encuentra el profesor
                }
                materia.name_profesor = profesorEncontrado
                    ? profesorEncontrado.nombre_c
                    : "Nombre no encontrado";
                // console.log(materia);
                // this.agregarProfe2(id);
                $("#modalP").modal("hide");
            } else {
                alert("Materia no encontrada");
            }
        },
        agregarProfe2: function (id) {
            // alert(id);
            // console.log(this.buscarCoincidencias);
            const materia = this.unGrupo.materias.find(
                (materia) => materia.id_materia === this.buscarCoincidencias
            );
            if (materia) {
                materia.id_profesor = id;

                // Buscar en los arrays anidados dentro de ProfesObtenidos
                let profesorEncontrado = null;
                for (let subArray of this.todosProfes) {
                    if (subArray.id_profe === id) {
                        profesorEncontrado = subArray;
                        break; // Salir del bucle si se encuentra el profesor
                    }
                }

                materia.name_profesor = profesorEncontrado
                    ? profesorEncontrado.nombre_c
                    : "Nombre no encontrado";

                // Aquí puedes agregar cualquier otra propiedad del profesor que quieras a `materia`
                if (profesorEncontrado) {
                    materia.domicilio_profesor = profesorEncontrado.domicilio;
                    materia.telefono_profesor = profesorEncontrado.telefono;
                    materia.correo_profesor =
                        profesorEncontrado.correo_institucional;
                }

                // console.log(materia);
                $("#modalP2").modal("hide");
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
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Asignaciones guardadas",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            console.log("Item actualizado:", response.data);
                            // Aquí puedes manejar la respuesta como desees
                        })
                        .catch((error) => {
                            console.error(
                                "Error al actualizar el item:",
                                error
                            );
                            // Manejo de errores
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Error al guardar. Por favor, intenta de nuevo.",
                                // footer: '<a href="#">Why do I have this issue?</a>'
                            });
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
        validateFieldsHyM() {
            // Aquí puedes agregar más validaciones según tus necesidades
            if (!this.hora || !this.hora_fin || !this.modulo) {
                console.error("Todos los campos son obligatorios.");
                return false;
            }
            return true;
        },
        updateHora: function () {
            if (!this.validateFieldsHyM()) {
                // Si la validación falla, no se realiza la petición
                return;
            }

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
        verModalPdf: function () {
            $("#modalPdf").modal("show");

            this.generarPDF();
        },
        verModalPdf2: function () {
            $("#modalPdf").modal("show");

            this.generarPDF2();
        },
        generarPDF() {
            const doc = new window.jspdf.jsPDF();
            const data = this.unGrupo;

            // URL de la imagen (puede ser una URL en línea o un Data URL)
            const imgData = "img/pdf/logo.jpeg"; // Aquí va la cadena base64 de tu imagen
            const imgData2 = "img/pdf/nas.jpeg"; // Aquí va la cadena base64 de tu imagen

            // Añadir la imagen al PDF
            doc.addImage(imgData, "JPEG", 40, 20, 30, 30); // (imagen, formato, x, y, ancho, alto)
            doc.addImage(imgData2, "JPEG", 140, 20, 35, 25); // (imagen, formato, x, y, ancho, alto)

            doc.text("UNIVERSIDAD AZTLÁN", 75, 20);
            doc.text("PLANTEL CANCÚN 2", 78, 28);
            doc.text("HORARIO DE CLASES", 76, 36, { fontSize: 8 });
            doc.setFontSize(80); // Cambiar tamaño de fuente global
            doc.setTextColor(53, 39, 131); // Establecer color de texto en RGB (azul)
            doc.text(data.cuatrimestre, 180, 39);

            doc.setFontSize(18); // Cambiar tamaño de fuente global
            doc.setTextColor(53, 39, 131); // Establecer color de texto en RGB (azul)
            doc.text("MÓDULO 10", 18, 93);
            doc.text(data.modalidad, 150, 93);
            doc.text("MÓDULO 20", 18, 180);
            doc.text(data.modalidad, 150, 180);
            // doc.text("MÓDULO 1", 40, 107);

            doc.setFontSize(12); // Cambiar tamaño de fuente global
            // doc.setTextColor(53, 39, 131); // Establecer color de texto en RGB (azul)
            doc.text("TOTAL DE CRÉDITOS:     0 CRÉDITOS", 18, 280);
            doc.text(
                "NOTA: Éste horario podrá sufrir cambios sin previo aviso",
                18,
                285
            );
            //crear tabla

            // Datos dinámicos
            const licenciatura = data.name[0].licenciatura;
            const anio = data.anio;
            const turno = data.turno;
            const cuatrimestre = data.cuatrimestre;
            const clave = data.id_grupo;

            // Datos para la tabla
            const head = [["PROGRAMA ACADÉMICO", licenciatura, "CICLO", anio]];
            const body = [
                ["TIPO DE CICLO", "CUATRIMESTRAL", "CLAVE DE GRUPO", clave],
                ["MODALIDAD", "NO ESCOLARIZADA", "AULA"],
                ["TURNO", turno, "CUATRIMESTRE", cuatrimestre],
            ];

            // Crear tabla
            doc.autoTable({
                head: head,
                body: body,
                startY: 55, // Posición inicial después del encabezado
                theme: "grid",
                styles: { fontSize: 8 },
                headStyles: { fillColor: [255, 0, 0] },
                alternateRowStyles: { fillColor: [240, 240, 240] },
            });

            // segunda tabla
            // variables para la tabla2
            // Datos para la tabla2
            const materiasModulo1 = this.materiasModulo1;

            const head2 = [["C", "ASIGNATURA", "DOCENTE", "HORARIO"]];
            // const body2 = [
            //     ["", "CUATRIMESTRAL", "CLAVE DE GRUPO", materiasModulo1],
            // ];

            const body2 = [];

            materiasModulo1.forEach((materia) => {
                body2.push([
                    "",
                    materia.materia,
                    materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            // Crear tabla asignaturas docentes
            doc.autoTable({
                head: head2,
                body: body2,
                startY: 95, // Posición inicial después del encabezado
                theme: "grid",
                styles: { fontSize: 10 },
                headStyles: { fillColor: [255, 0, 0] },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 14 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 5 }, // Ancho específico para la primera columna
                    1: { cellWidth: 47 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 25 }, // Ancho específico para la tercera columna
                    3: { cellWidth: 24 }, // Ancho específico para la cuarta columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                },
            });

            //crear tabla fechas modalidad nocturna y matutina
            const mes1Modulo1 = this.fechasMo1[0];
            const mes2Modulo1 = this.fechasMo1[1];

            const head3 = [
                [
                    //columna 1 meses
                    mes1Modulo1.mes +
                        " " +
                        mes1Modulo1.Martes +
                        " " +
                        mes2Modulo1.mes +
                        " " +
                        mes2Modulo1.Martes,

                    // columna 2 meses
                    mes1Modulo1.mes +
                        " " +
                        mes1Modulo1.Miércoles +
                        " " +
                        mes2Modulo1.mes +
                        " " +
                        mes2Modulo1.Miércoles,

                    //columna 3 meses
                    mes1Modulo1.mes +
                        " " +
                        mes1Modulo1.Jueves +
                        " " +
                        mes2Modulo1.mes +
                        " " +
                        mes2Modulo1.Jueves,
                ],
            ];
            // Datos para el cuerpo de la tabla
            const body3 = [
                ["2", "", ""],
                ["", "2", ""],
                ["", "", "2"],
            ];

            doc.autoTable({
                head: head3,
                body: body3,
                startY: 95, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 27 }, // Ancho específico para la primera columna
                    1: { cellWidth: 27 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 27 }, // Ancho específico para la tercera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 9,
                    rowHeight: 9,
                },
            });

            //crear tabla examenes modulo1

            const head4 = [["ACTIVIDAD", "ASIGNATURA", "HORARIO"]];
            const body4 = [];

            materiasModulo1.forEach((materia) => {
                body4.push([
                    "EXÁMENES",
                    materia.materia,
                    // materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            doc.autoTable({
                head: head4,
                body: body4,
                startY: 138, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 14 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 22 }, // Ancho específico para la primera columna
                    1: { cellWidth: 55 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 24 }, // Ancho específico para la tercera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                    rowHeight: 8,
                },
            });
            //CREAR TABLA FECHAS DE EXAMENES MODULO 1
            const semanaExamenesModulo1 = this.semanaExamenes;
            const head5 = [["FECHAS DE EXÁMENES"]];
            const body5 = [];
            semanaExamenesModulo1.forEach((fecha) => {
                body5.push([fecha.fecha + " de " + fecha.mes]);
            });
            doc.autoTable({
                head: head5,
                body: body5,
                startY: 138, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 81 }, // Ancho específico para la primera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 9,
                    rowHeight: 8,
                },
            });

            //tablas modulo 2
            // Datos para la tabla2
            const materiasModulo2 = this.materiasModulo2;

            const head6 = [["C", "ASIGNATURA", "DOCENTE", "HORARIO"]];
            // const body2 = [
            //     ["", "CUATRIMESTRAL", "CLAVE DE GRUPO", materiasModulo1],
            // ];

            const body6 = [];

            materiasModulo2.forEach((materia) => {
                body6.push([
                    "",
                    materia.materia,
                    materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            // Crear tabla asignaturas docentes
            doc.autoTable({
                head: head6,
                body: body6,
                startY: 182, // Posición inicial después del encabezado
                theme: "grid",
                styles: { fontSize: 10 },
                headStyles: { fillColor: [255, 0, 0] },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 14 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 5 }, // Ancho específico para la primera columna
                    1: { cellWidth: 47 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 25 }, // Ancho específico para la tercera columna
                    3: { cellWidth: 24 }, // Ancho específico para la cuarta columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                },
            });

            //crear tabla fechas modalidad nocturna y matutina
            const mes1Modulo2 = this.fechasMo2[0];
            const mes2Modulo2 = this.fechasMo2[1];

            const head7 = [
                [
                    //columna 1 meses
                    mes1Modulo2.mes +
                        " " +
                        mes1Modulo2.Martes +
                        " " +
                        mes2Modulo2.mes +
                        " " +
                        mes2Modulo2.Martes,

                    // columna 2 meses
                    mes1Modulo2.mes +
                        " " +
                        mes1Modulo2.Miércoles +
                        " " +
                        mes2Modulo2.mes +
                        " " +
                        mes2Modulo2.Miércoles,

                    //columna 3 meses
                    mes1Modulo2.mes +
                        " " +
                        mes1Modulo2.Jueves +
                        " " +
                        mes2Modulo2.mes +
                        " " +
                        mes2Modulo2.Jueves,
                ],
            ];
            // Datos para el cuerpo de la tabla
            const body7 = [
                ["2", "", ""],
                ["", "2", ""],
                ["", "", "2"],
            ];

            doc.autoTable({
                head: head7,
                body: body7,
                startY: 182, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 27 }, // Ancho específico para la primera columna
                    1: { cellWidth: 27 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 27 }, // Ancho específico para la tercera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 9,
                    rowHeight: 9,
                },
            });

            //crear tabla examenes modulo1

            const head8 = [["ACTIVIDAD", "ASIGNATURA", "HORARIO"]];
            const body8 = [];

            materiasModulo2.forEach((materia) => {
                body8.push([
                    "EXÁMENES",
                    materia.materia,
                    // materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            doc.autoTable({
                head: head8,
                body: body8,
                startY: 225, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 5, left: 14 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 22 }, // Ancho específico para la primera columna
                    1: { cellWidth: 55 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 24 }, // Ancho específico para la tercera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                    rowHeight: 8,
                },
            });
            //CREAR TABLA FECHAS DE EXAMENES MODULO 1
            const semanaExamenesModulo2 = this.semanaExamenes2;
            const head9 = [["FECHAS DE EXÁMENES"]];
            const body9 = [];
            semanaExamenesModulo2.forEach((fecha) => {
                body9.push([fecha.fecha + " de " + fecha.mes]);
            });
            doc.autoTable({
                head: head9,
                body: body9,
                startY: 225, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 5, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 81 }, // Ancho específico para la primera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 9,
                    rowHeight: 8,
                },
            });

            // Obtener el PDF como un Data URL
            const pdfDataUrl = doc.output("dataurlstring");

            // Mostrar el PDF en un iframe
            const iframe = document.getElementById("pdfPreview");
            iframe.src = pdfDataUrl;
            // console.log(materiasModulo1);
            // console.log(fechasMo1);
            // console.log(mes1Modulo1);
            // console.log(semanaExamenesModulo2);
        },
        claseEntreSemana: function () {
            dayjs.locale("es");

            

            // Obtener las fechas del modulo 1
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

            // Obtener las fechas del modulo 2
            let currentFecha2 = fechaFin;
            const fechaFin2 = fechaFF;
            const mesesObjetos2 = [];
            const semanaExamenes2 = [];

            while (
                currentFecha2.isBefore(fechaFin2) ||
                currentFecha2.isSame(fechaFin2, "day")
            ) {
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

            console.log(this.semanaExamenes2);
            console.log(fechaFin);
        },

        claseFinDeSemana: function () {
            dayjs.locale("es");
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
        obtenerProfe2: function () {
            // alert("buscando");
            window.axios
                .get(apiProfe)
                .then((response) => {
                    // console.log(response.data);
                    this.todosProfes = [];
                    this.todosProfes = response.data;
                    console.log(this.todosProfes);

                    $(document).ready(function () {
                        $("#dataTableTodos").DataTable({
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
        generarPDF2: function () { //este metodo crea el pdf de las clases sabatinas y dominicales
            const doc = new window.jspdf.jsPDF();

            const data = this.unGrupo;

            // URL de la imagen (puede ser una URL en línea o un Data URL)
            const imgData = "img/pdf/logo.jpeg"; // Aquí va la cadena base64 de tu imagen
            const imgData2 = "img/pdf/nas.jpeg"; // Aquí va la cadena base64 de tu imagen

            // Añadir la imagen al PDF
            doc.addImage(imgData, "JPEG", 40, 20, 30, 30); // (imagen, formato, x, y, ancho, alto)
            doc.addImage(imgData2, "JPEG", 140, 20, 35, 25); // (imagen, formato, x, y, ancho, alto)

            doc.text("UNIVERSIDAD AZTLÁN", 75, 20);
            doc.text("PLANTEL CANCÚN 2", 78, 28);
            doc.text("HORARIO DE CLASES", 76, 36, { fontSize: 8 });
            doc.setFontSize(80); // Cambiar tamaño de fuente global
            doc.setTextColor(53, 39, 131); // Establecer color de texto en RGB (azul)
            doc.text(data.cuatrimestre, 180, 39);

            doc.setFontSize(18); // Cambiar tamaño de fuente global
            doc.setTextColor(53, 39, 131); // Establecer color de texto en RGB (azul)
            doc.text("MÓDULO 1", 18, 93);
            doc.text(data.modalidad,150,93);
            doc.text("MÓDULO 2", 18, 180);
            doc.text(data.modalidad,150,180);
            // doc.text("MÓDULO 1", 40, 107);

            doc.setFontSize(12); // Cambiar tamaño de fuente global
            // doc.setTextColor(53, 39, 131); // Establecer color de texto en RGB (azul)
            doc.text("TOTAL DE CRÉDITOS:     0 CRÉDITOS", 18, 280);
            doc.text(
                "NOTA: Éste horario podrá sufrir cambios sin previo aviso",
                18,
                285
            );
            //crear tabla

            // Datos dinámicos
            const licenciatura = data.name[0].licenciatura;
            const anio = data.anio;
            const turno = data.turno;
            const cuatrimestre = data.cuatrimestre;
            const clave = data.id_grupo;

            // Datos para la tabla
            const head = [["PROGRAMA ACADÉMICO", licenciatura, "CICLO", anio]];
            const body = [
                ["TIPO DE CICLO", "CUATRIMESTRAL", "CLAVE DE GRUPO", clave],
                ["MODALIDAD", "NO ESCOLARIZADA", "AULA"],
                ["TURNO", turno, "CUATRIMESTRE", cuatrimestre],
            ];

            // Crear tabla
            doc.autoTable({
                head: head,
                body: body,
                startY: 55, // Posición inicial después del encabezado
                theme: "grid",
                styles: { fontSize: 8 },
                headStyles: { fillColor: [255, 0, 0] },
                alternateRowStyles: { fillColor: [240, 240, 240] },
            });

            // segunda tabla
            // variables para la tabla2
            // Datos para la tabla2
            const materiasModulo1 = this.materiasModulo1;

            const head2 = [["C", "ASIGNATURA", "DOCENTE", "HORARIO"]];
            // const body2 = [
            //     ["", "CUATRIMESTRAL", "CLAVE DE GRUPO", materiasModulo1],
            // ];

            const body2 = [];

            materiasModulo1.forEach((materia) => {
                body2.push([
                    "",
                    materia.materia,
                    materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            // Crear tabla asignaturas docentes
            doc.autoTable({
                head: head2,
                body: body2,
                startY: 95, // Posición inicial después del encabezado
                theme: "grid",
                styles: { fontSize: 10 },
                headStyles: { fillColor: [255, 0, 0] },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 3 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 5 }, // Ancho específico para la primera columna
                    1: { cellWidth: 47 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 35 }, // Ancho específico para la tercera columna
                    3: { cellWidth: 24 }, // Ancho específico para la cuarta columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                },
            });

            //crear tabla fechas modalidad nocturna y matutina
            const mes1Modulo1 = this.fechasMo1[0];
            const mes2Modulo1 = this.fechasMo1[1];
            const head3 = [];
            mes1Modulo1.sabados.forEach((element) => {
                // console.log(element + " - " + mes1Modulo1.mes);
                head3.push([element + " " + mes1Modulo1.mes.slice(0, 3)]);
            });
            mes2Modulo1.sabados.forEach((element) => {
                head3.push([element + " " + mes2Modulo1.mes.slice(0, 3)]);
            });

            // Datos para el cuerpo de la tabla
            const body3 = [
                ["2", "2", "2", "2", "2", "2", "2"],
                ["2", "2", "2", "2", "2", "2", "2"],
                ["2", "2", "2", "2", "2", "2", "2"],
            ];

            doc.autoTable({
                head: [head3],
                body: body3,
                startY: 95, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 13 }, // Ancho específico para la primera columna
                    1: { cellWidth: 13 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 13 }, // Ancho específico para la tercera columna
                    3: { cellWidth: 13 }, // Ancho específico para la cuarta columna
                    4: { cellWidth: 13 }, // Ancho específico para la quinta columna
                    5: { cellWidth: 13 }, // Ancho específico para la sexta columna
                    6: { cellWidth: 13 }, // Ancho específico para la septima columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 9,
                    minCellHeight: 8,
                },
            });

            //crear tabla examenes modulo1

            const head4 = [["ACTIVIDAD", "ASIGNATURA", "HORARIO"]];
            const body4 = [];

            materiasModulo1.forEach((materia) => {
                body4.push([
                    "EXÁMENES",
                    materia.materia,
                    // materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            doc.autoTable({
                head: head4,
                body: body4,
                startY: 138, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 14 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 22 }, // Ancho específico para la primera columna
                    1: { cellWidth: 55 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 24 }, // Ancho específico para la tercera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                    minCellHeight: 8,
                },
            });
            //CREAR TABLA FECHAS DE EXAMENES MODULO 1
            const semanaExamenesModulo1 = this.semanaExamenes;
            const head5 = [["FECHA DE EXÁMENES"]];
            const body5 = [
                [
                    semanaExamenesModulo1.dia +
                        " de " +
                        semanaExamenesModulo1.mes,
                ],
            ];
            // semanaExamenesModulo1.forEach((fecha) => {
            //     body5.push([fecha.fecha + " de " + fecha.mes]);
            // });
            doc.autoTable({
                head: head5,
                body: body5,
                startY: 138, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: {
                    fillColor: [255, 0, 0],
                    fontSize: 8,
                    minCellHeight: 8,
                },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 81, halign: "center" }, // Ancho específico para la primera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 25,
                    minCellHeight: 24,
                },
            });

            //modulo 2
            const materiasModulo2 = this.materiasModulo2;

            const head6 = [["C", "ASIGNATURA", "DOCENTE", "HORARIO"]];
            // const body2 = [
            //     ["", "CUATRIMESTRAL", "CLAVE DE GRUPO", materiasModulo1],
            // ];

            const body6 = [];

            materiasModulo2.forEach((materia) => {
                body6.push([
                    "",
                    materia.materia,
                    materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            // Crear tabla asignaturas docentes
            doc.autoTable({
                head: head6,
                body: body6,
                startY: 182, // Posición inicial después del encabezado
                theme: "grid",
                styles: { fontSize: 10 },
                headStyles: { fillColor: [255, 0, 0] },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 3 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 5 }, // Ancho específico para la primera columna
                    1: { cellWidth: 47 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 35 }, // Ancho específico para la tercera columna
                    3: { cellWidth: 24 }, // Ancho específico para la cuarta columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                },
            });

            //crear tabla fechas modalidad nocturna y matutina
            const mes1Modulo2 = this.fechasMo2[0];
            const mes2Modulo2 = this.fechasMo2[1];
            const head7 = [];
            mes1Modulo2.sabados.forEach((element) => {
                // console.log(element + " - " + mes1Modulo1.mes);
                head7.push([element + " " + mes1Modulo2.mes.slice(0, 3)]);
            });
            mes2Modulo2.sabados.forEach((element) => {
                head7.push([element + " " + mes2Modulo2.mes.slice(0, 3)]);
            });

            // Datos para el cuerpo de la tabla
            const body7 = [
                ["2", "2", "2", "2", "2", "2", "2"],
                ["2", "2", "2", "2", "2", "2", "2"],
                ["2", "2", "2", "2", "2", "2", "2"],
            ];

            doc.autoTable({
                head: [head7],
                body: body7,
                startY: 182, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 50, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 13 }, // Ancho específico para la primera columna
                    1: { cellWidth: 13 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 13 }, // Ancho específico para la tercera columna
                    3: { cellWidth: 13 }, // Ancho específico para la cuarta columna
                    4: { cellWidth: 13 }, // Ancho específico para la quinta columna
                    5: { cellWidth: 13 }, // Ancho específico para la sexta columna
                    6: { cellWidth: 13 }, // Ancho específico para la septima columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 9,
                    minCellHeight: 8,
                },
            });

            //crear tabla examenes modulo1

            const head8 = [["ACTIVIDAD", "ASIGNATURA", "HORARIO"]];
            const body8 = [];

            materiasModulo2.forEach((materia) => {
                body8.push([
                    "EXÁMENES",
                    materia.materia,
                    // materia.name_profesor,
                    materia.hora + " - " + materia.hora_fin,
                ]);
            });

            doc.autoTable({
                head: head8,
                body: body8,
                startY: 225, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: { fillColor: [255, 0, 0], fontSize: 8 },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 5, left: 14 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 22 }, // Ancho específico para la primera columna
                    1: { cellWidth: 55 }, // Ancho específico para la segunda columna
                    2: { cellWidth: 24 }, // Ancho específico para la tercera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 7,
                    minCellHeight: 8,
                },
            });
            //CREAR TABLA FECHAS DE EXAMENES MODULO 1
            const semanaExamenesModulo2 = this.semanaExamenes2;
            const head9 = [["FECHA DE EXÁMENES"]];
            const body9 = [
                [
                    semanaExamenesModulo2.dia +
                        " de " +
                        semanaExamenesModulo2.mes,
                ],
            ];
            // semanaExamenesModulo1.forEach((fecha) => {
            //     body5.push([fecha.fecha + " de " + fecha.mes]);
            // });
            doc.autoTable({
                head: head9,
                body: body9,
                startY: 225, // Posición inicial después del encabezado
                theme: "grid",

                headStyles: {
                    fillColor: [255, 0, 0],
                    fontSize: 8,
                    minCellHeight: 8,
                },
                alternateRowStyles: { fillColor: [240, 240, 240] },
                tableWidth: "wrap", // Ajustar ancho de la tabla al contenido
                cellWidth: "wrap", // Ajustar ancho de las celdas al contenido
                margin: { top: 50, right: 0, bottom: 5, left: 115 }, // Márgenes de la tabla
                columnStyles: {
                    0: { cellWidth: 81, halign: "center" }, // Ancho específico para la primera columna
                },
                styles: {
                    overflow: "linebreak", // Permitir salto de línea en las celdas
                    fontSize: 25,
                    minCellHeight: 24,
                },
            });

            const pdfDataUrl = doc.output("dataurlstring");

            // Mostrar el PDF en un iframe
            const iframe = document.getElementById("pdfPreview");
            iframe.src = pdfDataUrl;
            console.log(semanaExamenesModulo2);
        },
        claseDominical: function () {
            // alert("Clase Dominical");
            dayjs.locale("es");
            const inicio = this.GrupoFI;
            const fechaInicial = dayjs(inicio);
            const fechaFin = dayjs(this.GrupoFF);

            const DOMINGO = 0;
            const mesesObjetos = [];
            const semanaExamenes = [];

            let fechaActual = fechaInicial;

            while (
                fechaActual.isBefore(fechaFin) ||
                fechaActual.isSame(fechaFin)
            ) {
                if (fechaActual.day() === DOMINGO) {
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
