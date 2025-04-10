document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.getElementById("add-mission");
    const missionsWrapper = document.getElementById("missions-wrapper");

    let missionIndex = 1; // Começa em 1 porque o primeiro bloco já existe

    addButton.addEventListener("click", () => {
        if (missionIndex >= 10) {
            alert("Você só pode adicionar até 10 questões.");
            return;
        }

        // Seleciona o primeiro bloco como base
        const firstMission = document.querySelector(".mission-block");
        const newMission = firstMission.cloneNode(true);

        // Atualiza os campos com o novo índice
        newMission.setAttribute("data-index", missionIndex);
        newMission.querySelector("h5").textContent = `${missionIndex + 1}/10 Questão`;

        const inputs = newMission.querySelectorAll("input, textarea");

        inputs.forEach(input => {
            // Limpa os valores
            input.value = "";

            // Atualiza os atributos "name"
            if (input.name) {
                input.name = input.name.replace(/\[0\]/g, `[${missionIndex}]`);
            }
        });

        // Adiciona o novo bloco ao wrapper
        missionsWrapper.appendChild(newMission);
        missionIndex++;
    });
});
