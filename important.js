function submitAnswers() {
    document.getElementById("submit-btn").disabled = true;

    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            let userIP = data.ip;

            fetch('http://localhost/quiz/salvar_respostas.php', {

                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ ip: userIP, answers: userAnswers })
            })
            .then(response => response.json())
            .then(result => {
                console.log(result.message);
                localStorage.setItem("quizCompleted", "true");
                disableQuiz();
            })
            .catch(error => console.error("Erro ao salvar:", error));
        });
}
