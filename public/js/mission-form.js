document.addEventListener("DOMContentLoaded", function () {
    const addButton = document.getElementById("add-mission");
    const missionsWrapper = document.getElementById("missions-wrapper");
    let missionIndex = 1;

    addButton.addEventListener("click", () => {
        if (missionIndex >= 10) {
            alert("Você só pode adicionar até 10 questões.");
            return;
        }

        const firstMission = document.querySelector(".mission-block");
        const newMission = firstMission.cloneNode(true);

        // Atualiza o índice
        newMission.setAttribute("data-index", missionIndex);
        newMission.querySelector("h5").textContent = `${missionIndex + 1}/10 Questão`;

        // Atualiza os names dos inputs
        const inputs = newMission.querySelectorAll("input, textarea");
        inputs.forEach(input => {
            const name = input.name.replace(/\[0\]/g, `[${missionIndex}]`);
            input.name = name;
            input.value = "";
        });

        missionsWrapper.appendChild(newMission);
        missionIndex++;
    });
});