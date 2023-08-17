var idvariante = cantvariantes;
document.addEventListener("DOMContentLoaded", function() {
    var codigoInput = document.getElementById("codigo");
    var campoCompletado = document.getElementById("codigovariante");

    codigoInput.addEventListener("blur", function() {
        var valorCodigo = codigoInput.value;
        campoCompletado.value = valorCodigo + idvariante;
    });
});