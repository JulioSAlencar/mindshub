// resources/js/inatividade.js

function iniciarTemporizadorInatividade(tempoInatividade = 5 * 60 * 1000, redirectUrl = "/login") {
    let timeout;

    function encerrarSessaoPorInatividade() {
        alert("Você ficou inativo por muito tempo. A sessão será encerrada.");
        window.location.href = redirectUrl;
    }

    function resetarTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(encerrarSessaoPorInatividade, tempoInatividade);
    }

    // Eventos que reiniciam o temporizador
    window.onload = resetarTimer;
    document.onmousemove = resetarTimer;
    document.onkeypress = resetarTimer;
    document.onclick = resetarTimer;
    document.onscroll = resetarTimer;
}

export default iniciarTemporizadorInatividade;
