<div class="container">
        <h1 class= "card-title"> Escaneando...</h1>
        <div class="row">
            <div class="col-md-12">
                <div id="scanner-container">
                    <!-- El contenido del escáner se inserta aquí -->
                </div>
                <div id="resultado"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="progress-bar-container">
                    <span class="card-text" id="progress-text">0%</span>
                    <div class="progress">
                        <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <button class="btn btn-primary" id="btn">Cancelar</button>
            </div>
        </div>
</div>

    <!-- Include the image-diff library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>

<script>
    var _scannerIsRunning = false;

    var scannedCodes = [];

    function startScanner() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#scanner-container'),
                constraints: {
                    width: 480,
                    height: 320,
                    facingMode: "environment"
                },
            },
            decoder: {
                readers: [
                    "code_128_reader",
                    "ean_reader",
                    "ean_8_reader",
                    "code_39_reader",
                    "code_39_vin_reader",
                    "codabar_reader",
                    "upc_reader",
                    "upc_e_reader",
                    "i2of5_reader"
                ],
                debug: {
                    showCanvas: true,
                    showPatches: true,
                    showFoundPatches: true,
                    showSkeleton: true,
                    showLabels: true,
                    showPatchLabels: true,
                    showRemainingPatchLabels: true,
                    boxFromPatches: {
                        showTransformed: true,
                        showTransformedBox: true,
                        showBB: true
                    }
                }
            },

        }, function (err) {
            if (err) {
                console.log(err);
                return
            }

            console.log("Initialization finished. Ready to start");
            Quagga.start();

            // Set flag to is running
            _scannerIsRunning = true;
        });

        Quagga.onProcessed(function (result) {
            var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

            if (result) {
                if (result.boxes) {
                    drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                    result.boxes.filter(function (box) {
                        return box !== result.box;
                    }).forEach(function (box) {
                        Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                    });
                }

                if (result.box) {
                    Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                }

                if (result.codeResult && result.codeResult.code) {
                    Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                }
            }
        });


        Quagga.onDetected(function (result) {
            //da el resultado en consola
            const code = result.codeResult.code;
            const resultado = document.getElementById('resultado');
            console.log("Código de barras detectado: ", code);

            scannedCodes.push(code);
            
            var progressBar = document.getElementById('progress-bar');
            var progressValue = (scannedCodes.length / 60) * 100;
            progressBar.style.width = progressValue + '%';

            // Actualiza el texto del elemento "progress-text"
            var progressText = document.getElementById('progress-text');
            progressText.textContent = progressValue.toFixed(0) + '%';

            if (scannedCodes.length >= 30) {
                Quagga.stop();

                // Contar las repeticiones de cada valor
                var countMap = {};
                for (var i = 0; i < scannedCodes.length; i++) {
                    var currentCode = scannedCodes[i];
                    if (!countMap[currentCode]) {
                        countMap[currentCode] = 1;
                    } else {
                        countMap[currentCode]++;
                    }
                }

                // Encontrar el valor con más repeticiones
                var mostRepeatedCode = null;
                var maxCount = 0;
                for (var currentCode in countMap) {
                    if (countMap[currentCode] > maxCount) {
                        maxCount = countMap[currentCode];
                        mostRepeatedCode = currentCode; // Cambio "code" por "currentCode"
                    }
                }
                console.log("Count map:", countMap);
                console.log("Most repeated code:", mostRepeatedCode);
                
                setTimeout(function () {
                    var inputbox = document.getElementByID('codigo');
                    inputbox.textContent = mostRepeatedCode;
                    // window.location.href = "../nuevo_producto.php?most_repeated_code=" + mostRepeatedCode;
                }, 2000); // Redirigir a nuevo_producto.php después de 2 segundos
            }

        });
    }


    // Start/stop scanner
    startScanner();
    document.getElementById("btn").addEventListener("click", function () {
        if (_scannerIsRunning) {
            Quagga.stop();
            setTimeout(function () {
                    var inputbox = document.getElementByID('codigo');
                    inputbox.textContent = mostRepeatedCode;
                    //window.location.href = "../nuevo_producto.php?most_repeated_code=" + 0;
                }, 2000); // Redirigir a nuevo_producto.php después de 2 segundos
        } else {
            startScanner();
        }
    }, false);
    startScanner();
</script>