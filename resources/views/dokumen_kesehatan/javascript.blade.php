<script type="text/javascript">
    $(() => {
        window.jsPDF = window.jspdf.jsPDF;
        console.log("init")
        HELPER.api = {
            comboAnggota: BASE_URL + 'datakesehatan/comboAnggota',
            generateDoc: BASE_URL + 'dokumen_kesehatan/generate-doc',
        };
        HELPER.createCombo({
            el: ['anggota_id'],
            valueField: 'anggota_id',
            displayField: 'anggota_nama',
            placeholder: '-Pilih Anggota-',
            url: HELPER.api.comboAnggota,
            csrf: $('meta[name="csrf-token"]').attr('content'),
            type: "POST"
        });
    });

    // function generateDoc() {
    //     var formData = new FormData(document.getElementById("form-dokumen"));

    //     $.ajax({
    //         url: HELPER.api.generateDoc,
    //         type: "POST",
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         success: function(data) {
    //             console.log(data);
    //         },
    //         error: function(data) {
    //             console.log(data);
    //         },
    //     });
    // }

    function generateDoc() {
        var formData = new FormData(document.getElementById("form-dokumen"));
        HELPER.block();
        $.ajax({
            url: HELPER.api.generateDoc,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (!response.success) return;

                var dataVitality = [];
                var dataBloodSugar = [];
                var dataCholestrol = [];
                var dataJointAcidity = [];

                var rawData = response.data.properties.data;

                let vitalityCount = 0;
                let bloodSugarCount = 0;
                let cholestrolCount = 0;
                let jointAcidityCount = 0;

                rawData.forEach((element, i) => {
                    if (element.systol_awal) dataVitality.push({
                        systol_awal: element.systol_awal ?? 0,
                        dyastol_awal: element.dyastol_awal ?? 0,
                        dnm_awal: element.dnm_awal ?? 0,
                        systol_pasca: element.systol_pasca ?? 0,
                        dyastol_pasca: element.dyastol_pasca ?? 0,
                        dnm_pasca: element.dnm_pasca ?? 0,
                        order: ++vitalityCount
                    });
                    if (element.gula_darah) dataBloodSugar.push({
                        gula_darah: element.gula_darah,
                        order: ++bloodSugarCount
                    });
                    if (element.kolestrol) dataCholestrol.push({
                        kolestrol: element.kolestrol,
                        order: ++cholestrolCount
                    });
                    if (element.asam_urat) dataJointAcidity.push({
                        asam_urat: element.asam_urat,
                        order: ++jointAcidityCount
                    });
                });

                console.log(dataBloodSugar);
                console.log(dataCholestrol);
                console.log(dataJointAcidity);
                console.log(dataVitality);


                $('#preview').html(response.data.template);

                setTimeout(() => {
                    loadChVitality(dataVitality);
                    loadChBloodSugar(dataBloodSugar);
                    loadChCholestrol(dataCholestrol);
                    loadChJointAcidity(dataJointAcidity);
                }, 250);
            },
            error: function(response) {
                console.log(response)
            },
        });
    }

    function clear() {
        // $('#form-dokumen')[0].reset();
        $('#form-dokumen').trigger("reset");
    }

    function loadChVitality(data) {
        var root = am5.Root.new("ch-vitality");

        root.setThemes([am5themes_Animated.new(root)]);
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0,
                layout: root.verticalLayout
            })
        );

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 0,
            y: am5.percent(100),
            paddingTop: 1,
        });
        var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
                categoryField: "order",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            })
        );
        xRenderer.grid.template.setAll({
            location: 1
        })
        xAxis.data.setAll(data);
        var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                min: 0,
                extraMax: 0.1,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            })
        );

        function createColumnSeries(name, field) {

            var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.columns.template.setAll({
                tooltipY: am5.percent(10),
                templateField: "columnSettings"
            });

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 0.5,
                    sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: am5.percent(50),
                        centerX: am5.percent(50),
                        populateText: true
                    })
                });
            });

            series.data.setAll(data);
        }

        function createLineSeries(name, field) {
            var series = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.strokes.template.setAll({
                strokeWidth: 4,
            });

            series.data.setAll(data);

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Circle.new(root, {
                        strokeWidth: 3,
                        stroke: series.get("stroke"),
                        radius: 5,
                        fill: root.interfaceColors.get("background")
                    })
                });
            });

        }

        createColumnSeries("Systol Awal", "systol_awal");
        createColumnSeries("Dyastol Awal", "dyastol_awal");
        createColumnSeries("DNM Awal", "dnm_awal");
        createLineSeries("Systol Pasca", "systol_pasca");
        createLineSeries("Dyastol Pasca", "dyastol_pasca");
        createLineSeries("DNM Pasca", "dnm_pasca");

        // chart.set("cursor", am5xy.XYCursor.new(root, {}));
        var legend = chart.children.push(
            am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50,
                y: am5.percent(90)
            })
        );
        legend.data.setAll(chart.series.values);

        var annotator = am5plugins_exporting.Annotator.new(root, {});
        annotator.open();
        var marker = null;

        annotator.getMarkerArea().then((value) => {
            value.addEventListener("close", () => {
                HELPER.block();
                setTimeout(() => {
                    html2canvas(document.querySelector("#chart-vitality-container")).then(
                        canvas => {
                            var imgData = canvas.toDataURL('image/png');
                            $('#chart-vitality-container').html(
                                `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                            );
                            HELPER.unblock();
                        });
                }, 500)

                // exporting.exportImage('jpeg').then(function(imgData) {
                //     $('#chart-vitality-container').html(
                //         `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                //     );
                // });
            });
        })

        HELPER.unblock();
    }

    function loadChBloodSugar(data) {
        var root = am5.Root.new("ch-blood-sugar");

        root.setThemes([am5themes_Animated.new(root)]);
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0,
                layout: root.verticalLayout
            })
        );

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 0,
            y: am5.percent(100),
            paddingTop: 1,
        });
        var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
                categoryField: "order",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            })
        );
        xRenderer.grid.template.setAll({
            location: 1
        })
        xAxis.data.setAll(data);
        var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                min: 0,
                extraMax: 0.1,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            })
        );

        function createColumnSeries(name, field) {

            var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.columns.template.setAll({
                tooltipY: am5.percent(10),
                fill: am5.color(0x49eb34)
            });

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 0.5,
                    sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: am5.percent(50),
                        centerX: am5.percent(50),
                        populateText: true
                    })
                });
            });

            series.data.setAll(data);
        }

        function createLineSeries(name, field) {
            var series = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.data.setAll(data);

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Circle.new(root, {
                        strokeWidth: 3,
                        stroke: series.get("stroke"),
                        radius: 5,
                        fill: root.interfaceColors.get("background")
                    })
                });
            });
        }

        createColumnSeries("Gula Darah", "gula_darah");

        // chart.set("cursor", am5xy.XYCursor.new(root, {}));
        // var legend = chart.children.push(
        //     am5.Legend.new(root, {
        //         centerX: am5.p50,
        //         x: am5.p50,
        //         y: am5.percent(90)
        //     })
        // );
        // legend.data.setAll(chart.series.values);

        var annotator = am5plugins_exporting.Annotator.new(root, {});
        annotator.open();
        var marker = null;

        annotator.getMarkerArea().then((value) => {
            value.addEventListener("close", () => {
                HELPER.block();
                setTimeout(() => {
                    html2canvas(document.querySelector("#chart-blood-sugar-container")).then(
                        canvas => {
                            var imgData = canvas.toDataURL('image/png');
                            $('#chart-blood-sugar-container').html(
                                `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                            );
                            HELPER.unblock();
                        });
                }, 500)

                // exporting.exportImage('jpeg').then(function(imgData) {
                //     $('#chart-vitality-container').html(
                //         `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                //     );
                // });
            });
        })

        HELPER.unblock();
    }

    function loadChCholestrol(data) {
        var root = am5.Root.new("ch-cholestrol");

        root.setThemes([am5themes_Animated.new(root)]);
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0,
                layout: root.verticalLayout
            })
        );

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 0,
            y: am5.percent(100),
            paddingTop: 1,
        });
        var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
                categoryField: "order",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            })
        );
        xRenderer.grid.template.setAll({
            location: 1
        })
        xAxis.data.setAll(data);
        var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                min: 0,
                extraMax: 0.1,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            })
        );

        function createColumnSeries(name, field) {

            var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.columns.template.setAll({
                tooltipY: am5.percent(10),
                fill: am5.color(0x245cd4)
            });

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 0.5,
                    sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: am5.percent(50),
                        centerX: am5.percent(50),
                        populateText: true
                    })
                });
            });

            series.data.setAll(data);
        }

        function createLineSeries(name, field) {
            var series = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.data.setAll(data);

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Circle.new(root, {
                        strokeWidth: 3,
                        stroke: series.get("stroke"),
                        radius: 5,
                        fill: root.interfaceColors.get("background")
                    })
                });
            });
        }

        createColumnSeries("Kolestrol", "kolestrol");

        // chart.set("cursor", am5xy.XYCursor.new(root, {}));
        // var legend = chart.children.push(
        //     am5.Legend.new(root, {
        //         centerX: am5.p50,
        //         x: am5.p50,
        //         y: am5.percent(90)
        //     })
        // );
        // legend.data.setAll(chart.series.values);

        var annotator = am5plugins_exporting.Annotator.new(root, {});
        annotator.open();
        var marker = null;

        annotator.getMarkerArea().then((value) => {
            value.addEventListener("close", () => {
                HELPER.block();
                setTimeout(() => {
                    html2canvas(document.querySelector("#chart-cholestrol-container")).then(
                        canvas => {
                            var imgData = canvas.toDataURL('image/png');
                            $('#chart-cholestrol-container').html(
                                `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                            );
                            HELPER.unblock();
                        });
                }, 500)

                // exporting.exportImage('jpeg').then(function(imgData) {
                //     $('#chart-vitality-container').html(
                //         `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                //     );
                // });
            });
        })

        HELPER.unblock();
    }

    function loadChJointAcidity(data) {
        var root = am5.Root.new("ch-joint-acidity");

        root.setThemes([am5themes_Animated.new(root)]);
        var chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                paddingLeft: 0,
                layout: root.verticalLayout
            })
        );

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 0,
            y: am5.percent(100),
            paddingTop: 1,
        });
        var xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
                categoryField: "order",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            })
        );
        xRenderer.grid.template.setAll({
            location: 1
        })
        xAxis.data.setAll(data);
        var yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                min: 0,
                extraMax: 0.1,
                renderer: am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })
            })
        );

        function createColumnSeries(name, field) {

            var series = chart.series.push(
                am5xy.ColumnSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.columns.template.setAll({
                tooltipY: am5.percent(10),
                fill: am5.color(0xced424)
            });

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 0.5,
                    sprite: am5.Label.new(root, {
                        text: "{valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: am5.percent(50),
                        centerX: am5.percent(50),
                        populateText: true
                    })
                });
            });

            series.data.setAll(data);
        }

        function createLineSeries(name, field) {
            var series = chart.series.push(
                am5xy.LineSeries.new(root, {
                    name: name,
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: field,
                    categoryXField: "order",
                })
            );

            series.data.setAll(data);

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Circle.new(root, {
                        strokeWidth: 3,
                        stroke: series.get("stroke"),
                        radius: 5,
                        fill: root.interfaceColors.get("background")
                    })
                });
            });
        }

        createColumnSeries("Asam Urat", "asam_urat");

        // chart.set("cursor", am5xy.XYCursor.new(root, {}));
        // var legend = chart.children.push(
        //     am5.Legend.new(root, {
        //         centerX: am5.p50,
        //         x: am5.p50,
        //         y: am5.percent(90)
        //     })
        // );
        // legend.data.setAll(chart.series.values);

        var annotator = am5plugins_exporting.Annotator.new(root, {});
        annotator.open();
        var marker = null;

        annotator.getMarkerArea().then((value) => {
            value.addEventListener("close", () => {
                HELPER.block();
                setTimeout(() => {
                    html2canvas(document.querySelector("#chart-joint-acidity-container")).then(
                        canvas => {
                            var imgData = canvas.toDataURL('image/png');
                            $('#chart-joint-acidity-container').html(
                                `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                            );
                            HELPER.unblock();
                        });
                }, 500)

                // exporting.exportImage('jpeg').then(function(imgData) {
                //     $('#chart-vitality-container').html(
                //         `<img src="${imgData}" alt="ch-vitality" class="border" style="height: 500px">`
                //     );
                // });
            });
        })

        HELPER.unblock();
    }

    function downloadPDF() {
        var content = $('#preview').html();
        var formData = {
            periode_pemeriksaan: $('#periode_pemeriksaan').val(),
            anggota_id: $('#anggota_id').val(),
            table: content
        };

        HELPER.block();

        $.ajax({
            type: "POST",
            url: BASE_URL + 'dokumen_kesehatan/download-doc',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var link = document.createElement('a')
                link.href = BASE_URL + 'generated' + response.data;
                link.download = response.data.substr(1);

                link.click();
                HELPER.unblock();
            },
        })
    }
</script>
