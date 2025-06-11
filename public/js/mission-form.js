const MAX_QUESTIONS = 10;
    const MIN_QUESTIONS = 1;

    const questionsContainer = document.getElementById('questions-container');
    const addQuestionButton = document.getElementById('add-question-btn');
    const totalQuestionsInput = document.getElementById('total_questions');
    const questionTemplate = document.getElementById('question-template');

    addQuestionButton.addEventListener('click', addQuestionToForm);

    function addQuestionToForm() {
        const currentQuestionCount = questionsContainer.querySelectorAll('.question-card').length;
        if (currentQuestionCount >= MAX_QUESTIONS) {
            alert('Você atingiu o número máximo de 10 questões.');
            return;
        }
        const newQuestionNode = questionTemplate.firstElementChild.cloneNode(true);
        questionsContainer.appendChild(newQuestionNode);
        updateQuestionIndices();
        updateAddRemoveButtons();
    }

    function removeQuestionFromForm(button) {
        const currentQuestionCount = questionsContainer.querySelectorAll('.question-card').length;
        if (currentQuestionCount <= MIN_QUESTIONS) {
            alert('Deve haver pelo menos 1 questão.');
            return;
        }
        const cardToRemove = button.closest('.question-card');
        if (cardToRemove) {
            cardToRemove.remove();
        }
        updateQuestionIndices();
        updateAddRemoveButtons();
    }

    function updateQuestionIndices() {
        const questionCards = questionsContainer.querySelectorAll('.question-card');
        questionCards.forEach((card, index) => {
            const titleElement = card.querySelector('.question-title');
            if (titleElement) {
                titleElement.textContent = `Questão ${index + 1}`;
            }

            const statementTextarea = card.querySelector('textarea[name*="[statement]"]');
            if (statementTextarea) {
                statementTextarea.name = `questions[${index}][statement]`;
                statementTextarea.id = `questions_${index}_statement`;
                const labelStatement = card.querySelector(`label[for*="_statement"]`);
                if(labelStatement) labelStatement.setAttribute('for', `questions_${index}_statement`);
            }

            const correctAnswerInput = card.querySelector('input[name*="[correct_answer]"]');
            if (correctAnswerInput) {
                correctAnswerInput.name = `questions[${index}][correct_answer]`;
                correctAnswerInput.id = `questions_${index}_correct_answer`;
                const labelCorrectAnswer = card.querySelector(`label[for*="_correct_answer"]`);
                if(labelCorrectAnswer) labelCorrectAnswer.setAttribute('for', `questions_${index}_correct_answer`);
            }

            const explanationTextarea = card.querySelector('textarea[name*="[explanation]"]');
            if (explanationTextarea) {
                explanationTextarea.name = `questions[${index}][explanation]`;
                explanationTextarea.id = `questions_${index}_explanation`;
                const labelExplanation = card.querySelector(`label[for*="_explanation"]`);
                if(labelExplanation) labelExplanation.setAttribute('for', `questions_${index}_explanation`);
            }

            const wrongAnswerInputs = card.querySelectorAll('input[name*="[wrong_answers][]"]');
            wrongAnswerInputs.forEach((input, j) => {
                input.name = `questions[${index}][wrong_answers][]`;
                input.id = `questions_${index}_wrong_answers_${j}`;
            });
        });

        totalQuestionsInput.value = questionCards.length;
    }

    function updateAddRemoveButtons() {
        const questionCards = questionsContainer.querySelectorAll('.question-card');
        questionCards.forEach((card, index) => {
            let removeBtn = card.querySelector('button[onclick*="removeQuestionFromForm"]');
            if (!removeBtn && questionCards.length > 1) {
                removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'text-red-500 hover:text-red-700 text-2xl font-bold leading-none';
                removeBtn.innerHTML = '&times;';
                removeBtn.onclick = function () {
                    removeQuestionFromForm(this);
                };
                const header = card.querySelector('.flex.justify-between');
                if (header) header.appendChild(removeBtn);
            }
        });
    }